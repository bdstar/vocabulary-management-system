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
            toastr.error('Tag not '+type+'!', 'Tag!')
          }else{
            $("#operation-result").css("display", "block");
            $("#operation-result").removeClass("alert-danger");
            $("#operation-result").addClass("alert-success");
            $("#operation-result").html("<strong>"+data.result+"!</strong> <i>"+data.message+"</i> because of <b>"+data.msg+"</b>");
            toastr.success('Tag successfully '+type+'!', 'Tag');
          }

          if(type=="Add"){
            $("#save-form").removeClass("was-validated");
            $('.input-field').val("");
            /*$('#name').val("");
            $('#description').val("");*/
          }
        },
        fail: function(xhr, textStatus, errorThrown){
            toastr.error('Request Failed.', 'Failed!')
        }
      });
    });

  });







 

function deleteData(id,page) {
  //console.log("Delete id: ",id);
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