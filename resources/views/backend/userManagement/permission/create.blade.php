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
              
              <h3 class="nk-block-title">Create Permission</h3>
               
            
              </div>
              
              
            </div>
         <div class="card border">
		        <div class="card-header p-3 d-flex align-items-center justify-content-between bg-dark text-white"> <strong> Create Permission</strong> </div>
               

            <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
     
          <div class="card-body">
		 
           
            <div class="row g-3">
             
             <div class="col-lg-3">
              <div class="form-group">
               <label for="exampleFormControlInput9" class="form-label">Name
               </label>
               <div class="form-control-wrap">
                <input type="text" class="form-control" Placeholder="Name"  name="name"   >
                <p id="numberText"></p>
               </div>
              </div>
             </div>
             
             <div class="col-lg-3">
              <div class="form-group">
               <label for="exampleFormControlInput9" class="form-label">Display Name
               </label>
               <div class="form-control-wrap">
                <input type="text" class="form-control" Placeholder="Display Name"  name="display_name"   >
                <p id="numberText"></p>
               </div>
              </div>
             </div>
             <div class="col-lg-3">
              <div class="form-group">
               <label for="exampleFormControlInput9" class="form-label">Group Name
               </label>
               <div class="form-control-wrap">
                <input type="text" class="form-control" Placeholder="Group Name"  name="group_name"   >
                <p id="numberText"></p>
               </div>
              </div>
             </div>
              

             <div class="col-12">
                <button type="submit" class="btn btn-primary" id="bpButton" >Create</button>
                
            </div>
        </form>   
			 

<hr class="mb-0">
      <div class="col-md-12">
        <div class="fw-bold my-2">
          <h3>Permission List</h3>
        </div>
	  <!-- <div class="table-scroll"> -->
		<div class="table-responsive">
        <table class="datatable-init table table-bordered table-striped"  id="myTable"  data-nk-container="table-responsive table-border">
          <thead>
            <tr>
            <th class="col-lg-2"><label  class="form-label">NO.
               </label></th>
              <th class="col-lg-2"><label  class="form-label">Name
               </label></th>
               <th class="col-lg-2"><label  class="form-label">Display Name
               </label></th>
               <th class="col-lg-2"><label  class="form-label">Group Name
               </label></th>
               <th class="col-lg-2"><label  class="form-label">Group Slug
               </label></th>
               <th class="col"><label  class="form-label">Action
               </label></th>
            </tr>
          </thead>
          <tbody>
             
            <!-- 'permissions/permission_list_pagination'  -->
            @if(!empty($permissions))
                 
                 @foreach($permissions as $key=>$data)
                
                                 <tr>
                                   <td class="tb-col text-center">{{(int)$key+1}}</td>
                                   <td class="tb-col text-nowrap"> {{$data->name}}</td>
                                   <td class="tb-col"> {{$data->display_name}}</td>
                                   <td class="tb-col">{{$data->group_name}}</td>
                                   <td class="tb-col">{{$data->group_slug}}</td>
                                   <td class="tb-col">
                                        <div class="btn-group" role="group" > 
                                        <a href="{{route('permissionEditView',['id'=>$data->id])}}"><button type="button" class="btn btn-outline-secondary btn-sm" title="Edit"><em class="icon ni ni-edit-fill"></em></button></a>
                                        <a href="{{route('permissions.destroy',['id'=>$data->id])}}"><button type="button"    class="btn btn-outline-danger btn-sm ms-1 me-1  deleteDrDt"  title="Delete"><em class="icon ni ni-trash"></em></button></a>
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
		<!-- </div> -->
      </div>
			 
          </div>
		    
         </div>
        </div>
       </div>
       </div>
        </div>
       
    
  
@endsection