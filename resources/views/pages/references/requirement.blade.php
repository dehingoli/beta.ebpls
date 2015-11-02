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
											<h4 id="tit"><b>Add New Requirement</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">* Permit type</label>
										<div class="controls">
											<select id="form-field-select-1">
												<option value="" />
												@foreach ($permit_data as $permit_data)			
													<option value="{{$permit_data->id}}" />{{$permit_data->permit_type}}
												@endforeach
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form_requirement_name">* Requirement name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_requirement_name" placeholder="" />
											&nbsp;&nbsp;<input type="checkbox" id="id-disable-check" />
											<label class="lbl" for="id-disable-check"> Set as Default for all Permit.</label>
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addRequirement()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Permit</th>
										<th >Requirement</th>
										<th >Default?</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($requirement_data as $requirement_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$requirement_data->permit->permit_type}}</p>
										</td>
										<td>
											{{$requirement_data->requirement}}
										</td>
										<td>
											@if($requirement_data->is_default == '1')
												YES
											@else
												NO
											@endif
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateRequirement("{{$requirement_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteRequirement("{{$requirement_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateRequirement("{{$requirement_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteRequirement("{{$requirement_data->id}}")'>
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
		function addRequirement(){
			//alert();
				var requirement = $('#form_requirement_name').val();
				var permit_id = document.getElementById("form-field-select-1").value;
				var checked = document.getElementById("id-disable-check").checked;
				var is_default = "0";
				if(checked==true){
					is_default = "1";
				}
				if(requirement.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
				
						if(permit_id==0){
							$('#alert-success').hide();
							$('#alert-error').show();
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please select Permit!'; 
						}else{
						
						
						
								if(isAdding == true){
									$.post("/References/Requirement", {requirement: requirement, permit_id: permit_id, is_default: is_default}, function(result){	
									alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Requirement has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Requirement name  already exist!'; 
											reset();
										}
										else{
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Requirement! Please try again.'; 
											reset();
										}
									});
								}else{
									$.post("/References/Requirement/Update", {id: chosenID ,requirement: requirement, permit_id: permit_id, is_default: is_default}, function(result){	
									//alert(result);
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Requirement has been updated!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Requirement name already exist!'; 
													reset();
												}
												else{
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Requirement! Please try again.'; 
													reset();
												}
											});
						
								}
								
						
						}
						
				}
					
				
				
		}
		
		function reset(){
				$('#form_requirement_name').val('');
				document.getElementById("form-field-select-1").selectedIndex = "0";
		}
		function updateRequirement(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Requirement</b>';
				$.get("/References/Requirement/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					 $('#form_requirement_name').val(''+obj[0].requirement);
					document.getElementById("form-field-select-1").value = ''+obj[0].permit_id;
					var isDefault = ''+obj[0].is_default;
					if(isDefault=="1"){
						check();
					}else{
						uncheck();
					}
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Requirement</b>';
				reset();
		}
		function deleteRequirement(id){
				$.post("/References/Requirement/Delete", {id : id} ,function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Requirement has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Requirement! Please try again'; 
						reset();
					}
					
				});
		}
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, null, 
				  { "bSortable": false }
				] } );
				

		})
		function check() {
			document.getElementById("id-disable-check").checked = true;
		}

		function uncheck() {
			document.getElementById("id-disable-check").checked = false;
		}




		
	</script>
@endsection