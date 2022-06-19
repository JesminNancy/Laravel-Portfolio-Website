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
                      "<td><a class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#service_table');
              });
              
            //Service Table Delete Icon Click
              $('.serviceDeleteBtn').click(function() {

                  var id = $(this).data('id');
                  $('#serviceDeleteBtn').html(id);
                  $('#deleteModal').modal('show');

              });
              
              //Service Table Edit Icon Click
              $('.serviceEditBtn').click(function() {
                var id = $(this).data('id');
                $('#serviceEditBtn').html(id);
                ServiceEUpdateDetails(id);
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
//Services Delete Modal Yes Button
$('#serviceDeleteConfirmBtn').click(function() {
  var id = $('#serviceDeleteBtn').html();
  ServiceDelete(id);

})

//Services Edit/Update Modal Save Button
$('#serviceUpdateConfirmBtn').click(function() {
    var id = $('#serviceEditBtn').html();
    var name = $('#serviceNameId').val();
    var des = $('#serviceDesId').val();
    var img = $('#serviceImgId').val();
    ServiceUpdate(id,name,des,img);
  
  })

//Service Delete
function ServiceDelete(deleteid) {
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
  axios.post('/serviceDelete', {
          id: deleteid
      })
      .then(function(response) {
          if (response.data == 1) {
            $('#serviceDeleteConfirmBtn').html("Yes");
              $('#deleteModal').modal('hide');
              // toastr.success('Delete Success');
              alert('Delete Success');
              getServicesData();
          } else {
              $('#deleteModal').modal('hide');
              // toastr.success('Delete Fail');
              alert('Delete Fail');
              getServicesData();
          }

      })
      .catch(function(error) {

      });

}

//Each Service Update Details
function ServiceEUpdateDetails(detailsid) {
    axios.post('/serviceDetails', {
            id: detailsid
        })
        .then(function(response) {
            if(response.status==200){
                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#serviceNameId').val(jsonData[0].service_name);
                $('#serviceDesId').val(jsonData[0].service_des);
                $('#serviceImgId').val(jsonData[0].	service_img);
            }
            else{
            
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
               
            }
        })
        .catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');
            
        });
  
  }
  
  
//Service Update 
function ServiceUpdate(serviceId,serviceName,serviceDes,serviceImg) {

    
    if(serviceName.length==0){
        // toastr.error('serviceName is Empty');
        alert('serviceName is Empty');
    }
    else if(serviceDes.length==0){
        // toastr.error('serviceDes is Empty');
        alert('serviceDes is Empty');
    }
    else if(serviceImg.length==0){
        // toastr.error('serviceImg is Empty');
        alert('serviceImg is Empty');
    }else{
        $('#serviceUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
        axios.post('/serviceUpdate', {
            id: serviceId,
            name:serviceName,
            des:serviceDes,
            img:serviceImg,
        })
        .then(function(response) {
            if(response.status==200){
                $('#serviceUpdateConfirmBtn').html("Save");
                if (response.data == 1) {
                    $('#editModal').modal('hide');
                    // toastr.success('Update Success');
                    alert('Update Success');
                    getServicesData();
                } else {
                    $('#editModal').modal('hide');
                    // toastr.error('Update Fail');
                    alert('Update Fail!')
                    getServicesData();
                }
            }

        })
        .catch(function(error) {
            $('#editModal').modal('hide');
            alert('Something Went Wrong!')
        });
    
    }
  }