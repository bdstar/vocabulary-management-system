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

function goMemorized(){
  var id = $("#wordModal").data("modal");
  console.log("Modal=",id);
  //id = $("#is-complete-" + id).val();
  //console.log("Input=",id);
  completeMemorized(id)
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



$(document).ready(function () {
  $('.word-class').on("click", function () {
    var id = $(this).data("id");
    console.log("id=",id);

    var page = "words";
    var url = 'database.php?id='+id+'&page=' + page + '&action=viewword';
    $.ajax({
      type: 'post',
      dataType: "json",
      url: url,
      data: $('form').serialize(),
      success: function (data) {
        if (data.result == "failed") {
          //$("#operation-result").css("display", "block");
          //$("#operation-result").removeClass("alert-success");
          //$("#operation-result").addClass("alert-danger");
          //$("#operation-result").html("<strong>" + data.result + "!</strong> <i>" + data.message + "</i> because of <b>" + data.msg + "</b>");
          toastr.error(page + ' Data Not Found!')
        } else {
          //console.log(data.data[0].word);
          $("#modal-id").val(data.data[0].id);
          $("#wordModal").data('modal', data.data[0].id);
          $(".modal-word").html(data.data[0].word);
          $(".modal-meaning_number").html(data.data[0].meaning_number);
          (data.data[0].pos)? $("#modal-pos").html("("+data.data[0].pos+")"):"";

          //Start: modal-spelling-utterance
          let c = "";
          let a = data.data[0].spelling;
          let b = data.data[0].utterance;
          let f = 0;

          if (a || b){
            c += "(";
            if (a){c += (a); f=1;}
            if(b){if(f){c +="/";} c += b; }
            c += ")";
          }
          $("#modal-spelling-utterance").html(c);
          //End: modal-spelling-utterance

          //let smeaning = ((data.data[0].smeaning) ? (": "+data.data[0].smeaning) : "");
          $("#modal-smeaning").html(((data.data[0].smeaning) ? (": " + data.data[0].smeaning) : ""));
          $("#modal-emeaning").html(((data.data[0].emeaning) ? (": " + data.data[0].emeaning) : ""));
          $("#modal-lmeaning").html(((data.data[0].lmeaning) ? (": " + data.data[0].lmeaning) : ""));
          $("#modal-mnemonics").html(((data.data[0].mnemonics) ? (": " + data.data[0].mnemonics) : ""));
          $("#modal-sentence").html(((data.data[0].sentence) ? (": " + data.data[0].sentence) : ""));
          if (data.data[0].picture){
            $('#modal-picture').attr('src', (data.data[0].picture));
            $('#modal-picture').hide();
          }
          if (data.data[0].pos == "Verb" && (data.data[0].past || data.data[0].participle)){
            $("#modal-past").html(((data.data[0].past) ? (data.data[0].past) : ""));
            $("#modal-participle").html(((data.data[0].participle) ? (data.data[0].participle) : ""));
          }else{
            $('#modal-fov').hide();
          }

          if (data.data[0].complete == 1) {
            $("#modal-complete").attr("checked", true);
          }else{
            $("#modal-complete").attr("checked", false);
          }

          let checkboxid = "#is-complete-" + data.data[0].id;
          $("#modal-complete").attr("id", checkboxid);
          //$(idname).val(data.data[0].id);

          /*{
            "id": "377",
            -"word": "happen",
            -"pos": "Verb",
            -"spelling": null,
            -"utterance": null,
            -"mnemonics": null,
            -"smeaning": null,
            -"lmeaning": null,
            -"emeaning": null,
            -"sentence": null,
            -"picture": null,
            -"meaning_number": "1",
            -"past": "happened",
            -"participle": "happened",
            -"complete": "1",
            "created_at": "2022-01-12 21:27:34",
            "updated_at": "2022-01-12 21:27:34"
          }*/
          //$("#operation-result").css("display", "block");
          //$("#operation-result").removeClass("alert-danger");
          //$("#operation-result").addClass("alert-success");
          //$("#operation-result").html("<strong>" + data.result + "!</strong> <i>" + data.message + "</i> because of <b>" + data.msg + "</b>");
          //toastr.success(page + ' successfully ' + type + '!', '' + page + '');
          $('#wordModal').modal('show');
        }
      },
      fail: function (xhr, textStatus, errorThrown) {
        toastr.error('Request Failed.', 'Failed!')
      }
    });

    //$('#wordModal').modal('show');
  });
});



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