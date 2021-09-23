var gestaoProjetos = (function() {
    $modalProjeto = $('#modal-projeto'),
    $formAdicionarProjeto = $('#form-adicionar-projeto'),
    $opcoesAdicionar = $('.opcoes-adicionar'),
    $opcoesEdicao = $('.opcoes-edicao'),
    $opcoesRemover = $('.opcoes-remover'),
    $mensagemAlerta = $('.mensagem-alerta');

    function showModalAdicionarProjeto() {
        cleanFormProject();
        $opcoesEdicao.hide();
        $opcoesAdicionar.show();
        $opcoesRemover.hide();
        $modalProjeto.modal('show');
    };

    function showModalEditarProjeto(projeto) {
        cleanFormProject();
        $opcoesEdicao.show();
        $opcoesAdicionar.hide();
        $opcoesRemover.hide();
        $modalProjeto.modal('show');
        preecncherProjeto(projeto);
    };

    function showModalRemoverProjeto(projeto) {
        cleanFormProject();
        $opcoesEdicao.show();
        $('.modal-footer').find('button.opcoes-adicionar').hide();
        $('.modal-footer').find('button.opcoes-edicao').hide();
        $opcoesRemover.show();
        $modalProjeto.modal('show');
        preecncherProjeto(projeto);
    };

    function adicionarProjeto() {
        DS.adicionar();
    };

    function editarProjeto(projeto) {
        DS.editar(projeto);
    };

    function removerProjeto(projeto) {
        DS.remover(id);
    };

    const cleanFormProject = function() {
        $formAdicionarProjeto.find("input,textarea,select").each(function() {
            if (this.name === '_token') return;
            $(this).val('');
        });
    }

    const preecncherProjeto = function(projeto) {
        $formAdicionarProjeto.find("input,textarea,select").each(function() {
            if (this.name === '_token') return;
            if (projeto[this.name]) $(this).val(projeto[this.name]);
        });
    }

    const DS = (function() {

        const adicionar = function() {
            let formData = $formAdicionarProjeto.serializeArray()

            $.ajax({
                type: 'POST',
                url: 'projeto',
                data: formData,
                success: function(response){
                    console.log('teste success')
                    console.log(response)
                    alert(response);
                },
                error: function(error) {
                    $mensagemAlerta.html(error.responseJSON.message).show();
                    console.log(error.responseJSON.message);
                },
                complete: function() {
                    console.log('teste complete')
                }
             });
        }

        const editar = function() {
            console.log('DS-editar');
        }

        const remover = function() {
            console.log('DS-remover');
        }

        return {
            adicionar,
            editar,
            remover
        }
    })();

    return {
        showModalAdicionarProjeto,
        showModalEditarProjeto,
        showModalRemoverProjeto,
        adicionarProjeto,
        editarProjeto,
        removerProjeto
    }
})()


//# sourceURL=projetos.js



