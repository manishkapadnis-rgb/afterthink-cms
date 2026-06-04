$(function() {
    $('.btn-outline-dark').on('click', function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });
});
