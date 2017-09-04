$( document ).ready(function() {

    // Hide hidden fields
    $('input.hidden').closest('div.form-group').css({"display": "none", "height": "0px"});

    // Auto close alerts
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

    // Start Bootstrap form mark-up
    $(".select2").select2();
    $(".my-colorpicker2").colorpicker();
    $("#textarea").wysihtml5();

});
