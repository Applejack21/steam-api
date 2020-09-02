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
    
        $json_decode = json_decode(file_get_contents($api_url),true);
        
        if(!empty($json_decode['response'])) {
            $response_array = $json_decode['response'];
            if(!empty($response_array['players'])) {
                foreach($response_array['players'] as $player) {
                    $json_data[] = array(
                        'json_person_name' => $player['personaname'],
                        'json_avatar_full' => $player['avatarfull'],
                        'json_persona_state' => $player['personastate'],
                        'json_real_name' => $player['realname'],
                        'json_time_created' => $player['timecreated'], //seconds since unix time
                        'json_country_code' => $player['loccountrycode']
                    );
                }
            }
        }
        return $json_data;
    }
}

?>