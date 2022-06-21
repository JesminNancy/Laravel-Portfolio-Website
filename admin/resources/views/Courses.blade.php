@extends('Layout.app')

@section('content')



<div id="mainDivCourse" class="container  d-none">
  <div class="row">
  <div class="col-md-12 p-5">
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




@section('script')
<script type="text/javascript">
getCoursesData()
</script>
@endsection