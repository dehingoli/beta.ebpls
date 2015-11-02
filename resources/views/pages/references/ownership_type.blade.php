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

						<div style="border: 1px solid #d3d3d3; padding:20px; " >
							<div class="row-fluid">
								<div class="span7" >
									<div class="form-horizontal" >
											<div class="control-group">
												<div class="controls">
													<h4 id="tit"><b>Add New Ownership Type</b></h4>
												</div>
												</br>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-1">* Ownership Type</label>
												<div class="controls">
													<input type="text" maxlength="50" id="form_ownership_type" placeholder="" />
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-2">* Ownership Code</label>
												<div class="controls">
													<input type="text" maxlength="50" id="form_ownership_code" placeholder="" />
												</div>
											</div>
											
											<div class="control-group">
												<label class="control-label" for="form-field-2">* Tax Exemptions (%)</label>
												<div class="controls">
													<input type="number" max="100" min="0" id="form_tax_excemptions" value="0" placeholder="" />
												</div>
											</div>
											
											<div class="control-group">
												<div class="controls">
													<button class="btn btn-primary" onClick="addOwnershipType()" id="save">Save</button>
													<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
												</div>
											</div>
									</div>
								</div>	
								<div class="span5" id="addList" >
								<div class="controls">
									<h4 ><b>&nbsp;&nbsp;Fees Excemptions</b></h4>
								</div>
								<?php $count=0;?>
										@foreach ($tax_charges_fees_data as $tax_charges_fees_data)	
											<div class="control-group">
												<div class="controls">
													&nbsp;&nbsp;<input type="checkbox"  value="{{$tax_charges_fees_data->id}}" id="tax_excempt_{{$count}}" />
													<label class="lbl" for="tax_excempt_{{$count}}"> {{$tax_charges_fees_data->taxcharges_name}}</label>
												</div>
											</div>
										<?php $count++;?>
										@endforeach		
										<input type="hidden"  id="chargesCount" value="{{$count++}}" placeholder="" />										
								</div>	
							</div>	
						</div>
				



							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Ownership Type</th>
										<th >Ownership Code</th>
										<th >Tax Exemptions (%)</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($ownership_type_data as $ownership_type_data)					
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$ownership_type_data->ownership_type}}</p>
										</td>
										<td>
											{{$ownership_type_data->ownership_code}}
										</td>
										<td>
											{{$ownership_type_data->tax_excemptions}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateOwnershipType("{{$ownership_type_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteOwnershipType("{{$ownership_type_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateOwnershipType("{{$ownership_type_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteOwnershipType("{{$ownership_type_data->id}}")'>
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
		function addOwnershipType(){
			
				var ownership_code = $('#form_ownership_code').val();
				var ownership_type = $('#form_ownership_type').val();
				var tax_excemptions = $('#form_tax_excemptions').val();
				if(ownership_code.length==0||ownership_type.length==0||tax_excemptions.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
					if(isAdding == true){
						$.post("/References/Ownership-Type", {ownership_code: ownership_code,ownership_type: ownership_type ,tax_excemptions: tax_excemptions}, function(result){						
							var res = result.split("-");
							if(res[0]=="1"){
							id=res[1];
								$('#alert-success').show();
								$('#alert-error').hide();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Ownership Type has been added!';
								addChargeExcemptions(id);
							}else if(result=="2"){
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Ownership Type already exist or Ownership code exist!'; 
								reset();
							}
							else{
								$('#alert-success').hide();
								$('#alert-error').show();
								$('html, body').animate({ scrollTop: 0 }, 'fast');
								document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Ownership Type! Please try again.'; 
								reset();
							}
						});
					}else{
						$.post("/References/Ownership-Type/Update", {id: chosenID ,ownership_code: ownership_code,ownership_type: ownership_type ,tax_excemptions: tax_excemptions}, function(result){	
								alert(result);	
									if(result=="1"){
										$('#alert-success').show();
										$('#alert-error').hide();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Ownership Type has been updated!';
										addChargeExcemptions(chosenID);
									}else if(result=="2"){
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Ownership Type already exist or Ownership code exist!'; 
										reset();
									}
									else{
										$('#alert-success').hide();
										$('#alert-error').show();
										$('html, body').animate({ scrollTop: 0 }, 'fast');
										document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Ownership Type! Please try again.'; 
										reset();
									}
								});
			
					}
				
				}
		}
		
		function reset(){
			$('#form_tax_excemptions').val('');
			$('#form_ownership_code').val('');
			$('#form_ownership_type').val('');
			var chargeCount = $('#chargesCount').val();
			for( x=0;x<chargeCount;x++){
					document.getElementById("tax_excempt_"+x).checked = false;
			}
		}
		function updateOwnershipType(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		var chargeCount = $('#chargesCount').val();
			for( x=0;x<chargeCount;x++){
					document.getElementById("tax_excempt_"+x).checked = false;
			}
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Ownership Type</b>';
				$.get("/References/Ownership-Type/"+id, function(result){	
					var obj = JSON.parse(result);
					$('#form_ownership_type').val(''+obj[0].ownership_type);
					$('#form_ownership_code').val(''+obj[0].ownership_code);
					$('#form_tax_excemptions').val(''+obj[0].tax_excemptions);
					var count = parseInt(obj[0].tax_excempt.length);
						for( x=0;x<count;x++){
							var chargeCount = $('#chargesCount').val();
							var taxChargeID = parseInt(obj[0].tax_excempt[x].tax_charges_id);
								for( y=0;y<chargeCount;y++){
									var val = $("#tax_excempt_"+y).val();
									if(taxChargeID==val){
										document.getElementById("tax_excempt_"+y).checked = true;
									}
								}
						}
				});
		} 
		function cancel(id){
		isAdding = true;
				$('#cancel').hide();
				document.getElementById("save").innerHTML = 'Save';
				document.getElementById("tit").innerHTML = '<b>Add New Ownership Type</b>';
				reset();
		}
		function deleteOwnershipType(id){
				$.post("/References/Ownership-Type/Delete",{id : id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Ownership Type has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Ownership Type! Please try again'; 
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
		
	
	
	function addChargeExcemptions(id){
		var chargeCount = $('#chargesCount').val();
		var count = parseInt(chargeCount);
		for( x=0;x<count;x++){
			var lfckv = document.getElementById("tax_excempt_"+x).checked;
			if(lfckv){
				var tax_charges_id = $("#tax_excempt_"+x).val();
				$.post("/References/Ownership-Type-Add-Excemptions", {tax_charges_id: tax_charges_id,ownership_type_id: id}, function(result){			
				});
			}
		}	
		reset();
		location.reload();
	}


		
	</script>
@endsection