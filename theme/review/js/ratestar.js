

$(document).ready(function () {

    function ratingisset (){
      //SET BACKGROUND AFTER MOUSE LEAVE IF RATING IS SPECIFIED
            if (document.rate_form.rating.value == 1){
              $('#1star').css('background-color', '#F00000');
            }
            
            if (document.rate_form.rating.value == 2){
              $('#2star,#1star').css('background-color', '#FF9900');
            }

            if (document.rate_form.rating.value == 3){
              $('#1star,#2star,#3star').css('background-color', '#FF9900');
            }

            if (document.rate_form.rating.value == 4){
              $('#1star,#2star,#3star,#4star').css('background-color', '#6EA840');
            }

            if (document.rate_form.rating.value == 5){
              $('#1star,#2star,#3star,#4star,#5star').css('background-color', '#6EA840');
            }
    }

      // 1 Star
      $('#1star')
        .css('cursor', 'pointer')
        .click(
          function(){
            // $('#1star').unbind('mouseleave');
            $('#1star').css('background-color', '#F00000');
            $('#2star,#3star,#4star,#5star').css('background-color', '');
            $('#rate').empty();
            $('#rate').append("<font color = #F00000 >Bad! </font><br />");
            setRatingLevel(1);
          }
        )
        .hover(
          function(){
            $(this).css('background-color', '#F00000');
            $('#2star,#3star,#4star,#5star').css('background-color', '');
          },
          function(){
            $(this).css('background', '');
            ratingisset();
          }
        );
      // 2 star 
      $('#2star')
        .css('cursor', 'pointer')
        .click(
          function(){
           // $(this).unbind('mouseleave');
           $('#rate').empty();
           $('#2star,#1star').css('background-color', '#FF9900');
           $('#3star,#4star,#5star').css('background-color', '');
           setRatingLevel(2);
         $('#rate').empty();
         $('#rate').append("<font color = #FF9900 >Not Good! </font><br />");
          }
        )
        .hover(
          function(){
            $(this).css('background-color', '#FF9900');
            $('#1star').css('background-color', '#FF9900');
            $('#3star,#4star,#5star').css('background-color', '');
          },
          function(){
            $(this).css('background', '');
            $('#1star').css('background', '');
            ratingisset();
          }
        );

      //3 Star

      $('#3star')
        .css('cursor', 'pointer')
        .click(
          function(){
            $('#rate').empty();
          // $(this).unbind('mouseleave');
           $('#4star,#5star').css('background-color', '');
          setRatingLevel(3);
         $('#rate').empty();
         $('#rate').append("<font color = #FF9900 >Average! </font><br />");
         
          }
        )
        .hover(
          function(){
            $(this).css('background-color', '#FF9900');
            $('#1star,#2star').css('background-color', '#FF9900');
           $('#4star,#5star').css('background-color', '');
          },
          function(){
            $(this).css('background', '');
            $('#1star').css('background', '');
            $('#2star').css('background', '');
            ratingisset();
          }
        );

      //4 Star

        $('#4star')
        .css('cursor', 'pointer')
        .click(
          function(){
            $('#rate').empty();
          // $(this).unbind('mouseleave');
          $('#5star').css('background-color', '');
           setRatingLevel(4);
          $('#rate').empty();
          $('#rate').append("<font color = #6ea840 >Good! </font><br />");
         
          }
        )
        .hover(
          function(){
            $(this).css('background-color', '#6ea840');
            $('#1star,#2star,#3star').css('background-color', '#6ea840');
            $('#5star').css('background-color', '');
          },
          function(){
            $(this).css('background', '');
            $('#1star,#2star,#3star').css('background', '');
            ratingisset();
          }
        );

      // 5 Star

        $('#5star')
        .css('cursor', 'pointer')
        .click(
          function(){
          // $(this).unbind('mouseleave');
          $('#5star').css('background-color', '#6ea840');
           setRatingLevel(5);
            $('#rate').empty();
            $('#rate').append("<font color = #6ea840 >Excellent! </font><br />");
          }
        )
        .hover(
          function(){
            $('#1star,#2star,#3star,#4star,#5star').css('background-color', '#6ea840');
          },
          function(){
            $('#1star,#2star,#3star,#4star,#5star').css('background', '');
            ratingisset();
           }
        );

      });
