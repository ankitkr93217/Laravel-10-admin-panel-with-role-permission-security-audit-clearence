
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
                              <h4 class="card-title mb-0">{{__('Roles')}}</h4>
                           </div>
						     
                         
                        </div>
                        <div class="card-body">
                           <div class="">
                              <table class="data-tables table table-striped" style="width:100%">
                                 <thead class="light">
                                    <tr>
										<th>S No.</th>
                                       <th>Culture Stage Name</th>
									  
                                    <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
								
                                <tr>
                                    <td colspan="7">{{__('No results found.')}}</td>
                                </tr>
                         
								 
                                    <tr>
                                       <td> </td>
                                       <td> </a></td>
                                      
                                       <td></td>
                                       <td>
                                         
                                       </td>
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
	
   
	 
	  
	  <!-- Modal -->
				<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
				   <div class="modal-dialog modal-dialog-scrollable" role="document">
					  <div class="modal-content">
						 <div class="modal-header">
							<h5 class="modal-title" id="exampleModalScrollableTitle">Add Culture Stage</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						 </div>
						 
						
						 <div class="modal-body">
						<form method="POST" action="{{ route('culturestage.store') }}">
                    @csrf
											 <div class="form-group">
												<label for="text">Culture Stage Name :</label>
												 <input id="name" type="text" class="custom-select mb-3{{ $errors->has('name') ? ' is-invalid' : '' }}" name="plantstagename" value="{{ old('name') }}" required autofocus>
												 @if ($errors->has('planttype'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('planttype') }}</strong>
                                </span>
                            @endif 
											 </div>
											
							
											  <div class="form-group mb-4">
												 <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
								   <input type="checkbox" name="statusmedia" class="custom-control-input bg-success" id="active" required>
								   <label class="custom-control-label" for="active">Is active</label>
								</div>
												
												 
											  
											 </div>
											 <div class="form-group mb-4">
                                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											</div>
										  
						 </div>
						
						 </form>
					  </div>
				   </div>
				</div>
	       @extends('app.footer')
      