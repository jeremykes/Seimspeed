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
Route::get('/corporate/{corporate}/car/{car}/carsale/{carsale}/{notification}', 'FrameworkController@carsale'); // carsale 			
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
		// dashboard


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
