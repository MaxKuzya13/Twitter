$(document).ready(function() {

    let start = localStorage.getItem('start') || 5;
    let count = $('.full-box').length;

    let show = 1;

    $('.full-box').addClass('hide');
    $('.full-box:lt('+start+')').removeClass('hide');

    $('.show_more-tweets').click(function (e){
        e.preventDefault();

        start = (start + show <= count) ? start + show : count;
        localStorage.setItem('start', start);

        $('.full-box:lt('+start+')').removeClass('hide');
        console.log(start);
        console.log(count);

        if(start >= count)
        {
            $('.show_more-tweets').addClass('hide');
            $('.show_less-tweets').removeClass('hide');
        }



    })

    $('.show_less-tweets').click(function (e){
        $('.show_less-tweets').addClass('hide');
        localStorage.removeItem('start');
        window.location.reload();

    })

    if(start >= count)
    {
        $('.show_more-tweets').addClass('hide');
        $('.show_less-tweets').removeClass('hide');
    }





});