<script>

  $(document).on('click', '#confirmation-delete', function () {
    Swal.fire({
        title: 'Exclusão',
        text: "Deseja deletar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
        }).then((result) => {
        if (result.value) {
            window.location.href = $(this).data('info');
        } 
    });
  });
  
  
</script>