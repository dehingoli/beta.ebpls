<?php namespace App\Http\Controllers;
use Auth;
use DB;
use Input;
use Validator;
use App\Province;
use App\Lgu;
use App\District;
use App\Barangay;
use App\Zone;
use App\Citizenship;
use App\PaymentMode;
use App\OccupancyType;
use App\OwnershipType;
use App\IndustrySector;
use App\EconomicArea;
use App\EconomicOrganization;
use App\Owner;
use App\BusinessInfo;
use App\BusinessInfoMain;
use App\BusinessNature;
use App\LineOfBusiness;
use App\Requirement;
use App\BusinessRequirement;
use App\BusinessApplication;
class BusinessPermitController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function showBusinessApplicationList($id)
	{
	$user_fname = Auth::user()->fname;
	
	$province = Province::all();
	$citizenship = Citizenship::all();
	$paymentMode = PaymentMode::all();
	$occupancyType = OccupancyType::all();
	$ownershipType = OwnershipType::all();
	$industrySector = IndustrySector::all();
	$owner = Owner::all();
	$eco_org = EconomicOrganization::all();
	$eco_area = EconomicArea::all();
	$line_of_business = BusinessNature::all();
	
	$business_application = BusinessApplication::select(DB::raw('MAX(id) AS id'))
                ->groupby('business_info_id')
				->whereNull('deleted_at')
                ->get();			
	$arrays =  array();
	foreach ($business_application as $bp)	{
		array_push($arrays, $bp->id);
	}				
	$bp = BusinessApplication::whereIn('id', $arrays  )->with('business_info')->with('owner')->get();
	
	$requirement = DB::table('ref_requirements_tbl')
	->where(function($query)
            {
                $query->where('permit_id', '=', "1" )
                      ->orWhere('is_default', '=', "1" );
            })
	->whereNull('deleted_at')->get();
	
			if($id=="Application"){
				return view('pages.permits.businessapplication')->with('username',$user_fname)
				->with('sub_page','Application')
				->with('page','Permits')
				->with('main_page','Business Permits')
				->with('business_application_data',$bp )
				->with('requirement_data',$requirement )
				->with('line_of_business_data',$line_of_business )
				->with('owner_data',$owner )
				->with('eco_org_data',$eco_org )
				->with('eco_area_data',$eco_area )
				->with('industry_sector_data',$industrySector )
				->with('occupancytype_data',$occupancyType )
				->with('ownershiptype_data',$ownershipType )
				->with('citizenship_data',$citizenship )
				->with('paymentmode_data',$paymentMode )
				->with('province_data',$province )
				->with('province_bus_data',$province );
			}
	}
	
	public function getDataByID($id,$ids2)
	{
		if($id=="Province"){
			$province = Province::where('id','=', $ids2 )
			->get();
			return json_encode($province);	
		}
		else if($id=="Lgu"){
			$lgu_province = Lgu::where('lgu_province_id','=', $ids2 )->get();
			return json_encode($lgu_province);	
		}
		else if($id=="District"){
			$district_lgu = District::where('district_lgu_id','=', $ids2 )->get();
			return json_encode($district_lgu);	
		}
		else if($id=="Barangay"){
			$brgy_lgu = Barangay::where('brgy_district_id','=', $ids2 )->get();
			return json_encode($brgy_lgu);	
		}
		else if($id=="Zone"){
			$zone_brgy = Zone::where('zone_brgy_id','=', $ids2 )->get();
			return json_encode($zone_brgy);	
		}
		else if($id=="Attach-Owner"){
			$owner = Owner::with('lgu')->where('id','=', $ids2 )->get();
			return json_encode($owner);	
		}
		else if($id=="Owner"){
			if($ids2=="All"){
				$owner = Owner::with('lgu')->get();
				return json_encode($owner);	
			}
		}
		else if($id=="Business-Info"){
			try{
					$business_info = BusinessInfo::with('province')
					->with('lgu')
					->with('district')
					->with('barangay')
					->with('zone')
					->with('ownership_type')
					->with('occupancy_type')
					->with('business_info_main')
					->with('owner')
					->with('line_of_business')
					->with('requirements')
					->with('payment_mode')
					->where('id','=', $ids2 )
					->get();
					return json_encode($business_info);	
			}catch(\Exception $e){	
					return "error-".$e;
			}
		}
		else if($id=="Application-List"){
			if($ids2=="All"){
				$business_info = BusinessInfo::with('business_info_main')->get();
				return json_encode($business_info);	
			}
		}
		else if($id=="Line-Of-Business"){
			$line_business = LineOfBusiness::with('business_nature')->where('business_info_id','=', $ids2 )->get();
			return json_encode($line_business);		
		}
		else if($id=="Line-Of-Businessess"){
			if($ids2=="All"){
				try{
					$line_of_business = BusinessNature::all();
					return json_encode($line_of_business);	
				}catch(\Exception $e){	
					return "error-".$e;
				}
			}
		}
		else if($id=="Requirements"){
				try{
					$business_req = BusinessRequirement::where('business_info_id','=', $ids2 )->get();
					return json_encode($business_req);	
				}catch(\Exception $e){	
					return "error-".$e;
				}
		}
		else if($id=="Get-Access-Pin"){
			$digits = 4;
			$trackNo=rand(pow(10, $digits-1), pow(10, $digits)-1);
			$name =  explode("+", $ids2);
			$genName="";
			$result = explode("-", $name[0]);
			foreach($result as $result ) {
				$genName .= substr($result, 0, 1);	
			}
			
			
			$oid=$name[1];
			
			$access_pin = "";
			$business_application = BusinessApplication::where('owner_id','=', $oid )->select('access_pin')->withTrashed()->get();
			$business_application_count = $business_application->count();
			if($business_application_count>0){
				foreach($business_application as $business_application){
					$access_pin = $business_application->access_pin;
				}
			}else{
				
				$trackNo=rand(pow(10, $digits-1), pow(10, $digits)-1);
				$access_pin = "B-".$genName.$trackNo;
				$access_pin_exist = BusinessApplication::where('access_pin','=', $access_pin )->withTrashed()->count();
				while($access_pin_exist>0){
					$trackNo=rand(pow(10, $digits-1), pow(10, $digits)-1);
				}
				$access_pin = "B-".$genName.$trackNo;
			}
			return $access_pin;
		}
		else if($id=="Business-Application"){
			$business_application = BusinessApplication::where('id','=', $ids2 )->get();
			return json_encode($business_application);		
		}
		else if($id=="Business-Applications"){
			if($ids2=="All"){
				try{
					$business_application = BusinessApplication::select(DB::raw('MAX(id) AS id'))
					->groupby('business_info_id')
					->whereNull('deleted_at')
					->get();			
					$arrays =  array();
					foreach ($business_application as $bp)	{
						array_push($arrays, $bp->id);
					}				
					$bp = BusinessApplication::whereIn('id', $arrays  )->with('business_info')->with('owner')->get();
					return json_encode($bp);	
				}catch(\Exception $e){	
					return "error-".$e;
				}
			}
		}
	}
	
	public function addData($id)
	{
		$user_fname = Auth::user()->fname;
		
	
		
		if($id=="Add-Owner"){
			try {
				$rules = [
				'fname' => 'required|max:50',
				'lname' => 'required|max:50',
				'civil_status' => 'required',
				'gender' => 'required',
				'citizenship' => 'required',
				'province' => 'required',
				'lgu' => 'required',
				'district' => 'required',
				'barangay' => 'required',
				'zip' => 'required',
				'address' => 'required',
				'mobile' => 'required|max:10',
				'email' => 'required|email'
				];
				$input = Input::all();
				$fname = $input['fname'];
				$mname = $input['mname'];
				$lname = $input['lname'];
				$legal_entity = $input['legal_entity'];
				$bday = $input['bday'];
				$civil_status = $input['civil_status'];
				$gender = $input['gender'];
				$citizenship = $input['citizenship'];
				$tin = $input['tin'];
				$province = $input['province'];
				$lgu = $input['lgu'];
				$district = $input['district'];
				$barangay = $input['barangay'];
				$zone = $input['zone'];
				$zip = $input['zip'];
				$address = $input['address'];
				$mobile = $input['mobile'];
				$tel = $input['tel'];
				$email = $input['email'];
				$other = $input['other'];
				$validator = Validator::make(Input::all(),$rules);
				if ($validator->fails()) {
					 return "false-";
				}else{
					
					$count = DB::table('bp_owner_tbl')
					->where(function($query)
					{
					$input = Input::all();
					$fname = $input['fname'];
					$mname = $input['mname'];
					$lname = $input['lname'];
					$gender = $input['gender'];
					$bday = $input['bday'];
						$query->where('fname', '=', $fname )
							  ->where('mname', '=', $mname )
							  ->where('lname', '=', $lname )
							  ->where('gender', '=', $gender )
							  ->where('bday', '=', $bday );
					})
					->whereNull('deleted_at')
					->count();
				
					if ($count>0) {
						return "exist-";
					}else{
				
						$owner = new Owner;
						$owner->fname = $fname;
						$owner->mname = $mname;
						$owner->lname = $lname;
						$owner->legal_entity = $legal_entity;
						$owner->bday = $bday;
						$owner->civil_status = $civil_status;
						$owner->gender = $gender;
						$owner->owner_citizenship_id = $citizenship;
						$owner->owner_tin_no = $tin;
						$owner->owner_province_id = $province;
						$owner->owner_city_id = $lgu;
						$owner->owner_district_id = $district;
						$owner->owner_brgy_id = $barangay;
						$owner->owner_zone_id = $zone;
						$owner->complete_address = $address;
						$owner->mobile = $mobile;
						$owner->tel_no = $tel;
						$owner->email = $email;
						$owner->others = $other;
						
						$owner->created_by = $user_fname;
						$owner->updated_by = $user_fname;
						$owner->save();
						$inserted_id = $owner->id;

						return "true-".$inserted_id;
					}
				}
			}catch(\Exception $e){
				return "error-";
			}
		}
		else if($id=="Add-Owner-Business-Info"){
			try {
				$rules = [
				'business_name' => 'required',
				'business_branch' => 'required',
				'business_scale' => 'required',
				'pay_method' => 'required',
				'bus_mobile' => 'required|max:10',
				'bus_province' => 'required',
				'bus_lgu' => 'required',
				'bus_district' => 'required',
				'bus_barangay' => 'required',
				'bus_address' => 'required',
				'date_stablished' => 'required',
				'start_date' => 'required',
				'no_vehicle' => 'required',
				'no_emp_male' => 'required',
				'no_emp_female' => 'required|max:10',
				'occupancy_type' => 'required',
				'ownership_type' => 'required'
				];
				$input = Input::all();
				$oid = $input['oid'];
				$business_name = $input['business_name'];
				$business_branch = $input['business_branch'];
				$business_scale = $input['business_scale'];
				$pay_method = $input['pay_method'];
				$bus_bldg_name = $input['bus_bldg_name'];
				$bus_mobile = $input['bus_mobile'];
				$bus_province = $input['bus_province'];
				$bus_lgu = $input['bus_lgu'];
				$bus_district = $input['bus_district'];
				$bus_barangay = $input['bus_barangay'];
				$bus_zone = $input['bus_zone'];
				$bus_address = $input['bus_address'];
				$bus_fax = $input['bus_fax'];
				$bus_email = $input['bus_email'];
				$date_stablished = $input['date_stablished'];
				$start_date = $input['start_date'];
				$no_vehicle = $input['no_vehicle'];
				$no_emp_male = $input['no_emp_male'];
				$no_emp_female = $input['no_emp_female'];
				$occupancy_type = $input['occupancy_type'];
				$ownership_type = $input['ownership_type'];
				$location_desc = $input['location_desc'];
				$remarks = $input['remarks'];
				
				$dotc_accr_no = $input['dotc_accr_no'];
				$sec_reg_no = $input['sec_reg_no'];
				$bir_reg_no = $input['bir_reg_no'];
				$dti_reg_no = $input['dti_reg_no'];
				$dti_reg_date = $input['dti_reg_date'];
				$industry_sector = $input['industry_sector'];
				$nso_ass_no = $input['nso_ass_no'];
				$nso_stab_id = $input['nso_stab_id'];
				$office_name = $input['office_name'];
				$office_lot = $input['office_lot'];
				$office_tin = $input['office_tin'];
				$office_tel = $input['office_tel'];
				$office_province = $input['office_province'];
				$office_lgu = $input['office_lgu'];
				$office_district = $input['office_district'];
				$office_barangay = $input['office_barangay'];
				$office_zone = $input['office_zone'];
				$office_zip = $input['office_zip'];
				$eco_reg_name = $input['eco_reg_name'];
				$eco_paid_emp = $input['eco_paid_emp'];
				$eco_org = $input['eco_org'];
				$eco_area = $input['eco_area'];
				$bus_type = $input['bus_type'];
				$extra_name = $input['extra_name'];
				$extra_address = $input['extra_address'];
				$subsidiary = $input['subsidiary'];
				
				$access_pin = $input['pin'];
				$reference_no = $input['reference_no'];
				$application_method = $input['application_method'];
				
				$validator = Validator::make(Input::all(),$rules);
				if ($validator->fails()) {
					 return "false-";
				}else{
				
						$business_info = new BusinessInfo;
						$business_info->owner_id = $oid;
						//$business_info->black_listed = $mname;
						//$business_info->black_listed_desc = $lname;
						$business_info->business_name = $business_name;
						$business_info->business_scale = $business_scale;
						$business_info->business_branch = $business_branch;
						$business_info->payment_mode_id = $pay_method;
						$business_info->bldg_name = $bus_bldg_name;
						$business_info->bldg_address = $bus_address;
						$business_info->bldg_province_id = $bus_province;
						$business_info->bldg_lgu_id = $bus_lgu;
						$business_info->bldg_district_id = $bus_district;
						$business_info->bldg_brgy_id = $bus_barangay;
						$business_info->bldg_zone_id = $bus_zone;
						$business_info->bldg_contact_no = $bus_mobile;
						$business_info->bldg_fax_no = $bus_fax;
						$business_info->date_established = $date_stablished;
						$business_info->start_date = $start_date;
						$business_info->occupancy_id = $occupancy_type;
						$business_info->ownership_type_id = $ownership_type;
						$business_info->no_of_employees_f = $no_emp_female;
						$business_info->no_of_employees_m = $no_emp_male;
						$business_info->no_delivery_vehicles = $no_vehicle;
						$business_info->location_description = $location_desc;
						$business_info->remarks = $remarks;
						$business_info->created_by = $user_fname;
						$business_info->updated_by = $user_fname;
						$business_info->save();
						$inserted_id = $business_info->id;
						
						$business_info_main = new BusinessInfoMain;
						$business_info_main->business_info_id = $inserted_id;
						$business_info_main->dot_acr_no = $dotc_accr_no;
						$business_info_main->sec_registration = $sec_reg_no;
						$business_info_main->bir_reg_no = $bir_reg_no;
						$business_info_main->industry_id = $industry_sector;
						$business_info_main->dti_reg_no = $dti_reg_no;
						$business_info_main->dti_reg_date = $dti_reg_date;
						$business_info_main->nso_assigned_no = $nso_ass_no;
						$business_info_main->nso_established_id = $nso_stab_id;
						$business_info_main->office_name = $office_name;
						$business_info_main->office_lot = $office_lot;
						$business_info_main->office_tin_no = $office_tin;
						$business_info_main->office_province_id = $office_province;
						$business_info_main->office_lgu_id = $office_lgu;
						$business_info_main->office_district_id = $office_district;
						$business_info_main->office_brgy_id = $office_barangay;
						$business_info_main->office_zone_id = $office_zone;
						$business_info_main->office_phone_no = $office_tel;
						$business_info_main->registered_name = $eco_reg_name;
						$business_info_main->economic_org_id = $eco_org;
						$business_info_main->business_type = $bus_type;
						$business_info_main->paid_employees = $eco_paid_emp;
						$business_info_main->economic_area_id = $eco_area;
						$business_info_main->subsidiary = $subsidiary;
						$business_info_main->name = $extra_name;
						$business_info_main->address = $extra_address;
						$business_info_main->save();
						$inserted_business_info_main_id= $business_info_main->id;
						
							$business_application = new BusinessApplication;
							$business_application->business_info_id = $inserted_id;
							$business_application->owner_id = $oid;
							$business_application->application_type = "NEW";
							$business_application->reference_no = $reference_no;
							$business_application->application_method = $application_method;
							$business_application->application_status = "PENDING";
							$business_application->access_pin = $access_pin;
							$business_application->created_by = $user_fname;
							$business_application->updated_by = $user_fname;
							$business_application->save();
							$inserted_business_application_id= $business_application->id;

						return "true-".$inserted_id."-".$inserted_business_info_main_id."-".$inserted_business_application_id;

				}
				
			}catch(\Exception $e){	
				return "error-".$e;
			}
		}
		else if($id=="Add-Line-Of-Business"){	
			try {	
					$input = Input::all();
					$business_info_id = $input['bid'];
					$business_nature_id = $input['line_business'];
					$capital_investment = $input['capital_investment'];
					$last_year_gross = $input['last_year_gross'];	
					
					$line_business = new LineOfBusiness;
					$line_business->business_info_id = $business_info_id;
					$line_business->business_nature_id = $business_nature_id;
					$line_business->capital_investment = $capital_investment;
					$line_business->last_year_gross = $last_year_gross;
					$line_business->created_by = $user_fname;
					$line_business->updated_by = $user_fname;
					$line_business->save();
				    return "true-";
			}catch(\Exception $e){
				return "error-".$e; 
			}
		}
		else if($id=="Add-Requirements"){	
			try {	
					$input = Input::all();
					$business_info_id = $input['bid'];
					$requirement_id = $input['requirement_id'];
					
					$business_req = new BusinessRequirement;
					$business_req->business_info_id = $business_info_id;
					$business_req->requirement_id = $requirement_id;
					$business_req->save();
					
				    return "true-";
			}catch(\Exception $e){
				return "error-".$e; 
			}
		}
		
	}
	
	public function deleteDataByID($id)
	{
	$user_fname = Auth::user()->fname;
	$input = Input::all();
	$ids2 = $input['id'];
		if($id=="Owner"){
			try {
			
				$owner = Owner::find( $ids2 );
				$owner->deleted_by = $user_fname;
				$owner->touch();
				$owner->save();
			    $owner ->delete();
				
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		if($id=="Line-Of-Business"){
			try {
			
				$line_of_business = LineOfBusiness::find( $ids2 );
				$line_of_business->deleted_by = $user_fname;
				$line_of_business->touch();
				$line_of_business->save();
			    $line_of_business ->forceDelete();
				
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		if($id=="Business-Requirement"){
			try {
				$input = Input::all();
				BusinessRequirement::where('business_info_id','=', $ids2 )->forceDelete();
				
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
	}
	
	public function updateDataByID($id)
	{
	$user_fname = Auth::user()->fname;
		if($id=="Owner"){
			try {
				$rules = [
				'fname' => 'required|max:50',
				'lname' => 'required|max:50',
				'civil_status' => 'required',
				'gender' => 'required',
				'citizenship' => 'required',
				'province' => 'required',
				'lgu' => 'required',
				'district' => 'required',
				'barangay' => 'required',
				'zone' => 'required',
				'zip' => 'required',
				'address' => 'required',
				'mobile' => 'required|max:10',
				'email' => 'required|email'
				];
				$input = Input::all();
				$ids2 = $input['id'];
				$fname = $input['fname'];
				$mname = $input['mname'];
				$lname = $input['lname'];
				$legal_entity = $input['legal_entity'];
				$bday = $input['bday'];
				$civil_status = $input['civil_status'];
				$gender = $input['gender'];
				$citizenship = $input['citizenship'];
				$tin = $input['tin'];
				$province = $input['province'];
				$lgu = $input['lgu'];
				$district = $input['district'];
				$barangay = $input['barangay'];
				$zone = $input['zone'];
				$zip = $input['zip'];
				$address = $input['address'];
				$mobile = $input['mobile'];
				$tel = $input['tel'];
				$email = $input['email'];
				$other = $input['other'];
				$validator = Validator::make(Input::all(),$rules);
				if ($validator->fails()) {
					 return "false";
				}else{
						$owner = Owner::find( $ids2 );
						$owner->fname = $fname;
						$owner->mname = $mname;
						$owner->lname = $lname;
						$owner->legal_entity = $legal_entity;
						$owner->bday = $bday;
						$owner->civil_status = $civil_status;
						$owner->gender = $gender;
						$owner->owner_citizenship_id = $citizenship;
						$owner->owner_tin_no = $tin;
						$owner->owner_province_id = $province;
						$owner->owner_city_id = $lgu;
						$owner->owner_district_id = $district;
						$owner->owner_brgy_id = $barangay;
						$owner->owner_zone_id = $zone;
						$owner->complete_address = $address;
						$owner->mobile = $mobile;
						$owner->tel_no = $tel;
						$owner->email = $email;
						$owner->others = $other;
						$owner->updated_by = $user_fname;
						$owner->touch();
						$owner->save();
						return "true";
				}
			}catch(\Exception $e){
				return "error";
			}
		}
		if($id=="Business-Info"){
			try {
				$rules = [
				'business_name' => 'required',
				'business_branch' => 'required',
				'business_scale' => 'required',
				'pay_method' => 'required',
				'bus_mobile' => 'required|max:10',
				'bus_province' => 'required',
				'bus_lgu' => 'required',
				'bus_district' => 'required',
				'bus_barangay' => 'required',
				'bus_address' => 'required',
				'date_stablished' => 'required',
				'start_date' => 'required',
				'no_vehicle' => 'required',
				'no_emp_male' => 'required',
				'no_emp_female' => 'required|max:10',
				'occupancy_type' => 'required',
				'ownership_type' => 'required'
				];
				$input = Input::all();
				$bid2 = $input['bid2'];
				$bid = $input['bid'];
				$oid = $input['oid'];
				$business_name = $input['business_name'];
				$business_branch = $input['business_branch'];
				$business_scale = $input['business_scale'];
				$pay_method = $input['pay_method'];
				$bus_bldg_name = $input['bus_bldg_name'];
				$bus_mobile = $input['bus_mobile'];
				$bus_province = $input['bus_province'];
				$bus_lgu = $input['bus_lgu'];
				$bus_district = $input['bus_district'];
				$bus_barangay = $input['bus_barangay'];
				$bus_zone = $input['bus_zone'];
				$bus_address = $input['bus_address'];
				$bus_fax = $input['bus_fax'];
				$bus_email = $input['bus_email'];
				$date_stablished = $input['date_stablished'];
				$start_date = $input['start_date'];
				$no_vehicle = $input['no_vehicle'];
				$no_emp_male = $input['no_emp_male'];
				$no_emp_female = $input['no_emp_female'];
				$occupancy_type = $input['occupancy_type'];
				$ownership_type = $input['ownership_type'];
				$location_desc = $input['location_desc'];
				$remarks = $input['remarks'];
				
				$dotc_accr_no = $input['dotc_accr_no'];
				$sec_reg_no = $input['sec_reg_no'];
				$bir_reg_no = $input['bir_reg_no'];
				$dti_reg_no = $input['dti_reg_no'];
				$dti_reg_date = $input['dti_reg_date'];
				$industry_sector = $input['industry_sector'];
				$nso_ass_no = $input['nso_ass_no'];
				$nso_stab_id = $input['nso_stab_id'];
				$office_name = $input['office_name'];
				$office_lot = $input['office_lot'];
				$office_tin = $input['office_tin'];
				$office_tel = $input['office_tel'];
				$office_province = $input['office_province'];
				$office_lgu = $input['office_lgu'];
				$office_district = $input['office_district'];
				$office_barangay = $input['office_barangay'];
				$office_zone = $input['office_zone'];
				$office_zip = $input['office_zip'];
				$eco_reg_name = $input['eco_reg_name'];
				$eco_paid_emp = $input['eco_paid_emp'];
				$eco_org = $input['eco_org'];
				$eco_area = $input['eco_area'];
				$bus_type = $input['bus_type'];
				$extra_name = $input['extra_name'];
				$extra_address = $input['extra_address'];
				$subsidiary = $input['subsidiary'];
				$validator = Validator::make(Input::all(),$rules);
				if ($validator->fails()) {
					 return "false-";
				}else{
						$business_info = BusinessInfo::find( $bid );
						$business_info->owner_id = $oid;
						//$business_info->black_listed = $mname;
						//$business_info->black_listed_desc = $lname;
						$business_info->business_name = $business_name;
						$business_info->business_scale = $business_scale;
						$business_info->business_branch = $business_branch;
						$business_info->payment_mode_id = $pay_method;
						$business_info->bldg_name = $bus_bldg_name;
						$business_info->bldg_address = $bus_address;
						$business_info->bldg_province_id = $bus_province;
						$business_info->bldg_lgu_id = $bus_lgu;
						$business_info->bldg_district_id = $bus_district;
						$business_info->bldg_brgy_id = $bus_barangay;
						$business_info->bldg_zone_id = $bus_zone;
						$business_info->bldg_contact_no = $bus_mobile;
						$business_info->bldg_fax_no = $bus_fax;
						$business_info->date_established = $date_stablished;
						$business_info->start_date = $start_date;
						$business_info->occupancy_id = $occupancy_type;
						$business_info->ownership_type_id = $ownership_type;
						$business_info->no_of_employees_f = $no_emp_female;
						$business_info->no_of_employees_m = $no_emp_male;
						$business_info->no_delivery_vehicles = $no_vehicle;
						$business_info->location_description = $location_desc;
						$business_info->remarks = $remarks;
						$business_info->updated_by = $user_fname;
						$business_info->touch();
						$business_info->save();

						$business_info_main = BusinessInfoMain::find( $bid2 );
						$business_info_main->business_info_id = $bid;
						$business_info_main->dot_acr_no = $dotc_accr_no;
						$business_info_main->sec_registration = $sec_reg_no;
						$business_info_main->bir_reg_no = $bir_reg_no;
						$business_info_main->industry_id = $industry_sector;
						$business_info_main->dti_reg_no = $dti_reg_no;
						$business_info_main->dti_reg_date = $dti_reg_date;
						$business_info_main->nso_assigned_no = $nso_ass_no;
						$business_info_main->nso_established_id = $nso_stab_id;
						$business_info_main->office_name = $office_name;
						$business_info_main->office_lot = $office_lot;
						$business_info_main->office_tin_no = $office_tin;
						$business_info_main->office_province_id = $office_province;
						$business_info_main->office_lgu_id = $office_lgu;
						$business_info_main->office_district_id = $office_district;
						$business_info_main->office_brgy_id = $office_barangay;
						$business_info_main->office_zone_id = $office_zone;
						$business_info_main->office_phone_no = $office_tel;
						$business_info_main->registered_name = $eco_reg_name;
						$business_info_main->economic_org_id = $eco_org;
						$business_info_main->business_type = $bus_type;
						$business_info_main->paid_employees = $eco_paid_emp;
						$business_info_main->economic_area_id = $eco_area;
						$business_info_main->subsidiary = $subsidiary;
						$business_info_main->name = $extra_name;
						$business_info_main->address = $extra_address;
						$business_info_main->touch();
						$business_info_main->save();

						return "true-";

				}
				
			}catch(\Exception $e){	
				return "error-".$e;
			}
		}
		if($id=="Line-Of-Business"){
			try {
				$rules = [
				'id' => 'required|max:50',
				'line_business' => 'required',
				'capital_investment' => 'required',
				'last_year_gross' => 'required'
				];
				$input = Input::all();
				$ids2 = $input['id'];
				$business_nature_id = $input['line_business'];
				$capital_investment = $input['capital_investment'];
				$last_year_gross = $input['last_year_gross'];

				$validator = Validator::make(Input::all(),$rules);
				if ($validator->fails()) {
					 return "false-";
				}else{
						$line_of_business = LineOfBusiness::find( $ids2 );
						$line_of_business->business_nature_id = $business_nature_id;
						$line_of_business->capital_investment = $capital_investment;
						$line_of_business->last_year_gross = $last_year_gross;
						$line_of_business->updated_by = $user_fname;
						$line_of_business->touch();
						$line_of_business->save();
						return "true-";
				}
			}catch(\Exception $e){
				return "error-".$e;
			}
		}
		if($id=="Assess-Business-Application"){
			try {
				$input = Input::all();
				$ids2 = $input['baid'];
						$business = BusinessApplication::find($ids2);
						$business->application_status = "FOR ASSESMENT";
						$business->updated_by = $user_fname;
						$business->touch();
						$business->save();
						return "true-";
				
			}catch(\Exception $e){
				return "error-".$e;
			}
		}
		if($id=="Cancel-Business-Application"){
			try {
				$input = Input::all();
				$ids2 = $input['baid'];
						$business = BusinessApplication::find($ids2);
						$business->application_status = "CANCELLED";
						$business->updated_by = $user_fname;
						$business->touch();
						$business->save();
						return "true-";
				
			}catch(\Exception $e){
				return "error-".$e;
			}
		}
	}
	
	
	//8-1445235786
	
	
	public function onlineRegisterData(){
		$input = Input::all();
		$ref = $input['ref'];
		try{
		   $service_url = 'http://ebpls.homemallph.com/joins';
		   $curl = curl_init($service_url);
		   $curl_post_data = array(
				"username" => '5bmnostuwy',
				"password" => 'e1b8354374c2b7d173a1a1520153407ea122bb13',
				"referenceno" => $ref,
				);
		   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($curl, CURLOPT_POST, true);
		   curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		   $curl_response = curl_exec($curl);
		   return $curl_response;
		   curl_close($curl);
		}catch(\Exception $e){
			return "error";
		}
	}

}
