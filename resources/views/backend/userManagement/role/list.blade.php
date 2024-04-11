@extends('layouts.main')
  
@section('content')

<style>
.table-scroll {
	position:relative;
	max-width:1200px;
	overflow:hidden;
}
.table-wrap {
	width:100%;
	overflow:auto;
}
.table-scroll th, .table-scroll td {
	
	
	background:#fff;
	white-space:nowrap;
	vertical-align:top;
}
.table-scroll .form-label{margin-bottom: 0rem;}

</style>
    <!-- <div class="nk-wrap">
     <div class="nk-header nk-header-fixed"> -->
      
     <div class="nk-content">
      <div class="container-fluid">
       <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
              <div class="nk-block-head-content">
               
              </div>
            </div>
         <div class="card border">

          <div class="card-header fnt-18 d-flex align-items-center justify-content-between bg-dark text-white"> 
            <strong>Roles List</strong>
            <a href="{{route('roles.create')}}"> <button type="submit" class="btn btn-primary fw-bold  btn-sm" id="bpButton" >Create Role</button></a>
          </div>
               

            
      <div class="col-md-12">
        <!-- <div class="fw-bold my-2">
           
        </div> -->
	  <div class="table-responsive">
		<div class="table-wrap ">
        <table class="datatable-init table table-bordered"  id="myTable"   id=""  data-toggle="table"  >
          <thead>
            <tr>
            <th  ><label  class="form-label">NO.
               </label></th>
              <th  ><label  class="form-label">Name
               </label></th>
               <th  ><label  class="form-label">Guard Name
               </label></th>
               
               <th  ><label  class="form-label">Action
               </label></th>
            </tr>
          </thead>
          <tbody>
             
            
            @if(!empty($roles))
                 
                 @foreach($roles as $key=>$data)
                
                                 <tr>
                                   <td class="tb-col text-center">{{(int)$key+1}}</td>
                                   <td class="tb-col text-nowrap"> {{$data->name}}</td>
                                   <td class="tb-col"> {{$data->guard_name}}</td>
                                    
                                   <td class="tb-col">
                                        <div class="btn-group" role="group" > 
                                        <a href="{{route('roles.edit',['id'=>$data->id])}}"><button type="button" class="btn btn-outline-secondary btn-sm" title="Edit"><em class="icon ni ni-edit-fill"></em></button></a>
                                        <a href="{{route( 'roles.destroy',['id'=>$data->id])}}"><button type="button"    class="btn btn-outline-danger btn-sm ms-1 me-1  deleteDrDt"  title="Delete"><em class="icon ni ni-trash"></em></button></a>
                                        <!-- eg-swal-confirm-button -->
                                        <!-- data-id="{{$data->tbv_drs_id}}" -->
                                        </div>
                                   </td>
                                 </tr>

                 @endforeach

                       
                 @else
                 {{'Na'}}
                 @endif
            
          </tbody>
        </table>
		</div>
		</div>
      </div>
			 
          </div>
		    
         </div>
        </div>
       </div>
       </div>
        </div>
       
    
  
@endsection