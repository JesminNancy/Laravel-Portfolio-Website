function getContactData(){
    axios.get('/getContactData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivContact').removeClass('d-none');
            $('#loaderDivContact').addClass('d-none');
            
        //    $('#projectDataTable').DataTable().destroy();
           $('#contact_table').empty();
            
            var jsonData = response.data;

            $.each(jsonData, function(i, item) {

                $('<tr>').html(
                    "<td>"+jsonData[i].contact_name +"</td>" +
                    "<td>"+jsonData[i].contact_mobile +"</td>" +
                    "<td>"+jsonData[i].contact_email +"</td>" +
                    "<td>"+jsonData[i].contact_msg +"</td>" +
                    "<td><a class='contactDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#contact_table');
            });
            
          //Contact Table Delete Icon Click
               $('.contactDeleteBtn').click(function(){
                    var id = $(this).data('id');
                    $('#contactDeleteBtn').html(id);
                    $('#deletecontactModal').modal('show');
                })
        
           
            //  $('#projectDataTable').DataTable({"order":false});
            //  $('.dataTables_length').addClass('bs-select');
           
        } else {
            $('#loaderDivContact').addClass('d-none');
            $('#wrongDivContact').removeClass('d-none');
        }

      
    }).catch(function(error) {
        $('#loaderDivContact').addClass('d-none');
        $('#wrongDivContact').removeClass('d-none');
    });

}

//Projects Delete Modal Yes Button
$('#contactDeleteConfirmBtn').click(function() {
    var id = $('#contactDeleteBtn').html();
    contactDelete(id);
    });
//Projects Delete
function contactDelete(deleteid) {
    $('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    axios.post('/deleteContact', {
          id: deleteid
      })
      .then(function(response) {
          if (response.data == 1) {
            $('#contactDeleteConfirmBtn').html("Yes");
              $('#deletecontactModal').modal('hide');
              // toastr.success('Delete Success');
              alert('Delete Success');
              getContactData();
          } else {
              $('#deletecontactModal').modal('hide');
              // toastr.success('Delete Fail');
              alert('Delete Fail');
              getContactData();
          }
    
      })
      .catch(function(error) {
        $('#deletecontactModal').modal('hide');
        // toastr.success('Delete Fail');
        alert('Something Went Wrong!');
      });
    
    }      