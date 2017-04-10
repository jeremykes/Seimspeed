<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| 
| All guest routes go in here. All routes in here DO NOT require
| the user to be logged into the system.
|
*/
Route::get('/', function () {
	return view('welcome'); 
});



/*
|--------------------------------------------------------------------------
| Main Blade View URL's
|--------------------------------------------------------------------------
| 
| This routes will go the main blade views. They will also have optional parameters
| passed with the URL to determine what dynamic page will be loaded initially too.
|
*/
Route::get('/home', 'HomeController@index');
Route::get('/corporate/{corporate}/home/{page?}', 'FrameworkController@corporatehome'); 

// Ajax test - user send messages
// Route::post('/sendmessage', 'FrameworkController@sendmessage');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| 
| All autheniticated routes go in here. All routes in here require
| the user to be logged into the system.
|
*/
Route::group(['middleware' => ['auth']], function() {


	Route::post('/pusher/auth/{id}', function($id) {
		if ( Auth::user()->id === (int) $id ) {
		  $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
		  echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
		} else {
		  header('', true, 403);
		  echo "Forbidden";
		}
	}); 


	/*
	|--------------------------------------------------------------------------
	| Single Entity Routes
	|--------------------------------------------------------------------------
	| 
	| This routes will show blade templates with single entities. This will be 
	| useful for notification URL's that need to re-route to the entity.
	|
	*/

	Route::get('/carsale/{carsale}/{notification?}', 'FrameworkController@carsale'); 
	Route::get('/carrent/{carrent}/{notification?}', 'FrameworkController@carrent'); 
	Route::get('/cartender/{cartender}/{notification?}', 'FrameworkController@cartender'); 
	Route::get('/carauction/{carauction}/{notification?}', 'FrameworkController@carauction'); 
	Route::get('/partsale/{partsale}/{notification?}', 'FrameworkController@partsale'); 


	/*
	|--------------------------------------------------------------------------
	| Main Blade View URL's
	|--------------------------------------------------------------------------
	| 
	| This routes will go the main blade views. They will also have optional parameters
	| passed with the URL to determine what dynamic page will be loaded initially too.
	|
	*/

	Route::get('/corporate/{corporate}/settings/{page?}', 'FrameworkController@corporatesettings'); 
	Route::get('/corporate/{corporate}/dashboard/{page?}', 'FrameworkController@corporatedashboard'); 


















































































	// OLD CODE DOWN HERE


	/*
	|--------------------------------------------------------------------------
	| Auth routes (up to offers)
	|--------------------------------------------------------------------------
	|
	| All Auth routes up to offers.
	|
	*/
	// Route::get('/corporate/{corporate}/cars', 'UserController@carindex'); 

	// SALES
	// Route::get('/corporate/{corporate}/cars/sales', 'UserController@sales'); 
	// Route::get('/corporate/{corporate}/cars/sales/sale/{carsale}', 'UserController@sale'); 
	// Route::get('/corporate/{corporate}/cars/sales/sale/{carsale}/reserves/car', 'UserController@salereservedcar');
	// Route::get('/corporate/{corporate}/cars/sales/groups', 'UserController@salegroups'); 
	// Route::get('/corporate/{corporate}/cars/sales/groups/group/{cargroup}', 'UserController@salegroup'); 
	// Route::get('/corporate/{corporate}/cars/sales/groups/group/{cargroup}/car/{carsale}', 'UserController@salegroupcar');
// 
	// Route::post('/corporate/{corporate}/cars/sales/sale/{carsale}/carsalepurchase', 'CorporateController@carsalepurchase');
	// Route::post('/corporate/{corporate}/cars/sales/sale/{carsale}/carsalereservedelete', 'CorporateController@carsalereservedelete');
	// Route::post('/corporate/{corporate}/cars/sales/sale/{carsale}/ajaxacceptcarsaleoffer', 'CorporateController@ajaxacceptcarsaleoffer');
// 
	// RENT
	// Route::get('/corporate/{corporate}/cars/rents', 'UserController@rents'); 
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}', 'UserController@rent');
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}/comments', 'UserController@rentcomments');
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}/tails', 'UserController@renttails');  
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}/offers', 'UserController@rentoffers'); 
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}/reserves', 'UserController@rentreserves'); 
	// Route::get('/corporate/{corporate}/cars/rents/rent/{carrent}/reserves/car', 'UserController@rentreservedcar'); 
	// Route::get('/corporate/{corporate}/cars/rents/groups', 'UserController@rentgroups'); 
	// Route::get('/corporate/{corporate}/cars/rents/groups/group/{cargroup}', 'UserController@rentgroup'); 
	// Route::get('/corporate/{corporate}/cars/rents/groups/group/{cargroup}/car/{carrent}', 'UserController@rentgroupcar');
// 
	// AUCTION
	// Route::get('/corporate/{corporate}/cars/auctions', 'UserController@auctions'); 
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}', 'UserController@auction'); 
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}/comments', 'UserController@auctioncomments');
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}/tails', 'UserController@auctiontails');  
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}/bids', 'UserController@auctionbids'); 
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}/reserves', 'UserController@auctionreserves'); 
	// Route::get('/corporate/{corporate}/cars/auctions/auction/{carauction}/reserves/car', 'UserController@auctionreservedcar');
	// Route::get('/corporate/{corporate}/cars/auctions/groups', 'UserController@auctiongroups'); 
	// Route::get('/corporate/{corporate}/cars/auctions/groups/group/{cargroup}', 'UserController@auctiongroup'); 
	// Route::get('/corporate/{corporate}/cars/auctions/groups/group/{cargroup}/car/{carauction}', 'UserController@auctiongroupcar');
// 
	// TENDER
	// Route::get('/corporate/{corporate}/cars/tenders', 'UserController@tenders'); 
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}', 'UserController@tender'); 
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}/comments', 'UserController@tendercomments');
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}/tails', 'UserController@tendertails');  
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}/tenders', 'UserController@tendertenders'); 
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}/reserves', 'UserController@tenderreserves'); 
	// Route::get('/corporate/{corporate}/cars/tenders/tender/{cartender}/reserves/car', 'UserController@tenderreservedcar');
	// Route::get('/corporate/{corporate}/cars/tenders/groups', 'UserController@tendergroups'); 
	// Route::get('/corporate/{corporate}/cars/tenders/groups/group/{cargroup}', 'UserController@tendergroup'); 
	// Route::get('/corporate/{corporate}/cars/tenders/groups/group/{cargroup}/car/{cartender}', 'UserController@tendergroupcar');
// 
// 
	// CORPORATE PART AND ACCESSORIES
// 
	// Route::get('/corporate/{corporate}/parts', 'UserController@partindex');
// 
	// SALES
	// Route::get('/corporate/{corporate}/parts/sales', 'UserController@partsales'); 
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}', 'UserController@partsale'); 
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}/comments', 'UserController@partsalecomments');
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}/tails', 'UserController@partsaletails');  
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}/offers', 'UserController@partsaleoffers'); 
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}/reserves', 'UserController@partsalereserves'); 
	// Route::get('/corporate/{corporate}/parts/sales/sale/{partsale}/reserves/part', 'UserController@partsalereservedpart');
	// Route::get('/corporate/{corporate}/parts/sales/groups', 'UserController@partsalegroups'); 
	// Route::get('/corporate/{corporate}/parts/sales/groups/group/{partgroup}', 'UserController@partsalegroup'); 
	// Route::get('/corporate/{corporate}/parts/sales/groups/group/{partgroup}/part/{partsale}', 'UserController@partsalegrouppart');
// 
});

Auth::routes();
