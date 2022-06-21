@extends('Layout.app')

@section('content')
  
 
<div id="mainDiv" class="container d-none">
  <div class="row">
  <div class="col-md-12 p-5">
  
    <button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
    
  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="th-sm">Image</th>
      <th class="th-sm">Name</th>
      <th class="th-sm">Description</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
      </tr>
    </thead>
    <tbody id="service_table">
 
    
    </tbody>
  </table>
  
  </div>
  </div>
  </div>
  
  <div id="loaderDiv" class="container">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <img  class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
    </div>
    </div>
  </div>
  
  <div id="wrongDiv" class="container d-none">
    <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something went wrong!</h3>
    </div>
    </div>
  </div>
  
  

@endsection

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
        <h5 class="mt-4">Are You Sure to Delete?</h5>
        <h6 id="serviceDeleteBtn"></h6>
      </div>
      <div class="modal-footer">
        <button type="button"  id="serviceDeleteConfirmBtn" class="btn btn-primary btn-sm">Yes</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div> 


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
        <h6 id="serviceEditBtn"></h6>
        <div id="serviceEditForm" class=" d-none w-100">
          <input id="serviceNameId" type="text" class="form-control mb-4"  placeholder="Service-Name"/>
          <input id="serviceDesId" type="text"  class="form-control mb-4"  placeholder="Service-Descrption"/>
          <input id="serviceImgId" type="text"  class="form-control"  placeholder="Service-Image"/>
        </div>  
          <img  id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
          <h5 id="serviceEditWrong" class="d-none">Something went wrong!</h5>
      </div>
      <div class="modal-footer">
        <button type="button"  id="serviceUpdateConfirmBtn" class="btn btn-primary btn-sm">Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
        <h6 class="mb-4">Add New Service</h6>
        <div id="serviceAddForm" class="w-100">
          <input id="serviceNameAddId" type="text"  class="form-control mb-4"  placeholder="Service Name"/>
          <input id="serviceDesAddId" type="text"  class="form-control mb-4"  placeholder="Service Descrption"/>
          <input id="serviceImgAddId" type="text" class="form-control"  placeholder="Service Image"/>
        </div>  
      </div>
      <div class="modal-footer">
        <button type="button"  id="serviceAddConfirmBtn" class="btn btn-primary btn-sm">Save</button>
        <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@section('script')
<script type="text/javascript">
 getServicesData();
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

// Service Add New btn Click
$('#addNewBtnId').click(function(){
   $('#addModal').modal('show');
});
// Services Edit Modal Save Btn
$('#serviceAddConfirmBtn').click(function() {
    var name = $('#serviceNameAddId').val();
    var des = $('#serviceDesAddId').val();
    var img = $('#serviceImgAddId').val();
    ServiceAdd(name,des,img);
})
// Service Add Method

function ServiceAdd(serviceName,serviceDes,serviceImg) {

  
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
    $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");//Animation
    axios.post('/serviceAdd', {
        name:serviceName,
        des:serviceDes,
        img:serviceImg,
    })
    .then(function(response) {
        if(response.status==200){
            $('#serviceAddConfirmBtn').html("Save");
            if (response.data == 1) {
                $('#addModal').modal('hide');
                // toastr.success('Update Success');
                alert('Add Success');
                getServicesData();
            } else {
                $('#addModal').modal('hide');
                // toastr.error('Update Fail');
                alert('Add Fail!')
                getServicesData();
            }
        }

    })
    .catch(function(error) {
        $('#addModal').modal('hide');
        alert('Something Went Wrong!')
    });

}
}

 
</script>
@endsection