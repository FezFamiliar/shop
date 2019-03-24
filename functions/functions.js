
$(document).ready(function(){


  $('.shopping-cart').click(function(){
      $.get('ajax/cart.php');

  });

  $('.clear').click(function(){

          $.get('ajax/delete.php',function(data){
              $('.notification .notification').html(data);
          });
          var parent = $(this).parent().parent();
          var id = $(this).attr('data-id');
          $(parent).addClass('remove');
          $.get('ajax/table.php',{id:id});

      });


        $('#register-form').submit(function(e){
          var username = $('#username').val();
          var email = $('#email').val();
          var password = $('#password').val();
          if(username == '' && email == '' && password == ''){
            $('#register-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-pass td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-email td:nth-child(2)').html('Required').addClass('validation-toggle');
            e.preventDefault();
          }else if(username == '' && password == ''){


            $('#register-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-pass td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-email td:nth-child(2)').html('');
            e.preventDefault();
          }else if(email == '' && password == ''){

            $('#register-user td:nth-child(2)').html('');
            $('#register-pass td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-email td:nth-child(2)').html('Required').addClass('validation-toggle');
            e.preventDefault();
          }else if(email == '' && username == ''){

            $('#register-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-pass td:nth-child(2)').html('');
            $('#register-email td:nth-child(2)').html('Required').addClass('validation-toggle');
            e.preventDefault();
          }else if(username == '' && email != '' && passwrod != ''){

            $('#register-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-email td:nth-child(2)').html('');
            $('#register-pass td:nth-child(2)').html('');
            e.preventDefault();

          }else if(password == '' && email != '' && username != ''){

            $('#register-user td:nth-child(2)').html('');
            $('#register-pass td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#register-email td:nth-child(2)').html('');
            e.preventDefault();

          }else if(email == '' && password != '' && username != ''){

            $('#register-user td:nth-child(2)').html('');
            $('#register-pass td:nth-child(2)').html('');
            $('#register-email td:nth-child(2)').html('Required').addClass('validation-toggle');
            e.preventDefault();
          }


        })

        $('#login-form').submit(function(e){

          var username = $('#username').val();
          var password = $('#password').val();
          if(username == '' && password == ''){

            e.preventDefault();
            $('#validate-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#validate-pass td:nth-child(2)').html('Required').addClass('validation-toggle');

          }
          else if(password == ''){

            e.preventDefault();
            $('#validate-pass td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#validate-user td:nth-child(2)').html('');
          }
          else if(username == ''){

            e.preventDefault();
            $('#validate-user td:nth-child(2)').html('Required').addClass('validation-toggle');
            $('#validate-pass td:nth-child(2)').html('');

          }
        })



     
        $('#slider').mousedown(function(){
            var slide = $(this).val();
            var output = $('.slide-container span');
            output.html(slide);

            $('#slider').on('input',function(){

                output.html($(this).val())
            })

          });

          $(function() {
            $( "#slider-range" ).slider({
              range: true,
              min: 0,
              max: 500,
              values: [ 75, 300 ],
              slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
              }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
              " - $" + $( "#slider-range" ).slider( "values", 1 ) );
          } );


})
