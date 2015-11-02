<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Business Permit System - @yield('title')</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="_token" content="{!! csrf_token() !!}"/>
		
		<!--basic styles-->

		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-responsive.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">


		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="{{ URL::asset('assets/css/ace.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/ace-responsive.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/ace-skins.min.css') }}">
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
	
		<!--navbar-->
		@section('navbars')
        @show
		
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			
			<!--sidebar-->
			@section('sidebar')
			@show

			<div class="main-content">
			
				@yield('breadcrumps')
				
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							
							
								@yield('content')
							
							
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ URL::asset('assets/js/jquery-2.0.3.min.js') }}'>"+"<"+"/script>");
		</script>
		
		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='{{ URL::asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
		</script>
		<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="{{ URL::asset('assets/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.slimscroll.min.js') }}"></script>

		<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
		
		<!--ace scripts-->
		

		<script src="{{ URL::asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/ace.min.js') }}"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				
		
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
			
			$.ajaxSetup({
				headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
			});
		</script>
		
		@yield('page-script')
		
	</body>
	@yield('modal')					
</html>
