@extends('Layout.app')
@section('title','Photo Gallery')
@section('content')

    <div id="mainDivReview"  class="container">
      <div class="row">
      <div class="col-md-12 p-3">
        <button data-mdb-toggle="modal" data-mdb-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
      </div>
      </div>
      </div>
      @endsection
     
 
    <!-- Modal -->
    <div class="modal fade" id="PhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body p-5">
              <h6 class="mb-4">Add New Photo</h6>
              <div id="photoAddForm" class="w-100">
                <input class="form-control" id="imgInput" type="file">
                <img class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default-image.png')}}">

                
              </div>  
            </div>
            <div class="modal-footer">
              <button type="button"  id="SavePhoto" class="btn btn-primary btn-sm">Save</button>
              <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>


@section('script')
    <script type="text/javascript">
        $('#imgInput').change(function () {
            var reader=new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload=function (event) {
               var ImgSource= event.target.result;
                $('#imgPreview').attr('src',ImgSource);
            }
        })
        

        $('#SavePhoto').on('click',function () {
        $('#SavePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
           var PhotoFile= $('#imgInput').prop('files')[0];
           var formData=new FormData();
           formData.append('photo',PhotoFile);
           axios.post("/PhotoUpload",formData).then(function (response) {
               if(response.status==200 && response.data==1){
                   $('#PhotoModal').modal('hide');
                   $('#SavePhoto').html('Save');
                   alert('Photo Upload Success');
               }
               else{
                   $('#PhotoModal').modal('hide');
                   alert('Photo Upload Fail');
               }
           }).catch(function (error) {
               $('#PhotoModal').modal('hide');
               alert('Photo Upload Fail');
              
           })
        });
    </script>
@endsection