@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header"><h5>New Game</h5></div>

                <div class="card-body">
                    <form name="frmNewGame" id="frmNewGame" method="post">
                        <div class="row">
                            <div class="col-lg-6" id="game_result">

                            </div>
                            <div class="col-lg-6" id="new_game_link">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <td align="left" width="50%"><input type="button" name="btnStart" id="btnStart" onclick="startGame()" class="btn btn-primary" value="START GAME"></td>
                                        <td align="right"><div id="count_down_timer">60</div> Seconds</td>
                                    </tr>

                                    <tr>
                                        <td align="left"><?php echo Auth::user()->name ?></td>
                                        <td align="right">Dragon</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <div id="player" class="col-md-6 box">
                                                    <span id="player_percentage">100</span> %
                                                </div>
                                                <div id="dragon" class="col-md-6 box">
                                                    <span id="dragon_percentage">100</span> %
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <input type="button" name="btnAttack" id="btnAttack" class="btn btn-primary" disabled="disabled" onclick="startAttack()" value="ATTACK">
                                            &nbsp;<input type="button" name="btnBlast" id="btnBlast" class="btn btn-primary" disabled="disabled" onclick="playerPowerAttack()" value="BLAST">
                                            &nbsp;<input type="button" name="btnHeal" id="btnHeal" class="btn btn-primary" disabled="disabled" onclick="playerHeal()" value="HEAL">
                                            &nbsp;<input type="button" name="btnGiveUp" id="btnGiveUp" class="btn btn-primary" disabled="disabled" onclick="playerGiveUp()" value="GIVE UP">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">Commentary Box</div>
                                </div>    
                                <div class="row">
                                    <div class="col-lg-12" id="commentary_box"></div>
                                </div>    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var player_name                 =   '<?php echo Auth::user()->name ?>';
var user_id                     =   '<?php echo Auth::user()->id ?>';
var timer_seconds_count         =   '<?php echo Auth::user()->game_time ?>';

</script>
<script src="js/game.js" type="text/javascript"></script>
@endsection
