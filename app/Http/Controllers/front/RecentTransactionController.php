<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecentTransactionController extends Controller
{
    public function getViewIndex() {
        return view('frontend/recent_transaction');
    }
}
