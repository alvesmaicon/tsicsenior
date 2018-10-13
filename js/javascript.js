

$(document).ready(function(){
    $("#busca_produto").submit(function(){

        var result = $(this).serialize();
        $.ajax({
            url: "../controller/incluir.php",
            type: "POST",
            dataType: "json",
            data: result,
            success: function(result){
                $("#codigo_documento").val(result);
            }});

        return false;

    })
});

/*
function incluir(){

    var result = $(this).serialize();
    $.ajax({
        url: "../controller/incluir.php",
        type: "POST",
        dataType: "json",
        data: result,
        success: function(result){
            $("#codigo_documento").val(result);
        }});

    return false;
    // desse jeito esta indo pra pagina php

}

*/
