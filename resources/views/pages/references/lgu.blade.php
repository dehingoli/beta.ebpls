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
											<h4 id="tit"><b>Add New LGU</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">* Province</label>
										<div class="controls">
											<select id="form-field-select-1">
												<option value="" />
												@foreach ($province_data as $province_data)			
													<option value="{{$province_data->id}}" />{{$province_data->province_name}}
												@endforeach
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* LGU name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_lgu_name" placeholder="" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="form-field-2">* LGU Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_lgu_code" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" maxlength="50" for="form_zip_code">* ZIP Code</label>
										<div class="controls">
											<input type="text" id="form_zip_code" placeholder="" />
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
											<button class="btn btn-primary" onClick="addLgu()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Province</th>
										<th >LGU Name</th>
										<th >LGU Code</th>
										<th >Zip Code</th>
										<th >BLGF Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($lgu_data as $lgu_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$lgu_data->province->province_name}}</p>
										</td>
										<td>
											{{$lgu_data->lgu_name}}
										</td>
										 
										<td>
											{{$lgu_data->lgu_code}}
										</td>
											<td>
											{{$lgu_data->zip_code}}
										</td>
										<td>
											{{$lgu_data->blgf_code}}
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateLgu("{{$lgu_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteLgu("{{$lgu_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateLgu("{{$lgu_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteLgu("{{$lgu_data->id}}")'>
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
		function addLgu(){
			//alert();
				var lgu_name = $('#form_lgu_name').val();
				var lgu_code = $('#form_lgu_code').val();
				var zip_code = $('#form_zip_code').val();
				var lgu_province_id = document.getElementById("form-field-select-1").value;
				var blgf_code = $('#form_blgf_code').val();
				if(lgu_name.length==0||lgu_code.length==0||zip_code.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
				
						if(lgu_province_id==0){
							$('#alert-success').hide();
							$('#alert-error').show();
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please select Province!'; 
						}else{
						
						
						
								if(isAdding == true){
									$.post("/References/Lgu", {lgu_name: lgu_name,lgu_code: lgu_code, lgu_province_id: lgu_province_id, zip_code : zip_code, blgf_code: blgf_code}, function(result){	
									//alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New LGU has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;LGU name / LGU Code / Blgf Code / Zip Code already exist!'; 
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
								}else{
									$.post("/References/Lgu/Update", {id: chosenID ,lgu_name: lgu_name,lgu_code: lgu_code, lgu_province_id: lgu_province_id, zip_code : zip_code ,blgf_code: blgf_code}, function(result){	
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;LGU has been updated!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;LGU name / LGU Code / Blgf Code / Zip Code already exist!'; 
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
				$('#form_lgu_name').val('');
				$('#form_lgu_code').val('');
				$('#form_zip_code').val('');
				document.getElementById("form-field-select-1").selectedIndex = "0"
				$('#form_blgf_code').val('');
		}
		function updateLgu(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update LGU</b>';
				$.get("/References/Lgu/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					 $('#form_lgu_name').val(''+obj[0].lgu_name);
					 $('#form_lgu_code').val(''+obj[0].lgu_code);
					 $('#form_zip_code').val(''+obj[0].zip_code);
					 document.getElementById("form-field-select-1").value = ''+obj[0].province.id;
					 $('#form_blgf_code').val(''+obj[0].blgf_code);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New LGU</b>';
				reset();
		}
		function deleteLgu(id){
				$.post("/References/Lgu/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;LGU has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting LGU! Please try again'; 
						reset();
					}
					
				});
		}
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, null, null, null,
				  { "bSortable": false }
				] } );
				

		})
		



		
	</script>
@endsection