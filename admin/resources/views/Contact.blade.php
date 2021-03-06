@extends('Layout.app')

@section('content')



<div id="mainDivContact" class="container  d-none">
  <div class="row">
  <div class="col-md-12 p-5">
    
  <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Name</th>
        <th class="th-sm">Mobile</th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Message</th>
        <th class="th-sm">Delete</th>
      </tr>
    </thead>
    <tbody id="contact_table">
    
    <tr>
      <th class="th-sm">Name</th>
      <th class="th-sm">1000</th>
      <th class="th-sm">aaaa@gmail.com</th>
      <th class="th-sm">ddfw</th>
      <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
      </tr>	
    </tbody>
  </table>
  
  </div>
  </div>
  </div>



  <div id="loaderDivContact" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <img  class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
    </div>
    </div>
  </div>
  
  <div id="wrongDivContact" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something went wrong!</h3>
    </div>
    </div>
  </div>
  
@endsection

<div class="modal fade" id="deletecontactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Are You Sure to Delete?</h5>
        <h6 id="contactDeleteBtn" class="d-none"></h6>
      </div>
      <div class="modal-footer">
        <button type="button"  id="contactDeleteConfirmBtn" class="btn btn-primary btn-sm">Yes</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script type="text/javascript">
getContactData()


function getContactData(){
    axios.get('/getContactData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivContact').removeClass('d-none');
            $('#loaderDivContact').addClass('d-none');
            
          $('#contactDataTable').DataTable().destroy();
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
        
           
              $('#contactDataTable').DataTable({"order":false});
             $('.dataTables_length').addClass('bs-select');
           
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
</script>
@endsection