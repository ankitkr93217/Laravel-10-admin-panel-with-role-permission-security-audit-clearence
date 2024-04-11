 
@extends('backend.layout.admin_layout')

@section('admin_content')

 
				<div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Users List</h5>
								</div>
								<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
								</div>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table align-middle mb-0 table-hover" id="Transaction-History">
									<thead class="table-light">
										<tr>
											<th>S No.</th>
											<th>Name</th>
											<th>Username</th>
                                            <th>User Role</th>
											<th>Email</th>
											<th>Gender</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    @if(!empty($users))

                                        @php  
                                        $i=1;
									    @endphp
                 
                                        @foreach($users as $k=>$v)
                                        @php  $badgeColor=''; @endphp
										<tr>
											<td>{{$i}}</td>
											<td>{{$v->name}}</td>
											<td>{{$v->username}}</td>
                                            @if($v->r_name == 'ADMIN') 
                                                @php 
                                                    $badgeColor='bg-light-primary'; 
                                                    $role_name='ADMIN';   
                                                @endphp
                                            @elseif($v->r_name == 'SUPER_ADMIN')
                                                @php 
                                                    $badgeColor='bg-light-primary'; 
                                                    $role_name= $data->r_name;   
                                                @endphp     
                                            @elseif($v->r_name == 'USER') 
                                                @php 
                                                    $badgeColor='bg-light-dark'; 
                                                    $role_name=$v->r_name;  
                                                @endphp      
                                            @endif
                                            <td>
												<div class="badge rounded-pill {{$badgeColor}} text-info w-100"> {{$role_name}}</div>
											</td>
											<td>{{$v->email}}</td>
											<td>@if($v->gender=='M') {{'Male'}} @elseif($v->gender=='F') {{'Female'}} @elseif($v->gender=='O') {{'Other'}} @endif</td>
											<td>
												<div class="badge rounded-pill bg-light-info text-info w-100">@if($v->status==1) {{'Active'}} @elseif($v->gender=='0') {{'Blocked'}} @endif</div>
											</td>
											<td>
												<div class="d-flex order-actions px-auto">	
														<a href="javascript:;" class=" "><i class="bx bx-cog"></i></a>
														<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-down-arrow-alt"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-end">
															<div class="row row-cols-3 g-3 p-3">
																 
																<div class="col text-center">
																	<div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
																	
																	</div>
																	<a href="{{route('user_edit',$v->id)}}"><div class="app-title">Tasks</div></a>
																</div>
																 
															</div>
														</div>
													 
													 
 												</div>
											</td>
										</tr>
                                        @php  
                                        $i++;
									    @endphp
                                        @endforeach

                       
                                    @else
                                        {{'Na'}}
                                    @endif
										 
									</tbody>
								</table>
							</div>
						</div>
				</div>
               
@endsection()           

               