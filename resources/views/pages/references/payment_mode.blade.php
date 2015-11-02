@extends('layouts.master')

@section('title', 'References')

@section('navbars')
    @parent
    @include('includes.navbar')
@endsection

@section('sidebar')
    @parent
    @include('includes.sidebar')
@endsection
@section('breadcrumps')
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<a href="#">References</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">{{$main_page}}</li>
					</ul><!--.breadcrumb-->
				</div>
@endsection	
@section('content')

						<div id="alert-success" class="alert alert-block alert-success" style="display:none">
								<i class="icon-ok green" id="msg-success"></i>
						</div>
						<div id="alert-error" class="alert alert-block alert-error" style="display:none">
								<i class="icon-exclamation " id="msg-error"></i>
						</div>

		
							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Payment Mode</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($payment_mode_data as $payment_mode_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$payment_mode_data->payment_mode}}</p>
										</td>

										<td>
										
											<div class="hidden-phone visible-desktop btn-group">
											
												@if($payment_mode_data->id=='1')
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="quart1" type="text" data-date-format="mm-dd" value="01-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="quart2" type="text" data-date-format="mm-dd" value="04-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="quart3" type="text" data-date-format="mm-dd" value="07-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="quart4" type="text" data-date-format="mm-dd" value="10-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div>
														<br>
												@endif
												@if($payment_mode_data->id=='2')
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="semi1" type="text" data-date-format="mm-dd" value="01-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="semi2" type="text" data-date-format="mm-dd" value="07-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
												@endif
												@if($payment_mode_data->id=='3')
														<label  for="bday"><small class="text-error">*&nbsp;</small>Due date:&nbsp;&nbsp;</label>
														<div class="row-fluid input-append">
															<input class="span11 date-picker" id="bday" type="text" data-date-format="mm-dd" value="01-21"/>
															<span class="add-on">
																<i class="icon-calendar"></i>
															</span>
														</div><br>
												@endif
												<button class="btn btn-mini btn-primary" onClick= ''>
													save
												</button>
											</div>

											<div class="hidden-desktop visible-phone">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
														<i class="icon-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<button class="btn btn-mini btn-success" onClick= ''>
																manage
															</button>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>		
								@endforeach
									
							
								</tbody>
							</table>
						

@endsection

@section('page-script')
	<script src="{{ URL::asset('assets/js/date-time/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/date-time/bootstrap-datepicker.min.js') }}"></script>
	
	<script type="text/javascript">
	var isAdding = true;
	var chosenID = 0;
	
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, 
				  { "bSortable": false }
				] } );
				

		})
		
		$('[data-rel=tooltip]').tooltip();
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
			}).mask('99-99');
	



		
	</script>
@endsection