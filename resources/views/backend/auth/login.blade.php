<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon
	<link rel="icon" href="{{url('public/backend')}}/assets/images/favicon-32x32.png" type="image/png" />
	--><!--plugins-->
	<link href="{{url('public/backend')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{url('public/backend')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{url('public/backend')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{url('public/backend')}}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{url('public/backend')}}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{url('public/backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{url('public/backend')}}/assets/css/app.css" rel="stylesheet">
	<link href="{{url('public/backend')}}/assets/css/icons.css" rel="stylesheet">
	<title>Computrize Financial System</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{url('public/backend')}}/assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
										</p>
									</div>
									<div class="d-grid">
										<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="{{url('public/backend')}}/assets/images/icons/search.svg" width="16" alt="Image Description">
                          <span>Sign in with Google</span>
											</span>
										</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
									</div>

									<div class="login-separater text-center mb-4"> 

									@if (session('message'))
										@php
										$alert_type='alert-'.session('type');
										@endphp

										<div class="alert {{$alert_type}} alert-dismissible fade show" role="alert">
										<strong>{{ session('message') }}</strong>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									@endif
										<hr/>
									</div>
									<div class="form-body">
										<form class="row g-3" action="{{route('postLogin')}}" method="POST">@csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Username</label>
												<input type="text" value="{{old('username')}}" name="username" class="form-control" id="inputEmailAddress" placeholder="Email Address">
													@if($errors->has('username'))
														<span class="text-danger">{{ $errors->first('username') }}</span>
													@endif
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" id="password" class="form-control border-end-0"    value="" placeholder="Enter Password"> 
													@if($errors->has('password'))
														<span class="text-danger">{{ $errors->first('password') }}</span>
													@endif
                                     
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label for="password" class="form-label">Captcha <em class="icon ni ni-star-fill text-danger f-8 "></em></label>
													<div class="d-flex justify-content-between align-items-center">
													<div class="img-style new_captcha">{!! captcha_img('math') !!}</div>
													<button type="button" class="btn btn-primary btn-sm" class="reload" id="reload_captcha"> <em class="icon ni ni-reload"></em> </button>
													
													<input id="captcha" type="text" class="form-control input-captcha" placeholder="Enter Captcha" name="captcha">
									
													</div>
													<div> @if($errors->has('captcha'))
															<span class="text-danger">{{ $errors->first('captcha') }}</span>
														@endif
													</div>
												</div>
											</div>
											 
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Login</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->


	

	<!-- Bootstrap JS -->
	<script src="{{url('public/backend')}}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{url('public/backend')}}/assets/js/jquery.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		// $(document).ready(function () {
		// 	$("#show_hide_password a").on('click', function (event) {
		// 		event.preventDefault();
		// 		if ($('#show_hide_password input').attr("type") == "text") {
		// 			$('#show_hide_password input').attr('type', 'password');
		// 			$('#show_hide_password i').addClass("bx-hide");
		// 			$('#show_hide_password i').removeClass("bx-show");
		// 		} else if ($('#show_hide_password input').attr("type") == "password") {
		// 			$('#show_hide_password input').attr('type', 'text');
		// 			$('#show_hide_password i').removeClass("bx-hide");
		// 			$('#show_hide_password i').addClass("bx-show");
		// 		}
		// 	});
		// });
	</script>
	<!--app JS-->
	<script src="{{url('public/backend')}}/assets/js/app.js"></script>
	<script type="text/javascript">
		var base_url = "{{ url('/') }}";
		$(document).ready(function (){
		$("#reload_captcha").click(function(){
		
		$.ajax({
			type:'GET',
			//  url:'/refresh_captcha',
			url:"{{route('refresh_captcha')}}",
			success:function(data){
			// alert(data);
			$(".new_captcha").html('');
				// $(".captcha span").html(data.captcha);
				$(".new_captcha").html(data.captcha);

				
			}
		});
		});
		});
	</script> 
	<script>
		var logSlt = "{{ Session::get('loginsalt')}}";
		$('#password').change(function(){
		let curr_pass= $(this).val();
		let encPass= logSlt+btoa(curr_pass);
		 
		// let md5 = CryptoJS.MD5($(this).val());
		// var encPass = CryptoJS.SHA256(logSlt + md5);
		$('#password').val(encPass);
		
		});
	</script>

</body>

</html>