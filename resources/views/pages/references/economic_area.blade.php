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
											<h4 id="tit"><b>Add New Economic Area</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Economic Area name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_economic_area_name" placeholder="" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="form-field-2">Economic Area Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_economic_area_code" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addEconomicArea()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Economic Area</th>
										<th >Economic Area Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($economic_area_data as $economic_area_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$economic_area_data->economic_area_name}}</p>
										</td>
										<td>
											{{$economic_area_data->economic_area_code}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateEconomicArea("{{$economic_area_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteEconomicArea("{{$economic_area_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateEconomicArea("{{$economic_area_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteEconomicArea("{{$economic_area_data->id}}")'>
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
		function addEconomicArea(){
			
				var economic_area_name = $('#form_economic_area_name').val();
				var economic_area_code = $('#form_economic_area_code').val();
				if(economic_area_name.length==0||economic_area_code.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Economic-Area", {economic_area_name: economic_area_name,economic_area_code: economic_area_code}, function(result){					
							if(result=="1"){
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Economic Area has been added!';
								reset();
								location.reload();
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Economic Area already exist or Economic Area code exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Economic Area! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Economic-Area/Update", {id: chosenID ,economic_area_name,economic_area_code: economic_area_code}, function(result){	
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Economic Area has been updated!';
										reset();
										location.reload();
									}else if(result=="2"){
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Economic Area already exist or Economic Area Code exist!'; 
										reset();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Economic Area! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_economic_area_name').val('');
			$('#form_economic_area_code').val('');
		}
		function updateEconomicArea(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Economic Area</b>';
				$.get("/References/Economic-Area/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_economic_area_name').val(''+obj[0].economic_area_name);
					$('#form_economic_area_code').val(''+obj[0].economic_area_code);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Economic Area</b>';
				reset();
		}
		function deleteEconomicArea(id){
				$.post("/References/Economic-Area/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Economic Area has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Economic Area! Please try again'; 
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