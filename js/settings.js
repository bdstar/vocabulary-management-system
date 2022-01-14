$(document).ready(function() {
    $('#word-list').DataTable();
    $('.live-selectpicker').selectpicker();

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
} );


// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            //console.log("submitted");
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();


/*https://www.itsolutionstuff.com/post/simple-php-ajax-form-validation-example-from-scratchexample.html*/

  $(function () {
    $('#save-form').on('submit', function (e) {
      e.preventDefault();
      var type = $(this).data("type");
      var page = $(this).data("page");
      var url = (type == "Update") ? 'database.php?page=' + page + '&action=update' : 'database.php?page=' + page +'&action=insert';
      $.ajax({
        type: 'post',
        dataType: "json",
        url: url,
        data: $('form').serialize(),
        success: function (data) {
          if(data.result=="failed"){
            $("#operation-result").css("display", "block");
            $("#operation-result").removeClass("alert-success");
            $("#operation-result").addClass("alert-danger");
            $("#operation-result").html("<strong>"+data.result+"!</strong> <i>"+data.message+"</i> because of <b>"+data.msg+"</b>");
            toastr.error(page+' not '+type+'!', ''+page+'!')
          }else{
            $("#operation-result").css("display", "block");
            $("#operation-result").removeClass("alert-danger");
            $("#operation-result").addClass("alert-success");
            $("#operation-result").html("<strong>"+data.result+"!</strong> <i>"+data.message+"</i> because of <b>"+data.msg+"</b>");
            toastr.success(page+' successfully '+type+'!', ''+page+'');
          }

          if(type=="Add"){
            $("#save-form").removeClass("was-validated");
            $('.input-field').val("");
          }
        },
        fail: function(xhr, textStatus, errorThrown){
            toastr.error('Request Failed.', 'Failed!')
        }
      });
    });

  });







 

function deleteData(id) {
  var page = $("#delete-data").data("page");
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
  
  swalWithBootstrapButtons.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: true,
    preConfirm: (login) => {
      return fetch('database.php?page='+page+'&action=delete&id='+id)
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.json()
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        })
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      swalWithBootstrapButtons.fire('Deleted!', 'Your file has been deleted.','success')
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
    swalWithBootstrapButtons.fire('Cancelled', 'Your data is safe :)', 'error')
    }
  })
}



function completeMemorized(id) {
  var complete = 0;
  var title = 'Are you Memorized it?';
  var text = "Make sure you are confident!";
  var confirmBtnText = 'Yes, memorized it!';
  var swalBootstrapBtnTitle = 'Memorized!';
  var swalBootstrapBtnDesc = 'Iv been memorized this word.';
  var swalBootstrapBtnAlert = 'success';
  // (complete) ? $("#is-complete-"+id).prop('checked', true) : $("#is-complete-"+id).prop('checked', false)

  if ($("#is-complete-"+id).is(':checked')) {
    complete = 1;
    //console.log("Checkbox is checked.");
    title = 'Are you Memorized it?';
    text = "Make sure you are confident!";
    confirmBtnText = 'Yes, memorized it!';
    swalBootstrapBtnTitle = 'Memorized!';
    swalBootstrapBtnDesc = 'Iv been memorized this word.';
    swalBootstrapBtnAlert = 'success';
  }else{
    complete = 0;
    //console.log("Checkbox is unchecked.");
    title = 'Are you Forget it?';
    text = "Make sure you are confirmed!";
    confirmBtnText = 'Yes, forget it!';
    swalBootstrapBtnTitle = 'Forget!';
    swalBootstrapBtnDesc = 'Iv been forgot this word.';
    swalBootstrapBtnAlert = 'danger';
  }

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
  
  swalWithBootstrapButtons.fire({
    title: title,
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: confirmBtnText,
    cancelButtonText: 'No, cancel!',
    reverseButtons: true,
    preConfirm: (login) => {
      return fetch('database.php?page=words&action=complete&id='+id+'&complete='+complete)
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.json()
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        })
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      swalWithBootstrapButtons.fire(swalBootstrapBtnTitle, swalBootstrapBtnDesc,swalBootstrapBtnAlert)
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire('Cancelled', 'Your have canceled this operation', 'error')      
    }
  })
}





$(document).ready(function() {
  $('#tag-word').DataTable( {
      responsive: {
          details: {
              display: $.fn.dataTable.Responsive.display.modal( {
                  header: function ( row ) {
                      var data = row.data();
                      return 'Word('+data[0]+'): '+data[1];
                  }
              } ),
              renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                  tableClass: 'table'
              } )
          }
      }
  } );
} );






$(document).ready( function() {
  $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [label]);
  });

  $('.btn-file :file').on('fileselect', function(event, label) {
      
      var input = $(this).parents('.input-group').find(':text'),
          log = label;
      
      if( input.length ) {
          input.val(log);
      } else {
          if( log ) alert(log);
      }
    
  });
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#img-upload').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#imgInp").change(function(){
      readURL(this);
  }); 	
});