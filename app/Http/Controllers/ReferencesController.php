<?php namespace App\Http\Controllers;
use Auth;
use DB;
use Input;
use App\Province;
use App\Lgu;
use App\District;
use App\Barangay;
use App\Zone;
use App\Taxchargestype;
use App\Taxcharges;
use App\BusinessNature;
use App\TaxChargesRequirements;
use App\TaxChargesFormula;
use App\TaxChargesRange;
use App\Requirement;
use App\Permit;
use App\Citizenship;
use App\EconomicArea;
use App\EconomicOrganization;
use App\IndustrySector;
use App\PaymentMode;
use App\OccupancyType;
use App\OwnershipType;
use App\OwnershipTypeExcemptions;
class ReferencesController extends Controller {

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
	public function showReference($id)
	{
	$user_fname = Auth::user()->fname;
			if ($id=="Province") {
					$province = Province::all();
					return view('pages.references.province')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('province_data',$province)
					->with('page','Reference');	
			}else if ($id=="Lgu") {
					$province = Province::all();
					
					$lgu_province = Lgu::with('province')->get();
					// $lgu = DB::table('ref_lgu_tbl')
						// ->join('ref_province_tbl', 'ref_province_tbl.id', '=', 'ref_lgu_tbl.lgu_province_id')
						// ->select('ref_lgu_tbl.id', 'ref_lgu_tbl.lgu_name', 'ref_lgu_tbl.lgu_code','ref_province_tbl.province_name','ref_lgu_tbl.lgu_code')
						// ->get();
						
					return view('pages.references.lgu')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('province_data',$province)
					->with('lgu_data',$lgu_province)
					->with('page','Reference');
			}else if ($id=="District") {
					$lgu = Lgu::all();
					
					$district_lgu = District::with('lgu')->get();
					return view('pages.references.district')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('lgu_data',$lgu)
					->with('district_data',$district_lgu)
					->with('page','Reference');
			}
			else if ($id=="Barangay") {
					$district = District::all();
					
					$district_barangay = Barangay::with('district')->get();
					return view('pages.references.barangay')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('district_data',$district)
					->with('barangay_data',$district_barangay)
					->with('page','Reference');
			}
			else if ($id=="Zone") {
					$barangay = Barangay::all();
					
					$barangay_zone = Zone::with('barangay')->get();
					return view('pages.references.zone')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('barangay_data',$barangay)
					->with('zone_data',$barangay_zone)
					->with('page','Reference');
			}
			else if ($id=="Tax-Fees-Charges") {
					$tax_charges_type = Taxchargestype::all();
					
					$tax_charges = Taxcharges::with('taxchargestype')->get();
					return view('pages.references.tax_fees_charge')->with('username',$user_fname)
					->with('sub_page','Tax Fees and Charges')
					->with('main_page','Business Permit')
					->with('page','Reference')
					->with('tax_charges_type_data',$tax_charges_type)
					->with('tax_charges_data',$tax_charges);	
			}
			else if ($id=="Business-Nature") {
					$business_nature = BusinessNature::all();
					return view('pages.references.business_nature')->with('username',$user_fname)
					->with('sub_page','Business Nature')
					->with('main_page','Business Permit')
					->with('page','Reference')
					->with('business_nature_data',$business_nature);	
			}
			else if ($id=="Requirements") {
					$permit = Permit::all();
					$requirement = Requirement::with('permit')->get();
					return view('pages.references.requirement')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('page','Reference')
					->with('permit_data',$permit)
					->with('requirement_data',$requirement);						
			}
			else if ($id=="Citizenship") {
					$citizenship = Citizenship::all();
					return view('pages.references.citizenship')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page',$id)
					->with('citizenship_data',$citizenship)
					->with('page','Reference');
			}
			else if ($id=="Economic-Area") {
					$economic_area = EconomicArea::all();
					return view('pages.references.economic_area')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Economic Area')
					->with('economic_area_data',$economic_area)
					->with('page','Reference');
			}
			else if ($id=="Economic-Organization") {
					$economic_org = EconomicOrganization::all();
					return view('pages.references.economic_organization')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Economic Organization')
					->with('economic_org_data',$economic_org)
					->with('page','Reference');
			}
			else if ($id=="Industry-Sector") {
					$industry_sec = IndustrySector::all();
					return view('pages.references.industry_sector')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Industry Sector')
					->with('industry_sec_data',$industry_sec)
					->with('page','Reference');
			}
			else if ($id=="Payment-Mode") {
					$payment_mode = PaymentMode::all();
					return view('pages.references.payment_mode')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Payment Mode')
					->with('payment_mode_data',$payment_mode)
					->with('page','Reference');
			}
			else if ($id=="Occupancy-Type") {
					$occupancy_type = OccupancyType::all();
					return view('pages.references.occupancy_type')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Occupancy Type')
					->with('occupancy_type_data',$occupancy_type)
					->with('page','Reference');
			}
			else if ($id=="Ownership-Type") {
					$tax_charges_fees_data = Taxcharges::with('taxchargestype')->where('taxcharges_type_id', '!=', '1' )->get();
					
					$ownership_type = OwnershipType::all();
					return view('pages.references.ownership_type')->with('username',$user_fname)
					->with('sub_page','')
					->with('main_page','Ownership Type')
					->with('ownership_type_data',$ownership_type)
					->with('tax_charges_fees_data',$tax_charges_fees_data)
					->with('page','Reference');
			}
			else if($id=='CTC-Settings')
			{
				
					return view('pages.references.ctc')->with('username',$user_fname)
														->with('sub_page','')
														->with('main_page','CTC-Settings')	
														->with('page','CTC');					
				
			}

	}
	
	
	
	
	public function addData($id)
	{
		
		$user_fname = Auth::user()->fname;
		
		if($id=="Province"){	
			
			try {
			
			$count = DB::table('ref_province_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$name = $input['name'];
			$code = $input['code'];
                $query->where('province_name', '=', $name )
                      ->orWhere('blgf_code', '=', $code );
            })
			->whereNull('deleted_at')
            ->count();
			
			$input = Input::all();
			$name = $input['name'];
			$code = $input['code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$province = new Province;
					$province->province_name = $name;
					$province->blgf_code = $code;
					$province->created_by = $user_fname;
					$province->updated_by = $user_fname;
					$province->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Lgu"){	
			
			try {
			
			
			$count = DB::table('ref_lgu_tbl')
           
            ->where(function($query)
            {
			$input = Input::all();
			$lgu_name = $input['lgu_name'];
			$lgu_code = $input['lgu_code'];
			$zip_code = $input['zip_code'];
			$blgf_code = $input['blgf_code'];
                $query->where('lgu_name', '=', $lgu_name )
                      ->orWhere('zip_code', '=', $zip_code )
					  ->orWhere('lgu_code', '=', $lgu_code )
					  ->orWhere('blgf_code', '=', $blgf_code );
            })
			->whereNull('deleted_at')
            ->count();
			
			$input = Input::all();
			$lgu_province_id = $input['lgu_province_id'];
			$lgu_name = $input['lgu_name'];
			$lgu_code = $input['lgu_code'];
			$zip_code = $input['zip_code'];
			$blgf_code = $input['blgf_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$lgu = new Lgu;
					$lgu->lgu_province_id = $lgu_province_id;
					$lgu->lgu_name = $lgu_name;
					$lgu->lgu_code = $lgu_code;
					$lgu->zip_code = $zip_code;
					$lgu->blgf_code = $blgf_code;
					$lgu->created_by = $user_fname;
					$lgu->updated_by = $user_fname;
					$lgu->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}	
		else if($id=="District"){	
			try {
			$count = DB::table('ref_district_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$district_name = $input['district_name'];
			$blgf_code = $input['blgf_code'];
			
                $query->where('district_name', '=', $district_name )
					  ->orWhere('blgf_code', '=', $blgf_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$district_lgu_id = $input['district_lgu_id'];
			$district_name = $input['district_name'];
			$blgf_code = $input['blgf_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$district = new District;
					$district->district_lgu_id = $district_lgu_id;
					$district->district_name = $district_name;
					$district->blgf_code = $blgf_code;
					$district->created_by = $user_fname;
					$district->updated_by = $user_fname;
					$district->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Barangay"){	
			try {
			$count = DB::table('ref_brgy_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$brgy_name = $input['brgy_name'];
			$blgf_code = $input['blgf_code'];
			
                $query->where('brgy_name', '=', $brgy_name )
					  ->orWhere('blgf_code', '=', $blgf_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$brgy_district_id = $input['brgy_district_id'];
			$brgy_name = $input['brgy_name'];
			$blgf_code = $input['blgf_code'];
			$garbage_zone = $input['garbage_zone'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$barangay = new Barangay;
					$barangay->brgy_district_id = $brgy_district_id;
					$barangay->brgy_name = $brgy_name;
					$barangay->blgf_code = $blgf_code;
					$garbage_zone->blgf_code = $garbage_zone;
					$barangay->created_by = $user_fname;
					$barangay->updated_by = $user_fname;
					$barangay->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Zone"){	
			try {
			$count = DB::table('ref_zone_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$zone_name = $input['zone_name'];
                $query->where('zone_name', '=', $zone_name );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$zone_brgy_id = $input['zone_brgy_id'];
			$zone_name = $input['zone_name'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$zone = new Zone;
					$zone->zone_brgy_id = $zone_brgy_id;
					$zone->zone_name = $zone_name;
					$zone->created_by = $user_fname;
					$zone->updated_by = $user_fname;
					$zone->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Tax-Fees-Charges"){	
			try {
			$count = DB::table('ref_taxcharges_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$taxcharges_name = $input['taxcharges_name'];
                $query->where('taxcharges_name', '=', $taxcharges_name );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$taxcharges_type_id = $input['taxcharges_type_id'];
			$taxcharges_name = $input['taxcharges_name'];
			$amount = $input['amount'];
			$is_default = $input['is_default'];
			$no_of_years = $input['no_of_years'];

			
				if ($count>0) {
				    return "2";
				}else{
					
					$taxcharges = new Taxcharges;
					$taxcharges->taxcharges_type_id = $taxcharges_type_id;
					$taxcharges->taxcharges_name = $taxcharges_name;
					$taxcharges->amount = $amount;
					$taxcharges->is_default = $is_default;
					$taxcharges->no_of_years = $no_of_years;
					$taxcharges->created_by = $user_fname;
					$taxcharges->updated_by = $user_fname;
					$taxcharges->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Business-Nature"){	
			try {
			$count = DB::table('ref_business_nature_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$business_nature = $input['business_nature'];
			$psic_code = $input['psic_code'];
                $query->where('business_nature', '=', $business_nature )
				->orWhere('psic_code', '=', $psic_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$business_nature = $input['business_nature'];
			$psic_code = $input['psic_code'];

				if ($count>0) {
				    return "2";
				}else{
					
					$bus_nature = new BusinessNature;
					$bus_nature->business_nature = $business_nature;
					$bus_nature->psic_code = $psic_code;
					$bus_nature->created_by = $user_fname;
					$bus_nature->updated_by = $user_fname;
					$bus_nature->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		
		else if($id=="Business-Nature-Add-Tax-Req"){	
			try {
			$count = DB::table('bp_tax_charges_req_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$transaction_charge_id = $input['transaction_charge_id'];
			$transaction_type = $input['transaction_type'];
                $query->where('transaction_charge_id', '=', $transaction_charge_id )
				->where('transaction_type', '=', $transaction_type );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$transaction_charge_id = $input['transaction_charge_id'];
			$transaction_type = $input['transaction_type'];
			$basis = $input['basis'];
			$indicator = $input['indicator'];
			$mode = $input['mode'];
			$formula = $input['formula'];
			$amount = $input['amount'];
			$minimum_amount = $input['minimum_amount'];
			$unit_measure = $input['unit_measure'];

				if ($count>0) {
				    return "2";
				}else{
					$transaction_charge_req = new TaxChargesRequirements;
					$transaction_charge_req->transaction_charge_id = $transaction_charge_id;
					$transaction_charge_req->transaction_type = $transaction_type;
					$transaction_charge_req->basis = $basis;
					$transaction_charge_req->indicator = $indicator;
					$transaction_charge_req->mode = $mode;
					$transaction_charge_req->formula = $formula;
					$transaction_charge_req->amount = $amount;
					$transaction_charge_req->minimum_amount = $minimum_amount;
					$transaction_charge_req->unit_measure = $unit_measure;
					$transaction_charge_req->created_by = $user_fname;
					$transaction_charge_req->updated_by = $user_fname;
					$transaction_charge_req->save();
					$inserted_id = $transaction_charge_req->id;
				    return "1-".$inserted_id;
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
			
		}else if($id=="Business-Nature-Add-Tax-Req-Formula"){	
			try {
				$input = Input::all();
				$bp_tax_charges_req_id = $input['bp_tax_charges_req_id'];
				$var_name = $input['var_name'];
				$ref_tax_charges_id = $input['ref_tax_charges_id'];
				$transaction_charge_formula = new TaxChargesFormula;
				$transaction_charge_formula->bp_tax_charges_req_id = $bp_tax_charges_req_id;
				$transaction_charge_formula->var_name = $var_name;
				$transaction_charge_formula->ref_tax_charges_id = $ref_tax_charges_id;
				$transaction_charge_formula->created_by = $user_fname;
				$transaction_charge_formula->updated_by = $user_fname;
				$transaction_charge_formula->save();
				return "1";
			}catch(\Exception $e){
				return "0".$e; 
			}
		}else if($id=="Business-Nature-Add-Tax-Req-Range"){	
			try {
		
				$input = Input::all();
				$bp_tax_charges_req_id = $input['bp_tax_charges_req_id'];
				$lower_limit = $input['lower_limit'];
				$higher_limit = $input['higher_limit'];
				$value = $input['value'];

				$transaction_charge_range = new TaxChargesRange;
				$transaction_charge_range->bp_tax_charges_req_id = $bp_tax_charges_req_id;
				$transaction_charge_range->lower_limit = $lower_limit;
				$transaction_charge_range->higher_limit = $higher_limit;
				$transaction_charge_range->value = $value;
				$transaction_charge_range->created_by = $user_fname;
				$transaction_charge_range->updated_by = $user_fname;
				$transaction_charge_range->save();
				return "1";
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Requirement"){	
			try {
			$count = DB::table('ref_requirements_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$requirement = $input['requirement'];
			$permit_id = $input['permit_id'];
                $query->where('requirement', '=', $requirement )
					->where('permit_id', '=', $permit_id );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$requirement = $input['requirement'];
			$permit_id = $input['permit_id'];
			$is_default = $input['is_default'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$req = new Requirement;
					$req->requirement = $requirement;
					$req->permit_id = $permit_id;
					$req->is_default = $is_default;
					$req->created_by = $user_fname;
					$req->updated_by = $user_fname;
					$req->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Citizenship"){	
			try {
			$count = DB::table('ref_citizenship_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$citizenship_name = $input['citizenship_name'];

                $query->where('citizenship_name', '=', $citizenship_name );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$citizenship_name = $input['citizenship_name'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$citizenship = new Citizenship;
					$citizenship->citizenship_name = $citizenship_name;
					$citizenship->created_by = $user_fname;
					$citizenship->updated_by = $user_fname;
					$citizenship->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Economic-Area"){	
			try {
			$count = DB::table('ref_economic_area_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$economic_area_name = $input['economic_area_name'];
			$economic_area_code = $input['economic_area_code'];
			
                $query->where('economic_area_name', '=', $economic_area_name )
					  ->orWhere('economic_area_code', '=', $economic_area_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$economic_area_name = $input['economic_area_name'];
			$economic_area_code = $input['economic_area_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$economic_area = new EconomicArea;
					$economic_area->economic_area_name = $economic_area_name;
					$economic_area->economic_area_code = $economic_area_code;
					$economic_area->created_by = $user_fname;
					$economic_area->updated_by = $user_fname;
					$economic_area->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Economic-Organization"){	
			try {
			$count = DB::table('ref_economic_organization_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$economic_org_name = $input['economic_org_name'];
			$economic_org_code = $input['economic_org_code'];
			
                $query->where('economic_org_name', '=', $economic_org_name )
					  ->orWhere('economic_org_code', '=', $economic_org_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$economic_org_name = $input['economic_org_name'];
			$economic_org_code = $input['economic_org_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$economic_org = new EconomicOrganization;
					$economic_org->economic_org_name = $economic_org_name;
					$economic_org->economic_org_code = $economic_org_code;
					$economic_org->created_by = $user_fname;
					$economic_org->updated_by = $user_fname;
					$economic_org->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Industry-Sector"){	
			try {
			$count = DB::table('ref_industry_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$industry_sector_type = $input['industry_sector_type'];
			$industry_sector_code = $input['industry_sector_code'];
			
                $query->where('industry_sector_type', '=', $industry_sector_type )
					  ->orWhere('industry_sector_code', '=', $industry_sector_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$industry_sector_type = $input['industry_sector_type'];
			$industry_sector_code = $input['industry_sector_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$industry_sec = new IndustrySector;
					$industry_sec->industry_sector_type = $industry_sector_type;
					$industry_sec->industry_sector_code = $industry_sector_code;
					$industry_sec->created_by = $user_fname;
					$industry_sec->updated_by = $user_fname;
					$industry_sec->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Occupancy-Type"){	
			try {
			$count = DB::table('ref_occupancy_type_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$occupancy_type = $input['occupancy_type'];
			$occupancy_code = $input['occupancy_code'];
                $query->where('occupancy_type', '=', $occupancy_type )
					  ->orWhere('occupancy_code', '=', $occupancy_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$occupancy_type = $input['occupancy_type'];
			$occupancy_code = $input['occupancy_code'];
			
				if ($count>0) {
				    return "2";
				}else{
					
					$occupancy = new OccupancyType;
					$occupancy->occupancy_type = $occupancy_type;
					$occupancy->occupancy_code = $occupancy_code;
					$occupancy->created_by = $user_fname;
					$occupancy->updated_by = $user_fname;
					$occupancy->save();
				    return "1";
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}	
		else if($id=="Ownership-Type"){	
			try {
			$count = DB::table('ref_ownership_type_tbl')
            ->where(function($query)
            {
			$input = Input::all();
			$ownership_type = $input['ownership_type'];
			$ownership_code = $input['ownership_code'];
                $query->where('ownership_type', '=', $ownership_type )
					  ->orWhere('ownership_code', '=', $ownership_code );
            })
			->whereNull('deleted_at')
            ->count();

			$input = Input::all();
			$ownership_type = $input['ownership_type'];
			$ownership_code = $input['ownership_code'];
			$tax_excemptions = $input['tax_excemptions'];
				if ($count>0) {
				    return "2";
				}else{
					
					$ownership = new OwnershipType;
					$ownership->ownership_type = $ownership_type;
					$ownership->ownership_code = $ownership_code;
					$ownership->tax_excemptions = $tax_excemptions;
					$ownership->created_by = $user_fname;
					$ownership->updated_by = $user_fname;
					$ownership->save();
					$inserted_id = $ownership->id;
				    return "1-".$inserted_id;
				    
				}
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Ownership-Type-Add-Excemptions"){	
			try {
				$input = Input::all();
				$tax_charges_id = $input['tax_charges_id'];
				$ownership_type_id = $input['ownership_type_id'];
						
				$excemptions = new OwnershipTypeExcemptions;
				$excemptions->tax_charges_id = $tax_charges_id;
				$excemptions->ownership_type_id = $ownership_type_id;
				$excemptions->created_by = $user_fname;
				$excemptions->updated_by = $user_fname;
				$excemptions->save();
				
				return "1";
				
			}catch(\Exception $e){
				return "0".$e; 
			}
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
			$lgu_province = Lgu::with('province')->where('id','=', $ids2 )->get();
			return json_encode($lgu_province);	
		}
		else if($id=="District"){
			$district_lgu = District::with('lgu')->where('id','=', $ids2 )->get();
			return json_encode($district_lgu);	
		}
		else if($id=="Barangay"){
			$brgy_lgu = Barangay::with('district')->where('id','=', $ids2 )->get();
			return json_encode($brgy_lgu);	
		}
		else if($id=="Zone"){
			$zone_brgy = Zone::with('barangay')->where('id','=', $ids2 )->get();
			return json_encode($zone_brgy);	
		}
		else if($id=="Tax-Fees-Charges"){
			$tax_charges = Taxcharges::with('taxchargestype')->where('id','=', $ids2 )->get();
			return json_encode($tax_charges);	
		}
		else if($id=="Business-Nature"){
			$bus_nature = BusinessNature::all();
			return json_encode($bus_nature);	
		}
		else if($id=="Business-Nature-Transaction-Charge"){
			$tax_charges = Taxcharges::where('taxcharges_type_id','=', $ids2 )->get();
			return json_encode($tax_charges);		
		}
		else if($id=="Business-Nature-Transaction-Charge-All"){
			if($ids2=="All"){
				$tax_charges = Taxcharges::all();
				return json_encode($tax_charges);
			}			
		}else if($id=="Manage-Business-Nature-Charges"){
				$tax_charges_req = TaxChargesRequirements::with('taxCharge')->with('TaxChargesFormula')->with('TaxChargesRange')->where('id','=', $ids2 )->get();
				return json_encode($tax_charges_req);		
		}
		else if($id=="Requirement"){
			$requirement = Requirement::with('permit')->where('id','=', $ids2 )->get();
			return json_encode($requirement);	
		}
		else if($id=="Citizenship"){
			$citizenship = Citizenship::where('id','=', $ids2 )->get();
			return json_encode($citizenship);	
		}
		else if($id=="Economic-Area"){
			$economic_area = EconomicArea::where('id','=', $ids2 )->get();
			return json_encode($economic_area);	
		}
		else if($id=="Economic-Organization"){
			$economic_org = EconomicOrganization::where('id','=', $ids2 )->get();
			return json_encode($economic_org);	
		}
		else if($id=="Industry-Sector"){
			$industry_sec = IndustrySector::where('id','=', $ids2 )->get();
			return json_encode($industry_sec);	
		}
		else if($id=="Occupancy-Type"){
			$occupancy_type = OccupancyType::where('id','=', $ids2 )->get();
			return json_encode($occupancy_type);	
		}
		else if($id=="Ownership-Type"){
			$ownership = OwnershipType::with('tax_excempt')->where('id','=', $ids2 )->get();
			return json_encode($ownership);					
		}
	}
	
	public function deleteDataByID($id)
	{
	$user_fname = Auth::user()->fname;
	$input = Input::all();
	$ids2 = $input['id'];
		if($id=="Province"){
			try {
			
				$province = Province::find( $ids2 );
				$province->deleted_by = $user_fname;
				$province->touch();
				$province->save();
			    $province ->delete();
				
				
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Lgu"){
			try {
				$lgu = Lgu::find( $ids2 );
				$lgu->deleted_by = $user_fname;
				$lgu->touch();
				$lgu->save();
			    $lgu ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="District"){
			try {
				$district = District::find( $ids2 );
				$district->deleted_by = $user_fname;
				$district->touch();
				$district->save();
			    $district ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Barangay"){
			try {
				$barangay = Barangay::find( $ids2 );
				$barangay->deleted_by = $user_fname;
				$barangay->touch();
				$barangay->save();
			    $barangay ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Zone"){
			try {
				$zone = Zone::find( $ids2 );
				$zone->deleted_by = $user_fname;
				$zone->touch();
				$zone->save();
			    $zone ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Tax-Fees-Charges"){
			try {
				$taxcharges = Taxcharges::find( $ids2 );
				$taxcharges->deleted_by = $user_fname;
				$taxcharges->touch();
				$taxcharges->save();
			    $taxcharges ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Business-Nature"){
			try {
				$bus_nature = BusinessNature::find( $ids2 );
				$bus_nature->deleted_by = $user_fname;
				$bus_nature->touch();
				$bus_nature->save();
			    $bus_nature ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Manage-Business-Nature"){
			try {
				$tax_charge_req = TaxChargesRequirements::find( $ids2 );
				$tax_charge_req->deleted_by = $user_fname;
				$tax_charge_req->touch();
				$tax_charge_req->save();
			    $tax_charge_req ->delete();

				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Requirement"){
			try {
				$req = Requirement::find( $ids2 );
				$req->deleted_by = $user_fname;
				$req->touch();
				$req->save();
			    $req ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Citizenship"){
			try {
				$citizenship = Citizenship::find( $ids2 );
				$citizenship->deleted_by = $user_fname;
				$citizenship->touch();
				$citizenship->save();
			    $citizenship ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Economic-Area"){
			try {
				$economic_area = EconomicArea::find( $ids2 );
				$economic_area->deleted_by = $user_fname;
				$economic_area->touch();
				$economic_area->save();
			    $economic_area ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Economic-Organization"){
			try {
				$economic_org = EconomicOrganization::find( $ids2 );
				$economic_org->deleted_by = $user_fname;
				$economic_org->touch();
				$economic_org->save();
			    $economic_org ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Industry-Sector"){
			try {
				$industry_sec = IndustrySector::find( $ids2 );
				$industry_sec->deleted_by = $user_fname;
				$industry_sec->touch();
				$industry_sec->save();
			    $industry_sec ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Occupancy-Type"){
			try {
				$occupancy_type = OccupancyType::find( $ids2 );
				$occupancy_type->deleted_by = $user_fname;
				$occupancy_type->touch();
				$occupancy_type->save();
			    $occupancy_type ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Ownership-Type"){
			try {
				$ownership = OwnershipType::find( $ids2 );
				$ownership->deleted_by = $user_fname;
				$ownership->touch();
				$ownership->save();
			    $ownership ->delete();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
	}
	public function updateDataByID($id)
	{
	$user_fname = Auth::user()->fname;
		if($id=="Province"){
			try {
				$input = Input::all();
				$name = $input['name'];
				$code = $input['code'];
				$ids2 = $input['id'];
				$province = Province::find( $ids2 );
				$province->province_name = $name;
				$province->blgf_code = $code;
				$province->updated_by = $user_fname;
				$province->touch();
				$province->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Lgu"){
			try {
				$input = Input::all();
				$lgu_province_id = $input['lgu_province_id'];
				$lgu_name = $input['lgu_name'];
				$lgu_code = $input['lgu_code'];
				$zip_code = $input['zip_code'];
				$blgf_code = $input['blgf_code'];
				$ids2 = $input['id'];
				$lgu = Lgu::find( $ids2 );
				$lgu->lgu_name = $lgu_name;
				$lgu->lgu_code = $lgu_code;
				$lgu->zip_code = $zip_code;
				$lgu->blgf_code = $blgf_code;
				$lgu->lgu_province_id = $lgu_province_id;
				$lgu->updated_by = $user_fname;
				$lgu->touch();
				$lgu->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="District"){
			try {
				$input = Input::all();
				$district_lgu_id = $input['district_lgu_id'];
				$district_name = $input['district_name'];
				$blgf_code = $input['blgf_code'];
				$ids2 = $input['id'];
				$district = District::find( $ids2 );
				$district->district_name = $district_name;
				$district->blgf_code = $blgf_code;
				$district->district_lgu_id = $district_lgu_id;
				$district->updated_by = $user_fname;
				$district->touch();
				$district->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Barangay"){
			try {
				$input = Input::all();
				$brgy_district_id = $input['brgy_district_id'];
				$brgy_name = $input['brgy_name'];
				$blgf_code = $input['blgf_code'];
				$garbage_zone = $input['garbage_zone'];
				$ids2 = $input['id'];
				$barangay = Barangay::find( $ids2 );
				$barangay->brgy_name = $brgy_name;
				$barangay->blgf_code = $blgf_code;
				$barangay->garbage_zone= $garbage_zone;
				$barangay->brgy_district_id = $brgy_district_id;
				$barangay->updated_by = $user_fname;
				$barangay->touch();
				$barangay->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Zone"){
			try {
				$input = Input::all();
				$zone_brgy_id = $input['zone_brgy_id'];
				$zone_name = $input['zone_name'];
				$ids2 = $input['id'];
				$zone = Zone::find( $ids2 );
				$zone->zone_name = $zone_name;
				$zone->zone_brgy_id = $zone_brgy_id;
				$zone->updated_by = $user_fname;
				$zone->touch();
				$zone->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Tax-Fees-Charges"){
			try {
				$input = Input::all();
				$taxcharges_type_id = $input['taxcharges_type_id'];
				$taxcharges_name = $input['taxcharges_name'];
				$amount = $input['amount'];
				$is_default = $input['is_default'];
				$no_of_years = $input['no_of_years'];
				$ids2 = $input['id'];
				$taxcharges = Taxcharges::find( $ids2 );
				$taxcharges->taxcharges_type_id = $taxcharges_type_id;
				$taxcharges->taxcharges_name = $taxcharges_name;
				$taxcharges->amount = $amount;
				$taxcharges->is_default = $is_default;
				$taxcharges->no_of_years = $no_of_years;
				$taxcharges->updated_by = $user_fname;
				$taxcharges->touch();
				$taxcharges->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Business-Nature"){
			try {
				$input = Input::all();
				$business_nature = $input['business_nature'];
				$psic_code = $input['psic_code'];
				$ids2 = $input['id'];
				$bus_nature = BusinessNature::find( $ids2 );
				$bus_nature->business_nature = $business_nature;
				$bus_nature->psic_code = $psic_code;
				$bus_nature->updated_by = $user_fname;
				$bus_nature->touch();
				$bus_nature->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Business-Nature-Manage-Add-Tax-Req"){
			try {
			
				$input = Input::all();
				$transaction_charge_id = $input['transaction_charge_id'];
				$transaction_type = $input['transaction_type'];
				$basis = $input['basis'];
				$indicator = $input['indicator'];
				$mode = $input['mode'];
				$formula = $input['formula'];
				$amount = $input['amount'];
				$minimum_amount = $input['minimum_amount'];
				$unit_measure = $input['unit_measure'];
				$ids2 = $input['id'];
			
					$transaction_charge_req = TaxChargesRequirements::find( $ids2 );
					$transaction_charge_req->transaction_charge_id = $transaction_charge_id;
					$transaction_charge_req->transaction_type = $transaction_type;
					$transaction_charge_req->basis = $basis;
					$transaction_charge_req->indicator = $indicator;
					$transaction_charge_req->mode = $mode;
					$transaction_charge_req->formula = $formula;
					$transaction_charge_req->amount = $amount;
					$transaction_charge_req->minimum_amount = $minimum_amount;
					$transaction_charge_req->unit_measure = $unit_measure;
					$transaction_charge_req->updated_by = $user_fname;
					$transaction_charge_req->touch();
					$transaction_charge_req->save();
					
					$formula_row = TaxChargesRequirements::find( $ids2 );
					$formula_row->TaxChargesFormula()->forceDelete();
					$formula_row->TaxChargesRange()->forceDelete();
					
				    return "1";
				
			}catch(\Exception $e){
				return "0".$e; 
			}
		}
		else if($id=="Requirement"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$requirement = $input['requirement'];
				$permit_id = $input['permit_id'];
				$is_default = $input['is_default'];
				$req = Requirement::find( $ids2 );
				$req->is_default = $is_default;
				$req->requirement = $requirement;
				$req->permit_id = $permit_id;
				$req->updated_by = $user_fname;
				$req->touch();
				$req->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Citizenship"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$citizenship_name = $input['citizenship_name'];
				$citizenship = Citizenship::find( $ids2 );
				$citizenship->citizenship_name = $citizenship_name;
				$citizenship->updated_by = $user_fname;
				$citizenship->touch();
				$citizenship->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Economic-Area"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$economic_area_name = $input['economic_area_name'];
				$economic_area_code = $input['economic_area_code'];
				$economic_area = EconomicArea::find( $ids2 );
				$economic_area->economic_area_name = $economic_area_name;
				$economic_area->economic_area_code = $economic_area_code;
				$economic_area->updated_by = $user_fname;
				$economic_area->touch();
				$economic_area->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Economic-Organization"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$economic_org_name = $input['economic_org_name'];
				$economic_org_code = $input['economic_org_code'];
				$economic_org = EconomicOrganization::find( $ids2 );
				$economic_org->economic_org_name = $economic_org_name;
				$economic_org->economic_org_code = $economic_org_code;
				$economic_org->updated_by = $user_fname;
				$economic_org->touch();
				$economic_org->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Industry-Sector"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$industry_sector_type = $input['industry_sector_type'];
				$industry_sector_code = $input['industry_sector_code'];
				$industry_sec = IndustrySector::find( $ids2 );
				$industry_sec->industry_sector_type = $industry_sector_type;
				$industry_sec->industry_sector_code = $industry_sector_code;
				$industry_sec->updated_by = $user_fname;
				$industry_sec->touch();
				$industry_sec->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Occupancy-Type"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$occupancy_type = $input['occupancy_type'];
				$occupancy_code = $input['occupancy_code'];
				$occupancy = OccupancyType::find( $ids2 );
				$occupancy->occupancy_type = $occupancy_type;
				$occupancy->occupancy_code = $occupancy_code;
				$occupancy->updated_by = $user_fname;
				$occupancy->touch();
				$occupancy->save();
				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
		else if($id=="Ownership-Type"){
			try {
				$input = Input::all();
				$ids2 = $input['id'];
				$ownership_type = $input['ownership_type'];
				$ownership_code = $input['ownership_code'];
				$tax_excemptions = $input['tax_excemptions'];
				$ownership = OwnershipType::find( $ids2 );
				$ownership->ownership_type = $ownership_type;
				$ownership->ownership_code = $ownership_code;
				$ownership->tax_excemptions = $tax_excemptions;
				$ownership->updated_by = $user_fname;
				$ownership->touch();
				$ownership->save();
				
				$formula_row = OwnershipType::find( $ids2 );
				$formula_row->tax_excempt()->forceDelete();

				return "1"; 
			}catch(\Exception $e){
				return "0".$e; 
			}	
		}
	}
	
	
	
	
	
	
	//// managing data in sub sub page//
	
	public function manageDataByID($id,$ids2){
		if($id=="Manage-Business-Nature"){
		
				try {
					$bus_nature = BusinessNature::find( $ids2 );
					
					if($bus_nature){
						$count=$bus_nature->count();
						if ($count>0) {
							$user_fname = Auth::user()->fname;
							$tax_charges_type = Taxchargestype::all();
							$tax_charges_req = TaxChargesRequirements::with('taxCharge')->get();
							$transaction_type = DB::table('ref_transaction_type_tbl')->get();
							return view('pages.references.business_nature-manage')->with('username',$user_fname)
							    
								->with('sub_page','Business Nature')
								->with('main_page','Business Permit')
								->with('page','Reference')
								->with('tax_charges_type_data',$tax_charges_type)
								->with('business_nature_data',$bus_nature)
								->with('transaction_type_data',$transaction_type)
								->with('tax_charges_req_data',$tax_charges_req);
						}else{
							return "2";
						}
					}else{
						return "2";
					}
				}catch(\Exception $e){
					return "0".$e; 
				}
		}
	}
	
	

	

}
