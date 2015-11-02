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
											<h4 id="tit"><b>Add New Economic Organization</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Economic Organization name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_economic_org_name" placeholder="" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="form-field-2">Economic Organization Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_economic_org_code" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addEconomicOrganization()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Economic Organization Name</th>
										<th >Organization Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($economic_org_data as $economic_org_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$economic_org_data->economic_org_name}}</p>
										</td>
										<td>
											{{$economic_org_data->economic_org_code}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateEconomicOrganization("{{$economic_org_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteEconomicOrganization("{{$economic_org_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateEconomicOrganization("{{$economic_org_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteEconomicOrganization("{{$economic_org_data->id}}")'>
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
		function addEconomicOrganization(){
			
				var economic_org_name = $('#form_economic_org_name').val();
				var economic_org_code = $('#form_economic_org_code').val();
				if(economic_org_name.length==0||economic_org_code.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Economic-Organization", {economic_org_name: economic_org_name,economic_org_code: economic_org_code}, function(result){				
							if(result=="1"){
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Economic Organization has been added!';
								reset();
								location.reload();
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Economic Organization already exist or Economic Organization code exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Economic Organization! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Economic-Organization/Update", {id: chosenID ,economic_org_name,economic_org_code: economic_org_code}, function(result){						
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Economic Organization has been updated!';
										reset();
										location.reload();
									}else if(result=="2"){
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Economic Organization already exist or Economic Organization Code exist!'; 
										reset();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Economic Organization! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_economic_org_name').val('');
			$('#form_economic_org_code').val('');
		}
		function updateEconomicOrganization(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Economic Organization</b>';
				$.get("/References/Economic-Organization/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_economic_org_name').val(''+obj[0].economic_org_name);
					$('#form_economic_org_code').val(''+obj[0].economic_org_code);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Economic Organization</b>';
				reset();
		}
		function deleteEconomicOrganization(id){
				$.post("/References/Economic-Organization/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Economic Organization has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Economic Organization! Please try again'; 
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