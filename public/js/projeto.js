function deleteRegistroPaginacao(rotaUrl, idDoRegistro){
    if (confirm('Deseja confirmar a exclusão?')){
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: idDoRegistro,
            },
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando',
                    timeout: 2000,
                });
            },
        }).done(function(data){
            $.unblockUI();
            if(data.success == true){
                window.location.reload()
            } else {
                alert('Não foi possível excluir');
            }
            
        }).fail(function (data){
            $.unblockUI();
            alert('Não foi possível buscar os dados')
        })    
    }
}

$('#mascara_valor').mask('#.##0,00', { reverse: true});

$('#cep').blur(function (){
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != ""){
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)){
            $("#logradouro").val(" ");
            $("#bairro").val(" ");
            $("#endereco").val(" ");
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados){
                if (!dados.erro) {
                    $("#logradouro").val(dados.logradouro.toUpperCase());
                    $("#bairro").val(dados.bairro.toUpperCase());
                    $("#endereco").val(dados.localidade.toUpperCase());
                } else {
                    alert("CEP não encontrado. Digite manualmente ou tente novamente.");
                }
            });
        } else {
            alert("Formato de CEP inválido.");
        }
    }
});
