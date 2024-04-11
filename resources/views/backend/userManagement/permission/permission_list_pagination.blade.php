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

                        <tr >
                            <td colspan="12" align="center">
                            {!! $permissions->links() !!}
                            </td>
                        </tr>
                 @else
                 {{'Na'}}
                 @endif