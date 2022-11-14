"use strict";

$("document").jquery(function(){
    $('.button').on(function(){
        $.ajax({
        type: "POST",
        value: $(this).val(),
        url: "index.php",
        data: {'action': postForm()}
        
        })
    })
    })
