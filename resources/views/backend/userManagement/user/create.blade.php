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
            
         <div class="card border">
		        <div class="card-header fnt-18 d-flex align-items-center justify-content-between bg-dark text-white"> <strong> Create User</strong><a href="{{route('users.show')}}"><button type="submit" class="btn btn-primary fw-bold btn-sm" id="bpButton" >Users List</button>   
</a> </div>
               

           
          <div class="card-body">
         
       

            <form method="POST" action="{{ route('users.store') }}">
                    @csrf
     
		 
           
                <div class="row g-3">

                     
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="text">Name</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"   autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
      
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="text">Phone No</label>
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
<!-- // -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                        <label for="">Prefix(User Name)</label>
                                        <input id="prefix" type="text" class="form-control" readonly  name="prefix" value="nacp@" required>    
                                </div>
                            </div> 

                            <div class="col-lg-3">
                                <div class="form-group">
                                        <label for="">User Name</label>
                                        <input  type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"  >

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div> 
                            
                           
                            <div class="col-lg-3">
                                <div class="form-group">
                                        <label for="">Email </label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  >

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div> 

                            

                            <div class="col-lg-3">
                                <div class="form-group">
                                        <label for="">Password</label> 
                                         <input  type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                               
                            <!-- <div class="col-lg-3">
                                    <div class="form-group">
                                    <label for="">Confirm Password</label>
                                        
                                        <input id="password-confirm" type="text" class="form-control" name="password_confirmation" required>
                                    
                                    </div>
                            </div> -->

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Location </label>
                                        <select class="form-select{{ $errors->has('loc_id') ? ' is-invalid' : '' }}" name="loc_id">
                                        <option value="0">{{__('Select a Location')}}</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->loc_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('loc_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('loc_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                        <label >Assign Role</label>   
                                        <select class="form-select{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id">
                                        <option  value="0">Select Role</option>
                                        @foreach($roles as $role)
                                            <option  value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                                    
                  
             
            
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="bpButton" >Create</button>   
                    </div>
       
		        </div>  
            </form>
		    
         </div>
        </div>
       </div>
       </div>
        </div>
        </div>
    
  
@endsection