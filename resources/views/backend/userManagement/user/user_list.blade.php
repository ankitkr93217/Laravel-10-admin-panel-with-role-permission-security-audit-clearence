@if(!empty($users))
                 
                 @foreach($users as $key=>$data)
                
                                 <tr>
                                   <td class="tb-col text-center">{{(int)$key+1}}</td>
                                   <td class="tb-col text-nowrap"> {{$data->name}}</td>
                                   <td class="tb-col"> {{$data->email}}</td>
                                   <td class="tb-col">{{'Role'}}</td>
                                   <td class="tb-col">{{'Active/In Active'}}</td>
                                   <td class="tb-col">{{'Last Login time'}}</td>
                                   <td class="tb-col">
                                        <div class="btn-group" role="group" > 
                                        <a href="{{route('permissionEditView',['id'=>$data->id])}}"><button type="button" class="btn btn-outline-secondary btn-sm" title="Edit"><em class="icon ni ni-edit-fill"></em></button></a>
                                        <a href="{{route('permissions.destroy',['id'=>$data->id])}}"><button type="button"    class="btn btn-outline-danger btn-sm ms-1 me-1  deleteDrDt"  title="Delete"><em class="icon ni ni-trash"></em></button></a>
                                       
                                        </div>
                                   </td>
                                 </tr>

                 @endforeach

                        <tr >
                            <td colspan="12" align="center">
                            {!! $users->links() !!}
                            </td>
                        </tr>
                 @else
                 {{'Na'}}
                 @endif