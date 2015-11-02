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

						<div style="border: 1px solid #d3d3d3; padding:20px; ">
							<div class="form-horizontal" />
									<div class="control-group">
										<div class="controls">
											<h4 id="tit"><b>Add New Occupancy Type</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Occupancy Type</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_occupancy_type" placeholder="" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="form-field-2">Occupancy Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_occupancy_code" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addOccupancyType()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Occupancy Type</th>
										<th >Occupancy Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($occupancy_type_data as $occupancy_type_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$occupancy_type_data->occupancy_type}}</p>
										</td>
										<td>
											{{$occupancy_type_data->occupancy_code}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateOccupancyType("{{$occupancy_type_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteOccupancyType("{{$occupancy_type_data->id}}")'>
													delete
												</button>
											</div>

											<div class="hidden-desktop visible-phone">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
														<i class="icon-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<button class="btn btn-mini btn-success" onClick= 'updateOccupancyType("{{$occupancy_type_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteOccupancyType("{{$occupancy_type_data->id}}")'>
																delete
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
	

	<script type="text/javascript">
	var isAdding = true;
	var chosenID = 0;
		function addOccupancyType(){
			
				var occupancy_type = $('#form_occupancy_type').val();
				var occupancy_code = $('#form_occupancy_code').val();
				if(occupancy_type.length==0||occupancy_code.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Occupancy-Type", {occupancy_type: occupancy_type,occupancy_code: occupancy_code}, function(result){						
							if(result=="1"){
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Occupancy Type Area has been added!';
								reset();
								location.reload();
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Occupancy Type already exist or Occupancy code exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Occupancy Type! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Occupancy-Type/Update", {id: chosenID ,occupancy_type: occupancy_type,occupancy_code: occupancy_code}, function(result){	
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Occupancy Type has been updated!';
										reset();
										location.reload();
									}else if(result=="2"){
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Occupancy Type already exist or Occupancy Code exist!'; 
										reset();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Occupancy Type! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_occupancy_type').val('');
			$('#form_occupancy_code').val('');
		}
		function updateOccupancyType(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Occupancy Type</b>';
				$.get("/References/Occupancy-Type/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_occupancy_type').val(''+obj[0].occupancy_type);
					$('#form_occupancy_code').val(''+obj[0].occupancy_code);
				});
		} 
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Occupancy Type</b>';
				reset();
		}
		function deleteOccupancyType(id){
				$.post("/References/Occupancy-Type/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Occupancy Type has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Occupancy Type! Please try again'; 
						reset();
					}
					
				});
		}
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, 
				  { "bSortable": false }
				] } );
				

		})
		



		
	</script>
@endsection