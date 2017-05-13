<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        $user = User::find($user->id);
        return view('auth.edit')->with('user', $user);
    }
    public function editpass(User $user)
    {
        $user = Auth::user();

        $user = User::find($user->id);
        return view('auth.passwords.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        
        $user->password = bcrypt($request->password);

        if( $user->save() ){
            return redirect('dashboard')->with('status_user', 'Dados atualizados');  
        }
    }
    public function updatePass(Request $request, User $user)
    {
        $user = User::find(Auth::user()->id);
        
        $user->password = bcrypt($request->password);

        if( $user->save() ){
            return redirect('dashboard')->with('status_user', 'Senha atualizada');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
