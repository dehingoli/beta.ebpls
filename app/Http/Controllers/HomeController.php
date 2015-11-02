<?php namespace App\Http\Controllers;
use Auth;
use DB;
use Input;
class HomeController extends Controller {

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
	public function showHome()
	{
	$user_fname = Auth::user()->fname;
		$announcement =   DB::table('bp_announcement_tbl')
		->orderBy('created_at','asc')
		->get();

		return view('pages.announcement')->with('username',$user_fname)
				->with('announcement',$announcement)
				->with('sub_page','')
				->with('main_page','')
				->with('page','Home');
	}
	public function getAnnouncement()
	{
	$input = Input::all();
	$announcement_id = $input['announcement_id'];
	$announcement  =   DB::table('bp_announcement_tbl')
		->where('id','=', $announcement_id )
		->get();
		
		return json_encode($announcement);
	}
	
	// public function viewMarketPerPlaces($marketplace)
	// {
		
	 // $selectedStore =   DB::table('store_tbl')
		// ->join('product_tbl', function($join)
		// {
			// $join->on('product_tbl.store_id', '=', 'store_tbl.store_id')
			// ->where('product_tbl.status','=','1');
		// })	
		// ->join('sub_category_tbl','sub_category_tbl.sub_category_id','=','product_tbl.sub_category_id')
		// ->join('category_tbl','category_tbl.category_id','=','sub_category_tbl.category_id')
		// ->join('market_tbl','market_tbl.market_id','=','category_tbl.market_id')
		// ->select('store_tbl.store_id','store_tbl.store_name','category_tbl.market_id')
		// ->where('store_tbl.store_status','=','ACTIVATED')
		// ->where('market_tbl.market_name','=',str_replace('-',' ',$marketplace))
		// ->orderBy(DB::raw('RAND()'))
		// ->groupBy('store_tbl.store_id')
		// ->get();
	// //	return $selectedStore;
		// return view('marketplace')
				// ->with('selectedStore',$selectedStore)
				// ->with('marketName',$marketplace);
	// }
	

}
