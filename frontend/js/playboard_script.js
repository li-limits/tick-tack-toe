$(document).ready(function(){

    var state = 0;

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
        if (state == 0) {
          var period_request = $.ajax({
            url:"/backend/check_state.php"
        })

        period_request.done(function(response, textStatus, jqXHR){
            if (response == '1'){
                $('.cells_front').hide();
                draw_board();
            }
            else if (response == '0'){
                draw_board();
            }
        })

        var request = $.ajax({
          url: "/backend/check_field.php",
          type: "post"
        });

        request.done(function(response, textStatus, jqXHR){
          if (response == 'x'){
            state = 1;
            var win_request = $.ajax({
              url:"/backend/player_win.php",
              type:"post",
              data: {sign:'x'}
            })

            win_request.done(function(response, textStatus, jqXHR){
              $('.cells_front').show();
              $('.button_restart').css('display', 'flex');
            })
          }
          else if (response == 'o') {
            state = 1;
            var win_request = $.ajax({
              url:"/backend/player_win.php",
              type:"post",
              data: {sign:'o'}
            })

            win_request.done(function(response, textStatus, jqXHR){
              $('.cells_front').show();
              $('.button_restart').css('display', 'flex');
            })
          }
        })
      }

    }, 100);

    $(".cell").click(function(){
        $cell = $(this);
        var request = $.ajax({
          url: "/backend/player_move.php",
          type: "post",
          data: {id: $cell.attr('id')}
        });

        request.done(function(response, textStatus, jqXHR){
          if (response == 'x'){
            $cell.html("x");
          }
          else if (response == 'o'){
            $cell.html("o");
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
            alert("Ожидаем второго игрока!");
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
          }
        })
      }
    }, 1000)

    window.addEventListener("beforeunload", function(event){
        event.preventDefault();
        request = $.ajax({
            url:'/backend/player_left.php'
        })
    })
})