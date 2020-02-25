function deleteFunction() {
    $(document).ready(function () {
        $('.btn-delete').on('click',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data("textval");

            swal({
                title: "Are you sure you want to delete?",
                text: title,
                icon: "warning",
                buttons: true,
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    document.getElementById('delete-form'+id).submit(); 
                } 
                else {
                }
            });
        });
    }); 
}