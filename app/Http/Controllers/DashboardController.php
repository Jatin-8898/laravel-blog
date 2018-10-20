<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $user_id = auth()->user()->id;      //Get the id from the auth
        $user = User::find($user_id);       //Find this id in the users table
        
        return view('dashboard')->with('posts', $user->posts);      //calling post() in User Model
    }
}
