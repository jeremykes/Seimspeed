<?php

// ===================================================================================
// 
// 
//     NOTES
// 	   All view Routes will have fully qualified routes (/corporate/1/car/1/sale/1).
//     All action Routes will have abbreviated routes (/corp/addcarsales).
//     This is because action routes will send data via the Post so do not not need
//     Laravel model implicit binding in the routes.
// 
//     Misc Routes will contain routes that do not belong to any intuitive groups (View or Action).
// 
// 
// ===================================================================================


// ===================================================================================
// 
// 
//     Public Routes
// 	   Routes available to all users regardless of whether logged in or not.
// 
// 
// ===================================================================================


/*
|--------------------------------------------------------------------------
| View Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'FrameworkController@index'); // home
// allcarauctions 	
// allcargroups 	
// allcarrents  	
// allcars 			
// allcarsales 		
// allcartenders  
Route::get('/corporate/{corporate}/car/{car}/carauction/{carauction}', 'FrameworkController@carauction'); // carauction 		
// carauctiongroup 	
// cargroup  
Route::get('/corporate/{corporate}/car/{car}/carrent/{carrent}', 'FrameworkController@carrent'); // carrent 			
// carrentgroup 	
Route::get('/corporate/{corporate}/car/{car}/carsale/{carsale}', 'FrameworkController@carsale'); // carsale 			
// carsalegroup  		
Route::get('/corporate/{corporate}/car/{car}/cartender/{cartender}', 'FrameworkController@cartender'); // cartender  		
// cartendergroup  	
// cartendertenderers 
// allpartgroups 	
// allparts 		
// allpartsales 	
// partgroup  		
Route::get('/corporate/{corporate}/part/{part}/partsale/{partsale}', 'FrameworkController@partsale'); // partsale 		
// partsalegroup 
Route::get('/corporate/{corporate}', 'FrameworkController@corporatehome'); // corphome 

Route::get('/getcarsaleoffers', 'FrameworkController@getcarsaleoffers');
Route::get('/getcarrentoffers', 'FrameworkController@getcarrentoffers');
Route::get('/getcartendertenders', 'FrameworkController@getcartendertenders');
Route::get('/getcarauctionbids', 'FrameworkController@getcarauctionbids');
Route::get('/getpartsaleoffers', 'FrameworkController@getpartsaleoffers');
Route::get('/getcarcomments', 'FrameworkController@getcarcomments');
Route::get('/getpartcomments', 'FrameworkController@getpartcomments');
Route::get('/getcartails', 'FrameworkController@getcartails');
Route::get('/getparttails', 'FrameworkController@getparttails');


/*
|--------------------------------------------------------------------------
| Action Routes
|--------------------------------------------------------------------------
*/	
// SOCIAL LOGIN
// Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\AuthController@getSocialRedirect']);
// Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\AuthController@getSocialHandle']);

/*
|--------------------------------------------------------------------------
| Misc Routes
|--------------------------------------------------------------------------
*/
Route::post('/loadcarmodels', 'FrameworkController@loadcarmodels');


