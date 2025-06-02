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

$('#Cep').blur(function (){
    var cep = $(this).val().replace(/\D/g, '');
    if (cep != ""){
        var validacep = /^[0-9]{8}$/;
        $("#Logradouro").val(" ");
        $("#Bairro").val(" ");
        $("#Cidade").val(" ");
        $("#uf").val(" ");
        $("#ibge").val(" ");
        $.getJSON("https://viacep.com.br/ws" + cep + "/json/?callback=?"), function (dados){
            if (!"erro" in dados){
                $("#Logradouro").val(dados.logradouro.toUpperCase());
                $("#Bairro").val(dados.bairro.toUpperCase());
                $("#Cidade").val(dados.localidade.toUpperCase());
                $("#uf").val(dados.uf.toUpperCase());
                $("#ibge").val(dados.ibge.toUpperCase());        
            }
            else {
                alert("CEP não encontrado dee forma automatizado digite maanualmente ou tente novamente");
            }
        }
    };
    
})