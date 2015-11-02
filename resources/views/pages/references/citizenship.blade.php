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
											<h4 id="tit"><b>Add New Citizenship</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Citizenship name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_citizenship_name" placeholder="" />
										</div>
									</div>

								
									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addCitizenship()" id="save">Save</button>
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
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($citizenship_data as $citizenship_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$citizenship_data->citizenship_name}}</p>
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateCitizenship("{{$citizenship_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteCitizenship("{{$citizenship_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateCitizenship("{{$citizenship_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteCitizenship("{{$citizenship_data->id}}")'>
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
		function addCitizenship(){
			
				var citizenship_name = $('#form_citizenship_name').val();
				if(citizenship_name.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Citizenship", {citizenship_name: citizenship_name}, function(result){	
							if(result=="1"){
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Citizenship has been added!';
								reset();
								location.reload();
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Citizenship already exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Citizenship! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Citizenship/Update", {id: chosenID ,citizenship_name: citizenship_name}, function(result){	
						alert(result);
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Citizenship has been updated!';
										reset();
										location.reload();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Citizenship! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_citizenship_name').val('');
		}
		function updateCitizenship(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Citizenship</b>';
				$.get("/References/Citizenship/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_citizenship_name').val(''+obj[0].citizenship_name);
				});
		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Citizenship</b>';
				reset();
		}
		function deleteCitizenship(id){
				$.post("/References/Citizenship/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Citizenship has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Citizenship! Please try again'; 
						reset();
					}
					
				});
		}
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, 
				  { "bSortable": false }
				] } );
				

		})
		



		
	</script>
@endsection