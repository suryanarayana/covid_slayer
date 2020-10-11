var const_interval;
var const_attack_interval;
var attacks_list                =   [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; //For normal attacks
var power_attacks_list          =   [8, 9, 10]; //For Power Attacks
var player_health_percentage    =   100;
var dragon_health_percentage    =   100;
var commentary_info             =   [];

function showTimer() {
    var display_timer = --timer_seconds_count;

    //If timer is zero - have to disable action buttons
    if(display_timer == 0) {
        disableAttackButtons();
        clearInterval(const_interval);  //Clear the interval
        clearInterval(const_attack_interval);  //Clear the interval
    }

    $("#count_down_timer").html(display_timer);
}

function startGame() {
    //Enable the attack button
    $("#btnAttack").attr('disabled', false);

    //If game is started the button should be disabled.
    $("#btnStart").attr('disabled', true);
    const_interval = setInterval(showTimer, 1000);
}

function startAttack() {
    //Enable the attack button
    $("#btnAttack").attr('disabled', true);
    enableOtherAttackButtons();
    const_attack_interval = setInterval(playerAttack, 1000);
}

function playerAttack() {
    var dragon_attack_val           =   attacks_list[Math.floor(Math.random() * attacks_list.length)]; 
    attackDragon(dragon_attack_val);

    var player_attack_val           =   attacks_list[Math.floor(Math.random() * attacks_list.length)]; 
    attackPlayer(player_attack_val);

    setComentary();
    finishGame(player_health_percentage, dragon_health_percentage);
}

function playerPowerAttack() {
    var dragon_power_attack_val     =   power_attacks_list[Math.floor(Math.random() * power_attacks_list.length)]; 
    attackDragon(dragon_power_attack_val);

    var player_power_attack_val     =   power_attacks_list[Math.floor(Math.random() * power_attacks_list.length)];
    attackPlayer(player_power_attack_val);

    setComentary();
    finishGame(player_health_percentage, dragon_health_percentage);
}

function attackDragon(dragon_attack_val) {
    dragon_health_percentage        =   dragon_health_percentage - dragon_attack_val;
    commentary_info[commentary_info.length] =   player_name + ' Attack the Dragon by ' + dragon_attack_val;
    $("#dragon_percentage").html(dragon_health_percentage);
}

function attackPlayer(player_attack_val) {
    player_health_percentage        =   player_health_percentage - player_attack_val;
    commentary_info[commentary_info.length] =   'Dragon Attack the '+player_name+' by ' + player_attack_val;
    $("#player_percentage").html(player_health_percentage);
}

function playerHeal() {
    var heal_val                    =   attacks_list[Math.floor(Math.random() * attacks_list.length)]; 
    player_health_percentage        =   player_health_percentage + heal_val;
    commentary_info[commentary_info.length] =   player_name + ' healed by ' + heal_val;

    $("#player_percentage").html(player_health_percentage);
    setComentary();
}

function playerGiveUp() {
    disableAttackButtons();

    clearInterval(const_interval);  //Clear the interval
    clearInterval(const_attack_interval);  //Clear the interval

    var winner  =   "Dragon";
    $("#game_result").html("Dragon has one the game");

    var input_data  =   {"UserID":user_id, "Winner":winner, "PlayerHealth":player_health_percentage, "DragonHealth":dragon_health_percentage, "Commentary":commentary_info};

    $.ajax({
        method: "POST",
        url: 'savegame', 
        type: "POST",
        data: input_data,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(app_details) {
            console.log(app_details);
        }
    });

    $("#game_result").html("Dragon has one the game");
}

function finishGame(player_health_percentage, dragon_health_percentage) {
    if(player_health_percentage <= 0 || dragon_health_percentage <= 0) {        
        disableAttackButtons();

        clearInterval(const_interval);  //Clear the interval
        clearInterval(const_attack_interval);  //Clear the interval

        var winner = "";
        if(dragon_health_percentage > player_health_percentage) {
            winner  =   "Dragon";
            $("#game_result").html("Dragon has one the game");
        }
        else if(dragon_health_percentage < player_health_percentage) {
            winner  =   "Player";
            $("#game_result").html(player_name + " has one the game");
        }
        else if(dragon_health_percentage == player_health_percentage) {
            winner  =   "Tie";
            $("#game_result").html("The game is tie");
        }

        var input_data  =   {"UserID":user_id, "Winner":winner, "PlayerHealth":player_health_percentage, "DragonHealth":dragon_health_percentage, "Commentary":commentary_info};

        $.ajax({
            method: "POST",
            url: 'savegame', 
            type: "POST",
            data: input_data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(app_details) {
                console.log(app_details);
            }
        });
    }   
}

function enableOtherAttackButtons() {
    $("#btnBlast, #btnHeal, #btnGiveUp").attr('disabled', false);
}

function enableAllAttackButtons() {
    $("#btnAttack, #btnBlast, #btnHeal, #btnGiveUp").attr('disabled', false);
}

function disableAttackButtons() {
    $("#btnAttack, #btnBlast, #btnHeal, #btnGiveUp").attr('disabled', true);
}

function setComentary() {
    var commentary_length   =   commentary_info.length;
    var commentaries        =   "";
    for(i = (commentary_length - 1); i >= 0; i--) {
        commentaries += commentary_info[i]+"<br>";
    }

    $("#commentary_box").html(commentaries);
}