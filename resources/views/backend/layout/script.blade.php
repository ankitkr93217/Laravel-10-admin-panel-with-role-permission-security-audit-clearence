<script>
@if(Session::has('message'))
    var type = "{{ Session::get('type') }}";
    Swal.fire("{{ Session::get('message') }}","",type);
@endif
</script>

<script src="{{url('public/backend')}}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{url('public/backend')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{url('public/backend')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="{{url('public/backend')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{url('public/backend')}}/assets/js/index.js"></script>
	<!--app JS-->
	<script src="{{url('public/backend')}}/assets/js/app.js"></script>