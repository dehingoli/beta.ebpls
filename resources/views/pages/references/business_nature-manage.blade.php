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
						<li>
							<a href="#">{{$sub_page}}</a>
							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Manage Business Nature</li>
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
													<h4 id="tit"><b>Manage Business Nature</b></h4>
												</div>
												</br>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-1">* Business Nature Name</label>
												<div class="controls">
													<input type="text" maxlength="50" id="form_business_nature_name" value="{{$business_nature_data->business_nature}}" placeholder="" readonly/>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-1">* PSIC CODE</label>
												<div class="controls">
													<input type="text" maxlength="50"  id="form_psic_code" value="{{$business_nature_data->psic_code}}"  placeholder="" readonly/>
												</div>
											</div>
									</div>
	
								</div>




							</br>
								<a href="/References/Business-Permit/Business-Nature" class="btn btn-primary" >Back to list </a>
								<button class="btn btn-primary" onClick="addCharge()" >Add TAX / Fees / Charges </button>
							</br>
							
							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
									
										<th ></th>
										<th >Description</th>
										<th >Transaction Type</th>
										<th >Basis</th>
										<th >Indicator</th>
										<th >Mode</th>
										<th >Formula</th>
										<th >Amount</th>
										<th >Minimum Amount</th>
										<th >Unit Measure</th>
										<th ></th>
									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
								@foreach ($tax_charges_req_data as $tax_charges_req_data)			
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$tax_charges_req_data->taxCharge->taxcharges_name}}</p>
										</td>
										
										<td>
											{{$tax_charges_req_data->transaction_type}}
										</td>
										
										<td>
											{{$tax_charges_req_data->basis}}
										</td>
										
										<td>
											{{$tax_charges_req_data->indicator}}
										</td>
										
										<td>
											{{$tax_charges_req_data->mode}}
										</td>
										
										<td>
											{{$tax_charges_req_data->formula}}
										</td>
										
										<td>
											{{$tax_charges_req_data->amount}}
										</td>
										
										<td>
											{{$tax_charges_req_data->minimum_amount}}
										</td>
										
										<td>
											{{$tax_charges_req_data->unit_measure}}
										</td>
										
										
										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= 'updateCharge("{{$tax_charges_req_data->id}}")'>
													edit
												</button>
												<button class="btn btn-mini btn-danger" onClick= 'deleteCharge("{{$tax_charges_req_data->id}}")'>
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
															<button class="btn btn-mini btn-success" onClick= 'updateCharge("{{$tax_charges_req_data->id}}")'>
																edit
															</button>
															<button class="btn btn-mini btn-danger" onClick= 'deleteCharge("{{$tax_charges_req_data->id}}")'>
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
							
							
							
							

							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title" id="mod-title">Add Charge</h4>
								  </div>
								  <div class="modal-body">
									<div id="alert-success2" class="alert alert-block alert-success" style="display:none;">
										<i class="icon-ok green" id="msg-success2" ></i>
									</div>
									<div id="alert-error2" class="alert alert-block alert-error" style="display:none;">
											<i class="icon-exclamation " id="msg-error2">xxxx</i>
									</div>
									<div class="col-md-12 form-horizontal" >
											<div class="control-group">
												<label class="control-label" for="form-field-select-1">* Select Charge Type</label>
												<div class="controls">
													<select id="form-field-select-1" onChange="getTransactionCharge(this.value,'')">
														<option value="" />
														@foreach ($tax_charges_type_data as $tax_charges_type_data)			
															<option value="{{$tax_charges_type_data->id}}" />{{$tax_charges_type_data->tax_charges_type}}
														@endforeach
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-2">* Transaction Charge</label>
												<div class="controls">
													<select id="form-field-select-transaction-charge">
														<option value="" />
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-select-transaction-type">* Transaction Type</label>
												<div class="controls">
													<select id="form-field-select-transaction-type">
															<option value="New" />New
															<option value="Renew" />Renew
															<option value="Retire" />Retire
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-select-basis">* Basis</label>
												<div class="controls">
													<select id="form-field-select-basis" onChange="basisSetUp(this.value)">
															<option value="1" />Capital Investment
															<option value="2" />Gross Sale
															<option value="3" />Inputed Value
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-field-select-indicator">* Indicator</label>
												<div class="controls">
													<select id="form-field-select-indicator" onChange="indicatorSetUp(this.value)">
															<option value="1" />Constant
															<option value="2" />Formula
															<option value="3" />Range
													</select>
												</div>
											</div>
											
											<div class="control-group" id="div_unit_amount" >
												<label class="control-label" for="form-field-amount">* Amount</label>
												<div class="controls">
													<input type="number" min="0" max="100" id="form-field-amount" value="" placeholder="" />
												</div>
											</div>
											
											<div class="control-group" id="div_unit_no_range" style="display:none;">
												<label class="control-label" for="form-field-no-range">* No of Range</label>
												<div class="controls">
													<input type="number" min="0" id="form-field-no-range"  value="" placeholder="" />
													<button type="button" class="btn btn-primary btn-mini" id="generateBtnRange" onClick="isVariableValid('range')">Generate</button>
												</div>
											</div>
											
											<div class="control-group" id="div_unit_mode" style="display:none;">
												<label class="control-label" for="form-field-select-mode">* Mode</label>
												<div class="controls">
													<select id="form-field-select-mode" onChange="modeSetUp(this.value)">
															<option value="1" />Normal
															<option value="2" />Complex
													</select>
												</div>
											</div>
											
											<div class="control-group" id="div_unit_no_variable" style="display:none;">
												<label class="control-label" for="form-field-no-variable">* No of Variable</label>
												<div class="controls">
													<input type="number" min="0" max="100" id="form-field-no-variable"  value="" placeholder="1-100" />
													<button type="button" class="btn btn-primary btn-mini" id="generateBtnVariable" onClick="isVariableValid('variable')">Generate</button>
												</div>
											</div>
																				
											<div class="control-group">
												<label class="control-label" for="form-field-1">* Minimum Amount</label>
												<div class="controls">
													<input type="number" min="0" id="form-field-minimum-amount" value="" placeholder="" />
												</div>
											</div>
											
											

											<div class="control-group" id="div_unit_measure" style="display:none;">
												<label class="control-label" for="form-field-1">* Unit of Measure</label>
												<div class="controls">
													<input type="text" min="0" id="form-field-unit-measure" value="" placeholder="" />
												</div>
											</div>
	
									</div>
									
									<div id="formulas" class="alt1" style="padding:10px;">
										<label class="control-label" id="formula_legend" style="display:none" ><b>* Legend</b></label>
										<label class="control-label text-error" id="formula_legend_msg" style="display:none" >X0 = Capital Investment</label>
									</div>
									<div id="addlist" class="alt1" style="padding:10px;">
									</div>
									
									<div id="formulas" class="alt1" style="padding:10px;">
										<div class="control-group" id="div_unit_formula" style="display:none;">
										<label class="control-label" for="form-field-formula">* Formula</label>
												<div class="controls">
													<input type="text" min="0" id="form-field-formula" value="" placeholder="" />
												</div>
										<label class="control-label" for="form-field-formula">Example:</label>
										<label class="control-label" for="form-field-formula">Normal: (X0*.0025)/2</label>
										<label class="control-label" for="form-field-formula">Complex( if more than 1 variable in legend ): ((X0*X2)+(X1+X2))*X3</label>
										</div>
										<br /><br />
									</div>
									
									
									
									
								  </div>
								  <div class="modal-footer">
									<input type="button" class="btn btn-primary" id="addBtn" onClick="validateTaxChargeReq()" value="Add"></input>
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Close"></input>
								  </div>
								</div>

							  </div>
							</div>


