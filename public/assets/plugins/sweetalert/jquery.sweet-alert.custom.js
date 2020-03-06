function deleteFunction() {
    $(document).ready(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); 

        $('.btn-delete').on('click',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data("textval");

            Swal.fire({
              title: 'Are you sure you want to delete?',
              text: title,
              icon: 'warning',
              input: 'password',
              inputPlaceholder: 'Enter password to continue',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes delete it!',
              allowOutsideClick: false,
              inputValidator: (value) => {
                if (!value) {
                  return 'You need to write something!'
                }
              }
            }).then(function(result){
              if(result.value){
                let route = document.getElementById('delete-form'+id).attributes.action.value;
                let dataString = '_method=DELETE'+ '&password='+result.value + '&id='+id;
                   
                $.ajax({
                  url:route,
                  type:"POST",
                  dataType:"json",
                  data: dataString,
                  success:function(data){
                    if (data.success == true) {
                      swal.fire({
                        icon: 'success',
                        title: data.message,
                      }).then((isConfirm) => {
                        if (isConfirm) {
                          location.reload()
                        } 
                      });
                    } 
                    if (data.error == false) {
                      swal.fire({
                        icon: 'warning',
                        title: data.message,
                      })
                    }
                  },
                  error: function() {
                    swal({
                      title: "Something went wrong!",
                      icon: "warning",
                    });
                  }
                });
              }else if(result.dismiss == 'cancel'){
                 console.log('cancel');
              }
          });
        });
    }); 
}