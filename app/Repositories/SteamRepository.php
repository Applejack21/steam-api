<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SteamRepository
{
    public function findSteamId($request)
    {
        $steam_id = $request->steam_id;
        $api_key = env('STEAM_API_KEY');
        $api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$api_key."&steamids=".$steam_id;
        $steam_countries_json = 'public/json/steam_countries.min.json';
        
        $json_decode = json_decode(file_get_contents($api_url),true);

        if(!empty($json_decode['response'])) {
            $response_array = $json_decode['response'];
            if(!empty($response_array['players'])) {
                foreach($response_array['players'] as $player) {
                    
                    $user_location_coordinates = ""; //just incase the user doesnt have a state/city displayed on their profile
                    
                    //get all the information about the user that we need - https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0002.29
                    
                    if(isset($player['personaname'])) {
                        $user_persona_name = $player['personaname']; //their steam profile name
                    } else {
                        $user_persona_name = "";
                    }
                    
                    if(isset($player['avatarfull'])) {
                        $user_avatar = $player['avatarfull']; //their steam avatar
                    } else {
                        $user_avatar = "";
                    }
                    
                    if(isset($player['personastate'])) {
                        $user_persona_state = $player['personastate']; //their steam status (online/offline) - more persona states can be find in the api doc above
                        if($user_persona_state >= 1) {
                            $user_persona_state = "Online"; //just use online for now, keep it simple.
                        } else {
                            $user_persona_state = "Offline";
                        }
                    } else {
                        $user_persona_state = "";
                    }
                                    
                    if(isset($player['realname'])) {
                        $user_real_name = $player['realname']; //their steam "real name"
                    } else  {
                        $user_real_name = "";
                    }
                    
                    if(isset($player['timecreated'])) {
                        $unix_time_created = $player['timecreated']; //seconds since unix time they made their steam account
                        $user_time_created = gmdate("dS F Y", $unix_time_created); //converted to date.
                        $user_time_created_full = gmdate("dS F Y - H:i:s", $unix_time_created); //full created date and time
                    } else {
                        $user_time_created = "";
                        $user_time_created_full = "";
                    }
                    
                    if(isset($player['loccountrycode'])) {  
                        $user_country_code = $player['loccountrycode']; //their country code
                        $user_country_name = locale_get_display_region('-'.$user_country_code,'en'); //their country name
                    } else {
                        $user_country_code = "";
                        $user_country_name = "";
                    }
                    
                    if(isset($player['locstatecode'])) {
                        $user_state_code = $player['locstatecode']; //their state code
                        
                        $steam_countries = json_decode(file_get_contents(base_path($steam_countries_json)),true);
                        $user_state_name = $steam_countries[$user_country_code]['states'][$user_state_code]['name']; //name of the town they're in. the user has to have a country code to pick a state location on their steam profile
                        $user_location_coordinates = $steam_countries[$user_country_code]['states'][$user_state_code]['coordinates'];
                    } else {
                        $user_state_name = "";
                    }
                    
                    if(isset($player['loccityid'])) {
                        $user_city_id = $player['loccityid']; //their city id
                        
                        $steam_countries = json_decode(file_get_contents(base_path($steam_countries_json)),true);
                        $user_city_name = $steam_countries[$user_country_code]['states'][$user_state_code]['cities'][$user_city_id]['name']; //name of the city they're in. the user has to have a statecode and a countrycode to pick a city location on their steam profile
                        $user_location_coordinates = $steam_countries[$user_country_code]['states'][$user_state_code]['cities'][$user_city_id]['coordinates'];
                    } else {
                        $user_city_name = "";
                    }
             
                    if(isset($player['gameextrainfo'])) {
                        $user_current_game = $player['gameextrainfo']; //name of the current game they're playing
                        $user_current_game_id = $player['gameid']; //the id of the game they're playing
                    } else {
                        $user_current_game = "";
                        $user_current_game_id = "";
                    }
                    
                    $json_data[] = array(
                        'json_person_name' => $user_persona_name,
                        'json_avatar_full' => $user_avatar,
                        'json_persona_state' => $user_persona_state,
                        'json_real_name' => $user_real_name,
                        'json_time_created' => $user_time_created,
                        'json_time_created_full' => $user_time_created_full,
                        'json_country_code' => $user_country_code,
                        'json_country_name' => $user_country_name,
                        'json_state_name' => $user_state_name,
                        'json_city_name' => $user_city_name,
                        'json_location_coordinates' => $user_location_coordinates,
                        'json_current_game' => $user_current_game,
                        'json_current_game_id' => $user_current_game_id
                    );
                }
                return $json_data; 
            } else {
                return;
            }
        }
    }
}

?>