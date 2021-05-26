<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Repositories\SteamIDParse;

class SteamRepository
{
    
    public function findSteamId($request)
    {
        $json_data = array();
        $steam_id = $request->steam_id; //users search id/url
        $api_key = env('STEAM_API_KEY');
        $steam_countries_json = 'public/json/steam_countries.min.json';
        
        //take the url the user entered and change it to steamid64, if steamid64 was entered then this will essentially do nothing
        SteamID::SetSteamAPIKey($api_key);
        $steam_id_parse = SteamID::Parse($steam_id, SteamID::FORMAT_AUTO, true );
        $steam_id = $steam_id_parse->Format(SteamID::FORMAT_STEAMID64);
        
        $json_data["json_steam_id64"] = $steam_id; //add steam id64 into the array
        
        $api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$api_key."&steamids=".$steam_id;
        $frame_api_url = "https://api.steampowered.com/IPlayerService/GetAvatarFrame/v1/?key=".$api_key."&steamid=".$steam_id;

        $json_decode = json_decode(file_get_contents($api_url),true);

        if(!empty($json_decode['response'])) {
            $response_array = $json_decode['response'];
            if(!empty($response_array['players'])) {
                foreach($response_array['players'] as $player) {
                    
                    $user_location_coordinates = ""; //just incase the user doesnt have a state/city displayed on their profile
                    
                    //get all the information about the user that we need - https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0002.29
                    
                    //publically available data
                    
                    $steam_frame_json = json_decode(file_get_contents($frame_api_url),true);

                    if(!empty($steam_frame_json['response'])) {
                        $avatar_response = $steam_frame_json['response'];
                        if(!empty($avatar_response['avatar_frame'])) {
                            $avatar_frame = $avatar_response['avatar_frame']['image_small'];
                            $avatar_frame_url = "https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/".$avatar_frame;
                            $json_data["json_avatar_frame"] = $avatar_frame_url;
                        }
                    }
                    
                    if(isset($player['personaname'])) {
                        $json_data["json_person_name"] = $player['personaname']; //their steam profile name
                    }
                    
                    if(isset($player['avatarfull'])) {
                        $json_data["json_avatar_full"] = $player['avatarfull']; //their steam avatar
                    }
                    
                    if(isset($player['personastate'])) {
                        $user_persona_state = $player['personastate']; //their steam status (online/offline) - more persona states can be find in the api doc above
                        if($user_persona_state >= 1) {
                            $user_persona_state = "Online"; //just use online for now, keep it simple.
                            $json_data["json_persona_state"] = $user_persona_state;
                        } else {
                            $user_persona_state = "Offline";
                            $json_data["json_persona_state"] = $user_persona_state;
                        }
                    }
                    
                    if(isset($player['communityvisibilitystate'])) {
                        $user_visibility_state = $player['communityvisibilitystate'];
                        $json_data["json_visibility_state"] = $user_visibility_state;
                    }
                         
                    //private data (can only see this if they're profile is public aka = 3)
                    
                    if($user_visibility_state === 3) {
                    
                        if(isset($player['realname'])) {
                            $json_data["json_real_name"] = $player['realname']; //their steam "real name"
                        } 
                    
                        if(isset($player['timecreated'])) {
                            $unix_time_created = $player['timecreated']; //seconds since unix time they made their steam account
                            $user_time_created = gmdate("jS F Y", $unix_time_created); //converted to date.
                            $user_time_created_full = gmdate("jS F Y - H:i:s", $unix_time_created); //full created date and time
                            
                            $json_data["json_time_created"] = $user_time_created;
                            $json_data["json_time_created_full"] = $user_time_created_full;
                        }
                    
                        if(isset($player['loccountrycode'])) {  
                            $user_country_code = $player['loccountrycode']; //their country code
                            $user_country_name = locale_get_display_region('-'.$user_country_code,'en'); //their country name
                            
                            $json_data["json_country_code"] = $user_country_code;
                            $json_data["json_country_name"] = $user_country_name;
                        } 
                    
                        if(isset($player['locstatecode'])) {
                            $user_state_code = $player['locstatecode']; //their state code
                        
                            $steam_countries = json_decode(file_get_contents(base_path($steam_countries_json)),true);
                            $user_state_name = $steam_countries[$user_country_code]['states'][$user_state_code]['name']; //name of the town they're in. the user has to have a country code to pick a state location on their steam profile
                            $user_location_coordinates = $steam_countries[$user_country_code]['states'][$user_state_code]['coordinates'];
                            
                            $json_data["json_state_name"] = $user_state_name;
                            $json_data["json_location_coordinates"] = $user_location_coordinates;
                        }
                    
                        if(isset($player['loccityid'])) {
                            $user_city_id = $player['loccityid']; //their city id
                        
                            $steam_countries = json_decode(file_get_contents(base_path($steam_countries_json)),true);
                            $user_city_name = $steam_countries[$user_country_code]['states'][$user_state_code]['cities'][$user_city_id]['name']; //name of the city they're in. the user has to have a statecode and a countrycode to pick a city location on their steam profile
                            $user_location_coordinates = $steam_countries[$user_country_code]['states'][$user_state_code]['cities'][$user_city_id]['coordinates'];
                            
                            $json_data["json_city_name"] = $user_city_name;
                            $json_data["json_location_coordinates"] = $user_location_coordinates; //this will replace the "locstatecode" coordinates instead
                        }
             
                        if(isset($player['gameextrainfo'])) {
                            $user_current_game = $player['gameextrainfo']; //name of the current game they're playing
                            $user_current_game_id = $player['gameid']; //the id of the game they're playing
                            $user_current_game_image = "https://steamcdn-a.akamaihd.net/steam/apps/".$user_current_game_id."/header.jpg"; //store image of current game
                            
                            $json_data["json_current_game_name"] = $user_current_game;
                            $json_data["json_current_game_id"] = $user_current_game_id;
                            $json_data["json_current_game_image"] = $user_current_game_image;
                        }
                        
                        if(isset($player['lobbysteamid'])) {
                            $user_current_game_lobby_id = $player['lobbysteamid']; //the id of the lobby they're in
                            
                            $json_data["json_current_game_lobby_id"] = $user_current_game_lobby_id;
                        }
                        
                        if(isset($player['gameserverip'])) {
                            $user_current_game_server_ip = $player['gameserverip']; //the ip of the server they're in
                            
                            $json_data["json_current_game_server_ip"] = $user_current_game_server_ip;
                        }
                    }
                }
                return $json_data; 
            } else {
                return;
            }
        }
    }
    
