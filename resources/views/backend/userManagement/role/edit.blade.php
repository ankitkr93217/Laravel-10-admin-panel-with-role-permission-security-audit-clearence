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
            <strong>Roles Edit</strong>
            <a href="{{route('roles.show')}}" class="btn btn-danger btn-sm fw-bold ">Roles List</a>
          </div> 
          </div>

<!-- //////////////////// -->
<!-- <div class="row"> -->
			
					
            <div class="col-lg-12">
              <!-- <div class="card card-block card-stretch card-height">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title"> -->
                       <!-- <h4 class="card-title"> Add New Role</h4> -->
                    <!-- </div>
                    
                 </div>
                 <div class="card-body"> -->
                  
                   <form method="POST" action="{{ route('roles.update', $role->id) }}">
              @csrf 
                    <div class="col-md-4 my-3">
                       <div class="form-group">

                               @if($role->id === 1 || $role->id === 2 )
                                    @php
                                    $disable='disable';
                                    @endphp
                               @else
                                    @php
                                    $disable='';
                                    @endphp
                                @endif
                            
                                <label for="email" class="fw-bold">New Role Name</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}" required {{$disable}} autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            
                        </div>
                    </div>


                        
                <div class=" row">
                  <div class="col-md-2 mt-3">
                    <h3>{{ __('Permissions') }}</h3>
                    
                </div>
                  <div class="col-12">
                    <hr>
                  </div>
                  <div class="col-md-12">
                     
                      
                        @foreach($groups as $group)
                               
                                <div class="row my-2">

                                    <div class="col-4">
                                        <div class="form-check  ">
                                            <input type="checkbox" class="form-check-input checkall">
                                            <label class="fw-bold mx-1 ">{{$group['name']}}</label>
                                            
                                         </div>
                                    </div>
                                    <div class="col-8  ">
  
                                        @foreach($group['permissions'] as $perm)
                                       <div class="form-check">

                                            <label class="mr-4 ">
                                                <input class="form-check-input " type="checkbox"  name="{{$perm['name']}}"  @if($role->hasPermissionTo($perm['id'])) checked @endif>
                                                {{$perm['display_name'] !== null ? $perm['display_name'] : $perm['name']}}
                                            </label>
                                            
                                       </div>
                                            
                                        @endforeach
   
                                    </div>
                                   

                                </div>
                        @endforeach
                         
                  </div>
                  <div class="col-12">
                    <hr>
                  </div>
                  <div class="col-md-12 mb-4">
                   
                     <button type="submit" class="btn btn-primary">
                          <i class="material-icons md-18"></i> {{ __('Create') }}
                      </button>
                      <a href="{{route('roles.show')}}" class="btn btn-danger">Roles List</a>
                  </div>

              </div>
            
              
          </form>
           </div>
<!-- ///////////////////// -->



		    
         <!-- </div>
        </div> -->
       <!-- </div> -->
       </div>
        </div>
   <script>
    $(".checkall").on('click', function(){
    	var status = $(this).attr('checked');
    	$(this).parent().parent().parent().find('input').attr('checked',!status);
    });
   </script>    
    
  
@endsection