Route::group(['middleware' => ['auth']], function() {

	// ===================================================================================
	// 
	// 
	//     Authenticated Routes
	//     Routes that only need the user to log in (authenticated) go here.
	// 
	// 
	// ===================================================================================


	/*
	|--------------------------------------------------------------------------
	| View Routes
	|--------------------------------------------------------------------------
	*/	


	/*
	|--------------------------------------------------------------------------
	| Action Routes
	|--------------------------------------------------------------------------
	*/
	Route::post('/auth/rate', 'UserController@rate');
	Route::post('/auth/tailcorporate', 'UserController@tailcorporate');
	Route::post('/auth/addcarcomment', 'UserController@addcarcomment');
	// Route::post('/auth/updatecarcomment', 'UserController@updatecarcomment');
	Route::post('/auth/deletecarcomment', 'UserController@deletecarcomment');
	// Route::post('/auth/likecar', 'UserController@likecar');
	Route::post('/auth/tailcar', 'UserController@tailcar');
	Route::post('/auth/carsaleoffer', 'UserController@carsaleoffer');
	Route::post('/auth/carsaleoffercancel', 'UserController@carsaleoffercancel');
	Route::post('/auth/carrentoffer', 'UserController@carrentoffer');
	Route::post('/auth/carrentoffercancel', 'UserController@carrentoffercancel');
	Route::post('/auth/cartendertender', 'UserController@cartendertender');
	Route::post('/auth/cartendertendercancel', 'UserController@cartendertendercancel');
	Route::post('/auth/carauctionbid', 'UserController@carauctionbid');
	Route::post('/auth/carauctionbidcancel', 'UserController@carauctionbidcancel');
	Route::post('/auth/addpartcomment', 'UserController@addpartcomment');
	// Route::post('/auth/updatepartcomment', 'UserController@updatepartcomment');
	Route::post('/auth/deletepartcomment', 'UserController@deletepartcomment');
	// Route::post('/auth/likepart', 'UserController@likepart');
	Route::post('/auth/tailpart', 'UserController@tailpart');
	Route::post('/auth/partsaleoffer', 'UserController@partsaleoffer');
	Route::post('/auth/partsaleoffercancel', 'UserController@partsaleoffercancel');

	Route::post('/auth/sendmessage', 'FrameworkController@sendmessage');
	Route::post('/auth/reportuser', 'FrameworkController@reportuser');
	Route::post('/auth/reportcorporate', 'FrameworkController@reportcorporate');
	Route::post('/auth/reportpart', 'FrameworkController@reportpart');

	Route::post('/auth/addcorporate', 'FrameworkController@addcorporate');

	/*
	|--------------------------------------------------------------------------
	| Misc Routes
	|--------------------------------------------------------------------------
	*/
	// PUSHER AUTHENTICATION ROUTE
	// See if you can move this to the FrameworkController
	// Route::post('/pusher/auth/{id}', function($id) {
	// 	if ( Auth::user()->id === (int) $id ) {
	// 	  $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
	// 	  echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
	// 	} else {
	// 	  header('', true, 403);
	// 	  echo "Forbidden";
	// 	}
	// }); 

	Route::get('/pusher/auth/{id}', 'FrameworkController@pusherauthenticate');
	Route::get('/auth/iscorpuser', 'FrameworkController@iscorpuser');
	Route::get('/auth/hascorpuserrole', 'FrameworkController@hascorpuserrole');


	Route::group(['middleware' => ['corpuser']], function() {


		// ===================================================================================
		// 
		// 
		//     Corporate User Routes
		//     Routes that need the user to be a Corporate User of this Corporation go here.
		// 
		// 
		// ===================================================================================	


		/*
		|--------------------------------------------------------------------------
		| View Routes
		|--------------------------------------------------------------------------
		*/	
		Route::get('/corporate/{corporate}/dashboard', 'FrameworkController@corporatedashboard'); // dashboard
		Route::get('/corporate/{corporate}/members', 'FrameworkController@corporatemembers'); // members
		Route::get('/corporate/{corporate}/settings', 'FrameworkController@corporatesettings'); // settings


		/*
		|--------------------------------------------------------------------------
		| Action Routes
		|--------------------------------------------------------------------------
		*/		


		/*
		|--------------------------------------------------------------------------
		| Misc Routes
		|--------------------------------------------------------------------------
		*/


		Route::group(['middleware' => ['role:sales|administrator']], function() {


			// ===================================================================================
			// 
			// 
			//     Corporate User Administrator/Sales
			//     Routes that need the user to be a Corporate User 
			//     Administrator or Sales of this Corporation go here.
			// 
			// 
			// ===================================================================================

			/*
			|--------------------------------------------------------------------------
			| View Routes
			|--------------------------------------------------------------------------
			*/
			// allcarauctionreserves	
			// allcarrentreserves		
			// allcarsalereserves		
			// allcartenderreserves		
			// carauctionbidders		 
			// carauctionedit			
			// carrentedit				
			// carsaleedit				
			// cartenderedit	

			/*
			|--------------------------------------------------------------------------
			| Action Routes
			|--------------------------------------------------------------------------
			*/		
			Route::post('/corporate/{corporate}/corpuser/sales/car/addsale', 'CarController@addsale');
			Route::post('/corporate/{corporate}/corpuser/sales/car/updatesale', 'CarController@updatesale');
			Route::post('/corporate/{corporate}/corpuser/sales/car/deletesale', 'CarController@deletesale');
			Route::post('/corporate/{corporate}/corpuser/sales/car/closesale', 'CarController@closesale');
			Route::post('/corporate/{corporate}/corpuser/sales/car/saleofferreserve', 'CarController@saleofferreserve');
			Route::post('/corporate/{corporate}/corpuser/sales/car/saleofferreservecancel', 'CarController@saleofferreservecancel');
			Route::post('/corporate/{corporate}/corpuser/sales/car/purchasesale', 'CarController@purchasesale');

			Route::post('/corporate/{corporate}/corpuser/sales/car/addrent', 'CarController@addrent');
			Route::post('/corporate/{corporate}/corpuser/sales/car/updaterent', 'CarController@updaterent');
			Route::post('/corporate/{corporate}/corpuser/sales/car/deleterent', 'CarController@deleterent');
			Route::post('/corporate/{corporate}/corpuser/sales/car/closerent', 'CarController@closerent');
			Route::post('/corporate/{corporate}/corpuser/sales/car/rentofferreserve', 'CarController@rentofferreserve');
			Route::post('/corporate/{corporate}/corpuser/sales/car/rentofferreservecancel', 'CarController@rentofferreservecancel');
			Route::post('/corporate/{corporate}/corpuser/sales/car/purchaserent', 'CarController@purchaserent');
			Route::post('/corporate/{corporate}/corpuser/sales/car/rentreturned', 'CarController@rentreturned');

			Route::post('/corporate/{corporate}/corpuser/sales/car/addtender', 'CarController@addtender');
			Route::post('/corporate/{corporate}/corpuser/sales/car/updatetender', 'CarController@updatetender');
			Route::post('/corporate/{corporate}/corpuser/sales/car/deletetender', 'CarController@deletetender');
			Route::post('/corporate/{corporate}/corpuser/sales/car/closetender', 'CarController@closetender');
			Route::post('/corporate/{corporate}/corpuser/sales/car/tendertenderreserve', 'CarController@tendertenderreserve');
			Route::post('/corporate/{corporate}/corpuser/sales/car/tendertenderreservecancel', 'CarController@tendertenderreservecancel');
			Route::post('/corporate/{corporate}/corpuser/sales/car/purchasetender', 'CarController@purchasetender');

			Route::post('/corporate/{corporate}/corpuser/sales/car/addauction', 'CarController@addauction');
			Route::post('/corporate/{corporate}/corpuser/sales/car/updateauction', 'CarController@updateauction');
			Route::post('/corporate/{corporate}/corpuser/sales/car/deleteauction', 'CarController@deleteauction');
			Route::post('/corporate/{corporate}/corpuser/sales/car/closeauction', 'CarController@closeauction');
			Route::post('/corporate/{corporate}/corpuser/sales/car/auctionbidreserve', 'CarController@auctionbidreserve');
			Route::post('/corporate/{corporate}/corpuser/sales/car/auctionbidreservecancel', 'CarController@auctionbidreservecancel');
			Route::post('/corporate/{corporate}/corpuser/sales/car/purchaseauction', 'CarController@purchaseauction');

			Route::post('/corporate/{corporate}/corpuser/sales/part/addsale', 'PartController@addsale');
			Route::post('/corporate/{corporate}/corpuser/sales/part/updatesale', 'PartController@updatesale');
			Route::post('/corporate/{corporate}/corpuser/sales/part/deletesale', 'PartController@deletesale');
			Route::post('/corporate/{corporate}/corpuser/sales/part/closesale', 'PartController@closesale');
			Route::post('/corporate/{corporate}/corpuser/sales/part/saleofferreserve', 'PartController@saleofferreserve');
			Route::post('/corporate/{corporate}/corpuser/sales/part/saleofferreservecancel', 'PartController@saleofferreservecancel');
			Route::post('/corporate/{corporate}/corpuser/sales/part/purchasesale', 'PartController@purchasesale');
			/*
			|--------------------------------------------------------------------------
			| Misc Routes
			|--------------------------------------------------------------------------
			*/


		}); // End of middleware 'role:sales:administrator'


		Route::group(['middleware' => ['role:maintainer|administrator']], function() {


			// ===================================================================================
			// 
			// 
			//     Corporate User Administrator/Maintainer
			//     Routes that need the user to be a Corporate User 
			//     Administrator or Maintainer of this Corporation go here.
			// 
			// 
			// ===================================================================================


			/*
			|--------------------------------------------------------------------------
			| View Routes
			|--------------------------------------------------------------------------
			*/	
			// createcar 
			// createpart 



			/*
			|--------------------------------------------------------------------------
			| Action Routes
			|--------------------------------------------------------------------------
			*/	
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addcorporateuser', 'CorporateController@addcorporateuser');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatecorporateuser', 'CorporateController@updatecorporateuser');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletecorporateuser', 'CorporateController@deletecorporateuser');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addcorporateuserrole', 'CorporateController@addcorporateuserrole');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatecorporateuserrole', 'CorporateController@updatecorporateuserrole');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addcar', 'CorporateController@addcar');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatecar', 'CorporateController@updatecar');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletecar', 'CorporateController@deletecar');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addcarimage', 'CorporateController@addcarimage');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletecarimage', 'CorporateController@deletecarimage');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addcargroup', 'CorporateController@addcargroup');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatecargroup', 'CorporateController@updatecargroup');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletecargroup', 'CorporateController@deletecargroup');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addpart', 'CorporateController@addpart');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatepart', 'CorporateController@updatepart');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletepart', 'CorporateController@deletepart');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addpartimage', 'CorporateController@addpartimage');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletepartimage', 'CorporateController@deletepartimage');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/addpartgroup', 'CorporateController@addpartgroup');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/updatepartgroup', 'CorporateController@updatepartgroup');
			Routes::post('/corporate/{corporate}/corpuser/maintainer/deletepartgroup	', 'CorporateController@deletepartgroup');	


			/*
			|--------------------------------------------------------------------------
			| Misc Routes
			|--------------------------------------------------------------------------
			*/


		}); // End of middleware 'role:maintainer:administrator'


		Route::group(['middleware' => ['role:manager|administrator']], function() {


			// ===================================================================================
			// 
			// 
			//     Corporate User Administrator/Manager
			//     Routes that need the user to be a Corporate User 
			//     Administrator or Manager of this Corporation go here.
			// 
			// 
			// ===================================================================================


			/*
			|--------------------------------------------------------------------------
			| View Routes
			|--------------------------------------------------------------------------
			*/	
			// allmembers 	
			// corporatetail  
			// reports		


			/*
			|--------------------------------------------------------------------------
			| Action Routes
			|--------------------------------------------------------------------------
			*/	


			/*
			|--------------------------------------------------------------------------
			| Misc Routes
			|--------------------------------------------------------------------------
			*/


		}); // End of middleware 'role:manager:administrator'

		
		Route::group(['middleware' => ['role:administrator']], function() {


			// ===================================================================================
			// 
			// 
			//     Corporate User Administrator ONLY
			//     Routes that need the user to be a Corporate User 
			//     Administrator of this Corporation go here.
			// 
			// 
			// ===================================================================================


			/*
			|--------------------------------------------------------------------------
			| View Routes
			|--------------------------------------------------------------------------
			*/	


			/*
			|--------------------------------------------------------------------------
			| Action Routes
			|--------------------------------------------------------------------------
			*/		
			Routes::post('/corporate/{corporate}/corpuser/administrator/updatecorporate', 'CorporateController@updatecorporate');
			Routes::post('/corporate/{corporate}/corpuser/administrator/deactivatecorporate', 'CorporateController@deactivatecorporate');


			/*
			|--------------------------------------------------------------------------
			| Misc Routes
			|--------------------------------------------------------------------------
			*/


		}); // End of middleware 'role:administrator'

	}); // End of middleware 'corpuser'


}); // End of middleware 'auth'



Auth::routes();
