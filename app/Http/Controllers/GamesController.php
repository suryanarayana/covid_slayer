<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GamesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id    =   Auth::id();
        $games      =   DB::table('games')->where('user_id', 1)->get();

        return view('home', ['games' => $games]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGame()
    {
        return view('game.startgame');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveGame(Request $request)
    {
        $data       =   $request->all();
        
        $game_info  =   DB::table('games')->insert(
            ['user_id' => $data['UserID'], 'player_health_percentage' => $data['PlayerHealth'], 'dragon_health_percentage' => $data['DragonHealth'], 'winner' => $data['Winner'], 'commentary' => json_encode($data['Commentary']), 'created_date_time'=>date('Y-m-d H:i:s')]
        );

        $id = DB::getPdo()->lastInsertId();

        $file = fopen(public_path() ."/logs/". $data['UserID'] . '-'. $id . '.log',"w+");
        fwrite($file, json_encode($data['Commentary']));
        fclose($file);

    
        if($game_info == 1) {
            return "Game saved successfully";
        }
        else {
            return "Failed to save the game.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
