// DELETAR
function deletar(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'

    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            if (result.isConfirmed) {
            // Cria um formulário dinamicamente
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            // Cria um campo oculto para o ID do usuário
            var inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'deletarId';
            inputId.value = id;

            // Adiciona o campo oculto ao formulário
            form.appendChild(inputId);

            // Adiciona o formulário ao corpo do documento e o submete
            document.body.appendChild(form);
            form.submit();
        }
        }
    })
}