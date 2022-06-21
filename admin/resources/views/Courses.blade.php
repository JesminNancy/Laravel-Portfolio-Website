@extends('Layout.app')

@section('content')



<div id="mainDivCourse" class="container  d-none">
  <div class="row">
  <div class="col-md-12 p-5">
  
    <button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
    
  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Fee</th>
        <th class="th-sm">Class</th>
        <th class="th-sm">Enroll</th>
        <th class="th-sm">Details</th>
        <th class="th-sm">Edit</th>
        <th class="th-sm">Delete</th>
      </tr>
    </thead>
    <tbody id="course_table">
    
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">1000</th>
      <th class="th-sm">120</th>
      <th class="th-sm">200</th>
      <th class="th-sm"><a href="" ><i class="fas fa-eye"></i></a></th>
      <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
      <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
      </tr>	
    </tbody>
  </table>
  
  </div>
  </div>
  </div>



  <div id="loaderDivCourse" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <img  class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
    </div>
    </div>
  </div>
  
  <div id="wrongDivCourse" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something went wrong!</h3>
    </div>
    </div>
  </div>

@endsection


<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Are You Sure to Delete?</h5>
        <h6 id="courseDeleteBtn"></h6>
      </div>
      <div class="modal-footer">
        <button type="button"  id="courseDeleteConfirmBtn" class="btn btn-primary btn-sm">Yes</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script type="text/javascript">
getCoursesData()
</script>
@endsection