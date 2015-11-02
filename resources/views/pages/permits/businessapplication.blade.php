@extends('layouts.master')

@section('title', 'Sample')

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
							<a href="#">Permits</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li>
							<a href="#">Business Permits</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Application</li>
					</ul><!--.breadcrumb-->
				</div>
@endsection	
@section('content')
	
    <div id="alert-success" class="alert alert-block alert-success" style="display:none">
		<button type="button" class="close" onclick="$('#alert-success').hide();">
			<i class="icon-remove"></i>
		</button>
		<i class="icon-ok green" id="msg-success"></i>
	</div>
	<div id="alert-error" class="alert alert-block alert-error" style="display:none;">
		<button type="button" class="close" onclick="$('#alert-error').hide();">
			<i class="icon-remove"></i>
		</button>
		<i class="icon-exclamation " id="msg-error"></i>
	</div>
	<div id="alert-delete" class="alert alert-block alert-error" style="display:none;">
		<p id="msg-delete"><i class="icon-exclamation "></i></p></br>
		<button class="btn btn-mini btn-danger" id="confirmBtn" >
			yes
		</button>
		<button class="btn btn-mini btn-success" onClick="cancelDelete()">
			no
		</button>
	</div>
	<div class="accordion-group"  style="z-index:100">
		<div class="accordion-heading">
			<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				Application
			</a>
		</div>

		<div class="accordion-body collapse" id="collapseOne">
			<div class="accordion-inner">
				<div class="row-fluid">
					<div id="fuelux-wizard" class="row-fluid hide" data-target="#step-container">
						<ul class="wizard-steps">
							<li data-target="#step1" class="active">
								<span class="step">1</span>
								<span class="title">Owner Info</span>
							</li>

							<li data-target="#step2">
								<span class="step">2</span>
								<span class="title">Business Info</span>
							</li>

							<li data-target="#step3">
								<span class="step">3</span>
								<span class="title">Line of Business</span>
							</li>

							<li data-target="#step4">
								<span class="step">4</span>
								<span class="title">Requirements</span>
							</li>
						</ul>
					</div>
					
					<hr />
					<form class="form-horizontal"  />
					<div class="control-group well">
					<span class="span4">
							<span >Taxpayer name:</span><b><p id="info_tax_name"></p></b>
							<span >Business Name: </span><b><p id="info_bus_name"></p></b>
					</span>
					<span class="span4">
							<span >Payment Mode:</span><b><p id="info_pay_mode"></p></b>
							<span >Business Scale: </span><b><p id="info_bus_scale"></p></b>
					</span>
					<span class="span4">
							<span >Access Pin: </span><b><p id="info_access_pin"></p></b>
					</span>
					</div>
					</form>
					<div class="step-content row-fluid position-relative" id="step-container">
						<div class="step-pane active" id="step1">
						<input type="button" class="span3 btn btn-primary pull-left" id="search" onClick="openModal()" value="Search Existing Owner" data-toggle="modal" data-target="#myModal"></input></br>
						<input class="span3" type="text" id="oid" maxlength="50" placeholder="oid"/>
						<input class="span3" type="text" id="application_method" maxlength="50" value="LOCAL" placeholder="application_type"/>
						<input class="span3" type="text" id="reference_no" maxlength="50" value="" placeholder="reference_no"/>
							<h3 class="lighter block green center"><b>Taxpayer/Owner Info</b></h3>
							<form class="form-horizontal"  />
								<h4 class="lighter block"><b>Personal Info</b></h4>
								<div class="control-group">
									<span class="span4">
										<label for="fname"><small class="text-error">*&nbsp;</small>First Name:</label>
											<input class="span12" type="text" id="fname" maxlength="50" />
									</span>
									<span class="span4">
										<label  for="mname">Middle Name:</label>
											<input class="span12" type="text" id="mname" maxlength="50" />
									</span>
									<span class="span4">
										<label  for="lname"><small class="text-error">*&nbsp;</small>Last Name:</label>
											<input class="span12" type="text" id="lname" maxlength="50" />
									</span>
								</div>
								<div class="control-group">
									<span class="span4">
										<label for="legal_entity">Legal Entity:</label>
											<input class="span12" type="text" id="legal_entity" maxlength="50" />
									</span>
									<span class="span4">
										<label  for="bday"><small class="text-error">*&nbsp;</small>Birthday:</label>
											<div class="row-fluid input-append">
												<input class="span11 date-picker" id="bday" type="text" data-date-format="yyyy-mm-dd"/>
												<span class="add-on">
													<i class="icon-calendar"></i>
												</span>
											</div>
									</span>
									<span class="span4">
										<label  for="civil_status"><small class="text-error">*&nbsp;</small>Civil Status:</label>
											<select class="span12" id="civil_status">
											    <option value="0" />Select Civil Status
												<option value="Single" />Single
												<option value="Married" />Married
												<option value="Widowed" />Widowed
												<option value="Divorced" />Divorced
											</select>
									</span>
								</div>
								<div class="control-group">
									<span class="span4">
										<label  for="gender"><small class="text-error">*&nbsp;</small>Gender:</label>
											<select class="span12" id="gender">
											    <option value="0" />Select Gender
												<option value="Male" />Male
												<option value="Female" />Female
											</select>
									</span>
									<span class="span4">
										<label  for="citizenship"><small class="text-error">*&nbsp;</small>Citizenship:</label>
											<select class="span12" id="citizenship">
											    <option value="0" />Select Citizenship
												@foreach ($citizenship_data as $citizenship_data)	
													<option value="{{$citizenship_data->id}}" />{{$citizenship_data->citizenship_name}}
												@endforeach	
											</select>
									</span>
									<span class="span4">
										<label  for="tin">Tin:</label>
											<input class="span12" type="text" id="tin" />
									</span>
								</div>
								<h4 class="lighter block"><b>Contact Info</b></h4>
								<div class="control-group">
									<span class="span4">
										<label  for="province"><small class="text-error">*&nbsp;</small>Province:</label>
											<select class="span12" id="province" onChange="setProvince(this.value)">
											<option value="0" />Select Province
												@foreach ($province_data as $province_data)	
											    <option value="{{$province_data->id}}" />{{$province_data->province_name}}</option>
												@endforeach	
											</select>
									</span>
									<span class="span4">
										<label  for="lgu"><small class="text-error">*&nbsp;</small>LGU:</label>
											<select class="span12" id="lgu" onChange="setDistrict(this.value)">
											    <option value="0" />Select LGU
											</select>
									</span>
									<span class="span4">
										<label  for="district"><small class="text-error">*&nbsp;</small>District:</label>
											<select class="span12" id="district" onChange="setBarangay(this.value)">
											    <option value="0" />Select District
											</select>
									</span>
								</div>
								<div class="control-group">
									<span class="span4">
										<label  for="barangay"><small class="text-error">*&nbsp;</small>Barangay:</label>
											<select class="span12" id="barangay" onChange="setZone(this.value)">
											    <option value="0" />Select Barangay
											</select>
									</span>
									<span class="span4">
										<label  for="zone">Zone:</label>
											<select class="span12" id="zone">
											    <option value="0" />Select Zone
											</select>
									</span>
									<span class="span4">
										<label  for="zip"><small class="text-error">*&nbsp;</small>Zip:</label>
											<input class="span12" type="text" id="zip" maxlength="50" readonly/>
									</span>
								</div>
								<div class="control-group">
									<span class="span8">
										<label for="address"><small class="text-error">*&nbsp;</small>Address:</label>
											<textarea class="span12" id="address" placeholder="Complete Address"></textarea>
									</span>
									<span class="span4">
										<label  for="tel">Tel no:</label>
											<input class="span12" type="text" id="tel"  />
									</span>
								</div>
								<div class="control-group">
									<span class="span4">
										<label  for="mobile"><small class="text-error">*&nbsp;</small>Mobile no: </label>
											<div class="row-fluid input-append">
												<span class="add-on">
													+63
												</span>
												<input class="span11" type="text" id="mobile"  />
											</div>
									</span>
									<span class="span4">
										<label  for="email"><small class="text-error">*&nbsp;</small>Email:</label>
											<input class="span12" type="email" id="email" maxlength="50" />
									</span>
									<span class="span4">
										<label  for="other">Other:</label>
											<input class="span12" type="text" id="other" maxlength="50" />
									</span>
								</div>
								</br>
								<div class="control-group ">
									<span class="span9">
										<span class="span3">
											<input type="button" class="span12 btn btn-default btn-small" id="clearOwnerBtn" onClick="reset1()" value="Clear Fields"></input>
										</span>
										<span class="span3" id="addOwnerBtn">
											<input type="button" class="span12 btn btn-primary btn-small"  onClick="addOwner()" value="Add Info" ></input>
										</span>
										<span class="span3" id="updateBtn" style="display:none;">
											<input type="button" class="span12 btn btn-primary btn-small"  onClick="updateOwnerData()" value="Update Info" ></input>
										</span>
										<span class="span3" id="deleteBtn" style="display:none;"> 
											<input type="button" class="span12 btn btn-danger btn-small"  onClick="deleteOwner()" value="Delete Info" ></input>
										</span>
									</span>
								</div>
							</form>
						</div>

						
						
						
						
						
						<div class="step-pane" id="step2">
						<input class="span3" type="hidden" id="bid" maxlength="50" placeholder="bid"/>
						<input class="span3" type="hidden" id="bid2" maxlength="50" placeholder="bid2"/>
						<input class="span3" type="hidden" id="baid" maxlength="50" placeholder="baid"/>
							<div class="row-fluid">
								<h3 class="lighter block green center"><b>Business Info</b></h3>	
								<form class="form-horizontal"  />
								<h4 class="lighter block"><b>Business Info</b></h4>
									<div class="control-group">
										<span class="span4">
											<label for="business_name"><small class="text-error">*&nbsp;</small>Business Name:</label>
												<input class="span12" type="text" id="business_name" maxlength="50" />
										</span>
										<span class="span4">
											<label  for="business_branch"><small class="text-error">*&nbsp;</small>Business Branch:</label>
												<input class="span12" type="text" id="business_branch" maxlength="50" />
										</span>
										<span class="span4">
											<label  for="business_scale"><small class="text-error">*&nbsp;</small>Business Scale:</label>
												<select class="span12" id="business_scale">
													<option value="0" />Select Business Scale
													<option value="Micro" />Micro
													<option value="Cottege" />Cottage
													<option value="Small" />Small
													<option value="Medium" />Medium
													<option value="Large" />Large
												</select>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="pay_method"><small class="text-error">*&nbsp;</small>Payment Method:</label>
												<select class="span12" id="pay_method">
													<option value="0" />Select Payment Method
													@foreach ($paymentmode_data as $paymentmode_data)
														<option value="{{$paymentmode_data->id}}" />{{$paymentmode_data->payment_mode}}
													@endforeach	
												</select>
										</span>		
									</div>
									
								<h4 class="lighter block"><b>Business Contact Info</b></h4>	
									<div class="control-group">
										<span class="span4">
											<label  for="bus_bldg_name">Building name: </label>
												<input class="span12" type="text" id="bus_bldg_name"  />
										</span>
										<span class="span4">
											<label  for="bus_email">Email:</label>
												<input class="span12" type="email" id="bus_email" maxlength="50" />
										</span>
										<span class="span4">
											<label  for="bus_mobile"><small class="text-error">*&nbsp;</small>Mobile no: </label>
												<div class="row-fluid input-append">
													<span class="add-on">
														+63
													</span>
													<input class="span11" type="text" id="bus_mobile"  />
												</div>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="bus_province"><small class="text-error">*&nbsp;</small>Province:</label>
												<select class="span12" id="bus_province" onChange="setBusProvince(this.value)">
												<option value="0" />Select Province
													@foreach ($province_bus_data as $data)	
													<option value="{{$data->id}}" />{{$data->province_name}}
													@endforeach	
												</select>
										</span>
										<span class="span4">
											<label  for="bus_lgu"><small class="text-error">*&nbsp;</small>LGU:</label>
												<select class="span12" id="bus_lgu" onChange="setBusDistrict(this.value)">
													<option value="0" />Select LGU
												</select>
										</span>
										<span class="span4">
											<label  for="bus_district"><small class="text-error">*&nbsp;</small>District:</label>
												<select class="span12" id="bus_district" onChange="setBusBarangay(this.value)">
													<option value="0" />Select District
												</select>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="bus_barangay"><small class="text-error">*&nbsp;</small>Barangay:</label>
												<select class="span12" id="bus_barangay" onChange="setBusZone(this.value)">
													<option value="0" />Select Barangay
												</select>
										</span>
										<span class="span4">
											<label  for="bus_zone">Zone:</label>
												<select class="span12" id="bus_zone">
													<option value="0" />Select Zone
												</select>
										</span>
										<span class="span4">
											<label  for="bus_zip"><small class="text-error">*&nbsp;</small>Zip:</label>
												<input class="span12" type="text" id="bus_zip" maxlength="50" readonly/>
										</span>
									</div>
									<div class="control-group">
										<span class="span8">
											<label for="bus_address"><small class="text-error">*&nbsp;</small>Address:</label>
												<textarea class="span12" id="bus_address" placeholder="Complete Address"></textarea>
										</span>
										<span class="span4">
											<label  for="bus_fax">Fax no: </label>
												<input class="span12" type="text" id="bus_fax"  maxlength="50"/>
										</span>
									</div>
									
									
								<h4 class="lighter block"><b>Business Other Info</b></h4>	
									<div class="control-group">
										<span class="span4">
											<label  for="date_stablished"><small class="text-error">*&nbsp;</small>Date Stablished: </label>
												<div class="row-fluid input-append">
													<input class="span11 date-picker" id="date_stablished" type="text" data-date-format="yyyy-mm-dd" />
													<span class="add-on">
														<i class="icon-calendar"></i>
													</span>
												</div>
										</span>
										<span class="span4">
											<label  for="start_date"><small class="text-error">*&nbsp;</small>Start Date:</label>
												<div class="row-fluid input-append">
													<input class="span11 date-picker" id="start_date" type="text" data-date-format="yyyy-mm-dd" />
													<span class="add-on">
														<i class="icon-calendar"></i>
													</span>
												</div>
										</span>
										<span class="span4">
											<label  for="no_vehicle"><small class="text-error">*&nbsp;</small>No of Delivery Vehicle: </label>
												<input class="span12" type="text" id="no_vehicle"  />
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<span class="span6">
												<label  for="no_emp_male"><small class="text-error">*&nbsp;</small>Employees no. Male </label>
												<input class="span12" type="text" id="no_emp_male"  />
											</span>	
											<span class="span6">
												<label  for="no_emp_female"><small class="text-error">*&nbsp;</small>Emp no. Female </label>
												<input class="span12" type="text" id="no_emp_female"  />
											</span>	
										</span>
										<span class="span4">
											<label  for="occupancy_type"><small class="text-error">*&nbsp;</small>Occupancy Type:</label>
												<select class="span12" id="occupancy_type">
												<option value="0" />Select Occupancy Type
													@foreach ($occupancytype_data as $occupancytype_data)	
													<option value="{{$occupancytype_data->id}}" />{{$occupancytype_data->occupancy_type}}
													@endforeach	
												</select>
										</span>
										<span class="span4">
											<label  for="ownership_type"><small class="text-error">*&nbsp;</small>Ownership Type:</label>
												<select class="span12" id="ownership_type">
												<option value="0" />Select Ownership Type
													@foreach ($ownershiptype_data as $ownershiptype_data)	
													<option value="{{$ownershiptype_data->id}}" />{{$ownershiptype_data->ownership_type}}
													@endforeach	
												</select>
										</span>
									</div>
									<div class="control-group">
										<span class="span6">
											<label for="location_desc">Location Desc:</label>
												<textarea class="span12" id="location_desc" placeholder="" maxlength="300"></textarea>
										</span>
										<span class="span6">
											<label for="remarks">Remarks:</label>
												<textarea class="span12" id="remarks" placeholder="" id="remarks" maxlength="300"></textarea>
										</span>
									</div>
								<h4 class="lighter block"><b>Business Necessities Info</b></h4>		
									<div class="control-group">
										<span class="span4">
											<label  for="dotc_accr_no">DOTC Accredited no: </label>
												<input class="span12" type="text" id="dotc_accr_no"  maxlength="50"/>
										</span>
										<span class="span4">
											<label  for="sec_reg_no">SEC Registration no:</label>
												<input class="span12" type="text" id="sec_reg_no"  maxlength="50"/>
										</span>
										<span class="span4">
											<label  for="bir_reg_no">BIR Registration no: </label>
												<input class="span12" type="text" id="bir_reg_no"  maxlength="50"/>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="dti_reg_no">DTI Registration no: </label>
												<input class="span12" type="text" id="dti_reg_no"  maxlength="50"/>
										</span>
										<span class="span4">
											<label  for="dti_reg_date">DTI Registration Date:</label>
												<div class="row-fluid input-append">
													<input class="span11 date-picker" id="dti_reg_date" type="text" data-date-format="yyyy-mm-dd" />
													<span class="add-on">
														<i class="icon-calendar"></i>
													</span>
												</div>
										</span>
										<span class="span4">
											<label  for="industry_sector">Industry Sector:</label>
												<select class="span12" id="industry_sector" >
												<option value="0" />Select Industry Sector
													@foreach ($industry_sector_data as $industry_sector_data)	
													<option value="{{$industry_sector_data->id}}" />{{$industry_sector_data->industry_sector_type}}
													@endforeach	
												</select>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="nso_ass_no">NSO Assigned no: </label>
												<input class="span12" type="text" id="nso_ass_no" maxlength="50" />
										</span>
										<span class="span4">
											<label  for="nso_stab_id">NSO Stablished ID:</label>
												<input class="span12" type="text" id="nso_stab_id"  maxlength="50"/>
										</span>
									</div>
								<h4 class="lighter block"><b>Business Main Info</b></h4>			
									<div class="control-group">
										<span class="span4">
											<label  for="office_name">Office Name: </label>
												<input class="span12" type="text" id="office_name" maxlength="50" />
										</span>
										<span class="span4">
											<label  for="office_lot">Office Lot:</label>
												<input class="span12" type="text" id="office_lot"  maxlength="50"/>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="office_tin">Office Tin no:</label>
												<input class="span12" type="text" id="office_tin" />
										</span>
										<span class="span4">
											<label  for="office_tel">Office Tel no:</label>
												<input class="span12" type="text" id="office_tel"  />
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="office_province">Province:</label>
												<select class="span12" id="office_province" onChange="setOfficeProvince(this.value)">
												<option value="0" />Select Province
													@foreach ($province_bus_data as $data)	
													<option value="{{$data->id}}" />{{$data->province_name}}
													@endforeach	
												</select>
										</span>
										<span class="span4">
											<label  for="office_lgu">LGU:</label>
												<select class="span12" id="office_lgu" onChange="setOfficeDistrict(this.value)">
													<option value="0" />Select LGU
												</select>
										</span>
										<span class="span4">
											<label  for="office_district">District:</label>
												<select class="span12" id="office_district" onChange="setOfficeBarangay(this.value)">
													<option value="0" />Select District
												</select>
										</span>
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="office_barangay">Barangay:</label>
												<select class="span12" id="office_barangay" onChange="setOfficeZone(this.value)">
													<option value="0" />Select Barangay
												</select>
										</span>
										<span class="span4">
											<label  for="office_zone">Zone:</label>
												<select class="span12" id="office_zone">
													<option value="0" />Select Zone
												</select>
										</span>
										<span class="span4">
											<label  for="office_zip">Zip:</label>
												<input class="span12" type="text" id="office_zip" maxlength="50" readonly/>
										</span>
									</div>
								<h4 class="lighter block"><b>Business Economic Organization</b></h4>	
									<div class="control-group">
										<span class="span8">
											<label  for="eco_reg_name">Registered Name: </label>
												<input class="span12" type="text" id="eco_reg_name" maxlength="50" />
										</span>
										<span class="span4">
												<label  for="eco_paid_emp">Paid Employees: </label>
												<input class="span12" type="text" id="eco_paid_emp"  />
										</span>	
									</div>
									<div class="control-group">
										<span class="span4">
											<label  for="eco_org">Economic Organization:</label>
												<select class="span12" id="eco_org" >
												<option value="0" />Select Economic Organization
													@foreach ($eco_org_data as $eco_org_data)	
													<option value="{{$eco_org_data->id}}" />{{$eco_org_data->economic_org_name}}
													@endforeach	
												</select>
										</span>
										<span class="span4">
											<label  for="eco_area">Economic Area:</label>
												<select class="span12" id="eco_area" >
												<option value="0" />Select Economic Area
													@foreach ($eco_area_data as $eco_area_data)	
													<option value="{{$eco_area_data->id}}" />{{$eco_area_data->economic_area_name}}
													@endforeach	
												</select>
										</span>
										<span class="span4">
											<label  for="bus_type"> Business Type:</label>
												<select class="span12" id="bus_type" onchange="setBusType(this.value)">
													<option value="Main" />Main
													<option value="Franchise" />Franchise
												</select>
												&nbsp;&nbsp;<input type="checkbox" id="id-disable-check" onChange="setSubsidiary()"/>
											<label class="lbl" for="id-disable-check" id="subsidiary_lbl"> Subsidiary</label>
										</span>
									</div>
									<div class="control-group" style="display:none" id="extra">
										<span class="span4">
											<label  for="extra_name">Name: </label>
												<input class="span12" type="text" id="extra_name" maxlength="50" />
										</span>
										<span class="span8">
											<label  for="extra_address">Address: </label>
												<input class="span12" type="text" id="extra_address" maxlength="200" >
										</span>
									</div>
									<div class="control-group ">
										<span class="span9">
											<span class="span3">
												<input type="button" class="span12 btn btn-default btn-small" id="clearOwnerBtn" onClick="reset2()" value="Clear Fields"></input>
											</span>
											<span class="span3" id="addBusinessBtn" >
												<input type="button" class="span12 btn btn-primary btn-small"  onClick="addBusinessInfo()" value="Add Business Info" ></input>
											</span>
											<span class="span3" id="updateBtnBus" style="display:none;">
												<input type="button" class="span12 btn btn-primary btn-small"  onClick="updateBusinessInfoData()" value="Update Business Info" ></input>
											</span>
										</span>
									</div>
									
									
									
								</form>
								
								
								
								
								
								
								
								
							</div>
						</div>

						<div class="step-pane" id="step3">
						<h3 class="lighter block green center"><b>Line of Business</b></h3>	
							<form class="form-horizontal"  />
								<div class="control-group">
									<span class="span4">
										<label  for="line_business"><small class="text-error">*&nbsp;</small>Line of Business:</label>
											<select class="span12" id="line_business" onChange="">
											<option value="" />Select Line of Business
											</select>
									</span>
									
									<span class="span2">
										<label  for="capital_investment"><small class="text-error">*&nbsp;</small>Capital Investment </label>
										<input class="span12" type="number" id="capital_investment"  />
									</span>	
									<span class="span2">
										<label  for="last_year_gross"><small class="text-error">*&nbsp;</small>Last Year Gross </label>
										<input class="span12" type="number" id="last_year_gross"  value="0.00" readonly/>
									</span>	
									<span class="span2">
										</br>
										<input type="button" class="span12 btn btn-primary btn-small" id="addLineBusinessBtn" onClick="manageLineOfBusiness()" value="Add"></input>
									</span>	
									<span class="span2">
										</br>
										<input type="button" class="span12 btn btn-primary btn-small" id="cancelUpdateBtn"  value="Cancel" style="display:none"></input>
									</span>	
								</div>
							</form>
								<table id="sample-table-3" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th ></th>
											<th >Line of Business</th>
											<th >Capital Investment</th>
											<th >Last Year Gross</th>
											<th ></th>
										</tr>
									</thead>
									<tbody>
															
									</tbody>
								</table>
							
						</div>

						<div class="step-pane" id="step4">
						<h3 class="lighter block green center"><b>Requirements</b></h3>	
							<div class="center">
								<form class="form-horizontal"  />
								<?php $i=0;?>
									<div class="control-group">
										@foreach ($requirement_data as $requirement_data)	
										<span class="span2">	
												<input type="checkbox" id="req_check_{{$i}}" value="{{$requirement_data->id}}" onChange=""/>
												<label class="lbl" for="req_check_{{$i}}"  >&nbsp;&nbsp;&nbsp;{{$requirement_data->requirement}}</label>
										</span>
										<?php $i++;?>
										@endforeach	
									</div>
									<input type="hidden" id="req_count"  value="{{$i}}"/>
									</br>
									</br>
									<span class="span9">
										<span class="span3">
											<input type="button" class="span12 btn btn-primary btn-small" id="updateBtn" onClick="addRequirements()" value="Save" ></input>
										</span>
									</span>
								</form>
							</div>
						</div>
					</div>

					<hr />
					
					<div class="row-fluid wizard-actions">
						<button class="btn btn-danger pull-left" id="cancelApplication" style="display:none;" onclick="cancelApplicationNow()">
								Cancel Business Application	
						</button>
						<button class="btn btn-prev">
							<i class="icon-arrow-left"></i>
							Prev
						</button>

						<button class="btn btn-primary btn-next" data-last="Asses">
							Next
							<i class="icon-arrow-right icon-on-right"></i>
						</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	</br>
	
	
	<hr>
	<h3 ><b>Business Application List</b></h3>	
	<button class="btn btn-primary " onClick="refreshList()">Refresh List&nbsp;&nbsp;<i id="spinRefresh" class="icon-spinner icon-spin white bigger-125" style="display:none"></i></button>
	<table id="sample-table-2" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th ></th>
				<th >Business Permit No.</th>
				<th >Business Name</th>
				<th >Business Owner</th>
				<th >Last Application Type</th>
				<th >Last Transcation</th>
				<th >Application Status</th>
				<th ></th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>







