   function lockUnlockSwitcher(){
      var stopchange = false;

      $('.unlock-locked-switch').on('switchChange.bootstrapSwitch', function (e, state) {

          let message;
          let obj = $(this);
          let id = $(this).data('id');
          let title = $(this).data("textval");
          let currentState = $(this).val();

          if(currentState == "locked"){
              message = "Unlock";
          }else{
              message = "Lock";
          }

          if(stopchange === false)
          {
              swal.fire({
                  title: 'Are you sure you want to '+message+'?',
                  text: title,
                  icon: 'warning',
                  input: 'password',
                  inputPlaceholder: 'Enter your password to continue',
                  showCancelButton: true,
                  confirmButtonText: 'Yes '+message+' it!',
                  allowOutsideClick: false,
                  inputValidator: (value) => {
                      if (!value) {
                        return 'You need to write something!'
                    }
                }
              })
              .then((result) => {
                  if (result.value) {
                      let dataString = 'password='+result.value + '&id='+id;
                      $.ajax({
                          url:'/director/lock-and-unlock/report/forms/'+id,
                          type:"GET",
                          dataType:"json",
                          data: dataString,
                          success:function(data){
                              if (data.done == true) {
                                  Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                }).then((isConfirm) => {
                                  if (isConfirm) {
                                    if(data.message == "locked"){
                                        obj.attr("value","locked")
                                        $(".unlock").css("color","#d9534f");
                                    }else{
                                        obj.attr("value","unlock")
                                        $('.locked').css("color","#5cb85c");
                                    }
                                  } 
                                });

                              }
                              if (data.error == false) {
                                  Swal.fire({
                                    icon: 'warning',
                                    title: data.message,
                                }).then((isConfirm) => {
                                  if (isConfirm) {
                                    if(stopchange === false){
                                      stopchange = true;
                                      obj.bootstrapSwitch('toggleState');
                                      stopchange = false;
                                    }
                                  } 
                          });
                              }
                          },
                          error: function() {
                              Swal.fire({
                                  title: "Something went wrong!",
                                  icon: "warning",
                              });
                          }
                      });

                  }else if(result.dismiss == 'cancel'){
                      if(stopchange === false){
                          stopchange = true;
                          obj.bootstrapSwitch('toggleState');
                          stopchange = false;
                      }
                  }
              });
          }
      });
   }