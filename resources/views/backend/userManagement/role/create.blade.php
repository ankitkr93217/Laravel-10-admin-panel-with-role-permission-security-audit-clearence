 
@extends('backend.layout.admin_layout')

@section('admin_content')

                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">User Management</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Create Role</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('role_list')}}" type="button" class="btn btn-primary">Go to List</a>
							 
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

    <div class="row">
    
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                
                <form method="POST" action=" ">
                    @csrf
                    <div class="row">
                      <div class="col-md-4 my-3">
                        <div class="form-group">
                            <label   class="">New Role Name</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="col-md-4 my-3">
                        <div class="form-group">
                            <label   class="">Guard</label>
                            <input id="guard_name" type="text" class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}" name="guard_name" value="{{ old('guard_name') }}" required autofocus>

                              @if ($errors->has('guard_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('guard_name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                    </div><!--end row -->

                    <div class="row">
                    
                      <div class="col-md-2 mt-3">
                        <h3>{{ __('Permissions') }}</h3>  
                      </div>
                      <div class="col-12">
                        <hr>
                      </div>
                      <div class="col-md-12 mx-auto">
                          
                            
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
                                                      <input class="form-check-input " type="checkbox" name="{{$perm['name']}}">
                                                      {{$perm['display_name'] !== null ? $perm['display_name'] : $perm['name']}}
                                                  </label>
                                                  
                                            </div>
                                                  
                                              @endforeach
        
                                          </div>
                                        

                                      </div>
                              @endforeach
                              
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-3">
                              <div class="form-group py-3">
                                  
                                      <button class="btn btn-primary" type="submit">Save Changes</button>
                              </div>
                          </div>
                      </div>
                </form>
            </div>
        </div>

    </div><!--End Row-->

    <script>
    $(".checkall").on('click', function(){
    	var status = $(this).attr('checked');
    	$(this).parent().parent().parent().find('input').attr('checked',!status);
    });
   </script> 

				                
@endsection()           

               