

$(document).ready(function(){
    $("#busca_produto").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "../controller/incluir.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: function(result){

                // falha ao incluir o primeiro produto pois o produto nao esta cadastrado
                if(result.codigo == 1) {
                    alert("Produto não cadastrado");
                }

                // tentar incluir um produto nao cadastrado depois de incluir o primeiro produto
                else if(result.codigo == 2){
                    $("#codigo_documento").val(result.codigo_documento);
                    alert("Produto não cadastrado");
                }

                // o produto esta cadastrado e foi incluido no documento
                else{
                    $("#codigo_documento").val(result);
                }





            }});

            var data = $(this).serialize();
            $.ajax({
                url: "../controller/lista.php",
                type: "POST",
                dataType: "html",
                data: data,
                success: function (table) {
                    $("#lista_produto").html(table);

                }
            });


        return false;

    });

    $("#cadastra_produto").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "../controller/cadastrar.php",
            type: "POST",
            data : data,
            datatype:"html",
            success: function (result){

                alert("Produto cadastrado.");
                $('#id_produto').val('');
                $('#descricao_produto').val('');
                $('#preco_produto').val('');
            }
        });

        return false;

    });

    $("#confirmar_venda").click(function(){

        var cod =  document.getElementById('codigo_documento').value;

        if(cod == ''){
            alert("Lista de compras está vazia!");
        }
        else{
            var data = $("#busca_produto").serialize();
            $.ajax({
                url: "../controller/confirmar.php",
                type: "POST",
                dataType: "html",
                data: data,
                success: function (result) {


                    $('#lista_produto').empty();
                    $('#codigo_documento').val('');
                    $('#cod_produto').val('');


                    alert("Venda concluída.");

                }
            });
        }

    });

    $("#cancelar_venda").click(function(){
        location.href = '../index.html';
    });

    $("#cancelar_cadastrar").click(function(){
        location.href = '../index.html';
    });




});


function onLoadListDocuments(){

    $.ajax({
        url: "../controller/total.php",
        dataType: "html",
        success: function (result){
            $("#total_vendas").html(result);
        }
    });

}