<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog" style=" margin-top:5000px;">
	  <div class="modal-dialog" style="z-index:0">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Choose Taxpayer/Owner</h4>
		  </div>
		  <div class="modal-body">
			<div id="alert-danger-modal" class="alert alert-block alert-danger" style="display:none">
				<button type="button" class="close" onclick="$('#alert-danger-modal').hide();">
					<i class="icon-remove"></i>
				</button>
				<i class="icon-exclamation red" id="msg-error-modal"></i>
			</div>
			</br>
			<center><b>Search from Online Registration</b>
			</br>
						<label  for="reference_no">Reference No: </label>
						<input  type="text" id="reference"  /><br>
						<button type="button" class=" btn btn-primary btn-small" id="" onClick="getOnlineRegister()" >&nbsp; Search and Attach &nbsp;&nbsp;<i id="spin" class="icon-spinner icon-spin white bigger-125" style="display:none"></i></button>
			
			</center>
			</br>
			<center><b>Or Search Local Database</b></center>
			</br>
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th ></th>
						<th >Fullname</th>
						<th >Birthday</th>
						<th ></th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;?>
					@foreach ($owner_data as $owner_data)																			
						<tr>
							<td class="center">
							{{$i++}}
							</td>
							<td>
								<p style="white-space: nowrap; text-overflow: ellipsis;">{{$owner_data->lname}} , {{$owner_data->fname}} {{$owner_data->mname}}</p>
							</td>
							<td>
								{{$owner_data->bday}} 
							</td>
							<td>
								<div class="hidden-phone visible-desktop btn-group">
									<button class="btn btn-mini btn-primary" onClick= 'attach({{$owner_data->id}},1)'>
										attach
									</button>
								</div>
							</td>
						</tr>
					@endforeach							
				</tbody>
			</table>
		  </br>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>		