@endsection

@section('page-script')
	

	<script type="text/javascript">
	
	
	var isAdding = true;
	var chosenID = 0;
	var rangeCount = 0;
	var variableCount = 0;


	$(function() {
			var oTable1 = $('#sample-table-2').dataTable( {
			"aoColumns": [
			  { "bSortable": false },
			  null, null, null, null, null, null, null, null, null,
			  { "bSortable": false }
			] } );


	})
		
	
	
	
	
	
	
	
	
	////////////// add charges modal//////////
	function reset2(){
			$('#form-field-amount').val('');
			$('#form-field-no-range').val('');
			$('#form-field-minimum-amount').val('');
			$('#form-field-no-variable').val('');
			$('#form-field-unit-measure').val('');
			$('#form-field-formula').val('');
			$('#generateBtnRange').show();
			$('#generateBtnVariable').show();
			document.getElementById("form-field-select-transaction-charge").selectedIndex = "0";
			document.getElementById("form-field-select-1").selectedIndex = "0";
			document.getElementById("form-field-select-transaction-type").selectedIndex = "0";
			document.getElementById("form-field-select-indicator").selectedIndex = "0";
			document.getElementById("form-field-select-basis").selectedIndex = "0";
			setCapitalInvestment();
			setConstant();
			$('#form-field-select-transaction-charge').attr('disabled',false);
			$('#form-field-select-1').attr('disabled',false);
	}
	function getTransactionCharge(id,str){
				$.get("/References/Business-Nature-Transaction-Charge/"+id, function(result){	
					var obj = JSON.parse(result);
					var x1 = document.getElementById("form-field-select-transaction-charge");
					document.getElementById("form-field-select-transaction-charge").options.length = 0;
					var option = document.createElement("option");	
					option.text ='';
					x1.add(option);
					for(x=0;x<obj.length;x++){

						var option = document.createElement("option");	
						option.value=''+obj[0].id;
						option.text = ''+obj[0].taxcharges_name ;
						x1.add(option);
					}
					if(str.length!=0){
						document.getElementById("form-field-select-transaction-charge").value = ""+str;
					}
				});	
	}
	
	function basisSetUp(id){
		if(id==3){
			setInputedValue();		
		}else if(id==2){
			setGrossSale();
		}else if(id==1){
			setCapitalInvestment();
		}	
	}
	function indicatorSetUp(id){
	document.getElementById("form-field-select-mode").selectedIndex = "0";
		if(id==1){
			setConstant();
		}if(id==2){
			setFormula();
		}else if(id==3){
			setRange();
		}	
	}
	function modeSetUp(id){
		if(id==1){
			setNormal();
		}if(id==2){
			setComplex();			
		}	
	}
	$("#form-field-no-range").keypress(function (e) {
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				   return false;
		}
	});
	$("#form-field-no-variable").keypress(function (e) {
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
				   return false;
		}
	});
	
	function isVariableValid(str){
	rangeCount = 0;
	variableCount = 0;
	$('#addlist').empty();
		if(str=="variable"){
		$('#form-field-formula').val('');
			var mode = document.getElementById("form-field-select-mode").selectedIndex;
				if(mode==1){
				var val = $('#form-field-no-variable').val();
				//alert(val);
					if(val==0||val>100){
						document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input valid variable number ( 1 - 100 )! '; 
						$('#alert-success2').hide();
						$('#alert-error2').show();
						$("#myModal").scrollTop(0);
					}else{
						$('#alert-success2').hide();
						$('#alert-error2').hide();
						var x;
						val =  parseInt(val) + 1;
						for( x = 1; x < val ; x++){
							addInput(x,str,"add","");
						}
						$('#div_unit_formula').show();
					}
				}
		}else{
					var val = $('#form-field-no-range').val();
					if(val==0||val>100){
						document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input valid range number ( 1 - 100 )! '; 
						$('#alert-success2').hide();
						$('#alert-error2').show();
						$("#myModal").scrollTop(0);
					}else{
						$('#alert-success2').hide();
						$('#alert-error2').hide();
						var addList = document.getElementById('addlist');
						var docstyle = addList.style.display;
						if (docstyle == 'none') addList.style.display = '';
						
						var text = document.createElement('div');
						text.innerHTML = "<div class='control-group'>"+
										"<div class='controls span12' style='color:red;'>"+
											"<label  class='span1' >No</label>"+
											"<label  class='span3' >Lower Limit</label>"+
											"<label  class='span3' >Higher Limit</label>"+
											"<label  class='span3' >Value</label>"+
										"</div>"+
							"</div>";
									
						addList.appendChild(text);
						var x;
						val =  parseInt(val) + 1;
						for( x = 1; x < val ; x++){
							addInput(x,str,"add","");
						}
					}
		}
	}
	
	
	
	function addInput(ids,str,mode,taxid) {
		var text = document.createElement('div');
		text.ids = 'additem_' + ids;
		var addList = document.getElementById('addlist');
		var docstyle = addList.style.display;
		if (docstyle == 'none') addList.style.display = '';
			if(str=="variable"){	
				variableCount++; 
				text.innerHTML = "<div class='control-group'>"+
											"<div class='controls' style='color:red;'>"+
											"X"+ids+" =	 "+
												"<select id='"+ids+"'>"+
												"</select>"+
											"</div>"+
								"</div>";					
				addList.appendChild(text);
				$.get("/References/Business-Nature-Transaction-Charge-All/All", function(result){	
							 var obj = JSON.parse(result);
							 var x1 = document.getElementById(""+ids);
							 document.getElementById(""+ids).options.length = 0;
							 for(x=0;x<obj.length;x++){
							 
									var option = document.createElement("option");	
									option.value=''+obj[x].id;
									option.text = ''+obj[x].taxcharges_name ;
									x1.add(option);
							 }
							 if(mode=="update"){
								document.getElementById(ids).value=taxid;
							 }
				});
			}else{
				rangeCount++;
				var text = document.createElement('div');
				text.ids = 'additem_' + ids;
				text.innerHTML = "<div class='control-group'>"+
											"<div class='controls span12' style='color:red;'>"+
												"<label  class='span1' >"+ids+"</label>"+
												"<input type='number' class='span3'  min='0' id='lower"+ids+"'  placeholder='' />"+
												"<input type='number' class='span3' min='0' id='higher"+ids+"'  placeholder='' />"+
												"<input type='number' class='span3' min='0' id='value"+ids+"'  placeholder='' />"+
											"</div>"+
								"</div>";					
				addList.appendChild(text);
			}	
	}

	function validateTaxChargeReq(){
	$("#myModal").scrollTop(0);
		var chargeType = document.getElementById("form-field-select-1").selectedIndex;
		var basisPos = document.getElementById("form-field-select-basis").selectedIndex;
		var charge = document.getElementById("form-field-select-transaction-charge").selectedIndex;
		var type = document.getElementById("form-field-select-transaction-type").value;
		var basis = $("#form-field-select-basis option:selected").text();
		var indicator = document.getElementById("form-field-select-indicator").selectedIndex;
		var mode = document.getElementById("form-field-select-mode").selectedIndex;
		var amount = $('#form-field-amount').val();
		var min_amount = $('#form-field-minimum-amount').val();
		var unit_measure = $('#form-field-unit-measure').val();
		var formula = $('#form-field-formula').val();
		var no_variable = $('#form-field-no-variable').val();
		
		var chargeID = document.getElementById("form-field-select-transaction-charge").value;
		var strBasis = "N/A";
		var strIndicator = "N/A";
		var strMode = "N/A";

		if(chargeType==0){
			document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please select charge type! '; 
			$('#alert-success2').hide();
			$('#alert-error2').show();
			$("#myModal").scrollTop(0);
		}else{
			if(charge==0){
				document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please select charge! '; 
				$('#alert-success2').hide();
				$('#alert-error2').show();
				$("#myModal").scrollTop(0);
			}else{
				if(basisPos==2){
				strBasis = "Inputed Value";
					if(unit_measure.length==0){
						document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input unit measure! '; 
						$('#alert-success2').hide();
						$('#alert-error2').show();
						$("#myModal").scrollTop(0);
					}else{
						if(indicator==0){
						strMode="N/A";
						formula="N/A";
						no_variable = "N/A" ;
						strIndicator = "Constant";
							if(amount.length==0){
								document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input amount! '; 
								$('#alert-success2').hide();
								$('#alert-error2').show();
								$("#myModal").scrollTop(0);
							}else{
								if(min_amount.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(isAdding == true){
										$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
											var res = result.split("-");
											if(res[0]=="1"){
											id=res[1];
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												reset2();
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
											}else if(result=="2"){
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}else{
										$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
											if(result=="1"){
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												reset2();
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}
										});
									}
								}
							}
						}else if(indicator==1){
						amount="N/A";
						strIndicator = "Formula";
							if(mode==0){
							strMode="Normal";
								if(formula.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input formula! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(min_amount.length==0){
										document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
										$('#alert-success2').hide();
										$('#alert-error2').show();
										$("#myModal").scrollTop(0);
									}else{	
										if(isAdding == true){
											$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
												var res = result.split("-");
												if(res[0]=="1"){
												id=res[1];
													document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
													$('#alert-success2').show();
													$('#alert-error2').hide();
													$("#myModal").scrollTop(0);
													reset2();
													$('#myModal').on('hidden.bs.modal', function () {
														location.reload();
													});
												}else if(result=="2"){
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}else{
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}	
											});
										}else{
											$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
												
												if(result=="1"){
													document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
													$('#alert-success2').show();
													$('#alert-error2').hide();
													$("#myModal").scrollTop(0);
													reset2();
													$('#myModal').on('hidden.bs.modal', function () {
														location.reload();
													});
												}else{
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}	
											});
										}
									}
								}
							}else{
							strMode="Complex";
								if(no_variable.length==0){
										document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input number of variable! '; 
										$('#alert-success2').hide();
										$('#alert-error2').show();
										$("#myModal").scrollTop(0);
								}else{
									if(formula.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input formula! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
									}else{
										if(min_amount.length==0){
											document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
											$('#alert-success2').hide();
											$('#alert-error2').show();
											$("#myModal").scrollTop(0);
										}else{
											if(isAdding == true){
												$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
													var res = result.split("-");
													if(res[0]=="1"){
														id=res[1];
														document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
														$('#alert-success2').show();
														$('#alert-error2').hide();
														$("#myModal").scrollTop(0);
														$('#myModal').on('hidden.bs.modal', function () {
															location.reload();
														});
														addFormulas(id);
														reset2();
													}else if(result=="2"){
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}else{
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}	
												});
											}else{
												$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
													
													if(result=="1"){
														document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
														$('#alert-success2').show();
														$('#alert-error2').hide();
														$("#myModal").scrollTop(0);
														$('#myModal').on('hidden.bs.modal', function () {
															location.reload();
														});
														addFormulas(chosenID);
														reset2();
													}else{
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}	
												});
											}
										}
									}
								}
							
							}
						}else{
						strIndicator = "Range";
							if(rangeCount==0){
								document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input range! '; 
								$('#alert-success2').hide();
								$('#alert-error2').show();
								$("#myModal").scrollTop(0);
							}else{
								if(min_amount.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(isAdding == true){
										$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
											var res = result.split("-");
											if(res[0]=="1"){
											id=res[1];
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
												addRanges(id);
												reset2();
											}else if(result=="2"){
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}else{
										$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
											if(result=="1"){
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
												addRanges(chosenID);
												reset2();
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}
								}
							}
						}
					}
				}else{
				unit_measure="N/A";
				if(basisPos==0){
				strBasis = "Capital Investment";
				}else if(basisPos==1){
				strBasis = "Gross Sale";
				}
						if(indicator==0){
						strMode="N/A";
						formula="N/A";
						no_variable = "N/A" ;
						strIndicator = "Constant";
							if(amount.length==0){
								document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input amount! '; 
								$('#alert-success2').hide();
								$('#alert-error2').show();
								$("#myModal").scrollTop(0);
							}else{
								if(min_amount.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(isAdding == true){
										$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
											var res = result.split("-");
											if(res[0]=="1"){
											id=res[1];
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												reset2();
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
											}else if(result=="2"){
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}else{
										$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
											
											if(result=="1"){
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												reset2();
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}
								}
									
							}
						}else if(indicator==1){
						amount="N/A";
						strIndicator = "Formula";
							if(mode==0){
							strMode="Normal";
							
								if(formula.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input formula! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(min_amount.length==0){
										document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
										$('#alert-success2').hide();
										$('#alert-error2').show();
										$("#myModal").scrollTop(0);
									}else{
										if(isAdding == true){
											$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
												var res = result.split("-");
												if(res[0]=="1"){
												id=res[1];
													document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
													$('#alert-success2').show();
													$('#alert-error2').hide();
													$("#myModal").scrollTop(0);
													reset2();
													$('#myModal').on('hidden.bs.modal', function () {
														location.reload();
													});
												}else if(result=="2"){
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}else{
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}	
											});
										}else{
											$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
												
												if(result=="1"){
													document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
													$('#alert-success2').show();
													$('#alert-error2').hide();
													$("#myModal").scrollTop(0);
													reset2();
													$('#myModal').on('hidden.bs.modal', function () {
														location.reload();
													});
												}else{
													document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
													$('#alert-success2').hide();
													$('#alert-error2').show();
													$("#myModal").scrollTop(0);
												}	
											});
										}
									}
								}
							}else{
							strMode="Complex";
							
								if(no_variable.length==0){
										document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input number of variable! '; 
										$('#alert-success2').hide();
										$('#alert-error2').show();
										$("#myModal").scrollTop(0);
								}else{
									if(formula.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input formula! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
									}else{
										if(min_amount.length==0){
											document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
											$('#alert-success2').hide();
											$('#alert-error2').show();
											$("#myModal").scrollTop(0);
										}else{
											if(isAdding == true){
												$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
													var res = result.split("-");
													if(res[0]=="1"){
														id=res[1];
														document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
														$('#alert-success2').show();
														$('#alert-error2').hide();
														$("#myModal").scrollTop(0);
														$('#myModal').on('hidden.bs.modal', function () {
															location.reload();
														});
														addFormulas(id);
														reset2();
													}else if(result=="2"){
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}else{
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}	
												});
											}else{
												$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
													
													if(result=="1"){
														document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
														$('#alert-success2').show();
														$('#alert-error2').hide();
														$("#myModal").scrollTop(0);
														$('#myModal').on('hidden.bs.modal', function () {
															location.reload();
														});
														addFormulas(chosenID);
														reset2();
													}else{
														document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
														$('#alert-success2').hide();
														$('#alert-error2').show();
														$("#myModal").scrollTop(0);
													}	
												});
											}
										}
									}
								}
							
							}
						}else{
						strIndicator = "Range";
							if(rangeCount==0){
								document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input  range! '; 
								$('#alert-success2').hide();
								$('#alert-error2').show();
								$("#myModal").scrollTop(0);
							}else{
								if(min_amount.length==0){
									document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Please input minimum amount! '; 
									$('#alert-success2').hide();
									$('#alert-error2').show();
									$("#myModal").scrollTop(0);
								}else{
									if(isAdding == true){
										$.post("/References/Business-Nature-Add-Tax-Req",{transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){	
											var res = result.split("-");
											if(res[0]=="1"){
											id=res[1];
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;New Charge has been added! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
												addRanges(id);
												reset2();
											}else if(result=="2"){
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;This Charge already exist! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}else{
										$.post("/References/Business-Nature-Manage-Add-Tax-Req/Update", {id: chosenID ,transaction_charge_id : chargeID,transaction_type : type,basis : strBasis,indicator : strIndicator,mode : strMode,formula : formula,amount : amount,minimum_amount : min_amount,unit_measure : unit_measure}, function(result){
											
											if(result=="1"){
												document.getElementById("msg-success2").innerHTML = '&nbsp;&nbsp;Charge has been updated! '; 
												$('#alert-success2').show();
												$('#alert-error2').hide();
												$("#myModal").scrollTop(0);
												$('#myModal').on('hidden.bs.modal', function () {
													location.reload();
												});
												addRanges(chosenID);
												reset2();
											}else{
												document.getElementById("msg-error2").innerHTML = '&nbsp;&nbsp;Something went wrong. Please try again! '; 
												$('#alert-success2').hide();
												$('#alert-error2').show();
												$("#myModal").scrollTop(0);
											}	
										});
									}
								}
							}
						}
				}
			}
		}
		
	}
	
	function addFormulas(id){
		var val =  parseInt(variableCount) + 1;
		alert(val);
		for( x=1;x<val;x++){
			var chargeID = document.getElementById(""+x).value;
			var varName = "X"+x;
			$.post("/References/Business-Nature-Add-Tax-Req-Formula",{bp_tax_charges_req_id : id,var_name : varName,ref_tax_charges_id : chargeID}, function(result){	
			});	
		}
							
	}
	
	function addRanges(id){
		var val =  parseInt(rangeCount) + 1;
		for( x=1;x<val;x++){
			var lowerLimit = $('#lower'+x).val();
			var higherLimit = $('#higher'+x).val();
			var value = $('#value'+x).val();
			$.post("/References/Business-Nature-Add-Tax-Req-Range",{bp_tax_charges_req_id : id,lower_limit : lowerLimit, higher_limit : higherLimit, value : value}, function(result){	
			});	
		}						
	}
	
	function deleteCharge(id){
				$.post("/References/Manage-Business-Nature/Delete", {id : id}, function(result){	
				alert(result);
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Tax Charges has been deleted!';
						reset2();
						location.reload();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Tax Requirements! Please try again'; 
						reset2();
					}
				});
	}
	
	function updateCharge(id){
	$('#addBtn').val('Update');
	$("#myModal").modal();
		isAdding = false;
		$('#form-field-select-transaction-charge').attr('disabled',true);
		$('#form-field-select-1').attr('disabled',true);
		chosenID = id;
		document.getElementById("mod-title").innerHTML = '<b>Update Charge</b>';

			$.get("/References/Manage-Business-Nature-Charges/"+id, function(result){	
					var obj = JSON.parse(result);
					document.getElementById("form-field-select-1").value =  ''+obj[0].tax_charge.taxcharges_type_id;
					getTransactionCharge(obj[0].tax_charge.taxcharges_type_id,obj[0].transaction_charge_id);
					document.getElementById("form-field-select-transaction-type").value = ""+obj[0].transaction_type;
					$('#form-field-minimum-amount').val(''+obj[0].minimum_amount);
					
					
					var basisID;
					if(''+obj[0].basis=="Capital Investment"){
						basisID=1;
						setCapitalInvestment();
					}else if(''+obj[0].basis=="Gross Sale"){
						basisID=2;
						setGrossSale();
					}else{
						basisID=3;
						setInputedValue();	
						$('#form-field-unit-measure').val(''+obj[0].unit_measure);
					}
					document.getElementById("form-field-select-basis").value  = basisID;
					
					
					var formulaID;
					if(''+obj[0].indicator=="Constant"){
						formulaID=1;
						setConstant();
						$('#form-field-amount').val(''+obj[0].amount);
					}else if(''+obj[0].indicator=="Formula"){
						formulaID=2;
						setFormula();
						document.getElementById("form-field-select-mode").selectedIndex = 0;	
						if(''+obj[0].mode=="Normal"){
							setNormal();
						}else if(''+obj[0].mode=="Complex"){
							setComplex();	
							$('#form-field-no-variable').val(''+obj[0].tax_charges_formula.length);
							var val =  parseInt(obj[0].tax_charges_formula.length) + 1;
							variableCount=val;
							var pos = 0;
								for( x = 1; x < val ; x++){
									addInput(x,"variable","update",obj[0].tax_charges_formula[pos].ref_tax_charges_id);
									pos++;
								}
							$('#form-field-formula').val(''+obj[0].formula);
							document.getElementById("form-field-select-mode").selectedIndex = 1;							
						}
						
					}else{
						formulaID=3;
						setRange();
						$('#form-field-no-range').val(''+obj[0].tax_charges_range.length);
							var val =  parseInt(obj[0].tax_charges_range.length) + 1;
							rangeCount = parseInt(obj[0].tax_charges_range.length);
							var addList = document.getElementById('addlist');
							var docstyle = addList.style.display;
							if (docstyle == 'none') addList.style.display = '';
							
							var text = document.createElement('div');
							text.innerHTML = "<div class='control-group'>"+
											"<div class='controls span12' style='color:red;'>"+
												"<label  class='span1' >No</label>"+
												"<label  class='span3' >Lower Limit</label>"+
												"<label  class='span3' >Higher Limit</label>"+
												"<label  class='span3' >Value</label>"+
											"</div>"+
								"</div>";
										
							addList.appendChild(text);
							var pos=0;
								for( x = 1; x < val ; x++){
									var text = document.createElement('div');
									text.ids = 'additem_' + x;
									text.innerHTML = "<div class='control-group'>"+
																"<div class='controls span12' style='color:red;'>"+
																	"<label  class='span1' >"+x+"</label>"+
																	"<input type='number' class='span3'  min='0' id='lower"+x+"' value='"+obj[0].tax_charges_range[pos].lower_limit+"' placeholder='' />"+
																	"<input type='number' class='span3' min='0' id='higher"+x+"' value='"+obj[0].tax_charges_range[pos].higher_limit+"' placeholder='' />"+
																	"<input type='number' class='span3' min='0' id='value"+x+"' value='"+obj[0].tax_charges_range[pos].value+"' placeholder='' />"+
																"</div>"+
													"</div>";					
									addList.appendChild(text);
									pos++;
								}	
					}
					document.getElementById("form-field-select-indicator").value  = formulaID;	
			});
	}
	function addCharge(){
		reset2();
		$('#addBtn').val('Add');
		$("#myModal").modal();
		isAdding = true;
		document.getElementById("mod-title").innerHTML = '<b>Add Charge</b>';
	
	}
	
	function getFormulaVariable(id){
	alert('x');
		$.get("/References/Manage-Business-Nature-Charges-Get-Formula-Variable/"+id, function(result){
			alert(result);		
		});
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// set views
	function setConstant(){
			$('#div_unit_amount').show();	
			$('#div_unit_formula').hide();
			$('#div_unit_mode').hide();
			$('#div_unit_no_variable').hide();
			$('#formula_legend').hide();
			$('#formula_legend_msg').hide();
			$('#div_unit_no_range').hide();
			$('#form-field-formula').val('');
			$('#addlist').empty();
	}
	function setFormula(){
			$('#div_unit_amount').hide();	
			$('#div_unit_formula').show();
			$('#div_unit_mode').show();
			$('#formula_legend').show();
			$('#formula_legend_msg').show();
			$('#div_unit_no_range').hide();
			$('#form-field-amount').val('');
			$('#addlist').empty();
	}
	function setRange(){
			$('#div_unit_amount').hide();	
			$('#div_unit_formula').hide();
			$('#div_unit_mode').hide();
			$('#div_unit_no_range').show();
			$('#div_unit_no_variable').hide();
			$('#formula_legend').hide();
			$('#formula_legend_msg').hide();
			$('#form-field-amount').val('');
			$('#form-field-formula').val('');
			$('#addlist').empty();
	}
	function setNormal(){
			$('#div_unit_amount').hide();	
			$('#div_unit_no_variable').hide();
			$('#div_unit_formula').show();
			$('#addlist').empty();
	}
	function setComplex(){
			$('#div_unit_amount').hide();	
			$('#div_unit_no_variable').show();
			$('#div_unit_formula').show();	
	}
	function setInputedValue(){
			$('#div_unit_measure').show();
			document.getElementById("formula_legend_msg").innerHTML = "X0 = Inputted Value";	
	}
	function setCapitalInvestment(){
			$('#div_unit_measure').hide();
			document.getElementById("formula_legend_msg").innerHTML = "X0 = Capital Investment";
			$('#form-field-unit-measure').val('');	
	}function setGrossSale(){
			$('#div_unit_measure').hide();
			document.getElementById("formula_legend_msg").innerHTML = "X0 = Gross Sale";
			$('#form-field-unit-measure').val('');	
	}
	

	
	
	
	</script>
@endsection