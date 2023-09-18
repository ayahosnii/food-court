$(document).ready(function(){

 "use strict";




/*==============================================================
// deal countdown js
==============================================================*/

    if(document.getElementById('days1'))
    {
            const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;
            x = setInterval(function() {
            if(document.querySelectorAll('.contdown_row').length == 1){
                    document.getElementById('days').innerText = Math.floor(distance / (day)),
                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
            }else{
                var i;
                for (i = 1; i <= document.querySelectorAll('.contdown_row').length; i++) {
                    console.log($('[data-timer='+i+']').attr('data-date'));
                    var date_date = $('[data-timer='+i+']').attr('data-date');
                    var date_timer = $('.contdown_row').attr('data-timer');
                        var countDown = new Date(date_date).getTime();
                        var now = new Date().getTime();
                        var distance = countDown - now;
                        document.getElementById('days'+[i]).innerText = Math.floor(distance / (day)),
                        document.getElementById('hours'+[i]).innerText = Math.floor((distance % (day)) / (hour)),
                        document.getElementById('minutes'+[i]).innerText = Math.floor((distance % (hour)) / (minute)),
                        document.getElementById('seconds'+[i]).innerText = Math.floor((distance % (minute)) / second);
                    }
                }
            }, second)
    }

/*==============================================================
// deal of the day
==============================================================*/

$('.deal-day').owlCarousel({
    loop: false,
    rewind: true,
    nav: true,
    dots:false,
    margin: 30,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive: {
        0: {
            items: 1,
            margin: 15
        },
        479: {
            items: 2,
            margin: 15
        },
        768: {
            items: 1
        },
        979: {
            items: 1
        },
        1199: {
            items: 1
        }
    }
});



   /* ==========================================
   // index 7
  ========================================== */

  $('.releted-products-7').owlCarousel({
    loop: false,
    rewind: true,
    margin: 30,
    nav: true,
    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    dots: false,autoplay: true,
    sautoplayTimeout: 5000,
    autoplayHoverPause: true,
    responsive:{
      0:{
        items:2,
        margin: 15
      },
      480:{
        items:2
      },
      768:{
        items:2
      },
      979:{
        items:3
      }
    }
  });

// **************************************** count sales ********************************************

        function countdown() {
        var daysElement = document.getElementById('days');
        var hoursElement = document.getElementById('hours');
        var minutesElement = document.getElementById('minutes');
        var secondsElement = document.getElementById('seconds');

        var days = parseInt(daysElement.innerHTML);
        var hours = parseInt(hoursElement.innerHTML);
        var minutes = parseInt(minutesElement.innerHTML);
        var seconds = parseInt(secondsElement.innerHTML);

        var totalSeconds = (days * 24 * 60 * 60) + (hours * 60 * 60) + (minutes * 60) + seconds;

        if (totalSeconds <= 0) {
        // Countdown is finished, do something here
        return;
    }

        totalSeconds--;
        days = Math.floor(totalSeconds / (24 * 60 * 60));
        hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
        minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
        seconds = totalSeconds % 60;

        daysElement.innerHTML = days;
        hoursElement.innerHTML = hours;
        minutesElement.innerHTML = minutes;
        secondsElement.innerHTML = seconds;

        setTimeout(countdown, 1000);
    }

        countdown();



// **************************************** blog page ********************************************




});
