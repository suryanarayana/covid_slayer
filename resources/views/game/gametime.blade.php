@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header"><h5>Configure Game Time</h5></div>

                <div class="card-body">
                    <form name="frmConfigureGameTime" id="frmConfigureGameTime" action="{{ url('/save_game_time') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                            Game Time: <br><br>
                            <?php
                            if(isset($message_info['success_message'])) {
                                echo "<span style='color:red'>".$message_info['success_message']."</span><br>";
                            }
                            ?>
                            <input id="game_time" type="number" name="game_time" value="<?php echo Auth::user()->game_time; ?>" required><br><br>
                            <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
