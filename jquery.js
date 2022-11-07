"use strict";

$("document").jquery(function(){
    $('.button').on(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = "ajax.php",
        data = {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            response = "The function was repeated succesfully";
            alert(response);
        })
    })
})