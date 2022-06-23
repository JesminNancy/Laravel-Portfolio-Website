@extends('Layout.app')

@section('content')



<div id="mainDivCourse" class="container  d-none">
  <div class="row">
  <div class="col-md-12 p-5">
  
    <button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-info">Add New </button>
    
  <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Fee</th>
        <th class="th-sm">Class</th>
        <th class="th-sm">Enroll</th>
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


 
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  <div class="modal-header">
      <h5 class="modal-title">Update Course</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body  text-center">
    
    <h5 id="courseEditId" class="mt-4 d-none">  </h5>

     <div id="courseEditForm" class="container d-none">

      <div class="row">
        <div class="col-md-6">
        <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
        <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
        <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
        <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
        </div>
        <div class="col-md-6">
        <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
        <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
        <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
        </div>
      </div>
     </div>

        <img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
        <h5 id="courseEditWrong" class="d-none">Something Went Wrong !</h5>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Are You Sure to Delete?</h5>
        <h6 id="courseDeleteBtn" class="d-none"></h6>
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


//Courses Display For Admin Panel
function getCoursesData() {

axios.get('/getCoursesData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
            
          //  $('#courseDataTable').DataTable().destroy();
           $('#course_table').empty();
            
            var jsonData = response.data;

            $.each(jsonData, function(i, item) {

                $('<tr>').html(
                    "<td>"+jsonData[i].course_name +"</td>" +
                    "<td>"+jsonData[i].course_fee +"</td>" +
                    "<td>"+jsonData[i].course_totalclass +"</td>" +
                    "<td>"+jsonData[i].course_totalenroll	+"</td>" +
                    "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                    "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#course_table');
            });
            
          //Service Table Delete Icon Click
              $('.courseDeleteBtn').click(function(){
                  var id = $(this).data('id');
                  $('#courseDeleteBtn').html(id);
                  $('#deleteCourseModal').modal('show');
              })
            
            //Service Table Edit Icon Click

            $('.courseEditBtn').click(function(){
              var id= $(this).data('id');
              CourseUpdateDetails(id);
              $('#courseEditId').html(id);
              $('#updateCourseModal').modal('show');
           })
           
           $('#courseDataTable').DataTable({"order":false});
           $('.dataTables_length').addClass('bs-select');
           
        } else {
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        }

      
    }).catch(function(error) {
      $('#loaderDivCourse').addClass('d-none');
      $('#wrongDivCourse').removeClass('d-none');
    });

}

// Courses Add New btn Click
$('#addNewCourseBtnId').click(function(){
  $('#addCourseModal').modal('show');
});

// Courses Add Modal Save Btn
$('#CourseAddConfirmBtn').click(function() {
  var CourseName = $('#CourseNameId').val();
  var CourseDes = $('#CourseDesId').val();
  var CourseFee = $('#CourseFeeId').val();
  var CourseEnroll = $('#CourseEnrollId').val();
  var CourseClass = $('#CourseClassId').val();
  var CourseLink = $('#CourseLinkId').val();
  var CourseImg = $('#CourseImgId').val();
  CoursesAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})

// Service Add Method

function CoursesAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {


  if(CourseName.length==0){
      // toastr.error('serviceName is Empty');
      alert('CourseName is Empty');
  }
  else if(CourseDes.length==0){
      // toastr.error('serviceDes is Empty');
      alert('CourseDes is Empty');
  }
  else if(CourseFee.length==0){
   // toastr.error('serviceImg is Empty');
   alert('CourseFee is Empty');
   }
  else if(CourseEnroll.length==0){
      // toastr.error('serviceImg is Empty');
       alert('CourseEnroll is Empty');
  }
   else if(CourseClass.length==0){
      // toastr.error('serviceImg is Empty');
      alert('CourseClass is Empty');
   }
   else if(CourseLink.length==0){
      // toastr.error('serviceImg is Empty');
      alert('CourseLink is Empty');
   }
   else if(CourseImg.length==0){
      // toastr.error('serviceImg is Empty');
       alert('CourseImg is Empty');
  }else{
      $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
      axios.post('/CoursesAdd', {
          course_name:CourseName,
          course_des:CourseDes,
          course_fee:CourseFee,
          course_totalenroll:CourseEnroll,
          course_totalclass:CourseClass,
          course_link:CourseLink,
          course_img:CourseImg,
      })
      .then(function(response) {
          if(response.status==200){
              $('#CourseAddConfirmBtn').html("Save");
              if (response.data == 1) {
                  $('#addCourseModal').modal('hide');
                  // toastr.success('Update Success');
                  alert('Add Success');
                  getCoursesData();
              } else {
                  $('#addCourseModal').modal('hide');
                  // toastr.error('Update Fail');
                  alert('Add Fail!')
                  getCoursesData();
              }
          }
  
      })
      .catch(function(error) {
          $('#addCourseModal').modal('hide');
          alert('Something Went Wrong!')
      });
  
  }
}
  
