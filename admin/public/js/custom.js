//Projects Display For Admin Panel
function getProjectsData() {

  axios.get('/getProjectsData')
      .then(function(response) {
  
          if (response.status == 200) {
  
              $('#mainDivProject').removeClass('d-none');
              $('#loaderDivProject').addClass('d-none');
              
            //  $('#courseDataTable').DataTable().destroy();
             $('#project_table').empty();
              
              var jsonData = response.data;
  
              $.each(jsonData, function(i, item) {
  
                  $('<tr>').html(
                      "<td>"+jsonData[i].project_name +"</td>" +
                      "<td>"+jsonData[i].project_des +"</td>" +
                      "<td><a class='projectEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                      "<td><a class='projectDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                  ).appendTo('#project_table');
              });
              
            //Service Table Delete Icon Click
                 $('.projectDeleteBtn').click(function(){
                     var id = $(this).data('id');
                     $('#projectDeleteBtn').html(id);
                     $('#deleteProjectModal').modal('show');
                 })
              
              //Service Table Edit Icon Click
  
              $('.projectEditBtn').click(function(){
                 $('#projectUpdateModal').modal('show');
                 var id = $(this).data('id');
                 $('#projectEditBtn').html(id);
                 ProjectsDetails(id);
              })
             
              // $('#courseDataTable').DataTable({"order":false});
              // $('.dataTables_length').addClass('bs-select');
             
          } else {
              $('#loaderDivProject').addClass('d-none');
              $('#wrongDivProject').removeClass('d-none');
          }
  
        
      }).catch(function(error) {
        $('#loaderDivProject').addClass('d-none');
        $('#wrongDivProject').removeClass('d-none');
      });
  
  }


// Projects Add New btn Click
$('#addNewProjectBtnId').click(function(){
  $('#addProjectModal').modal('show');
});

// Projects Add Modal Save Btn
$('#projectAddConfirmBtn').click(function() {
  var ProjectName = $('#projectNameId').val();
  var ProjectDes = $('#projectDesId').val();
  var ProjectLink = $('#projectLinkId').val();
  var ProjectImg = $('#projectImgId').val();
  ProjectsAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg);
})

// Service Add Method

function ProjectsAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg) {


  if(ProjectName.length==0){
      // toastr.error('serviceName is Empty');
      alert('Project Name is Empty');
  }
  else if(ProjectDes.length==0){
      // toastr.error('serviceDes is Empty');
      alert('ProjectDes is Empty');
  }
  else if(ProjectLink.length==0){
   // toastr.error('serviceImg is Empty');
   alert('ProjectLink is Empty');
   }
  else if(ProjectImg.length==0){
      // toastr.error('serviceImg is Empty');
       alert('ProjectImg is Empty');
  }
  else{
      $('#projectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
      axios.post('/ProjectsAdd', {
        project_name:ProjectName,
        project_des:ProjectDes,
        project_link:ProjectLink,
        project_img:ProjectImg,
      })
      .then(function(response) {
          if(response.status==200){
              $('#projectAddConfirmBtn').html("Save");
              if (response.data == 1) {
                  $('#addProjectModal').modal('hide');
                  // toastr.success('Update Success');
                  alert('Add Success');
                  getProjectsData();
              } else {
                  $('#addProjectModal').modal('hide');
                  // toastr.error('Update Fail');
                  alert('Add Fail!')
                  getProjectsData();
              }
          }
  
      })
      .catch(function(error) {
          $('#addProjectModal').modal('hide');
          alert('Something Went Wrong!')
      });
  
  }
}
  
  
  
//Projects Delete Modal Yes Button
$('#projectDeleteConfirmBtn').click(function() {
  var id = $('#projectDeleteBtn').html();
  ProjectsDelete(id);
});


//Projects Edit/Update Modal Save Button
$('#projectUpdateConfirmBtn').click(function() {
  var id = $('#projectEditBtn').html();
  var projectName = $('#projectUpdateNameId').val();
  var projectDes = $('#projectUpdateDesId').val();
  var projectLink = $('#projectUpdateLinkId').val();
  var projectImg = $('#projectUpdateImgId').val();
  ProjectsUpdate(id,projectName,projectDes,projectLink,projectImg);

})

//Projects Delete
function ProjectsDelete(deleteid) {
  $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
axios.post('/ProjectsDelete', {
        id: deleteid
    })
    .then(function(response) {
        if (response.data == 1) {
          $('#projectDeleteConfirmBtn').html("Yes");
            $('#deleteProjectModal').modal('hide');
            // toastr.success('Delete Success');
            alert('Delete Success');
            getProjectsData();
        } else {
            $('#deleteProjectModal').modal('hide');
            // toastr.success('Delete Fail');
            alert('Delete Fail');
            getProjectsData();
        }

    })
    .catch(function(error) {
      $('#deleteProjectModal').modal('hide');
      // toastr.success('Delete Fail');
      alert('Something Went Wrong!');
    });

}  

//Each Project Update Details
function ProjectsDetails(detailsid) {
  axios.post('/ProjectsDetails', {
          id: detailsid
      })
      .then(function(response) {
          if(response.status==200){
              $('#projectEditForm').removeClass('d-none');
              $('#projectEditLoader').addClass('d-none');
              var jsonData = response.data;
              $('#projectUpdateNameId').val(jsonData[0].project_name);
              $('#projectUpdateDesId').val(jsonData[0].project_des);
              $('#projectUpdateLinkId').val(jsonData[0].project_link);
              $('#projectUpdateImgId').val(jsonData[0].project_img);
          }
          else{
          
              $('#projectEditLoader').addClass('d-none');
              $('#projectEditWrong').removeClass('d-none');
             
          }
      })
      .catch(function(error) {
          $('#projectEditLoader').addClass('d-none');
          $('#projectEditWrong').removeClass('d-none');
          
      });

}


//Service Update 
function ProjectsUpdate(projectId,projectName,projectDes,projectLink,projectImg) {

  
  if(projectName.length==0){
      // toastr.error('serviceName is Empty');
      alert('projectName is Empty');
  }
  else if(projectDes.length==0){
      // toastr.error('serviceDes is Empty');
      alert('projectDes is Empty');
  }
  else if(projectLink.length==0){
      // toastr.error('serviceImg is Empty');
      alert('projectLink is Empty');
  }else if(projectImg.length==0){
    // toastr.error('serviceImg is Empty');
    alert('projectImg is Empty');
}
  else{
      $('#projectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
      axios.post('/ProjectsUpdate', {
          id: projectId,
          project_name:projectName,
          project_des:projectDes,
          project_link:projectLink,
          project_img:projectImg,
      })
      .then(function(response) {
          if(response.status==200){
              $('#projectUpdateConfirmBtn').html("Save");
              if (response.data == 1) {
                  $('#projectUpdateModal').modal('hide');
                  // toastr.success('Update Success');
                  alert('Update Success');
                  getProjectsData();
              } else {
                  $('#projectUpdateModal').modal('hide');
                  // toastr.error('Update Fail');
                  alert('Update Fail!')
                  getProjectsData();
              }
          }

      })
      .catch(function(error) {
          $('#projectUpdateModal').modal('hide');
          alert('Something Went Wrong!')
      });
  
  }
}

