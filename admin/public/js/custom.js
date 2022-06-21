//Service Display For Admin Panel
function getCoursesData() {

  axios.get('/getCoursesData')
      .then(function(response) {
  
          if (response.status == 200) {
  
              $('#mainDivCourse').removeClass('d-none');
              $('#loaderDivCourse').addClass('d-none');
  
              $('#course_table').empty();
              var jsonData = response.data;
  
              $.each(jsonData, function(i, item) {
  
                  $('<tr>').html(
                      "<td>"+jsonData[i].course_name +"</td>" +
                      "<td>"+jsonData[i].course_fee +"</td>" +
                      "<td>"+jsonData[i].course_totalclass +"</td>" +
                      "<td>"+jsonData[i].course_totalenroll	+"</td>" +
                      "<td><a class='courseDetailsBtn' data-id=" + jsonData[i].id + "><i class='fas fa-eye'></i></a></td>"+
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