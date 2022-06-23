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
</script>
@endsection