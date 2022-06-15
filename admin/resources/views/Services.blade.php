@extends('Layout.app')

@section('content')
    
<div id="mainDiv" class="container d-none">
  <div class="row">
  <div class="col-md-12 p-5">
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


@section('script')

<script type="text/javascript">
  getServicesData();
</script>
@endsection