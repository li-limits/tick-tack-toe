$(document).ready(function() {

    $('.overlay').click(function(){
        $('.room_pass_window').animate({opacity: 0}, 198, function(){
          $(this).css('display', 'none');
          $('.overlay').fadeOut(297);
        });
        setTimeout(function(){
            window.room_state_var = 0;
        }, 500);
      })

    $('.room').click(function(){
        $room = $(this);
        var $id = $room.attr('id').split('-')[1];
        var $pass = '#pass-' + $id;
        if ($($pass).html() == "YES") {
          window.room_state_var = 1;
          $('.overlay').fadeIn(297,	function(){
            $('#room_pass_window-' + $id) 
            .css('display', 'flex')
            .animate({opacity: 1}, 198);
          });
        }
        else {
          request = $.ajax({
            url:'/backend/join_room.php',
            type:'post',
            data: {id:$id}
          })
    
          request.done(function(response, textStatus, jqXHR){
            if (response == 1){
              window.location = '/playtable.php';
            }
            else if (response == 0){
              alert("Комната уже занята!");
            }
            else if (response == 3) {
              alert("Войдите в ваш аккаунт!");
            }
          })
        }
      })
    
      $('.room_pass_window').submit(function(event){
        event.preventDefault();
    
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serData = $form.serialize();
        $inputs.prop("disabled", true);

        var $id = $form.attr('id').split('-')[1];
        $pass = $('#pass_input-' + $id).val();
    
        var request = $.ajax({
          url:'/backend/join_room.php',
          type:'post',
          data: {id:$id, pass:$pass}
        })
    
        request.done(function(response, textStatus, jqXHR){
          if (response == 0) {
            alert("Комната уже занята!");
          }
          else if (response == 1) {
            window.location = '/playtable.php';
          }
          else if (response == 2) {
            alert("Неправильный пароль!");
          }
          else if (response == 3) {
            alert("Войдите в ваш аккаунт!");
          }
        })

        request.always(function(response, textStatus, jqXHR){
            $inputs.prop("disabled", false);
        })
      })
});