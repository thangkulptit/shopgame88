<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RechargeCard extends Controller
{
    public function index(){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://shopacclmht69.com/testapi.php');
        $response = $request->getBody();
        $response = json_decode($response);
        if ($response->status == 200) {
            return $response->msg;
        }
    }
    
}

