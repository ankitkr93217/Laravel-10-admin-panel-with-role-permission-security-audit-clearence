 
@extends('backend.layout.admin_layout')

@section('admin_content')

         
        
        <div class="row">
          <div class="col-xl-12 d-flex">
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-1">Role List</h5>
                   </div>
                  <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                  </div>
                </div>
                <div class="table-responsive mt-4">
                  <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                    <thead class="table-light">
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
                                                    <a href="{{route('edit_role',['id'=>$data->id])}}"><button type="button" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="lni lni-pencil"></i></button></a>
                                                    <a href="{{route( 'delete_role',['id'=>$data->id])}}"><button type="button"    class="btn btn-outline-danger btn-sm ms-1 me-1  deleteDrDt"  title="Delete"><i class="lni lni-trash"></i></em></button></a>
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
        <!--end row-->

     

				                
@endsection()           

               