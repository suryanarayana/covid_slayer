<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id    =   Auth::id();
        $games      =   DB::table('games')->where('user_id', $user_id)->get()->toArray();
        return view('home', ['games' => $games]);
    }

    /**
     * @method  configureGameTime
     */
    public function configureGameTime() {
        return view('game.gametime');
    }

    /**
     * @method  saveGameTime
     */
    public function saveGameTime() {

        $user_id        =   Auth::id();
        DB::table('users')->where('id', $user_id)->update(['game_time' => $_POST['game_time']]);

        $message_info   =   ["success_message"=>"Successfully updated the game time."];

        return redirect()->route('game_time');
        //return view('game.gametime', ['message_info'=>$message_info]);
    }
}
