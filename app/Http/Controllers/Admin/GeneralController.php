<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Spatie\Analytics\Period;
use GuzzleHttp\Client;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;

use Analytics;
use Validator;

class GeneralController extends Controller
{
    //Homepage
    public function getHomepage()
    {
        return view('homepage');
    }
}
