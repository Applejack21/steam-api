<?php

namespace App\Http\Controllers\Api;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\User;
use Validator;

use App\Repositories\SteamRepository;

class GeneralController extends Controller
{
    private $success_status = 200;
    private $fail_status = 400;
    private $unauthorised_status = 401;
    private $error_status = 500;
    
    public function __construct(SteamRepository $steam)
    {
        $this->steam = $steam;
    }
    
    public function findSteamId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'steam_id' => 'required'
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->fail_status);
        } else {
            $find_steam_id = $this->steam->findSteamId($request);
            if(!$find_steam_id) {
                return response()->json(['success' => false], $this->error_status);
            } else {
                return response()->json(['success' => true, 'steam_data' => $find_steam_id], $this->success_status);
            }
        }
    }
}
