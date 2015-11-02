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
											<h4 id="tit"><b>Add New Province</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Province name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_province_name" placeholder="" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="form-field-2">BLGF Code</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_blgf_code" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addProvince()" id="save">Save</button>
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
										<th >BLGF Code</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($province_data as $province_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$province_data->province_name}}</p>
										</td>
										<td>
											{{$province_data->blgf_code}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateProvince("{{$province_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteProvince("{{$province_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateProvince("{{$province_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteProvince("{{$province_data->id}}")'>
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
		function addProvince(){
			
				var name = $('#form_province_name').val();
				var code = $('#form_blgf_code').val();
				if(name.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Province", {name: name,code: code}, function(result){	
							if(result=="1"){
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Province has been added!';
								reset();
								location.reload();
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Province already exist or blgf code exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving province! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Province/Update", {id: chosenID ,name: name,code: code}, function(result){	
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Province has been updated!';
										reset();
										location.reload();
									}else if(result=="2"){
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Province already exist or blgf code exist!'; 
										reset();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving province! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_province_name').val('');
			$('#form_blgf_code').val('');
		}
		function updateProvince(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Province</b>';
				$.get("/References/Province/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_province_name').val(''+obj[0].province_name);
					$('#form_blgf_code').val(''+obj[0].blgf_code);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Province</b>';
				reset();
		}
		function deleteProvince(id){
				$.post("/References/Province/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Province has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Province! Please try again'; 
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