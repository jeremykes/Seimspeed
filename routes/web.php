<?php




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
Route::get('/corporate/{corporate}/car/{car}/carauction/{carauction}/{notification}', 'FrameworkController@carauction'); // carauction 		
// carauctiongroup 	
// cargroup  
Route::get('/corporate/{corporate}/car/{car}/carrent/{carrent}/{notification}', 'FrameworkController@carrent'); // carrent 			
// carrentgroup 	
Route::get('/corporate/{corporate}/car/{car}/carsale/{carsale}/', 'FrameworkController@carsale'); // carsale 			
// carsalegroup  		
Route::get('/corporate/{corporate}/car/{car}/cartender/{cartender}/{notification}', 'FrameworkController@cartender'); // cartender  		
// cartendergroup  	
// cartendertenderers 
// allpartgroups 	
// allparts 		
// allpartsales 	
// partgroup  		
Route::get('/corporate/{corporate}/part/{part}/partsale/{partsale}/{notification}', 'FrameworkController@partsale'); // partsale 		
// partsalegroup 
Route::get('/corporate/{corporate}/{notification}', 'FrameworkController@corporatehome'); // corphome 


/*
|--------------------------------------------------------------------------
| Action Routes
|--------------------------------------------------------------------------
*/		
// SOCIAL LOGIN
// Route::get('/social/redirect/{provider}',   ['as' => 'social.redirect',   'uses' => 'Auth\AuthController@getSocialRedirect']);
// Route::get('/social/handle/{provider}',     ['as' => 'social.handle',     'uses' => 'Auth\AuthController@getSocialHandle']);

// AJAX LOAD CAR MODEL
// Route::post('/loadcarmodels', 'UserController@loadcarmodels');


/*
|--------------------------------------------------------------------------
| Asynchronous Routes
|--------------------------------------------------------------------------
*/


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


	/*
	|--------------------------------------------------------------------------
	| Asynchronous Routes
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


		/*
		|--------------------------------------------------------------------------
		| Action Routes
		|--------------------------------------------------------------------------
		*/		


		/*
		|--------------------------------------------------------------------------
		| Asynchronous Routes
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


			/*
			|--------------------------------------------------------------------------
			| Asynchronous Routes
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


			/*
			|--------------------------------------------------------------------------
			| Asynchronous Routes
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
			| Asynchronous Routes
			|--------------------------------------------------------------------------
			*/


		}); // End of middleware 'role:manager:administrator'

	}); // End of middleware 'corpuser'


}); // End of middleware 'auth'



Auth::routes();
