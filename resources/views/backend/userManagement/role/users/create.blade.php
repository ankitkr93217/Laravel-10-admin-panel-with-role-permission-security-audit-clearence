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
              
              <h3 class="nk-block-title">Create User</h3>
               
            
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
			 

 
       
			 
          </div>
		    
         </div>
        </div>
       </div>
       </div>
        </div>
       
    
  
@endsection