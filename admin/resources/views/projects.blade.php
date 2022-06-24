@extends('Layout.app')

@section('content')


<div id="mainDivProject" class="container  d-none">
  <div class="row">
  <div class="col-md-12 p-5">
  
    <button id="addNewProjectBtnId" class="btn my-3  btn-primary">Add New </button>
    
  <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Description</th>
        <th class="th-sm">Edit</th>
        <th class="th-sm">Delete</th>
      </tr>
    </thead>
    <tbody id="project_table">
    
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">adddddd</th>
      <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
      <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
      </tr>	
    </tbody>
  </table>
  
  </div>
  </div>
  </div>



  <div id="loaderDivProject" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <img  class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
    </div>
    </div>
  </div>
  
  <div id="wrongDivProject" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something went wrong!</h3>
    </div>
    </div>
  </div>


@endsection

<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      	
      	<input id="projectNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
        <input id="projectDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
    		<input id="projectLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
     		<input id="projectImgId" type="text" id="" class="form-control mb-3" placeholder="Project Img">
       	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="projectUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <h6 id="projectEditBtn" class="d-none"></h6>
        <div id="projectEditForm" class=" d-none w-100">
          <input id="projectUpdateNameId" type="text" class="form-control mb-4"  placeholder="Project-Name"/>
          <input id="projectUpdateDesId" type="text"  class="form-control mb-4"  placeholder="Project-Descrption"/>
          <input id="projectUpdateLinkId" type="text"  class="form-control mb-4"  placeholder="Project Link"/>
          <input id="projectUpdateImgId" type="text"  class="form-control"  placeholder="Project-Image"/>
        </div>  
          <img  id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          <h5 id="projectEditWrong" class="d-none">Something went wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button"  id="projectUpdateConfirmBtn" class="btn btn-primary btn-sm">Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Are You Sure to Delete?</h5>
        <h6 id="projectDeleteBtn" class="d-none"></h6>
      </div>
      <div class="modal-footer">
        <button type="button"  id="projectDeleteConfirmBtn" class="btn btn-primary btn-sm">Yes</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script type="text/javascript">
getProjectsData();

//Projects Display For Admin Panel
function getProjectsData() {

axios.get('/getProjectsData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivProject').removeClass('d-none');
            $('#loaderDivProject').addClass('d-none');
            
           $('#projectDataTable').DataTable().destroy();
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
           
             $('#projectDataTable').DataTable({"order":false});
             $('.dataTables_length').addClass('bs-select');
           
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


//Project Update 
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


</script>
@endsection