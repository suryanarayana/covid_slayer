@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header"><h5>Games List</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ url('/startgame') }}">Create New Game</a><br><br>
                    
                    <?php
                    if(isset($games)) {
                        ?>
                        Games List:
                        <table class="table table-bordered">
                        <tr>
                            <td>Player Health</td>
                            <td>Dragon Health</td>
                            <td>Winner</td>
                            <td>Commentary</td>
                            <td>Created Date Time</td>
                        </tr>
                        <?php
                        for($g = 0; $g < count($games); $g++) {
                            ?>
                            <tr>
                                <td><?php echo $games[$g]->player_health_percentage; ?></td>
                                <td><?php echo $games[$g]->dragon_health_percentage; ?></td>
                                <td><?php echo $games[$g]->winner; ?></td>
                                <td>
                                    <div style="max-height: 50px;overflow-y: scroll;">
                                    <?php
                                        $commentaries_list  =   json_decode($games[$g]->commentary, true);
                                        for($c = 0; $c < count($commentaries_list); $c++) {
                                            echo $commentaries_list[$c]."<br>";
                                        }
                                        ?>
                                    </div>    
                                </td>
                                <td><?php echo $games[$g]->created_date_time; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
