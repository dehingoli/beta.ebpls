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
						<li>
							<a href="#">Business Permit</a>
							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">{{$sub_page}}</li>
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

									<div class="form-horizontal" >
											<div class="control-group">
												<div class="controls">
													<h4 id="tit"><b>Add Business Nature</b></h4>
												</div>
												</br>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-1">* Business Nature Name</label>
												<div class="controls">
													<input type="text" maxlength="50" id="form_business_nature_name" placeholder="" />
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-1">* PSIC CODE</label>
												<div class="controls">
													<input type="text" maxlength="50"  id="form_psic_code" placeholder="" />
												</div>
											</div>


											<div class="control-group">
												<div class="controls">
													<button class="btn btn-primary" onClick="addBusinessNature()" id="save">Save</button>
													<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
												</div>
											</div>
									</div>
								
								</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Business Nature Name</th>
										<th >PSIC CODE</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($business_nature_data as $business_nature_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
										<td>
											{{$business_nature_data->business_nature}}
										</td>
										<td>
											{{$business_nature_data->psic_code}}
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<a href="/References/Business-Permit/Business-Nature/Manage-Business-Nature/{{$business_nature_data->id}}" class="btn btn-mini btn-success" >
													manage
												</a>
												<button class="btn btn-mini btn-success" onClick= 'updateBusinessNature("{{$business_nature_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteBusinessNature("{{$business_nature_data->id}}")'>
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
															<a href="/References/Business-Permit/Business-Nature/Manage-Business-Nature/{{$business_nature_data->id}}" class="btn btn-mini btn-success" >
																manage
															</a>
															<button class="btn btn-mini btn-success" onClick= 'updateBusinessNature("{{$business_nature_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteBusinessNature("{{$business_nature_data->id}}")'>
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
		function addBusinessNature(){
			//alert();
				var business_nature = $('#form_business_nature_name').val();
				var psic_code = $('#form_psic_code').val();

				if(business_nature.length==0||psic_code.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
								if(isAdding == true){
									$.post("/References/Business-Nature", {business_nature: business_nature, psic_code: psic_code }, function(result){	
									//alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Business Nature has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Charge Business Nature  already exist!'; 
											reset();
										}
										else{
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Business Nature! Please try again.'; 
											reset();
										}
									});
								}else{
									$.post("/References/Business-Nature/Update", {id: chosenID ,business_nature: business_nature, psic_code: psic_code}, function(result){	
									//alert(result);
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Business Nature has been updated!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Business Nature name already exist!'; 
													reset();
												}
												else{
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Business Nature! Please try again.'; 
													reset();
												}
											});
						
								}

				}

		}
		
		function reset(){
				$('#form_business_nature_name').val('');
				$('#form_psic_code').val('');
		}
		function updateBusinessNature(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Business Nature</b>';
				$.get("/References/Business-Nature/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					$('#form_business_nature_name').val(''+obj[0].business_nature);
					$('#form_psic_code').val(''+obj[0].psic_code);
				});

		}
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Business Nature</b>';
				reset();
		}
		function deleteBusinessNature(id){
				$.post("/References/Business-Nature/Delete",{id : id}, function(result){	
				//alert(result);
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Business Nature has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Business Nature! Please try again'; 
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