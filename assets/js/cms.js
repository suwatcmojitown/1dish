$(document).ready(function() {

    $('#menu-toggle').on('click', function() {
        $('#sidebar').toggleClass('open');
        $('#sidebar-overlay').toggleClass('show');
    });

    $('#sidebar-overlay').on('click', function() {
        $('#sidebar').removeClass('open');
        $(this).removeClass('show');
    });

});