@endsection



@section('page-script')
	<!--page specific plugin scripts-->

	<script src="{{ URL::asset('assets/js/select2.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/additional-methods.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/fuelux/fuelux.wizard.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/date-time/bootstrap-datepicker.min.js') }}"></script>


	<script type="text/javascript">
	
	var isAddingNewApplication = true;
	var stepone=false;
	var steptwo=false;
	
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, null, null, null, null,
				  { "bSortable": false }
				] } );
				
				var oTable2 = $('#sample-table-1').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null,  null,  
				  { "bSortable": false }
				] } );
				

				
			$('[data-rel=tooltip]').tooltip();
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
			});
			
			
			var $validation = false;
			
			$('#fuelux-wizard').ace_wizard().on('change' , function(e, info){
				if(info.step == 1 && info.direction==='next' ) {
					if(stepone==true){
						$('#alert-error').hide();
						$('#alert-success').hide();
						$('#alert-delete').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						return true;
					}else{
						$('#alert-error').show();
						$('#alert-success').hide();
						$('#alert-delete').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;You cannot procced without owner/taxpayer. Please fill all required fields with valid inputs!'; 
						return false;
					}
				}if(info.step == 2 && info.direction==='next' ) {
				
					addBusinessInfo();
				
					if(steptwo==true){
						$('#alert-error').hide();
						$('#alert-success').hide();
						$('#alert-delete').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						return true;
					}else{
						$('#alert-error').show();
						$('#alert-success').hide();
						$('#alert-delete').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;You cannot procced without Business Info. Please fill all required fields with valid inputs!'; 
						return false;
					}
				}if(info.step == 3 && info.direction==='next') {
					var count = $('#sample-table-3').dataTable().fnGetData().length;
					if(count>0){
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						return true;
					}else{
						$('#alert-error').show();
						$('#alert-success').hide();
						$('#alert-delete').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;You cannot procced without Capital Investment. Please fill all required fields with valid inputs!'; 
						return false;
					}
				}
				
			}).on('finished', function(e) {
					var result = assesApplication();
					if(result=='true-'){
							$('#alert-success').show();
							$('#alert-error').hide();
							$('#alert-delete').hide();
							document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Application has been moved for assesment!';
							$('html, body').animate({ scrollTop: 0 }, 'fast');
						return true;
					}else if(result=='error-'){
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Business Application. Please try again!'; 
						return false;
					}
			}).on('stepclick', function(e, info){
				//return false;//prevent clicking on steps
			});	
			
			getAllBusinessApplication();
		})
		
		//////////////////////// events /////////////////////////
		
		$('#tin').mask('999-999-999');
		$('#bday').mask('9999-99-99');
		$('#office_tin').mask('999-999-999');
		$('#tel').mask('999-99-99');
		$('#office_tel').mask('999-99-99');
		$('#mobile').mask('9999999999');
		$('#bus_tel').mask('999-99-99');
		$('#bus_mobile').mask('9999999999');
		$('#date_stablished').mask('9999-99-99');
		$('#start_date').mask('9999-99-99');
		$('#dti_reg_date').mask('9999-99-99');

		$("#no_vehicle").keypress(function (e) {
		var count=$("#no_vehicle").val();
		if(count.length==5){
			return false;
		}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
				   return false;
			}
		});
		$("#no_emp_male").keypress(function (e) {
		var count=$("#no_emp_male").val();
		if(count.length==10){
			return false;
		}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
				   return false;
			}
		});
		$("#no_emp_female").keypress(function (e) {
		var count=$("#no_emp_female").val();
		if(count.length==10){
			return false;
		}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
				   return false;
			}
		});
		$("#eco_paid_emp").keypress(function (e) {
		var count=$("#eco_paid_emp").val();
		if(count.length==10){
			return false;
		}
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57 )) {
				   return false;
			}
		});
		$("#fname").on("keypress", function(event) {

			var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;
			var key = String.fromCharCode(event.which);
			if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
				return true;
			}
			return false;
		});

		$('#fname').on("paste",function(e)
		{
			e.preventDefault();
		});
		$("#mname").on("keypress", function(event) {

			var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;
			var key = String.fromCharCode(event.which);
			if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
				return true;
			}
			return false;
		});

		$('#mname').on("paste",function(e)
		{
			e.preventDefault();
		});
		$("#lname").on("keypress", function(event) {

			var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;
			var key = String.fromCharCode(event.which);
			if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
				return true;
			}
			return false;
		});

		$('#lname').on("paste",function(e)
		{
			e.preventDefault();
		});
	//////////////////////////////////// Owners Functions (step 1) ////////////////////////////////////////////
		function setProvince(id,type,lid,zip){
			$('#lgu').empty().append('<option selected="0" value="">Select LGU</option>');
			$('#district').empty().append('<option selected="0" value="">Select District</option>');
			$('#barangay').empty().append('<option selected="0" value="">Select Barangay</option>');
			$('#zone').empty().append('<option selected="0" value="">Select Zone</option>');
			$('#zip').val('');
			$.get("/Permits/Business-Permits/Lgu/"+id, function(result){	
				var obj = JSON.parse(result);
				var x1 = document.getElementById("lgu");
				document.getElementById("lgu").options.length = 0;
				var option = document.createElement("option");	
				option.text ='Select LGU';
				option.value='0';
				x1.add(option);
				for(x=0;x<obj.length;x++){
					var option = document.createElement("option");	
					option.value=''+obj[x].id+'-'+obj[x].zip_code;
					option.text = ''+obj[x].lgu_name ;
					x1.add(option);
				}
				if(type=="attach"){
					document.getElementById("lgu").value = lid+"-"+zip;
					$('#zip').val(''+zip);
				}
			});
		}
	
		function setDistrict(id,type,did){
			
		var res = id.split("-");
		id=res[0];
		if(res[1]){
			$('#zip').val(""+res[1]);
		}else{
			$('#zip').val("");
		}
			
			$('#district').empty().append('<option selected="" value="0">Select District</option>');
			$('#barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
			$('#zone').empty().append('<option selected="" value="0">Select Zone</option>');
			$.get("/Permits/Business-Permits/District/"+id, function(result){	
				var obj = JSON.parse(result);
				var x1 = document.getElementById("district");
				document.getElementById("district").options.length = 0;
				var option = document.createElement("option");	
				option.value='0';
				option.text ='Select District';
				x1.add(option);
				for(x=0;x<obj.length;x++){
					var option = document.createElement("option");	
					option.value=''+obj[x].id;
					option.text = ''+obj[x].district_name ;
					x1.add(option);
				}
				if(type=="attach"){
					document.getElementById("district").value = did;
				}
			});	
		}
		
		function setBarangay(id,type,bid){
			$('#barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
			$('#zone').empty().append('<option selected="" value="0">Select Zone</option>');
			$.get("/Permits/Business-Permits/Barangay/"+id, function(result){	
				var obj = JSON.parse(result);
				var x1 = document.getElementById("barangay");
				document.getElementById("barangay").options.length = 0;
				var option = document.createElement("option");	
				option.value='0';
				option.text ='Select Barangay';
				x1.add(option);
				for(x=0;x<obj.length;x++){
					var option = document.createElement("option");	
					option.value=''+obj[x].id;
					option.text = ''+obj[x].brgy_name ;
					x1.add(option);
				}
				if(type=="attach"){
					document.getElementById("barangay").value = bid;
				}
			});	
		}
		function setZone(id,type,bid){
			$('#zone').empty().append('<option selected="" value="0">Select Zone</option>');
			$.get("/Permits/Business-Permits/Zone/"+id, function(result){	
				var obj = JSON.parse(result);
				var x1 = document.getElementById("zone");
				document.getElementById("zone").options.length = 0;
				var option = document.createElement("option");	
				option.value='0';
				option.text ='Select Zone';
				x1.add(option);
				for(x=0;x<obj.length;x++){
					var option = document.createElement("option");	
					option.value=''+obj[x].id;
					option.text = ''+obj[x].zone_name ;
					x1.add(option);
				}
				if(type=="attach"){
					document.getElementById("zone").value = bid;
				}
			});	
		}
		
		function reset1(){
		
			$('#fname').val('');
			$('#mname').val('');
			$('#lname').val('');
			$('#legal_entity').val('');
			$('#bday').val('');
			document.getElementById("civil_status").selectedIndex = 0;
			document.getElementById("gender").selectedIndex = 0;
			document.getElementById("citizenship").selectedIndex = 0;
			$('#tin').val('');
			document.getElementById("province").selectedIndex = 0;
			$('#lgu').empty().append('<option selected="" value="0">Select LGU</option>');
			$('#district').empty().append('<option selected="" value="0">Select District</option>');
			$('#barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
			$('#zone').empty().append('<option selected="" value="0">Select Zone</option>');
			$('#zip').val('');
			$('#address').val('');
			$('#mobile').val('');
			$('#tel').val('');
			$('#email').val('');
			$('#other').val('');
			$('#oid').val('');
			$('#addOwnerBtn').show();
			$('#updateBtn').hide();
			$('#updateBtn').hide();
			$('#deleteBtn').hide();
			$('#alert-error').hide();
			$('#alert-success').hide();
			$('#alert-delete').hide();
			$('#bid').val('');
			$('#bid2').val('');
			$('#baid').val('');
			$('#application_method').val('');
			document.getElementById("info_tax_name").innerHTML="";
			document.getElementById("info_bus_name").innerHTML="";
			document.getElementById("info_bus_scale").innerHTML="";
			document.getElementById("info_access_pin").innerHTML="";
			document.getElementById("info_pay_mode").innerHTML="";
			cancelApplication();
			stepone=false;
			steptwo=false;
			
		}

		
		
		function getOwnerData(){
			var fname=$('#fname').val();
			var mname=$('#mname').val();
			var lname=$('#lname').val();
			var legal_entity=$('#legal_entity').val();
			var bday=$('#bday').val();
			var civil_status=document.getElementById("civil_status").value;
			var gender=document.getElementById("gender").value;
			var citizenship=document.getElementById("citizenship").value;
			var tin = $('#tin').val();
			var province = document.getElementById("province").value;
			var lgu = document.getElementById("lgu").value;
			var district = document.getElementById("district").value;
			var barangay = document.getElementById("barangay").value;
			var zone = document.getElementById("zone").value;
			var zip = $('#zip').val();
			var address =$('#address').val();
			var mobile =$('#mobile').val();
			var tel =$('#tel').val();
			var email =$('#email').val();
			var other =$('#other').val();
			
			var obj = '{'
		   +'"fname" : "'+fname+'",'
		   +'"mname"  : "'+mname+'",'
		   +'"lname" : "'+lname+'",'
		   +'"legal_entity" : "'+legal_entity+'",'
		   +'"bday" : "'+bday+'",'
		   +'"civil_status"  : "'+civil_status+'",'
		   +'"gender" : "'+gender+'",'
		   +'"citizenship" : "'+citizenship+'",'
		   +'"tin"  : "'+tin+'",'
		   +'"province" : "'+province+'",'
		   +'"lgu" : "'+lgu+'",'
		   +'"district"  : "'+district+'",'
		   +'"barangay" : "'+barangay+'",'
		   +'"zone" : "'+zone+'",'
		   +'"zip"  : "'+zip+'",'
		   +'"address" : "'+address+'",'
		   +'"mobile" : "'+mobile+'",'
		   +'"tel"  : "'+tel+'",'
		   +'"email" : "'+email+'",'
		   +'"other" : "'+other+'"'
		   +'}';
		   
			return JSON.parse(obj);
		}
		
		function addOwner(){
						var result = validateOwner();
						var res=result.split('-');
						if(res[0]==true||res[0]=='true'){
							$('#alert-error').hide();
							document.getElementById("msg-error").innerHTML = ''; 
							$('#alert-success').show();
							$('#alert-delete').hide();
							document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Taxpayer/Owner has been created you can now input its business info!';
							$('html, body').animate({ scrollTop: 0 }, 'fast');
							$('#oid').val(''+res[1]);
							var owner = getOwnerData();
							document.getElementById("info_tax_name").innerHTML=owner.lname.toUpperCase()+" , "+owner.fname.toUpperCase()+" "+owner.mname.toUpperCase();
							var s = getAccessPin(owner.fname.toUpperCase()+" ,-"+owner.lname.toUpperCase()+"-"+owner.mname.toUpperCase());
							document.getElementById("info_access_pin").innerHTML = s;
							$('#application_method').val('LOCAL');
							getAllOwners();
							$('#updateBtnBus').hide();
							cancelApplication();
							$('#addOwnerBtn').hide();
							$('#updateBtn').show();
							$('#deleteBtn').show();
							stepone=true;
						}else if(res[0]==false||res[0]=='false'){
							$('#alert-error').show();
							$('html, body').animate({ scrollTop: 0 }, 'fast');
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!'; 
							stepone=false;
						}else if(res[0]=='exist'){
							$('#alert-error').show();
							$('html, body').animate({ scrollTop: 0 }, 'fast');
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Taxpayer/Owner Already Exist!'; 
							stepone=false;
						}else if(res[0]=='error'){
							$('#alert-error').show();
							$('html, body').animate({ scrollTop: 0 }, 'fast');
							document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Taxpayer/Owner. Please try again!'; 
							stepone=false;
						}else if(res[0]=='proceed'){
							$('#alert-error').hide();
							$('#alert-delete').hide();
							$('html, body').animate({ scrollTop: 0 }, 'fast');
							$('#updateBtnBus').hide();
							var owner = getOwnerData();
							document.getElementById("info_tax_name").innerHTML="&nbsp;&nbsp;"+owner.lname.toUpperCase()+" , "+owner.fname.toUpperCase()+" "+owner.mname.toUpperCase();
							cancelApplication();
							stepone=true;
						}
		}
		
		
		
		function validateOwner(){
			var obj = getOwnerData();
			var oid = $('#oid').val();
				
			if(oid.length==0){
				if(obj.fname.length==0||obj.lname.length==0||obj.civil_status.length==0||obj.gender.length==0||obj.citizenship.length==0||
				obj.province.length==0||obj.lgu.length==0||obj.district.length==0||obj.barangay.length==0||obj.address.length==0||
				obj.mobile.length==0||obj.email.length==0){
					return 'false-';
				}else{
					return $.ajax({
						type: "POST",
						url: "/Permits/Business-Permits/Add-Owner",
						data: {fname:obj.fname, mname:obj.mname, lname:obj.lname, legal_entity:obj.legal_entity, bday:obj.bday, civil_status:obj.civil_status, gender:obj.gender,
						citizenship:obj.citizenship, tin:obj.tin, province:obj.province, lgu:obj.lgu, district:obj.district,
						barangay:obj.barangay,zone:obj.zone,zip:obj.zip,address:obj.address,mobile:obj.mobile,tel:obj.tel,email:obj.email,other:obj.other},
						async: false
					}).responseText;	
				}
			}else{
				if(obj.fname.length==0||obj.lname.length==0||obj.civil_status.length==0||obj.gender.length==0||obj.citizenship.length==0||
				obj.province.length==0||obj.lgu.length==0||obj.district.length==0||obj.barangay.length==0||obj.address.length==0||
				obj.mobile.length==0||obj.email.length==0){
					return 'false-';
				}else{
					return 'proceed-';
				}
			}
		}
		
	function updateOwner(){
	
		var obj = getOwnerData();
		var oid = $('#oid').val();
			if(obj.fname.length==0||obj.lname.length==0||obj.civil_status.length==0||obj.gender.length==0||obj.citizenship.length==0||
			obj.province.length==0||obj.lgu.length==0||obj.district.length==0||obj.barangay.length==0||obj.address.length==0||
			obj.mobile.length==0||obj.email.length==0){
				return 'false';
			}else{
				return $.ajax({
					type: "POST",
					url: "/Permits/Owner/Update",
					data: {id:oid, fname:obj.fname, mname:obj.mname, lname:obj.lname, legal_entity:obj.legal_entity, bday:obj.bday, civil_status:obj.civil_status, gender:obj.gender, citizenship:obj.citizenship, tin:obj.tin, province:obj.province, lgu:obj.lgu, district:obj.district,
					barangay:obj.barangay,zone:obj.zone,zip:obj.zip,address:obj.address,mobile:obj.mobile,tel:obj.tel,email:obj.email,other:obj.other},
					async: false
				}).responseText;	
			}

	}
	
	function updateOwnerData(){
		var result = updateOwner();
					if(result=='true'){
						$('#alert-error').hide();
						document.getElementById("msg-error").innerHTML = ''; 
						$('#alert-success').show();
						$('#alert-delete').hide();
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Taxpayer/Owner has been updated!';
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						getAllOwners();
						var owner = getOwnerData();
						document.getElementById("info_tax_name").innerHTML="&nbsp;&nbsp;"+owner.lname.toUpperCase()+" , "+owner.fname.toUpperCase()+" "+owner.mname.toUpperCase();
						getAllBusinessApplication();
						return true;
					}else if(result=='false'){
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!'; 
						return false;
					}else if(result=='error'){
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Taxpayer/Owner. Please try again!'; 
						return false;
					}
	}
		
	function getAllOwners(){
		$.get("/Permits/Business-Permits/Owner/All", function(result){	
			var obj = JSON.parse(result);
			$('#sample-table-1').dataTable().fnClearTable();
			var count = 0;
			for(x=0;x<obj.length;x++){
			count++;
			
				var id = obj[x].id;
				var fname = obj[x].fname;
				var mname = obj[x].mname;
				var lname = obj[x].lname;
				var bday = obj[x].bday;
				$('#sample-table-1').dataTable().fnAddData( [
				""+count,
				""+lname+" , "+fname+" "+mname,""+bday ,
				"<div class='hidden-phone visible-desktop btn-group'>"+
									"<button class='btn btn-mini btn-primary' onClick= 'attach("+id+",1)'>"+
										"attach"+
									"</button>"+
				"</div>"
				] );
			}
		});	
	}	
	function attach(id,mode){

		$.get("/Permits/Business-Permits/Attach-Owner/"+id, function(result){	
			var obj = JSON.parse(result);
			$('#fname').val(obj[0].fname);
			$('#mname').val(obj[0].mname);
			$('#lname').val(obj[0].lname);
			$('#legal_entity').val(obj[0].legal_entity);
			$('#bday').val(obj[0].bday);
			document.getElementById("civil_status").value = obj[0].civil_status;
			document.getElementById("gender").value = obj[0].gender;
			document.getElementById("citizenship").value = obj[0].owner_citizenship_id;
			$('#tin').val(obj[0].tin);
			document.getElementById("province").value = obj[0].owner_province_id;
			setProvince(obj[0].owner_province_id,'attach',obj[0].owner_city_id,obj[0].lgu.zip_code);
			setDistrict(obj[0].owner_city_id+"-"+obj[0].lgu.zip_code,'attach',obj[0].owner_district_id);
			setBarangay(obj[0].owner_district_id,'attach',obj[0].owner_brgy_id);
			setZone(obj[0].owner_brgy_id,'attach',obj[0].owner_zone_id);
			$('#address').val(obj[0].complete_address);
			$('#mobile').val(obj[0].mobile);
			$('#tel').val(obj[0].tel_no);
			$('#email').val(obj[0].email);
			$('#other').val(obj[0].other);
			$('#oid').val(obj[0].id);
			if(mode==1){
				$('#bid').val('');
				$('#bid2').val('');
				reset2();
			}
			$('#application_method').val('LOCAL');
			var name = obj[0].fname.toUpperCase()+" , "+obj[0].lname.toUpperCase()+" "+obj[0].mname.toUpperCase();
			document.getElementById("info_tax_name").innerHTML=name;
			var s = getAccessPin(obj[0].fname.toUpperCase()+" ,-"+obj[0].lname.toUpperCase()+"-"+obj[0].mname.toUpperCase());
			document.getElementById("info_access_pin").innerHTML = s;
			$('#addOwnerBtn').hide();
			$('#updateBtn').show();
			$('#deleteBtn').show();
			$('#myModal').modal('hide');
			stepone=true;
		});	
	}
	function deleteOwner(){
		document.getElementById("msg-delete").innerHTML = '&nbsp;&nbsp;Are you sure you want to delete this Taxpayer/Owner?'; 
		$('#alert-delete').show();
		$('#confirmBtn').show();
		$('#alert-error').hide();
		$('#alert-success').hide();
		$('html, body').animate({ scrollTop: 0 }, 'fast');
	}
	var confirm = document.getElementById('confirmBtn');
	confirm.addEventListener('click', function() {
	var oid = $('#oid').val();
		$.post("/Permits/Owner/Delete", {id : oid}, function(result){	
			if(result=="1"){
				reset2();
				reset1();
				$('#alert-success').show();
				$('#alert-error').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Taxpayer/Owner has been deleted!';
				getAllOwners();
				$('#bid').val('');
				$('#bid2').val('');
				cancelApplication();
				getAllBusinessApplication();
			}else {
				$('#alert-success').hide();
				$('#alert-error').show();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Taxpayer/Owner! Please try again'; 
			}
		});
	}, false);
	
	function cancelDelete(){
		$('#alert-delete').hide();
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////// Business Info Functions (Step 2) /////////////////////////////////////////////
	function reset2(){
		$('#business_name').val('');
		$('#business_branch').val('');
		document.getElementById("business_scale").selectedIndex = 0;
		document.getElementById("pay_method").selectedIndex = 0;
		$('#bus_bldg_name').val('');
		$('#bus_mobile').val('');
		document.getElementById("bus_province").selectedIndex = 0;
		$('#bus_lgu').empty().append('<option selected="" value="0">Select LGU</option>');
		$('#bus_district').empty().append('<option selected="" value="0">Select District</option>');
		$('#bus_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#bus_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$('#bus_zip').val('');
		$('#bus_address').val('');
		$('#bus_fax').val('');
		$('#bus_email').val('');
		$('#date_stablished').val('');
		$('#start_date').val('');
		$('#no_vehicle').val('');
		$('#no_emp_male').val('');
		$('#no_emp_female').val('');
		document.getElementById("occupancy_type").selectedIndex = 0;
		document.getElementById("ownership_type").selectedIndex = 0;
		$('#location_desc').val('');
		$('#remarks').val('');
		$('#dotc_accr_no').val('');
		$('#sec_reg_no').val('');
		$('#bir_reg_no').val('');
		$('#dti_reg_no').val('');
		$('#dti_reg_date').val('');
		document.getElementById("industry_sector").selectedIndex = 0;
		$('#nso_ass_no').val('');
		$('#nso_stab_id').val('');
		$('#office_name').val('');
		$('#office_lot').val('');
		$('#office_tin').val('');
		$('#office_tel').val('');
		document.getElementById("office_province").selectedIndex = 0;
		$('#office_lgu').empty().append('<option selected="" value="0">Select LGU</option>');
		$('#office_district').empty().append('<option selected="" value="0">Select District</option>');
		$('#office_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#office_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$('#office_zip').val('');
		$('#eco_reg_name').val('');
		$('#eco_paid_emp').val('');
		document.getElementById("eco_org").selectedIndex = 0;
		document.getElementById("eco_area").selectedIndex = 0;
		document.getElementById("bus_type").selectedIndex = 0;
		uncheck();
		$('#extra').hide();
		$('#subsidiary_lbl').show();
		$('#extra_name').val('');
		$('#extra_address').val('');
		$('#updateBtnBus').hide();
		$('#addBusinessBtn').show();
	}
		
	function getBusinessData(){
		var business_name = $('#business_name').val();
		var business_branch = $('#business_branch').val();
		var business_scale = document.getElementById("business_scale").value;
		var pay_method = document.getElementById("pay_method").value;
		var index = document.getElementById("pay_method").selectedIndex;
		var pay_method_text = document.getElementById("pay_method").options[index].text;
		var bus_bldg_name = $('#bus_bldg_name').val();
		var bus_mobile = $('#bus_mobile').val();
		var bus_province = document.getElementById("bus_province").value;
		var bus_lgu = document.getElementById("bus_lgu").value;
		var bus_district = document.getElementById("bus_district").value;
		var bus_barangay = document.getElementById("bus_barangay").value;
		var bus_zone = document.getElementById("bus_zone").value;
		var bus_zip = $('#bus_zip').val();
		var bus_address = $('#bus_address').val();
		var bus_fax = $('#bus_fax').val();
		var bus_email = $('#bus_email').val();
		var date_stablished = $('#date_stablished').val();
		var start_date = $('#start_date').val();
		var no_vehicle = $('#no_vehicle').val();
		var no_emp_male = $('#no_emp_male').val();
		var no_emp_female = $('#no_emp_female').val();
		var occupancy_type = document.getElementById("occupancy_type").value;
		var ownership_type = document.getElementById("ownership_type").value;
		var location_desc = $('#location_desc').val();
		var remarks = $('#remarks').val();
		var dotc_accr_no = $('#dotc_accr_no').val();
		var sec_reg_no = $('#sec_reg_no').val();
		var bir_reg_no = $('#bir_reg_no').val();
		var dti_reg_no = $('#dti_reg_no').val();
		var dti_reg_date = $('#dti_reg_date').val();
		var industry_sector = document.getElementById("industry_sector").value;
		var nso_ass_no = $('#nso_ass_no').val();
		var nso_stab_id = $('#nso_stab_id').val();
		var office_name = $('#office_name').val();
		var office_lot = $('#office_lot').val();
		var office_tin = $('#office_tin').val();
		var office_tel = $('#office_tel').val();
		var office_province = document.getElementById("office_province").value;
		var office_lgu = document.getElementById("office_lgu").value;
		var office_district = document.getElementById("office_district").value;
		var office_barangay = document.getElementById("office_barangay").value;
		var office_zone = document.getElementById("office_zone").value;
		var office_zip = $('#office_zip').val();
		var eco_reg_name = $('#eco_reg_name').val();
		var eco_paid_emp = $('#eco_paid_emp').val();
		var eco_org = document.getElementById("eco_org").value;
		var eco_area = document.getElementById("eco_area").value;
		var bus_type = document.getElementById("bus_type").value;
		var checked = document.getElementById("id-disable-check").checked;
		var pin = document.getElementById("info_access_pin").innerHTML;
		var subsidiary = "";
			if(checked){
				subsidiary = "1";
			}else{
				subsidiary = "0";
			}
		var extra_name = $('#extra_name').val();
		var extra_address = $('#extra_address').val();
		
		var obj = '{'
	   +'"business_name" : "'+business_name+'",'
	   +'"pin" : "'+pin+'",'
	   +'"business_branch"  : "'+business_branch+'",'
	   +'"business_scale" : "'+business_scale+'",'
	   +'"pay_method" : "'+pay_method+'",'
	   +'"pay_method_text" : "'+pay_method_text+'",'
	   +'"bus_bldg_name"  : "'+bus_bldg_name+'",'
	   +'"bus_mobile" : "'+bus_mobile+'",'
	   +'"bus_province"  : "'+bus_province+'",'
	   +'"bus_lgu"  : "'+bus_lgu+'",'
	   +'"bus_district" : "'+bus_district+'",'
	   +'"bus_barangay" : "'+bus_barangay+'",'
	   +'"bus_zone"  : "'+bus_zone+'",'
	   +'"bus_zip" : "'+bus_zip+'",'
	   +'"bus_address" : "'+bus_address+'",'
	   +'"bus_fax"  : "'+bus_fax+'",'
	   +'"bus_email" : "'+bus_email+'",'
	   +'"date_stablished" : "'+date_stablished+'",'
	   +'"start_date"  : "'+start_date+'",'
	   +'"no_vehicle" : "'+no_vehicle+'",'
	   +'"no_emp_male" : "'+no_emp_male+'",'
	   +'"no_emp_female" : "'+no_emp_female+'",'
	   +'"occupancy_type" : "'+occupancy_type+'",'
	   +'"ownership_type" : "'+ownership_type+'",'
	   +'"location_desc" : "'+location_desc+'",'
	   +'"remarks" : "'+remarks+'",'
	   +'"dotc_accr_no" : "'+dotc_accr_no+'",'
	   +'"sec_reg_no" : "'+sec_reg_no+'",'
	   +'"bir_reg_no" : "'+bir_reg_no+'",'
	   +'"dti_reg_date" : "'+dti_reg_date+'",'
	   +'"dti_reg_no" : "'+dti_reg_no+'",'
	   +'"industry_sector" : "'+industry_sector+'",'
	   +'"nso_ass_no" : "'+nso_ass_no+'",'
	   +'"nso_stab_id" : "'+nso_stab_id+'",'
	   +'"office_name" : "'+office_name+'",'
	   +'"office_lot" : "'+office_lot+'",'
	   +'"office_tin" : "'+office_tin+'",'
	   +'"office_tel" : "'+office_tel+'",'
	   +'"office_province" : "'+office_province+'",'
	   +'"office_lgu" : "'+office_lgu+'",'
	   +'"office_district" : "'+office_district+'",'
	   +'"office_barangay" : "'+office_barangay+'",'
	   +'"office_zone" : "'+office_zone+'",'
	   +'"office_zip" : "'+office_zip+'",'
	   +'"eco_reg_name" : "'+eco_reg_name+'",'
	   +'"eco_paid_emp" : "'+eco_paid_emp+'",'
	   +'"eco_org" : "'+eco_org+'",'
	   +'"eco_area" : "'+eco_area+'",'
	   +'"bus_type" : "'+bus_type+'",'
	   +'"subsidiary" : "'+subsidiary+'",'
	   +'"extra_name" : "'+extra_name+'",'
	   +'"extra_address" : "'+extra_address+'"'
	   +'}';
		   
			return JSON.parse(obj);
		}
		
	function setBusProvince(id,type,lid,zip){
		$('#bus_lgu').empty().append('<option selected="" value="0">Select LGU</option>');
		$('#bus_district').empty().append('<option selected="" value="0">Select District</option>');
		$('#bus_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#bus_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$('#bus_zip').val('');
		$.get("/Permits/Business-Permits/Lgu/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("bus_lgu");
			document.getElementById("bus_lgu").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select LGU';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id+'-'+obj[x].zip_code;
				option.text = ''+obj[x].lgu_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("bus_lgu").value = lid+"-"+zip;
					$('#zip').val(''+zip);
			}
		});	
	}


	
	function setBusDistrict(id,type,did){
		
	var res = id.split("-");
	id=res[0];
	if(res[1]){
		$('#bus_zip').val(""+res[1]);
	}else{
		$('#bus_zip').val("");
	}
		
		$('#bus_district').empty().append('<option selected="" value="0">Select District</option>');
		$('#bus_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#bus_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/District/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("bus_district");
			document.getElementById("bus_district").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select District';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].district_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("bus_district").value = did;
				}
		});	
	}

	function setBusBarangay(id,type,bid){
		$('#bus_barangay').empty().append('<option selected="0" value="">Select Barangay</option>');
		$('#bus_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/Barangay/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("bus_barangay");
			document.getElementById("bus_barangay").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select Barangay';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].brgy_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("bus_barangay").value = bid;
				}
		});	
	}
	
	function setBusZone(id,type,bid){
		$('#bus_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/Zone/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("bus_zone");
			document.getElementById("bus_zone").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select Zone';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].zone_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("bus_zone").value = bid;
				}
		});	
	}
	function setOfficeProvince(id,type,lid,zip){
		$('#office_lgu').empty().append('<option selected="0" value="">Select LGU</option>');
		$('#office_district').empty().append('<option selected="0" value="">Select District</option>');
		$('#office_barangay').empty().append('<option selected="0" value="">Select Barangay</option>');
		$('#office_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$('#office_zip').val('');
		$.get("/Permits/Business-Permits/Lgu/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("office_lgu");
			document.getElementById("office_lgu").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select LGU';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id+'-'+obj[x].zip_code;
				option.text = ''+obj[x].lgu_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("office_lgu").value = lid+"-"+zip;
					$('#office_zip').val(''+zip);
			}
		});	
	}

	function setOfficeDistrict(id,type,did){
		
		var res = id.split("-");
		id=res[0];
		if(res[1]){
			$('#office_zip').val(""+res[1]);
		}else{
			$('#office_zip').val("");
		}
		
		$('#office_district').empty().append('<option selected="" value="0">Select District</option>');
		$('#office_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#office_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/District/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("office_district");
			document.getElementById("office_district").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select District';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].district_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("office_district").value = did;
				}
		});	
	}
	function setOfficeBarangay(id,type,did){
		$('#office_barangay').empty().append('<option selected="" value="0">Select Barangay</option>');
		$('#office_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/Barangay/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("office_barangay");
			document.getElementById("office_barangay").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select Barangay';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].brgy_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("office_barangay").value = did;
				}
		});	
	}
	function setOfficeZone(id,type,did){
		$('#office_zone').empty().append('<option selected="" value="0">Select Zone</option>');
		$.get("/Permits/Business-Permits/Zone/"+id, function(result){	
			var obj = JSON.parse(result);
			var x1 = document.getElementById("office_zone");
			document.getElementById("office_zone").options.length = 0;
			var option = document.createElement("option");	
			option.value='0';
			option.text ='Select Zone';
			x1.add(option);
			for(x=0;x<obj.length;x++){
				var option = document.createElement("option");	
				option.value=''+obj[x].id;
				option.text = ''+obj[x].zone_name ;
				x1.add(option);
			}
			if(type=="attach"){
					document.getElementById("office_zone").value = did;
				}
		});	
	}


	function setBusType(val){
		if(val=='Main'){
			$('#id-disable-check').show();
			$('#subsidiary_lbl').show();
			$('#extra').hide();
		}else{
			$('#id-disable-check').hide();
			$('#subsidiary_lbl').hide();
			$('#extra').show();
		}	
	}
	function setSubsidiary(){
			var checked = document.getElementById("id-disable-check").checked;
			if(checked){
				$('#extra').show();
			}else{
				$('#extra').hide();
			}
	}
	function check() {
		document.getElementById("id-disable-check").checked = true;
	}
	function uncheck() {
		document.getElementById("id-disable-check").checked = false;
	}
	
	function validateOwnerBusinessInfo(){
	
			var obj = getBusinessData();
			var bid = $('#bid').val();
			var oid = $('#oid').val();
			var application_method = $('#application_method').val();
			var reference_no = $('#reference_no').val();
			if(bid.length==0){
				if(obj.business_name.length==0||obj.business_branch.length==0||obj.business_scale.length==0||obj.pay_method.length==0||
				obj.bus_mobile.length==0||obj.bus_province.length==0||obj.bus_lgu.length==0||obj.bus_district.length==0||obj.bus_barangay.length==0||
				obj.bus_address.length==0||obj.date_stablished.length==0||obj.start_date.length==0||obj.no_vehicle.length==0||
				obj.no_emp_male.length==0||obj.no_emp_female.length==0||obj.occupancy_type.length==0||obj.ownership_type.length==0){
					return 'false-';
				}else{
					return $.ajax({
						type: "POST",
						url: "/Permits/Business-Permits/Add-Owner-Business-Info",
						data: {pin:obj.pin,oid:oid,business_name:obj.business_name, business_branch:obj.business_branch, business_scale:obj.business_scale, pay_method:obj.pay_method,
						bus_bldg_name:obj.bus_bldg_name, bus_mobile:obj.bus_mobile, bus_province:obj.bus_province, bus_lgu:obj.bus_lgu, bus_district:obj.bus_district,
						bus_barangay:obj.bus_barangay,bus_zone:obj.bus_zone,bus_address:obj.bus_address, bus_fax:obj.bus_fax, bus_email:obj.bus_email,
						date_stablished:obj.date_stablished,start_date:obj.start_date,no_vehicle:obj.no_vehicle,no_emp_male:obj.no_emp_male,no_emp_female:obj.no_emp_female,occupancy_type:obj.occupancy_type,
						ownership_type:obj.ownership_type,location_desc:obj.location_desc,remarks:obj.remarks ,dotc_accr_no:obj.dotc_accr_no,sec_reg_no:obj.sec_reg_no,bir_reg_no:obj.bir_reg_no
						,dti_reg_date:obj.dti_reg_date,dti_reg_no:obj.dti_reg_no,industry_sector:obj.industry_sector,nso_ass_no:obj.nso_ass_no,nso_stab_id:obj.nso_stab_id,office_name:obj.office_name
						,office_lot:obj.office_lot,office_tin:obj.office_tin,office_tel:obj.office_tel,office_province:obj.office_province,office_lgu:obj.office_lgu,office_district:obj.office_district
						,office_barangay:obj.office_barangay,office_zone:obj.office_zone,office_zip:obj.office_zip,eco_reg_name:obj.eco_reg_name,eco_reg_name:obj.eco_reg_name
						,eco_paid_emp:obj.eco_paid_emp,eco_org:obj.eco_org,eco_area:obj.eco_area,bus_type:obj.bus_type,subsidiary:obj.subsidiary,extra_name:obj.extra_name,extra_address:obj.extra_address,application_method:application_method,reference_no :reference_no },
						async: false
					}).responseText;	
				}
			}else{
				if(obj.business_name.length==0||obj.business_branch.length==0||obj.business_scale.length==0||obj.pay_method.length==0||
				obj.bus_mobile.length==0||obj.bus_province.length==0||obj.bus_lgu.length==0||obj.bus_district.length==0||obj.bus_barangay.length==0||
				obj.bus_address.length==0||obj.date_stablished.length==0||obj.start_date.length==0||obj.no_vehicle.length==0||
				obj.no_emp_male.length==0||obj.no_emp_female.length==0||obj.occupancy_type.length==0||obj.ownership_type.length==0){
					return 'false-';
				}else{
					return 'proceed-';
				}
			}
	}	
	function addBusinessInfo(){
		var response = validateOwnerBusinessInfo();
		var res=response.split('-');
		if(res[0]==true||res[0]=='true'){
				$('#alert-error').hide();
				$('#alert-delete').hide();
				$('#alert-success').show();
				document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;New Business Info has been created! You can now add line of business.';
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				$('#bid').val(''+res[1]);
				$('#bid2').val(''+res[2]);
				$('#baid').val(''+res[3]);
				$('#updateBtnBus').show();
				$('#addBusinessBtn').hide();
				var businessInfo = getBusinessData();
				document.getElementById("info_bus_name").innerHTML = businessInfo.business_name.toUpperCase();
				document.getElementById("info_bus_scale").innerHTML = businessInfo.business_scale.toUpperCase();
				document.getElementById("info_pay_mode").innerHTML = businessInfo.pay_method_text.toUpperCase();
				cancelApplication();
				getAllLineOfBusiness(res[1]);
				getAllBusinessApplication();
				steptwo=true;
			}else if(res[0]==false||res[0]=='false'){
				$('#alert-error').show();
				$('#alert-success').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!';
				steptwo=false;				
			}else if(res[0]=='error'){
				$('#alert-error').show();
				$('#alert-delete').hide();
				$('#alert-success').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Business Info. Please try again!'; 
				steptwo=false;	
			}else if(res[0]=='proceed'){
				$('#alert-error').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				$('#updateBtnBus').show();
				cancelApplication();
				steptwo=true;	
			}
	}
	function updateBusinessInfo(){
	
		var obj = getBusinessData();
		var bid = $('#bid').val();
		var bid2 = $('#bid2').val();
		var oid = $('#oid').val();
			if(bid.length!=0){
				if(obj.business_name.length==0||obj.business_branch.length==0||obj.business_scale.length==0||obj.pay_method.length==0||
				obj.bus_mobile.length==0||obj.bus_province.length==0||obj.bus_lgu.length==0||obj.bus_district.length==0||obj.bus_barangay.length==0||
				obj.bus_address.length==0||obj.date_stablished.length==0||obj.start_date.length==0||obj.no_vehicle.length==0||
				obj.no_emp_male.length==0||obj.no_emp_female.length==0||obj.occupancy_type.length==0||obj.ownership_type.length==0){
					return 'false-';
				}else{
					return $.ajax({
						type: "POST",
						url: "/Permits/Business-Info/Update",
						data: {bid2:bid2,bid:bid,oid:oid,business_name:obj.business_name, business_branch:obj.business_branch, business_scale:obj.business_scale, pay_method:obj.pay_method,
						bus_bldg_name:obj.bus_bldg_name, bus_mobile:obj.bus_mobile, bus_province:obj.bus_province, bus_lgu:obj.bus_lgu, bus_district:obj.bus_district,
						bus_barangay:obj.bus_barangay,bus_zone:obj.bus_zone,bus_address:obj.bus_address, bus_fax:obj.bus_fax, bus_email:obj.bus_email,
						date_stablished:obj.date_stablished,start_date:obj.start_date,no_vehicle:obj.no_vehicle,no_emp_male:obj.no_emp_male,no_emp_female:obj.no_emp_female,occupancy_type:obj.occupancy_type,
						ownership_type:obj.ownership_type,location_desc:obj.location_desc,remarks:obj.remarks ,dotc_accr_no:obj.dotc_accr_no,sec_reg_no:obj.sec_reg_no,bir_reg_no:obj.bir_reg_no
						,dti_reg_date:obj.dti_reg_date,dti_reg_no:obj.dti_reg_no,industry_sector:obj.industry_sector,nso_ass_no:obj.nso_ass_no,nso_stab_id:obj.nso_stab_id,office_name:obj.office_name
						,office_lot:obj.office_lot,office_tin:obj.office_tin,office_tel:obj.office_tel,office_province:obj.office_province,office_lgu:obj.office_lgu,office_district:obj.office_district
						,office_barangay:obj.office_barangay,office_zone:obj.office_zone,office_zip:obj.office_zip,eco_reg_name:obj.eco_reg_name,eco_reg_name:obj.eco_reg_name
						,eco_paid_emp:obj.eco_paid_emp,eco_org:obj.eco_org,eco_area:obj.eco_area,bus_type:obj.bus_type,subsidiary:obj.subsidiary,extra_name:obj.extra_name,extra_address:obj.extra_address},
						async: false
					}).responseText;	
				}
			}
	}
	
	function updateBusinessInfoData(){
		var result = updateBusinessInfo();
					if(result=='true-'){
						$('#alert-error').hide();
						document.getElementById("msg-error").innerHTML = ''; 
						$('#alert-success').show();
						$('#alert-delete').hide();
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Business Info has been updated!';
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						getAllOwners();
						var businessInfo = getBusinessData();
						document.getElementById("info_bus_name").innerHTML = businessInfo.business_name.toUpperCase();
						document.getElementById("info_bus_scale").innerHTML = businessInfo.business_scale.toUpperCase();
						document.getElementById("info_pay_mode").innerHTML = businessInfo.pay_method_text.toUpperCase();
						getAllBusinessApplication();
						return true;
					}else if(result=='false-'){
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!'; 
						return false;
					}else if(result=='error-'){
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Business Info. Please try again!'; 
						return false;
					}
	}
	
	///////////////////////////////////////////////////////////////////////// line of business /////////////////////////////////////////////
	
	var isLineBusinessAdding = true;
	var chosenID = 0;
	function reset3(){
			$('#capital_investment').val('');
			$('#last_year_gross').val('0.00');
			document.getElementById("line_business").selectedIndex = 0;
			$('#cancelUpdateBtn').hide();
			isLineBusinessAdding = true;
			$('#addLineBusinessBtn').val('Add');
	}	
	function getLineOfBusiness(){
		var capital_investment=$('#capital_investment').val();
		var last_year_gross=$('#last_year_gross').val();
		var line_business=document.getElementById("line_business").value;
		var obj = '{'
	   +'"capital_investment" : "'+capital_investment+'",'
	   +'"last_year_gross"  : "'+last_year_gross+'",'
	   +'"line_business" : "'+line_business+'"'
	   +'}';
		return JSON.parse(obj);
	}
	
	function validateLineOfBusiness(str,id){
		if(str=="new"){
			var obj = getLineOfBusiness();
			var bid = $('#bid').val();
			var value = parseInt(""+obj.capital_investment);
			if(value>0){
				if(obj.capital_investment.length==0||obj.last_year_gross.length==0||obj.line_business.length==0){
					return 'false-';
				}else{
					return $.ajax({
						type: "POST",
						url: "/Permits/Business-Permits/Add-Line-Of-Business",
						data: {bid:bid, line_business:obj.line_business, capital_investment:obj.capital_investment, last_year_gross:obj.last_year_gross},
						async: false
					}).responseText;	
				}
			}else{
				return 'invalid-';
			}
		}else if(str=="update"){
			var obj = getLineOfBusiness();
			var bid = $('#bid').val();
			var value = parseInt(""+obj.capital_investment);
			if(value>0){
				if(obj.capital_investment.length==0||obj.last_year_gross.length==0||obj.line_business.length==0){
					return 'false-';
				}else{
					return $.ajax({
						type: "POST",
						url: "/Permits/Line-Of-Business/Update",
						data: {id:id,bid:bid, line_business:obj.line_business, capital_investment:obj.capital_investment, last_year_gross:obj.last_year_gross},
						async: false
					}).responseText;	
				}
			}else{
				return 'invalid-';
			}
		}
	}	
	
	function manageLineOfBusiness(){
		if(isLineBusinessAdding == true){
			addLineOfBusiness();
		}else{
			updateLineOfBusinessData(chosenID);
		}
	}
	
	function addLineOfBusiness(id){
		
			var result =  validateLineOfBusiness("new","");
			if(result=='true-'){
				var bid = $('#bid').val();
				$('#alert-error').hide();
				document.getElementById("msg-error").innerHTML = ''; 
				$('#alert-success').show();
				$('#alert-delete').hide();
				document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Line of  Business has been added!';
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				getAllLineOfBusiness(bid);
				reset3();
				return true;
			}else if(result=='false-'){
				$('#alert-error').show();
				$('#alert-success').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!'; 
				return false;
			}else if(result=='error-'){
				$('#alert-error').show();
				$('#alert-success').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Line of  Business. Please try again!'; 
				return false;
			}else if(result=='invalid-'){
				$('#alert-error').show();
				$('#alert-success').hide();
				$('#alert-delete').hide();
				$('html, body').animate({ scrollTop: 0 }, 'fast');
				document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please input valid amount!'; 
				return false;
			}
	
	}
	function updateLineOfBusinessData(id){
		var result =  validateLineOfBusiness("update",id);
		if(result=='true-'){
			var bid = $('#bid').val();
			$('#alert-error').hide();
			document.getElementById("msg-error").innerHTML = ''; 
			$('#alert-success').show();
			$('#alert-delete').hide();
			document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Line of  Business has been updated!';
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			getAllLineOfBusiness(bid);
			reset3();
			return true;
		}else if(result=='false-'){
			$('#alert-error').show();
			$('#alert-success').hide();
			$('#alert-delete').hide();
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Please fill all required fields with valid inputs!'; 
			return false;
		}else if(result=='error-'){
			$('#alert-error').show();
			$('#alert-success').hide();
			$('#alert-delete').hide();
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in saving Line of  Business. Please try again!'; 
			return false;
		}		
	}
	function getAllLineOfBusiness(bid){
		var result = $.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Line-Of-Business/"+bid,
			async: false
		}).responseText;
	//alert(result);
			var obj = JSON.parse(result);
			$('#sample-table-3').dataTable().fnClearTable();
			var count = 0;
			for(x=0;x<obj.length;x++){
			count++;
				try{
					
					var id = obj[x].id;
					$("#line_business option[value='"+obj[x].business_nature_id+"']").remove();
					var business_nature = obj[x].business_nature.business_nature;
					var capital_investment = obj[x].capital_investment;
					var last_year_gross = obj[x].last_year_gross;
					var lineBusiness = '{'
					   +'"id" : "'+obj[x].id+'",'
					   +'"val" : "'+obj[x].business_nature_id+'",'
					   +'"capital" : "'+obj[x].capital_investment+'",'
					   +'"gross" : "'+obj[x].last_year_gross+'",'
					   +'"name" : "'+business_nature+'"'
					   +'}';
					$('#sample-table-3').dataTable().fnAddData( [
					""+count,
					""+business_nature,""+ numberWithCommas(capital_investment) ,""+numberWithCommas(last_year_gross) ,
					"<div class='hidden-phone visible-desktop btn-group'>"+
										"<button class='btn btn-mini btn-primary' onClick= 'updateLineOfBusiness("+lineBusiness+")'>"+
											"edit"+
										"</button>"+
										"<button class='btn btn-mini btn-danger' onClick= 'deleteLineOfBusiness("+lineBusiness+")'>"+
											"delete"+
										"</button>"+
					"</div>"
					] );
				}catch(err){}
			
			}
		
	}
	function resetAllLineOfBusiness(){
		var result = $.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Line-Of-Businessess/All",
			async: false
		}).responseText;
		
		var obj = JSON.parse(result);
		$('#line_business').empty();
		$('#line_business').append('<option value="0">Select Line of Business</option>');
		for(x=0;x<obj.length;x++){
			$('#line_business').append('<option value="'+obj[x].id+'">'+obj[x].business_nature+'</option>');
		}
	}
	function deleteLineOfBusiness(lineBusiness){
				$.post("/Permits/Line-Of-Business/Delete",{id : lineBusiness.id}, function(result){	
					if(result=="1"){
						$('#alert-success').show();
						$('#alert-error').hide();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Business Line has been deleted!';
						if ($("#line_business").val() === lineBusiness.val) {}else{
							$('#line_business').append('<option value="'+lineBusiness.val+'">'+lineBusiness.name+'</option>');
						}
						var bid = $('#bid').val();
						getAllLineOfBusiness(bid);
						reset3();
					}else {
						$('#alert-success').hide();
						$('#alert-error').show();
						$('html, body').animate({ scrollTop: 0 }, 'fast');
						document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in deleting Business Line! Please try again'; 
					}
				});
	}
	function updateLineOfBusiness(lineBusiness){
		isLineBusinessAdding = false;
		$('#addLineBusinessBtn').val('Update');
		var id = lineBusiness.id;
		chosenID = id;
		$('#capital_investment').val(''+lineBusiness.capital);
		$('#last_year_gross').val(''+lineBusiness.gross);
		$('#line_business').append('<option value="'+lineBusiness.val+'">'+lineBusiness.name+'</option>');
		document.getElementById("line_business").value = ''+lineBusiness.val;	
		$('#cancelUpdateBtn').show();
		$('#cancelUpdateBtn').click(function(){
			$("#line_business option[value='"+lineBusiness.val+"']").remove();	
			reset3();
		});
	}

	///////////////////////////////////////////////////////////////////////// requirement /////////////////////////////////////////////

	function addRequirements(){
		var val = $('#req_count').val();
		var count = parseInt(val);
		var msg = deleteRequirements();
			for(x = 0 ; x < count ; x++){
				var checked = document.getElementById("req_check_"+x).checked;
				var value = document.getElementById("req_check_"+x).value;
				if(checked){
					getAndAddRequirements(value);
				}
			}
			$('#alert-success').show();
			$('#alert-error').hide();
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Requirements has been saved!';
			
			
	}
	function getAndAddRequirements(id){
	var bid = $('#bid').val();
		return $.ajax({
			type: "POST",
			url: "/Permits/Business-Permits/Add-Requirements",
			data: {bid:bid,requirement_id:id},
			async: false
		}).responseText;
	}
	function deleteRequirements(){
	var bid = $('#bid').val();
		return $.ajax({
			type: "POST",
			url: "/Permits/Business-Requirement/Delete",
			data: {id:bid},
			async: false
		}).responseText;
	}
	function getAllRequirement(id){
		var result = $.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Requirements/"+id,
			async: false
		}).responseText;
		var obj = JSON.parse(result);
		for(x=0;x<obj.length;x++){
			var req_id=obj[x].requirement_id;
			var val = $('#req_count').val();
			var count = parseInt(val);
			for(y = 0 ; y < count ; y++){
				var value = document.getElementById("req_check_"+y).value;
				if(value==req_id){
					document.getElementById("req_check_"+y).checked=true;
				}
			}
		}
	}

	
	
	////////////////////////////////////////////////// edit application //////////////////////////////////////////
	
	function editApplication(id,x){
		$('#spinEdit'+x).show();
		$.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Business-Application/"+id,
			async: true,
			success: function(result){
				$('#spinEdit'+x).hide();
				$('[data-target=#step1]').trigger("click");
				$('#collapseOne').collapse();
				
				if(result=='error-') {
					$('#alert-success').hide();
					$('#alert-error').show()
					$('html, body').animate({ scrollTop: 0 }, 'fast');
					document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in retrieving application data! Please try again'; 
				}else{
					$('#alert-error').hide();
					$('#alert-success').hide();
					$('#alert-delete').hide();
					var obj = JSON.parse(result);		
					var oid = obj[0].owner_id;	
					var bid = obj[0].business_info_id;	
					var ref = obj[0].reference_no;	
					$('#bid').val(bid);
					$('#baid').val(id);
					$('#reference_no').val(ref);
					
					attach(oid,2);
					attachBusinessInfo(bid);
				}
			}
		});
	}
	function attachBusinessInfo(id){

		var response = $.ajax({
						type: "GET",
						url: "/Permits/Business-Permits/Business-Info/"+id,
						async: false
					}).responseText;
				
		if(response=='error-') {
			$('#alert-success').hide();
			$('#alert-error').show();
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in retrieving application data! Please try again'; 
		}else{
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			var obj = JSON.parse(response);			
			var bid2 = obj[0].business_info_main.id;	
			$('#bid2').val(bid2);			
			$('#business_name').val(obj[0].business_name);
			$('#business_branch').val(obj[0].business_branch);
			document.getElementById("business_scale").value = obj[0].business_scale;
			document.getElementById("pay_method").value = obj[0].payment_mode_id;
			$('#bus_bldg_name').val(obj[0].bldg_name);
			$('#bus_mobile').val(obj[0].bldg_contact_no);
			
			document.getElementById("info_bus_name").innerHTML = obj[0].business_name.toUpperCase();
			document.getElementById("info_bus_scale").innerHTML = obj[0].business_scale.toUpperCase();
			document.getElementById("info_pay_mode").innerHTML = obj[0].payment_mode.payment_mode.toUpperCase();
			
			document.getElementById("bus_province").value = obj[0].bldg_province_id;
			setBusProvince(obj[0].bldg_province_id,'attach',obj[0].bldg_lgu_id,obj[0].lgu.zip_code);
			setBusDistrict(obj[0].bldg_lgu_id+"-"+obj[0].lgu.zip_code,'attach',obj[0].bldg_district_id);
			setBusBarangay(obj[0].bldg_district_id,'attach',obj[0].bldg_brgy_id);
			setBusZone(obj[0].bldg_brgy_id,'attach',obj[0].bldg_zone_id);

			$('#bus_address').val(obj[0].bldg_address);
			$('#bus_fax').val(obj[0].bldg_fax_no);
			$('#bus_email').val(obj[0].bldg_email);
			$('#date_stablished').val(obj[0].date_established);
			$('#start_date').val(obj[0].start_date);
			$('#no_vehicle').val(obj[0].no_delivery_vehicles);
			$('#no_emp_male').val(obj[0].no_of_employees_m);
			$('#no_emp_female').val(obj[0].no_of_employees_f);
			document.getElementById("occupancy_type").value = obj[0].occupancy_id;
			document.getElementById("ownership_type").value = obj[0].ownership_type_id;
			$('#location_desc').val(obj[0].location_description);
			$('#remarks').val(obj[0].remarks);
			$('#dotc_accr_no').val(obj[0].business_info_main.dot_acr_no);
			$('#sec_reg_no').val(obj[0].business_info_main.sec_registration);
			$('#bir_reg_no').val(obj[0].business_info_main.bir_reg_no);
			$('#dti_reg_no').val(obj[0].business_info_main.dti_reg_no);
			$('#dti_reg_date').val(obj[0].business_info_main.dti_reg_date);
			document.getElementById("industry_sector").value = obj[0].business_info_main.industry_id;
			$('#nso_ass_no').val(obj[0].business_info_main.nso_assigned_no);
			$('#nso_stab_id').val(obj[0].business_info_main.nso_established_id);
			$('#office_name').val(obj[0].business_info_main.office_name);
			$('#office_lot').val(obj[0].business_info_main.office_lot);
			$('#office_tin').val(obj[0].business_info_main.office_tin_no);
			$('#office_tel').val(obj[0].business_info_main.office_phone_no);
			$('#eco_reg_name').val(obj[0].business_info_main.registered_name);
			$('#eco_paid_emp').val(obj[0].business_info_main.paid_employees);
			document.getElementById("eco_org").value = obj[0].business_info_main.economic_org_id;
			document.getElementById("eco_area").value = obj[0].business_info_main.economic_area_id;
			document.getElementById("bus_type").value = obj[0].business_info_main.business_type;
			var subsidiary = obj[0].subsidiary;
	
			if(subsidiary=="1"){
				check();
				$('#extra').show();
				$('#subsidiary_lbl').show();
			}else{
				uncheck();
				$('#extra').hide();
				$('#subsidiary_lbl').hide();
			}
			if(obj[0].business_info_main.business_type=="Franchise"){
				$('#extra').show();
				$('#subsidiary_lbl').hide();
			}else{
				$('#extra').hide();
				$('#subsidiary_lbl').show();
			}
			$('#extra_name').val(obj[0].business_info_main.name);
			$('#extra_address').val(obj[0].business_info_main.address);
			$('#updateBtnBus').show();
			$('#addBusinessBtn').hide();	
			document.getElementById("office_province").value = obj[0].business_info_main.office_province_id;
			setOfficeProvince(obj[0].business_info_main.office_province_id,'attach',obj[0].business_info_main.office_lgu_id,obj[0].business_info_main.lgu.zip_code);
			setOfficeDistrict(obj[0].business_info_main.office_lgu_id+"-"+obj[0].business_info_main.office_lgu_id.zip_code,'attach',obj[0].business_info_main.office_district_id);
			setOfficeBarangay(obj[0].business_info_main.office_district_id,'attach',obj[0].business_info_main.office_brgy_id);
			setOfficeZone(obj[0].business_info_main.office_brgy_id,'attach',obj[0].business_info_main.office_zone_id);
			
			
			resetAllLineOfBusiness();
			getAllLineOfBusiness(id);
			getAllRequirement(id);
			cancelApplication();
			
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	function refreshList(){
		getAllBusinessApplication();
	}
	
	function getAllBusinessApplication(){
		$('#spinRefresh').show();
		$.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Business-Applications/All",
			async: true,
			success: function(result){
			
				var obj = JSON.parse(result);
				$('#sample-table-2').dataTable().fnClearTable();
				var count = 0;
				for(x=0;x<obj.length;x++){
				count++;
					try{
						
						var id = obj[x].id;
						var business_permit_no = obj[x].business_permit_no;
						var business_name = obj[x].business_info.business_name;
						var business_owner = obj[x].owner.lname+" , "+obj[x].owner.fname+" "+obj[x].owner.mname;
						var last_application_type = obj[x].application_type;
						var last_transaction = obj[x].created_at;
						var application_status = obj[x].application_status;
						
						if(application_status=="CANCELLED"){
							$('#sample-table-2').dataTable().fnAddData( [
							""+count,""+business_permit_no,
							""+business_name,""+ business_owner,""+last_application_type , last_transaction , application_status,
							"<div class='hidden-phone visible-desktop btn-group'>"+
												"<button class='btn btn-mini btn-primary' onClick= 'editApplication("+id+","+x+")'>"+
													"edit&nbsp;&nbsp;<i id='spinEdit"+x+"' class='icon-spinner icon-spin white bigger-125' style='display:none'></i>"+
												"</button>"+
												"<button class='btn btn-mini btn-primary' onClick= ''>"+
													"asses"+
												"</button>"+
												"<button class='btn btn-mini btn-primary' onClick= ''>"+
													"history"+
												"</button>"+
												"<button class='btn btn-mini btn-danger' onClick= ''>"+
													"retire"+
												"</button>"+
												
							"</div>"
							] );
						}else{
							$('#sample-table-2').dataTable().fnAddData( [
							""+count,""+business_permit_no,
							""+business_name,""+ business_owner,""+last_application_type , last_transaction , application_status,
							"<div class='hidden-phone visible-desktop btn-group'>"+
												"<button class='btn btn-mini btn-primary' onClick= 'editApplication("+id+","+x+")'>"+
													"edit&nbsp;&nbsp;<i id='spinEdit"+x+"' class='icon-spinner icon-spin white bigger-125' style='display:none'></i>"+
												"</button>"+
												"<button class='btn btn-mini btn-primary' onClick= ''>"+
													"asses"+
												"</button>"+
												"<button class='btn btn-mini btn-primary' onClick= ''>"+
													"history"+
												"</button>"+
												"<button class='btn btn-mini btn-danger' onClick= ''>"+
													"retire"+
												"</button>"+
												"<button class='btn btn-mini btn-danger' onClick= ''>"+
													"cancel"+
												"</button>"+
							"</div>"
							] );
							
						}
						$('#spinRefresh').hide();
					}catch(err){$('#spinRefresh').hide();}
				
				}
			} 
		});
		
		
		
	}
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	function getAccessPin(name){
		var oid = $('#oid').val();
		return $.ajax({
			type: "GET",
			url: "/Permits/Business-Permits/Get-Access-Pin/"+name+"+"+oid,
			async: false
		}).responseText;
	}
	function assesApplication(){
	var count = $('#sample-table-3').dataTable().fnGetData().length;
		if(count>0){
			var baid = $('#baid').val();
				return $.ajax({
					type: "POST",
					url: "/Permits/Assess-Business-Application/Update",
					data: {baid:baid},
					async: false
				}).responseText;
		}
	}
	function cancelApplicationNow(){
	var baid = $('#baid').val();
		var response = $.ajax({
					type: "POST",
					url: "/Permits/Cancel-Business-Application/Update",
					data: {baid:baid},
					async: false
				}).responseText;
		if(response=='true-'){
			$('#alert-error').hide();
			document.getElementById("msg-error").innerHTML = ''; 
			$('#alert-success').show();
			$('#alert-delete').hide();
			document.getElementById("msg-success").innerHTML = '&nbsp;&nbsp;Business Applicationhas been cancelled!';
			resetAll();
		}else if(response=='error-'){
			$('#alert-error').show();
			$('#alert-success').hide();
			$('#alert-delete').hide();
			$('html, body').animate({ scrollTop: 0 }, 'fast');
			document.getElementById("msg-error").innerHTML = '&nbsp;&nbsp;Error occur in Canceling Business Application. Please try again!'; 
		}	
	}
	function cancelApplication(){
	var bid2 = $('#bid2').val();
		if(bid2.length!=0){
			$('#cancelApplication').show();
		}else{
			$('#cancelApplication').hide();
		}
	}
	function resetAll(){
		reset1();
		reset2();
		reset3();
		$('#sample-table-3').dataTable().fnClearTable();
		var val = $('#req_count').val();
		var count = parseInt(val);
			for(x = 0 ; x < count ; x++){
				document.getElementById("req_check_"+x).checked=false;
			}
		 $('[data-target=#step1]').trigger("click");
		 getAllBusinessApplication();
	}
	function openModal(){
		$("#myModal").css("margin-top","0px")
	}
	
	
	/////////////////////////////////////////////////////////////// online register ////////////////////////////////////////////////////
	function getOnlineRegister(){
		$('#spin').show();
		var ref = $('#reference').val();
		$.post("/Permits/Online-Register", { ref : ref }, function(result){	
		alert(result);
			if(result=="error"){
				$('#alert-danger-modal').show();
				document.getElementById("msg-error-modal").innerHTML = '&nbsp;&nbsp;Error occur in retrieving online register data. Please try again!'; 
			}else{
				var obj = JSON.parse(result);
				var success = obj[0].success;
				var msg = obj[0].message;
					if(success=="0"){
						$('#alert-danger-modal').show();
						document.getElementById("msg-error-modal").innerHTML = '&nbsp;&nbsp;'+msg; 
					}else if(success=="1"){
						$('#alert-danger-modal').hide();
						attachOnlineRegister(result);
					}
			}
			$('#spin').hide();
		});
	}
	function attachOnlineRegister(result){
		
			var obj = JSON.parse(result);
			//alert(obj[0].data[0].for_business_info.for_owner_info.fname);
						
			$('#fname').val(obj[0].data[0].for_business_info.for_owner_info.fname);
			$('#mname').val(obj[0].data[0].for_business_info.for_owner_info.mname);
			$('#lname').val(obj[0].data[0].for_business_info.for_owner_info.lname);
			$('#legal_entity').val(obj[0].data[0].for_business_info.for_owner_info.legal_entity);
			$('#bday').val(obj[0].data[0].for_business_info.for_owner_info.bday);
			document.getElementById("civil_status").value = obj[0].data[0].for_business_info.for_owner_info.civil_status;
			document.getElementById("gender").value = obj[0].data[0].for_business_info.for_owner_info.gender
			alert(obj[0].data[0].for_business_info.for_owner_info.owner_citizenship_id);
			document.getElementById("citizenship").value = obj[0].data[0].for_business_info.for_owner_info.owner_citizenship_id;
			$('#tin').val(obj[0].data[0].for_business_info.for_owner_info.owner_tin_no);
			//document.getElementById("province").value = obj[0].data[0].for_business_info.for_owner_info.show_province.id;
			// setProvince(obj[0].owner_province_id,'attach',obj[0].owner_city_id,obj[0].lgu.zip_code);
			// setDistrict(obj[0].owner_city_id+"-"+obj[0].lgu.zip_code,'attach',obj[0].owner_district_id);
			// setBarangay(obj[0].owner_district_id,'attach',obj[0].owner_brgy_id);
			// setZone(obj[0].owner_brgy_id,'attach',obj[0].owner_zone_id);
			$('#address').val(obj[0].data[0].for_business_info.for_owner_info.complete_address);
			$('#mobile').val(obj[0].data[0].for_business_info.for_owner_info.mobile);
			$('#tel').val(obj[0].data[0].for_business_info.for_owner_info.tel_no);
			$('#email').val(obj[0].data[0].for_business_info.for_owner_info.email);
			$('#other').val(obj[0].data[0].for_business_info.for_owner_info.others);
			$('#oid').val('');
			$('#application_method').val('');
			//var name = obj[0].data[0].for_business_info.for_owner_info.lname.toUpperCase()+" , "+obj[0].data[0].for_business_info.for_owner_info.fname.toUpperCase()+" "+obj[0].data[0].for_business_info.for_owner_info.mname.toUpperCase();
			//document.getElementById("info_tax_name").innerHTML=name;
			//var s = obj[0].data[0].for_business_info.for_owner_info.fname.toUpperCase()+" ,-"+obj[0].data[0].for_business_info.for_owner_info.lname.toUpperCase()+"-"+obj[0].data[0].for_business_info.for_owner_info.mname.toUpperCase());
		    //document.getElementById("info_access_pin").innerHTML = s;
			$('#addOwnerBtn').show();
			$('#updateBtn').hide();
			$('#deleteBtn').hide();
			stepone=false;
			
			
			
			
			//$('#bid').val('');
			//$('#bid2').val('');
			
			// if(mode==1){
				// $('#bid').val('');
				// $('#bid2').val('');
				// reset2();
			// }
			// $('#application_method').val('LOCAL');
			// var name = obj[0].fname.toUpperCase()+" , "+obj[0].lname.toUpperCase()+" "+obj[0].mname.toUpperCase();
			// document.getElementById("info_tax_name").innerHTML=name;
			// var s = getAccessPin(obj[0].fname.toUpperCase()+" ,-"+obj[0].lname.toUpperCase()+"-"+obj[0].mname.toUpperCase());
			// document.getElementById("info_access_pin").innerHTML = s;
			// $('#addOwnerBtn').hide();
			// $('#updateBtn').show();
			// $('#deleteBtn').show();
			// stepone=true;
			$('#myModal').modal('hide');
	}
	</script>
@endsection