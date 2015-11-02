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
											<h4 id="tit"><b>Add New District</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">* Lgu</label>
										<div class="controls">
											<select id="form-field-select-1">
												<option value="" />
												@foreach ($lgu_data as $lgu_data)			
													<option value="{{$lgu_data->id}}" />{{$lgu_data->lgu_name}}
												@endforeach
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" maxlength="50" for="form-field-1">* District name</label>
										<div class="controls">
											<input type="text" id="form_district_name" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" maxlength="50" for="form-field-2"> BLGF Code</label>
										<div class="controls">
											<input type="text" id="form_blgf_code" placeholder="" />
										</div>
									</div>
									
									
									
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addDistrict()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Lgu</th>
										<th >District Name</th>
										<th >BLGF Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($district_data as $district_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$district_data->lgu->lgu_name}}</p>
										</td>
										<td>
											{{$district_data->district_name}}
										</td>
										<td>
											{{$district_data->blgf_code}}
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateDistrict("{{$district_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteDistrict("{{$district_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateDistrict("{{$district_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteDistrict("{{$district_data->id}}")'>
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
		function addDistrict(){
			//alert();
				var district_name = $('#form_district_name').val();
				var district_lgu_id = document.getElementById("form-field-select-1").value;
				var blgf_code = $('#form_blgf_code').val();
				if(district_name.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
				
						if(district_lgu_id==0){
							$('#alert-success').hide();
							$('#alert-error').show();
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please select LGU!'; 
						}else{
						
						
						
								if(isAdding == true){
									$.post("/References/District", {district_name: district_name, district_lgu_id: district_lgu_id,blgf_code: blgf_code}, function(result){	
									//alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New District has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;District name / Blgf Code  already exist!'; 
											reset();
										}
										else{
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving District! Please try again.'; 
											reset();
										}
									});
								}else{
									$.post("/References/District/Update", {id : chosenID, district_name: district_name, district_lgu_id: district_lgu_id,blgf_code: blgf_code}, function(result){	
									//alert(result);
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New District has been added!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;District name / Blgf Code already exist!'; 
													reset();
												}
												else{
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving LGU! Please try again.'; 
													reset();
												}
											});
						
								}
								
						
						}
						
				}
					
				
				
		}
		
		function reset(){
				$('#form_district_name').val('');
				document.getElementById("form-field-select-1").selectedIndex = "0";
				$('#form_blgf_code').val('');
		}
		function updateDistrict(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update District</b>';
				$.get("/References/District/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					 $('#form_district_name').val(''+obj[0].district_name);
					 document.getElementById("form-field-select-1").value = ''+obj[0].lgu.id;
					 $('#form_blgf_code').val(''+obj[0].blgf_code);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New District</b>';
				reset();
		}
		function deleteDistrict(id){
				$.post("/References/District/Delete", {id : id} , function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;District has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting District! Please try again'; 
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
		



		
	</script>
@endsection