<?php

namespace App\Http\Controllers;

use App\Record;
use App\Action;
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

        //$actions = Action::orderby('id')->get();

        $user_id = Auth::user()->id;

        $actions = Action::where('user_id', $user_id)->get();

        //$historic = DB::select("SELECT * FROM actions where user_id = {$user_id} ORDER BY created_at DESC");

        $shared = DB::select("SELECT * FROM materials where user_id = {$user_id} ORDER BY created_at DESC");

        $commented = DB::select("SELECT * FROM comments where user_id = {$user_id} ORDER BY created_at DESC");

        return view('dashboard', [
            'actions' => $actions,
            'shared' => $shared,
            'commented' => $commented
            ]);
    }
}
