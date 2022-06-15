//Visitor table page
$(document).ready(function() {
  $('#VisitorDt').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

//Service Display For Admin Panel
function getServicesData() {

  axios.get('/getServicesData')
      .then(function(response) {

          if (response.status == 200) {

              $('#mainDiv').removeClass('d-none');
              $('#loaderDiv').addClass('d-none');

              $('#service_table').empty();
              var jsonData = response.data;

              $.each(jsonData, function(i, item) {

                  $('<tr>').html(
                      "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                      "<td>" + jsonData[i].service_name + "</td>" +
                      "<td>" + jsonData[i].service_des + "</td>" +
                      "<td><a class='serviceEditBtn'><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#service_table');
              });
            //Delete  Button Icon Click
              $('.serviceDeleteBtn').click(function() {

                  var id = $(this).data('id');
                  $('#serviceDeleteBtn').html(id);
                  $('#deleteModal').modal('show');

              });
              
              $('.serviceEditBtn').click(function() {;
                $('#editModal').modal('show');

            });

          } else {
              $('#loaderDiv').addClass('d-none');
              $('#wrongDiv').removeClass('d-none');
          }

        
      }).catch(function(error) {
          $('#loaderDiv').addClass('d-none');
          $('#wrongDiv').removeClass('d-none');
      });

}
//Delete Yes Button
$('#serviceDeleteConfirmBtn').click(function() {
  var id = $('#serviceDeleteBtn').html();
  ServiceDelete(id);

})

//ServiceDelete
function ServiceDelete(deleteid) {
  axios.post('/serviceDelete', {
          id: deleteid
      })
      .then(function(response) {
          if (response.data == 1) {
              $('#deleteModal').modal('hide');
              // toastr.success('Hi! I am success message.');
              // toastr.success('suceess');
              toastr.success('Delete Success');
              getServicesData();
          } else {
              $('#deleteModal').modal('hide');
              // toastr.success('Hi! I am success message.');
              toastr.error('Delete Fail');
              getServicesData();
          }

      })
      .catch(function(error) {

      });

}