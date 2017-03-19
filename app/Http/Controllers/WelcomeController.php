<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Content;

class WelcomeController extends Controller
{
    public function index()
    {
    	$contents = Content::orderby('name')->get();
        return view('welcome', ['contents' => $contents]);
    }
}
