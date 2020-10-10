$(document).ready(function() {
    $('#sidebar').scrollToFixed({
        marginTop: 100,
        postFixed: function() { $(this).css('width', '300px'); },
    });
});