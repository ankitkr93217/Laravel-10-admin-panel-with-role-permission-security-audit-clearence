 
@extends('backend.layout.admin_layout')

@section('admin_content')

    <div class="row">
    
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                
                <form method="POST" action="{{ route('user_edit',$user[0]->id) }}">
                    @csrf
                <div class="row">
                    
                     
                
     
                                        
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="text">Name :</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user[0]->name}}"   autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="text">Phone No:</label>
                            <input id="phone" type="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{$user[0]->number}}">

                            @if ($errors->has('number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                                <label for="">User Name</label>
                                <input id="email" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="<?php if(!empty($user[0]->username)){echo $user[0]->username; }else{echo 'NA';} ?>"  >

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div> 


                    <div class="col-lg-3">
                        <div class="form-group">
                                <label for="">E-Mail Address </label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user[0]->email}}"  >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div> 

                   

                    <div class="col-lg-3">
                        <div class="form-group">
                                <label for="">Assign Role</label>   
                                <select class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id">
                                <option  value="0">Select Role</option>
                                @foreach($roles as $role)
                                    <option  value="{{$role->id}}" @if($role->name==$user[0]->r_name) {{'selected'}} @else {{''}}  @endif>{{$role->name}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

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

				                
@endsection()           

               