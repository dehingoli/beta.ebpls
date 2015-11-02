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
											<h4 id="tit"><b>Add New Barangay</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">* District</label>
										<div class="controls">
											<select id="form-field-select-1">
												<option value="" />
												@foreach ($district_data as $district_data)			
													<option value="{{$district_data->id}}" />{{$district_data->district_name}}
												@endforeach
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Barangay name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_barangay_name" placeholder="" />
											&nbsp;&nbsp;<input type="checkbox" id="id-disable-check" />
											<label class="lbl" for="id-disable-check"> Not Garbage Zone.</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2"> BLGF Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_blgf_code" placeholder="" />
										</div>
									</div>
									
									
									
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addBarangay()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >District</th>
										<th >Barangay Name</th>
										<th >Garbage Zone</th>
										<th >BLGF Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($barangay_data as $barangay_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$barangay_data->district->district_name}}</p>
										</td>
										<td>
											{{$barangay_data->brgy_name}}
										</td>
										<td>
											@if($barangay_data->garbage_zone == '1')
												YES
											@else
												NO
											@endif
										</td>
										<td>
											{{$barangay_data->blgf_code}}
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateBarangay("{{$barangay_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteBarangay("{{$barangay_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateBarangay("{{$barangay_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteBarangay("{{$barangay_data->id}}")'>
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
		function addBarangay(){
			//alert();
				var brgy_name = $('#form_barangay_name').val();
				var brgy_district_id = document.getElementById("form-field-select-1").value;
				var blgf_code = $('#form_blgf_code').val();
				var checked = document.getElementById("id-disable-check").checked;
				var garbage_zone = "0";
				if(checked==true){
					garbage_zone = "1";
				}
				if(brgy_name.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
				
						if(brgy_district_id==0){
							$('#alert-success').hide();
							$('#alert-error').show();
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please select District!'; 
						}else{
						
						
						
								if(isAdding == true){
									$.post("/References/Barangay", {brgy_name: brgy_name, brgy_district_id: brgy_district_id, garbage_zone: garbage_zone,blgf_code: blgf_code}, function(result){	
									//alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Barangay has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Barangay name / Blgf Code  already exist!'; 
											reset();
										}
										else{
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Barangay! Please try again.'; 
											reset();
										}
									});
								}else{
									$.post("/References/Barangay/Update", {id: chosenID ,brgy_name: brgy_name, brgy_district_id: brgy_district_id, garbage_zone: garbage_zone,blgf_code: blgf_code}, function(result){	
									//alert(result);
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Barangay has been added!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Barangay name / Blgf Code already exist!'; 
													reset();
												}
												else{
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Barangay! Please try again.'; 
													reset();
												}
											});
						
								}
								
						
						}
						
				}
					
				
				
		}
		
		function reset(){
				$('#form_barangay_name').val('');
				document.getElementById("form-field-select-1").selectedIndex = "0";
				$('#form_blgf_code').val('');
		}
		function updateBarangay(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Barangay</b>';
				$.get("/References/Barangay/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					 $('#form_barangay_name').val(''+obj[0].brgy_name);
					 document.getElementById("form-field-select-1").value = ''+obj[0].district.id;
					 $('#form_blgf_code').val(''+obj[0].blgf_code);
					 var garbage_zone = ''+obj[0].garbage_zone;
						if(garbage_zone=="1"){
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
				document.getElementById("tit").innerHTML = '<b>Add New Barangay</b>';
				reset();
		}
		function deleteBarangay(id){
				$.post("/References/Barangay/Delete", {id : id}, function(result){	
				//alert(result);
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
			      null, null, null, null,
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