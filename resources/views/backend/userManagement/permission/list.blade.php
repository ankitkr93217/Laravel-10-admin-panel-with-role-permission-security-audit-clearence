
		    @include('app.header')
         	@include('app.left')
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
                              <h4 class="card-title mb-0">{{__('Permissions')}}</h4>
                           </div>
						  @can('permissions_create')
                    <a href="{{route('permissions.create')}}" class="btn btn-primary btn-round float-right"><i class="material-icons md-18"></i> {{__('Add New Permission')}}</a>
                @endcan
                        </div>
						
								  
                        <div class="card-body">
						 
                           <div class="">
                              <table class="datatable-init table table-bordered table-striped   data-table   ">
                                 <thead class="Primary">
									<tr>
										<th>{{__('Name')}}</th>
										<th>{{__('Display Name')}}</th>
										<th>{{__('Group')}}</th>
										<th>{{__('Group Slug')}}</th>
										<th class="col-lg-1 text-center">View</th>
										<th class="col-lg-1 text-center">Edit</th>
									</tr>
                                 </thead>
                                 @if($permissions->total() == 0)
                                <tr>
                                    <td colspan="6"  class="text-center">{{__('No results found.')}}</td>
                                </tr>
                            @else
                                @foreach($permissions as $permission)
                                    <tr>
                                       
                                        <td>
                                            @if(auth()->user()->can('permissions_show'))
                                                <a href="{{route('permissions.show', $permission->id)}}">{{$permission->name}}</a>
                                            @else
                                                {{$permission->name}}
                                            @endif
                                        </td>
                                        <td>{{$permission->display_name}}</td>
                                        <td>{{$permission->group_name}}</td>
                                        <td>{{$permission->group_slug}}</td>
										 <td  class="text-center">
                                            @can('permissions_show')
                                                <a href="{{route('permissions.show', $permission->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('View Permission')}}" class="btn btn-info btn-sm">
                                                    View
                                                </a>
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            @can('permissions_edit')
                                                <a href="{{route('permissions.edit', $permission->id)}}" data-toggle="tooltip" data-placement="top" title="{{__('Edit Permission')}}" class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                              </table>
					
                    <div class="float-left">
                        @if(!empty($term))
                            {{ $permissions->appends(['s' => $term])->links() }}
                        @else
                            {{ $permissions->links() }}
                        @endif
                    </div>

                    <div class="float-right text-muted">
                        {{__('Showing')}} {{ $permissions->firstItem() }} - {{ $permissions->lastItem() }} / {{ $permissions->total() }} ({{__('page')}} {{ $permissions->currentPage() }} )
                    </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
			   
         </div>
      </div>
@include('app.footer')
      