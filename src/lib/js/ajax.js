// document.addEventListener('DOMContentLoaded', function() {
$(function () {
    $('.ativo').click(function (e) {
        let ativo = $(this).data('status'); // Obtém o valor do atributo rel
        let id = $(this).data('id'); // Obtém o ID do atributo data-id
        let UrlBase = $(this).data('url');
        //alert(UrlBase+'&id='+id+'&ativo='+ativo)

        $.ajax({
            type: "get",
            url: UrlBase + '&id=' + id + '&ativo=' + ativo,
            success: function () {
                location.reload(); // Recarrega a página após sucesso
            }
        });
    });
});
// });

$(function () {
    $('.qtde').change(function () {
        var quantidade = $(this).val();
        var linha = $(this).data('linha'); 

        $.ajax({
            type: "POST",
            url: "index.php?controller=CarrinhoController&metodo=atualizarCarrinho",
            data: { linha: linha, quantidade: quantidade }, 
            success: function () {
                location.reload();
            }
        });
    });
});