$(document).ready(function(){

    setInterval(function(){
        var period_request = $.ajax({
            url:"/backend/check_state.php"
        })

        period_request.done(function(response, textStatus, jqXHR){
            if (response == '1'){
                $('.cells_front').hide();
                var request = $.ajax({
                  url:'/backend/draw_board.php',
                  dataType:'json',
                  success:function(data){
                      $('#cell_1').html(data.cell_1);
                      $('#cell_2').html(data.cell_2);
                      $('#cell_3').html(data.cell_3);
                      $('#cell_4').html(data.cell_4);
                      $('#cell_5').html(data.cell_5);
                      $('#cell_6').html(data.cell_6);
                      $('#cell_7').html(data.cell_7);
                      $('#cell_8').html(data.cell_8);
                      $('#cell_9').html(data.cell_9);
                  }
              })
            }
            else if (response == '0'){
                $('.cells_front').show();
            }
        })
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
          $cell.off('click');
          inner_request = $.ajax({
            url: "/backend/check_field.php",
            type: "post",
            data: {html1:$("#cell_1").html(), html2:$("#cell_2").html(), html3:$("#cell_3").html(),
                  html4:$("#cell_4").html(), html5:$("#cell_5").html(), html6:$("#cell_6").html(),
                  html7:$("#cell_7").html(), html8:$("#cell_8").html(), html9:$("#cell_9").html()}
          });

            inner_request.done(function(response, textStatus, jqXHR){
            if (response == 'x'){
              alert("Победа крестиков!");
            }
            else if (response == 'o') {
              alert("Победа ноликов!");
            }
          })
        });
      });

    window.addEventListener("beforeunload", function(event){
        event.preventDefault();
        request = $.ajax({
            url:'/backend/player_left.php'
        })

        request.done(function(response, textStatus, jqXHR){
            if (response == '1'){
                alert("Создатель покинул комнату!");
            }
            else if (response == '2'){
                alert("Противник покинул комнату!");
            }
        })
    })
})