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

							<div class="form-horizontal" />
									<div class="control-group">
										<div class="controls">
											<h4 id="tit"><b>Add Charges</b></h4>
										</div>
										</br>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">*Charge Type</label>
										<div class="controls">
											<select id="form-field-select-1">
												<option value="" />
												@foreach ($tax_charges_type_data as $tax_charges_type_data)			
													<option value="{{$tax_charges_type_data->id}}" />{{$tax_charges_type_data->tax_charges_type}}
												@endforeach
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Name</label>
										<div class="controls">
											<input type="text" maxlength="50" id="form_charge_name" placeholder="" />
											&nbsp;&nbsp;<input type="checkbox" id="id-disable-check" />
											<label class="lbl" for="id-disable-check"> Set as Default for Business nature.</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-1">* Amount</label>
										<div class="controls">
											<input type="number" min="0"  id="form_chargeamount_name" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="form-field-2">* No. of Years</label>
										<div class="controls">
											<select id="form-field-select-2">
												@for ($i = 1; $i < 101; $i++)
													<option value="{{ $i }}" />{{ $i }}
												@endfor
											</select>
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
											<button class="btn btn-primary" onClick="addCharges()" id="save">Save</button>
											<button class="btn btn-danger" onClick="cancel()" id="cancel" style="display:none">Cancel</button>
										</div>
									</div>
							</div>
						
						</div>




							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Type</th>
										<th >Name</th>
										<th >Amount</th>
										<th >Default</th>
										<th >No of Years</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($tax_charges_data as $tax_charges_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$tax_charges_data->taxchargestype->tax_charges_type}}</p>
										</td>
										<td>
											{{$tax_charges_data->taxcharges_name}}
										</td>
										<td>
											{{$tax_charges_data->amount}}
										</td>
										<td>
											@if($tax_charges_data->is_default == '1')
												YES
											@else
												NO
											@endif
										</td>
										<td>
											{{$tax_charges_data->no_of_years}}
										</td>
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateCharges("{{$tax_charges_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteCharges("{{$tax_charges_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateCharges("{{$tax_charges_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteCharges("{{$tax_charges_data->id}}")'>
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
		function addCharges(){
			//alert();
				var taxcharges_name = $('#form_charge_name').val();
				var amount = $('#form_chargeamount_name').val();
				var taxcharges_type_id = document.getElementById("form-field-select-1").value;
				var no_of_years = document.getElementById("form-field-select-2").value;
				var checked = document.getElementById("id-disable-check").checked;
				var is_default = "0";
				if(checked==true){
					is_default = "1";
				}
				if(taxcharges_name.length==0||amount.length==0){
					$('#alert-success').hide();
					$('#alert-error').show();
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input required field!'; 
				}else{
				
				
						if(taxcharges_type_id==0){
							$('#alert-success').hide();
							$('#alert-error').show();
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please select Charge Type!'; 
						}else{
						
						
						
								if(isAdding == true){
									$.post("/References/Tax-Fees-Charges", {taxcharges_name: taxcharges_name, amount: amount, taxcharges_type_id: taxcharges_type_id, no_of_years: no_of_years, checked: checked, is_default: is_default}, function(result){	
									//alert(result);
										if(result=="1"){
											$('#alert-success').show();
											$('#alert-error').hide();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Charge has been added!';
											reset();
											location.reload();
										}else if(result=="2"){
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Charge name  already exist!'; 
											reset();
										}
										else{
											$('#alert-success').hide();
											$('#alert-error').show();
											$('html, body').animate({ scrollTop: 0 }, 'fast');
											document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Charge! Please try again.'; 
											reset();
										}
									});
								}else{
									$.post("/References/Tax-Fees-Charges/Update", {id: chosenID, taxcharges_name: taxcharges_name, amount: amount, taxcharges_type_id: taxcharges_type_id, no_of_years: no_of_years, checked: checked, is_default: is_default}, function(result){	
									//alert(result);
												if(result=="1"){
													$('#alert-success').show();
													$('#alert-error').hide();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Charge has been added!';
													reset();
													location.reload();
												}else if(result=="2"){
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Charge name already exist!'; 
													reset();
												}
												else{
													$('#alert-success').hide();
													$('#alert-error').show();
													$('html, body').animate({ scrollTop: 0 }, 'fast');
													document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Charge! Please try again.'; 
													reset();
												}
											});
						
								}
								
						
						}
						
				}
					
				
				
		}
		
		function reset(){
				$('#form_charge_name').val('');
				$('#form_chargeamount_name').val('');
				document.getElementById("form-field-select-1").selectedIndex = "0";
				document.getElementById("form-field-select-2").selectedIndex = "0";
				uncheck();
		}
		function updateCharges(id){
		isAdding = false;
		chosenID = id;
		$('#cancel').show();
		document.getElementById("save").innerHTML = 'Update';
				document.getElementById("tit").innerHTML = '<b>Update Charge</b>';
				$.get("/References/Tax-Fees-Charges/"+id, function(result){	
					//alert(result);
					 var obj = JSON.parse(result);
					 //$('#form_zone_name').val(''+obj[0].zone_name);
					// document.getElementById("form-field-select-1").value = ''+obj[0].barangay.id;
					$('#form_charge_name').val(''+obj[0].taxcharges_name);
					$('#form_chargeamount_name').val(''+obj[0].amount);
					document.getElementById("form-field-select-1").value = ''+obj[0].taxcharges_type_id;
					document.getElementById("form-field-select-2").value = ''+obj[0].no_of_years;
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
				document.getElementById("tit").innerHTML = '<b>Add New Zone</b>';
				reset();
		}
		function deleteCharges(id){
				$.post("/References/Tax-Fees-Charges/Delete",{id : id}, function(result){	
				alert(result);
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Charge has been deleted!';
						reset();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting taxcharges! Please try again'; 
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
		

		function check() {
			document.getElementById("id-disable-check").checked = true;
		}

		function uncheck() {
			document.getElementById("id-disable-check").checked = false;
		}

		
	</script>
@endsection