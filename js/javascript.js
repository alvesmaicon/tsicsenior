

$(document).ready(function(){
    $("#busca_produto").submit(function(e){
        e.preventDefault();
        var result = $(this).serialize();
        $.ajax({
            url: "../controller/incluir.php",
            type: "POST",
            dataType: "json",
            data: result,
            success: function(result){
                $("#codigo_documento").val(result).focus();



            }});

        var table = $(this).serialize();
        $.ajax({
            url: "../controller/lista.php",
            type: "POST",
            dataType: "html",
            data: table,
            success: function(table){
                $("#lista_produto").html(table).update();

            }});


        return false;

    });

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
