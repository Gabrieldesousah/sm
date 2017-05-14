<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $historic = DB::select("SELECT DISTINCT file_id, action FROM actions where user_id = {$user_id} ORDER BY created_at DESC");

        $shared = DB::select("SELECT * FROM materials where user_id = {$user_id} ORDER BY created_at DESC");

        $commented = DB::select("SELECT * FROM comments where user_id = {$user_id} ORDER BY created_at DESC");

        return view('dashboard', [
            'historic' => $historic,
            'shared' => $shared,
            'commented' => $commented
            ]);
    }
}