    public function findRecentGames($request)
    {        
        $json_data = array();
        $steam_id = $request->steam_id; //searched users steamid64
        $api_key = env('STEAM_API_KEY');
                
        $api_url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=".$api_key."&steamid=".$steam_id;

        $json_decode = json_decode(file_get_contents($api_url),true);
        
        if(!empty($json_decode['response'])) {
            $response_array = $json_decode['response'];
            if(!empty($response_array['games'])) {
                $array_count = count($response_array['games']);
                for ($i = 0; $i < $array_count; $i++) {
                    //url for achievements: http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v1/?appid=730&key=EFEF71BF15A24DA73EAD88291274E32D&steamid=76561198043959584&l=en
                    
                    $app_id = $response_array['games'][$i]['appid']; //game app id
                    $game_name = $response_array['games'][$i]['name']; //game name
                    $recent_hours = $response_array['games'][$i]['playtime_2weeks']; //hours in minutes
                    $total_hours = $response_array['games'][$i]['playtime_forever']; //hours in minutes
                    $game_image = "https://steamcdn-a.akamaihd.net/steam/apps/".$app_id."/header.jpg";
                    
                    $recent_hours = $recent_hours / 60; //get hours
                    $total_hours = $total_hours / 60; //get hours
                    
                    $recent_hours = number_format($recent_hours, 1); //convert to 1 decimal place
                    $total_hours = round($total_hours); //round to near whole number
                    
                    $json_data[$i]["json_game_id"] = $app_id;
                    $json_data[$i]["json_game_image"] = $game_image;
                    $json_data[$i]["json_game_name"] = $game_name;
                    $json_data[$i]["json_recent_hours"] = $recent_hours;
                    $json_data[$i]["json_total_hours"] = $total_hours;
                }
                return $json_data; 
            } else {
                $json_data["json_none_found"] = "none";
                return $json_data;
            }
        } else {
            $json_data["json_none_found"] = "non";
            return $json_data;
        }
    }
}

?>