$(document).ready(function() {

  window.room_state_var = 0;

  $('a.login').click( function(event){
    event.preventDefault();
    $('.overlay').fadeIn(297,	function(){
      $('#login_window') 
      .css('display', 'block')
      .animate({opacity: 1}, 198);
    });
  });

  $('a.create_acc').click( function(event){
    event.preventDefault();
    $('.overlay').animate({opacity: 1}, 198, function(){
      $(this).css('display', 'block');
      $('#newacc_window') 
      .css('display', 'block')
      .animate({opacity: 1}, 198);
    });
  });

  $('#create_room_window_close, .overlay').click(function(){
    $('#create_room_window').animate({opacity: 0}, 198, function(){
      $(this).css('display', 'none');
      $('.overlay').fadeOut(297);
    });
  })

  $('#login_close, .overlay').click( function(){
    $('#login_window').animate({opacity: 0}, 198, function(){
      $(this).css('display', 'none');
      $('.overlay').fadeOut(297);
    });
  });

  $('#newacc_close, .overlay').click( function(){
    $('#newacc_window').animate({opacity: 0}, 198, function(){
      $(this).css('display', 'none');
      $('.overlay').fadeOut(297);
    });
  });

  $('#add_window_close, .overlay').click( function(){
    $('.add_window').animate({opacity: 0}, 198, function(){
      $(this).css('display', 'none');
      $('.overlay').fadeOut(297);
    });
  });

  var request;

  $(".login_field").submit(function(event){
    event.preventDefault();

    if (request){
      request.abort();
    }

    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serData = $form.serialize();
    $inputs.prop("disabled", true);

    request = $.ajax({
      url: "/backend/login.php",
      type: "post",
      data: serData
    });

    request.done(function(response, textStatus, jqXHR){
      location.reload();
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
      alert("!");
    });

    request.always(function(){
      $inputs.prop("disabled", false);
    });
  });

  $(".newacc_field").submit(function(event){
    event.preventDefault();

    if (request){
      request.abort();
    }

    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serData = $form.serialize();
    $inputs.prop("disabled", true);

    request = $.ajax({
      url: "/backend/newacc_create.php",
      type: "post",
      data: serData
    });

    request.done(function (response, textStatus, jqXHR){
      $("#newacc_result").html(response);
    });

    request.fail(function (response, textStatus, jqXHR){
      $("#newacc_result").html("Ошибка!");
    });

    request.always(function(){
      $inputs.prop("disabled", false);
    });
  });

  $('a.create_room').click(function(event){
    event.preventDefault();
    $('.overlay').fadeIn(297,	function(){
      $('#create_room_window') 
      .css('display', 'block')
      .animate({opacity: 1}, 198);
    });
  })

  $('.create_room_field').submit(function(event){
    event.preventDefault();

    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serData = $form.serialize();
    $inputs.prop("disabled", true);

    var request = $.ajax({
      url:'/backend/create_room.php',
      type:'post',
      data: serData
    })

    request.done(function (response, textStatus, jqXHR){
      $("#create_room_window > #room_result").html(response);
      setTimeout(function(){
        $('#create_room_window').animate({opacity: 0}, 198, function(){
          $(this).css('display', 'none');
          $('#overlay').fadeOut(297);
        })
      }, 1300);
      setTimeout(function(){
        window.location = '/playtable.php';
      }, 2200);
    });

    request.fail(function (response, textStatus, jqXHR){
      $("#create_room_window > #result").html("Ошибка!");
    });
  })

  setInterval(function(){
    if (room_state_var == 0){
      var request = $.ajax({
        url:'/backend/rooms_draw.php'
      })

      request.done(function(response, textStatus, jqXHR){
        $('.main_main').html(response);
        $('html').find('script').filter(function(){
          return $(this).attr('src') == '/frontend/js/refresh_rooms.js'
      }).remove();
        $.getScript("/frontend/js/refresh_rooms.js");
      })
    }
  }, 2000)
});