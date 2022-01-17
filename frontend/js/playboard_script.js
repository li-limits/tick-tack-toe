$(document).ready(function(){

    var state = 0;

    var start_request = $.ajax({
      url:'/backend/wins_check.php',
      dataType:'json',
      success:function(data){
        $('#creator_wins').html("Победы " + data.creator + ": " + data.creator_wins);
        if (data.player != NULL) {
          $('#player_wins').html("Победы " + data.player + ": " + data.player_wins);
        }
      }
    })

    $('.cell_front').each(function(){
      $(this).hide();
    })

    function draw_board() {
      var request = $.ajax({
        url:'/backend/draw_board.php',
        dataType:'json',
        success:function(data){
            $('#cell_1').html(data.cell_1);
            if (data.cell_1 != null) {
              $('#cell_front-1').show();
            }
            $('#cell_2').html(data.cell_2);
            if (data.cell_2 != null) {
              $('#cell_front-2').show();
            }
            $('#cell_3').html(data.cell_3);
            if (data.cell_3 != null) {
              $('#cell_front-3').show();
            }
            $('#cell_4').html(data.cell_4);
            if (data.cell_4 != null) {
              $('#cell_front-4').show();
            }
            $('#cell_5').html(data.cell_5);
            if (data.cell_5 != null) {
              $('#cell_front-5').show();
            }
            $('#cell_6').html(data.cell_6);
            if (data.cell_6 != null) {
              $('#cell_front-6').show();
            }
            $('#cell_7').html(data.cell_7);
            if (data.cell_7 != null) {
              $('#cell_front-7').show();
            }
            $('#cell_8').html(data.cell_8);
            if (data.cell_8 != null) {
              $('#cell_front-8').show();
            }
            $('#cell_9').html(data.cell_9);
            if (data.cell_9 != null) {
              $('#cell_front-9').show();
            }
        }
      })
    }

    setInterval(function(){
      var request = $.ajax({
        url:"/backend/check_enemy.php"
      })

      request.done(function(response, textStatus, jqXHR){
        $('#enemy_info').html("Ваш оппонент: " + response);
      })
    }, 4000);

    setInterval(function(){
      var request = $.ajax({
        url: "/backend/check_field.php",
        type: "post"
      });

      request.done(function(response, textStatus, jqXHR){
        if (state == 0) {
          if (response == 'x' || response == 'o'){
            draw_board();
            state = 1;
            var win_request = $.ajax({
              url:"/backend/player_win.php",
            })
  
            win_request.done(function(response, textStatus, jqXHR){
              $('.cells_front').show();
              $('.button_restart').css('display', 'flex');
              setTimeout(function(){
                var info_request = $.ajax({
                  url:'/backend/wins_check.php',
                  dataType:'json',
                  success:function(data){
                    $('#creator_wins').html("Победы " + data.creator + ": " + data.creator_wins );
                    $('#player_wins').html("Победы " + data.player + ": " + data.player_wins);
                  }
                })
              }, 1500);
            })
          }
          else {
            var period_request = $.ajax({
              url:"/backend/check_state.php"
          })
  
          period_request.done(function(response, textStatus, jqXHR){
              if (response == '1'){
                  $('.cells_front').hide();
                  $('#player_turn').html("Ваш ход!");
                  draw_board();
              }
              else if (response == '0'){
                $('#player_turn').html("Ход оппонента!");
                  draw_board();
              }
          })
          }
        }
      })
        /*if (state == 0) {
          var period_request = $.ajax({
            url:"/backend/check_state.php"
        })

        period_request.done(function(response, textStatus, jqXHR){
            if (response == '1'){
                $('.cells_front').hide();
                $('#player_turn').html("Ваш ход!");
                draw_board();
            }
            else if (response == '0'){
              $('#player_turn').html("Ход оппонента!");
                draw_board();
            }
        })

        var request = $.ajax({
          url: "/backend/check_field.php",
          type: "post"
        });

        request.done(function(response, textStatus, jqXHR){
          if (response == 'x' || response == 'o'){
            state = 1;
            var win_request = $.ajax({
              url:"/backend/player_win.php",
            })

            win_request.done(function(response, textStatus, jqXHR){
              $('.cells_front').show();
              $('.button_restart').css('display', 'flex');
              setTimeout(function(){
                var info_request = $.ajax({
                  url:'/backend/wins_check.php',
                  dataType:'json',
                  success:function(data){
                    $('#creator_wins').html("Победы " + data.creator + ": " + (data.creator_wins / 2));
                    $('#player_wins').html("Победы " + data.player + ": " + (data.player_wins / 2));
                  }
                })
              }, 1500);
            })
          }
        })
      }*/

    }, 300);

    $(".cell").click(function(){
        $cell = $(this);
        var request = $.ajax({
          url: "/backend/player_move.php",
          type: "post",
          data: {id: $cell.attr('id')}
        });

        request.done(function(response, textStatus, jqXHR){
          if (response == 'X'){
            $cell.html("X");
          }
          else if (response == 'O'){
            $cell.html("O");
          }
          var $num = $cell.attr('id').split('_')[1];
          var $cell_front = '#cell_front-' + $num;
          
          $($cell_front).show();
          $('.cells_front').show();
        });
      });
    
    $('.button_restart').click(function(){

        $('.cell_front').each(function(){
          $(this).hide();
        })
        var request = $.ajax({
          url:'/backend/button_restart_click.php',
          type:'post'
        })

        request.done(function(response, textStatus, jqXHR){
          if (response == 1) {
            state = 2;
            $('#enemy_wait').html("Ожидаем оппонента!");
          }
          else if (response == 2) {
            state = 0;
          }
        })
        $(this).css('display', 'none');
    })

    setInterval(function(){
      if(state == 2){
        var request = $.ajax({
          url:'/backend/waiting_second_restart.php',
          type:'post'
        })

        request.done(function(response, textStatus, jqXHR){
          if (response == 2) {
            state = 0;
            $('#enemy_wait').html("");
          }
        })
      }
    }, 1000)

    $(window).on("beforeunload", function(event){
        request = $.ajax({
            url:'/backend/player_left.php'
        })
    })
})