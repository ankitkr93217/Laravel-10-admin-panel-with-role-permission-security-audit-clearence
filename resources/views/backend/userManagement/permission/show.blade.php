
		    @extends('app.header')
         	@extends('app.left')
         <div class="content-page">
            <div class="container-fluid">
            <div class="row">
			
			
                  <div class="col-lg-12">
				  
		
                       <div id="app">
                       @include('flash-message')
                             </div>
                     <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title mb-0">{{__('Permission Details')}}</h4>
                           </div>
						<div class="heading">
                @can('permissions_edit')
                    <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary btn-round"><i class="material-icons md-18"></i> <span class="d-md-inline d-none">{{__('Edit')}}</span></a>
                @endcan

                <!--@can('permissions_delete')
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-round deleteBtn" data-confirm-message="{{__("Are you sure you want to delete this permission?")}}"><i class="material-icons md-18">delete</i> <span class="d-md-inline d-none">{{__('Delete')}}</span></button>
                    </form>
                @endcan-->

                <a href="{{route('permissions.index')}}" class="btn btn-secondary btn-round"><i class="material-icons md-18"></i> <span class="d-md-inline d-none">{{__('Back To List')}}</span></a>
            </div>
                        </div>
						
								  <div class="card bg-white">
            <div class="card-body">
                <div class="row">
                   
                </div>
            </div>
        </div>
                        <div class="card-body">
						 <div class="col-md-4" style="float: right;">
                        <form class="w-100">
                            <div class="input-group bg-light">
                                <input type="text" name="s" class="form-control searchInput" placeholder="{{__('Search')}}" @if(!empty($term)) value="{{$term}}" @endif>
                                <div class="input-group-append">
                                     @if(!empty($term))
                                        <a href="{{route('permissions.index')}}" class="btn btn-light">
                                            <i class="material-icons md-18">close</i>
                                        </a>
                                    @endif
                                    <button class="btn btn-primary">
                                        <i class="material-icons md-18">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                           <div class="">
                              <table class="table table-striped" style="width:100%">
                                 <thead class="light">
                                   <tr>
                                
                                
                                
                                 
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Display Name') }}</th>
                                <th>{{ __('Group Name') }}</th>
                                <th>{{ __('Group Slug') }}</th>
								
                               
								
                            </tr>
                                 </thead>
								    <tbody>
                                
                                <tr>
                                    
									<td> {{ $permission->name }}</td>
									<td> {{ $permission->display_name }}</td>
									<td>{{ $permission->group_name }}</td>
									<td> {{ $permission->group_slug }}</td>
                                </tr>
                         
                               
                        </tbody>
                              </table>
				
                   
                   
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
			   
         </div>
      </div>
@extends('app.footer')
      