//Courses Delete Modal Yes Button
$('#courseDeleteConfirmBtn').click(function() {
  var id = $('#courseDeleteBtn').html();
  CourseDelete(id);
});

//Course Delete
function CourseDelete(deleteid) {
  $('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
axios.post('/CoursesDelete', {
        id: deleteid
    })
    .then(function(response) {
        if (response.data == 1) {
          $('#courseDeleteConfirmBtn').html("Yes");
            $('#deleteCourseModal').modal('hide');
            // toastr.success('Delete Success');
            alert('Delete Success');
            getCoursesData();
        } else {
            $('#deleteCourseModal').modal('hide');
            // toastr.success('Delete Fail');
            alert('Delete Fail');
            getCoursesData();
        }

    })
    .catch(function(error) {
      $('#deleteCourseModal').modal('hide');
      // toastr.success('Delete Fail');
      alert('Something Went Wrong!');
    });

}  



      // Course Update
      function CourseUpdateDetails(detailsID){
        axios.post('/CoursesDetails', {
          id: detailsID
        })
       .then(function(response) {
         if(response.status==200){
              $('#courseEditForm').removeClass('d-none');
              $('#courseEditLoader').addClass('d-none');    
              var jsonData = response.data;
              $('#CourseNameUpdateId').val(jsonData[0].course_name);
              $('#CourseDesUpdateId').val(jsonData[0].course_des);
              $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
              $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
              $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
              $('#CourseLinkUpdateId').val(jsonData[0].course_link);
              $('#CourseImgUpdateId').val(jsonData[0].course_img);
          }
        
        else{
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
          }
        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
      });
}
$('#CourseUpdateConfirmBtn').click(function(){
    var courseID=$('#courseEditId').html();
    var  courseName=$('#CourseNameUpdateId').val();
    var  courseDes=$('#CourseDesUpdateId').val();
    var courseFee=$('#CourseFeeUpdateId').val();
    var  courseEnroll=$('#CourseEnrollUpdateId').val();
    var  courseClass=$('#CourseClassUpdateId').val();
    var courseLink=$('#CourseLinkUpdateId').val();
    var  courseImg=$('#CourseImgUpdateId').val();
CourseUpdate(courseID,courseName,courseDes,courseFee,courseEnroll,courseClass,courseLink,courseImg);
})
function CourseUpdate(courseID,courseName,courseDes,courseFee,courseEnroll,courseClass,courseLink,courseImg) {
  
  if(courseName.length==0){
  toastr.error('Course Name is Empty !');
  }
  else if(courseDes.length==0){
  toastr.error('Course Description is Empty !');
  }
  else if(courseFee.length==0){
  toastr.error('Course Fee is Empty !');
  }
  else if(courseEnroll.length==0){
  toastr.error('Course Enroll is Empty !');
  }
  else if(courseClass.length==0){
  toastr.error('Course Class is Empty !');
  }
  else if(courseLink.length==0){
  toastr.error('Course Link is Empty !');
  }
  else if(courseImg.length==0){
  toastr.error('Course Image is Empty !');
  }
  else{
$('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Animation....
axios.post('/CoursesUpdate', {
    id: courseID,
    course_name: courseName,
    course_des: courseDes,
    course_fee: courseFee,
    course_totalenroll: courseEnroll,
    course_totalclass: courseClass,  
    course_link: courseLink,             
    course_img: courseImg,   
})
  .then(function(response) {
      $('#CourseUpdateConfirmBtn').html("Save");
      if(response.status==200){
        if (response.data == 1) {
          $('#updateCourseModal').modal('hide');
          // toastr.success('Update Success');
          alert('Update Success');
          getCoursesData();
      } else {
          $('#updateCourseModal').modal('hide');
          // toastr.error('Update Fail');
          alert('Update Fail');
          getCoursesData();
      }  
   } 
   else{
      $('#updateCourseModal').modal('hide');
       toastr.error('Something Went Wrong !');
   }   
  })
  .catch(function(error) {
    $('#updateCourseModal').modal('hide');
    toastr.error('Something Went Wrong !');
  });
  }
}  
</script>
@endsection