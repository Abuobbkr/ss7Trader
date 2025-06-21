<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Signal;
use Illuminate\Http\Request;

class SignalController extends Controller
{
    public function index()
    {
        $signals = Signal::orderBy("created_at", "desc")->paginate(4); // 10 per page
        // dd("", $signals);
        return view("frontend.index", compact("signals"));
    }
}
