$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});

// ===================================================================================
// 
// 
//     HOME AND CORPORATE HOME VIEWS   -   Dynamic Page Builders (add car and part groups later)
// 
// 
// ===================================================================================
function newsfeedbuilder(trades) {
	// page = newsfeed
    var htmltext = '<div class="panel panel-primary"><div class="panel-body" style="border-radius:0"><div class="col-md-4"><h5>';

    for (var i = 0; i < trades.length; i++) {

    	var carOrPart = '';
    	var image = '';
    	var corporateName = '';
    	var timePosted = '';
    	var type = '';
    	var description = '';
    	var numberOfComments = '';
    	var numberOfTailing = '';
    	var numberOfOffers = '';
    	var negotiable = '';
    	var price = '';

    	if (trades[i].carorpart) {
    		carOrPart = trades[i].carorpart;
    	}
    	if (trades[i].image) {
    		image = trades[i].image;
    	}
    	if (trades[i].corporatename) {
    		corporateName = trades[i].corporatename;
    	}
    	if (trades[i].timeposted) {
    		timePosted = trades[i].timeposted;
    	}
    	if (trades[i].type) {
    		type = trades[i].type;
    	}
    	if (trades[i].description) {
    		description = trades[i].description;
    	}
    	if (trades[i].numberofcomments) {
    		numberofcomments = trades[i].numberofcomments;
    	}
    	if (trades[i].numberoftailing) {
    		numberOfTailing = trades[i].numberoftailing;
    	}
    	if (trades[i].numberofoffers) {
    		numberOfOffers = trades[i].numberofoffers;
    	}
    	if (trades[i].negotiable) {
    		negotiable = trades[i].negotiable;
    	}
    	if (trades[i].price) {
    		price = trades[i].price;
    	}

		htmltext += carOrPart;
		htmltext += '</h5><img class="img-responsive" src="';
		htmltext += image;
		htmltext += '"></div><div class="col-md-8"><p><strong>';
		htmltext += corporateName;
		htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
		htmltext += timePosted;
		htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
		htmltext += type;
		htmltext += '</span></span></p><p>';
		htmltext += description;
		htmltext += '</p><p><span style="color:gray;font-size:11px">';
		htmltext += numberOfComments;
		htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
		htmltext += numberOfOffers;
		htmltext += ' <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
		htmltext += numberOfTailing;
		htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
		htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
		htmltext += '</span><span class="pull-right"><span style="font-size:9px;color:grey">';
		htmltext += negotiable;
		htmltext += '</span>&nbsp;&nbsp;<span class="label label-default" style="font-size:15px">';
		htmltext += price;
		htmltext += '</span></span></p></div></div></div>';
    }

    $('#newsfeed').append(htmltext);

}

function carsaleBuilder(carsale) {
	// page = carsale
	var htmltext = '';

    htmltext += 'Car';
	htmltext += '</h5><img class="img-responsive" src="';
	htmltext += carsale.image;
	htmltext += '"></div><div class="col-md-8"><p><strong>';
	htmltext += carsale.corporateName;
	htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
	htmltext += carsale.timePosted;
	htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
	htmltext += carsale.type;
	htmltext += '</span></span></p><p>';
	htmltext += carsale.description;
	htmltext += '</p><p><span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfComments;
	htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfOffers;
	htmltext += ' <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfTailing;
	htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
	htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
	htmltext += '</span><span class="pull-right"><span style="font-size:9px;color:grey">';
	htmltext += carsale.negotiable;
	htmltext += '</span>&nbsp;&nbsp;<span class="label label-default" style="font-size:15px">';
	htmltext += carsale.price;
	htmltext += '</span></span></p></div></div></div>';

	$('#canvas').append(htmltext);
	
}

function carrentBuilder(carrent) {
	// page = carrent
    var htmltext = '';

    htmltext += 'Car';
	htmltext += '</h5><img class="img-responsive" src="';
	htmltext += carrent.image;
	htmltext += '"></div><div class="col-md-8"><p><strong>';
	htmltext += carrent.corporateName;
	htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
	htmltext += carrent.timePosted;
	htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
	htmltext += carrent.type;
	htmltext += '</span></span></p><p>';
	htmltext += carrent.description;
	htmltext += '</p><p><span style="color:gray;font-size:11px">';
	htmltext += carrent.numberOfComments;
	htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carrent.numberOfTailing;
	htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
	htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
	htmltext += '</span><span class="pull-right">';
	htmltext += '<span class="label label-default" style="font-size:15px">';
	htmltext += carrent.price;
	htmltext += '</span></span></p></div></div></div>';

	$('#canvas').append(htmltext);

}

function cartenderBuilder(cartender) {
	// page = cartender
    var htmltext = '';

    htmltext += 'Car';
	htmltext += '</h5><img class="img-responsive" src="';
	htmltext += cartender.image;
	htmltext += '"></div><div class="col-md-8"><p><strong>';
	htmltext += cartender.corporateName;
	htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
	htmltext += cartender.timePosted;
	htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
	htmltext += cartender.type;
	htmltext += '</span></span></p><p>';
	htmltext += cartender.description;
	htmltext += '</p><p><span style="color:gray;font-size:11px">';
	htmltext += cartender.numberOfComments;
	htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += cartender.numberOfTailing;
	htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
	htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
	htmltext += '</span><span class="pull-right">';
	htmltext += '</span></p></div></div></div>';

	$('#canvas').append(htmltext);

}

function carauctionBuilder(carauction) {
	// page = carauction
    var htmltext = '';

    htmltext += 'Car';
	htmltext += '</h5><img class="img-responsive" src="';
	htmltext += carauction.image;
	htmltext += '"></div><div class="col-md-8"><p><strong>';
	htmltext += carauction.corporateName;
	htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
	htmltext += carauction.timePosted;
	htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
	htmltext += carauction.type;
	htmltext += '</span></span></p><p>';
	htmltext += carauction.description;
	htmltext += '</p><p><span style="color:gray;font-size:11px">';
	htmltext += carauction.numberOfComments;
	htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carauction.numberOfOffers;
	htmltext += ' <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carauction.numberOfTailing;
	htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
	htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
	htmltext += '</span><span class="pull-right">';
	htmltext += '</span></p></div></div></div>';

	$('#canvas').append(htmltext);

}

function partsaleBuilder(partsale) {
	// page = partsale
    var htmltext = '';

    htmltext += 'Part';
	htmltext += '</h5><img class="img-responsive" src="';
	htmltext += carsale.image;
	htmltext += '"></div><div class="col-md-8"><p><strong>';
	htmltext += carsale.corporateName;
	htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
	htmltext += carsale.timePosted;
	htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
	htmltext += carsale.type;
	htmltext += '</span></span></p><p>';
	htmltext += carsale.description;
	htmltext += '</p><p><span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfComments;
	htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfOffers;
	htmltext += ' <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
	htmltext += carsale.numberOfTailing;
	htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
	htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
	htmltext += '</span><span class="pull-right"><span style="font-size:9px;color:grey">';
	htmltext += carsale.negotiable;
	htmltext += '</span>&nbsp;&nbsp;<span class="label label-default" style="font-size:15px">';
	htmltext += carsale.price;
	htmltext += '</span></span></p></div></div></div>';

	$('#canvas').append(htmltext);

}



// ===================================================================================
// 
// 
//     SETTINGS VIEW - Settings, Members, Roles, Account Builder
// 
// 
// ===================================================================================
function settingsBuilder(settings) {
	// page = settings
	var htmltext = '';

	// insert each setting value into a form field here.

    $('#canvas').append(htmltext);

}

function membersBuilder(members) {
	// members
	var htmltext = '';

	for (var i = 0; i < members.length; i++) {
		
		// insert each member here.

	}

    $('#canvas').append(htmltext);

}

function accountBuilder(account) {
	// page = account
	var htmltext = '';

	// insert each account value into a form field here.

    $('#canvas').append(htmltext);

}



// ===================================================================================
// 
// 
//     CORPORATE DASHBOARD VIEW - Dashboard, Transactions, Reports, History, Trades. 
//     Similar to the above but will append some more details about the trades like 
//     reservation list, tenders list, bids list, tenderers list, bidders list.
// 
// 
// ===================================================================================
function dashboardBuilder(dashboard) {
	// page = dashboard
	var htmltext = '';

	// insert each dashboard summary value into a form field here.

    $('#canvas').append(htmltext);

}

function reportsBuilder(reports) {
	// page = reports
	var htmltext = '';

	// insert each reports generation button here.

    $('#canvas').append(htmltext);

}

function allCarsBuilder(cars) {
	// page = allcars
	var htmltext = '';

	for (var i = 0; i < cars.length; i++) {
		
		// insert each car here.

	}

    $('#canvas').append(htmltext);

}

function allPartsBuilder(parts) {
	// page = allparts
	var htmltext = '';

	for (var i = 0; i < parts.length; i++) {
		
		// insert each part here.

	}

    $('#canvas').append(htmltext);

}

function allCarsalesBuilder(carsales) {
	// page = allcarsales
	var htmltext = '';

	for (var i = 0; i < carsales.length; i++) {
		
		// insert each carsale here.

	}

    $('#canvas').append(htmltext);

}

function allCarrentsBuilder(carrents) {
	// page = allcarrents
	var htmltext = '';

	for (var i = 0; i < carrents.length; i++) {
		
		// insert each carrent here.

	}

    $('#canvas').append(htmltext);

}

function allCartendersBuilder(cartenders) {
	// page = allcartenders
	var htmltext = '';

	for (var i = 0; i < cartenders.length; i++) {
		
		// insert each cartender here.

	}

    $('#canvas').append(htmltext);

}

function allCarauctionsBuilder(carauctions) {
	// page = allcarauctions
	var htmltext = '';

	for (var i = 0; i < carauctions.length; i++) {
		
		// insert each carauction here.

	}

    $('#canvas').append(htmltext);

}

function allPartsalesBuilder(partsales) {
	// page = allpartsales
	var htmltext = '';

	for (var i = 0; i < partsales.length; i++) {
		
		// insert each partsale here.

	}

    $('#canvas').append(htmltext);

}



// ===================================================================================
// 
// 
//     LIST BUILDERS   -   Comments, Offers, Tails, Reservations, Tenders, Bids, 
//     Tenderers, Bidders Builder
// 
// 
// ===================================================================================
function commentsListBuilder(comments) {

	var htmltext = '';

	for (var i = 0; i < comments.length; i++) {
        htmltext += '<div class="list-group-item col-md-12"><div class="col-md-1"><img class="img-responsive" src="';
        htmltext += comments[i]['comment_user_propic'];
        htmltext += '" style="height:40px;width:auto"></div><div class="col-md-11"><p><strong><a href="';
        htmltext += comments[i]['comment_user_url'];
        htmltext += '">';
        htmltext += comments[i]['comment_user_name'];
        htmltext += '</a></strong> <span class="pull-right"><span style="color:gray;font-size:11px">';
        htmltext += comments[i]['comment_created_at'];
        htmltext += '</span></span></p><p>';
        htmltext += comments[i]['comment_comment'];
        htmltext += '</p></div></div>';
    }

    $('#comments').append(htmltext);

}

function offersListBuilder(offers) {

	var htmltext = '';

	for (var i = 0; i < offers.length; i++) {
	    htmltext += '<div class="list-group-item col-md-12"><div class="col-md-2"><img class="img-responsive" src="';
	    htmltext += offers[i]['offer_user_propic'];
	    htmltext += '"> </div><div class="col-md-10"><p><strong><a href="';
	    htmltext += offers[i]['offer_user_url'];
	    htmltext += '">';
	    htmltext += offers[i]['offer_user_name'];
	    htmltext += '</a></strong><span class="pull-right"><span style="color:gray;font-size:11px">';
	    htmltext += offers[i]['offer_created_at'];
	    htmltext += '</span></span></p><p style="font-size:18px">K';
	    htmltext += offers[i]['offer_offer'];
	    htmltext += '</p><p class="pull-right">';
	    
	    if (offers['offer_reserves_count'] < 3 && offers['corporate_user'] == true && offers['has_role_sales_or_admin'] == true) {
	      htmltext += '<span class="label label-danger" id="offerlisterror';
	      htmltext += offers[i]['offer_id'];
	      htmltext += '"></span><a style="font-size:9px" class="btn btn-xs btn-success" onclick="acceptOffer(';
	      htmltext += offers[i]['offer_id'];
	      htmltext += ')">accept offer</a><a style="font-size:9px" class="btn btn-xs btn-default" onclick="deleteOffer(';
	      htmltext += offers[i]['offer_id'];
	      htmltext += ')">delete offer</a>';
	    }

	    htmltext += '</p></div></div>';
	}

	$('#offers').append(htmltext);

}

function tailsListBuilder(tails) {

	var htmltext = '';

	for (var i = 0; i < tail.length; i++) {
    	htmltext += '<div class="list-group-item col-md-12"><div class="col-md-12" style="padding:10px;"><a href="';
    	htmltext += tail[i]['tail_user_url'];
    	htmltext += '"><img src="';
    	htmltext += tail[i]['tail_user_propic'];
    	htmltext += '" style="height:50px;width:auto">&nbsp;&nbsp;&nbsp;<strong>';
    	htmltext += tail[i]['tail_user_name'];
    	htmltext += '</strong></a><span class="pull-right"><span style="color:gray;font-size:11px">';
    	htmltext += tail[i]['tail_created_at'];
    	htmltext += '</span></span></div></div>';
    }

    $('#tails').append(htmltext);

}

function reservationListBuilder(reservations) {

	var htmltext = '';

	for (var i = 0; i < reservations.length; i++) {
		
		// insert each reservation here

	}
}

function tendersListBuilder(tenders) {

	var htmltext = '';

	for (var i = 0; i < tenders.length; i++) {
		
		// insert each tender here

	}
}

function bidsListBuilder(bids) {

	var htmltext = '';

	for (var i = 0; i < bids.length; i++) {
		
		// insert each bid here

	}
}

function tenderersListBuilder(tenderers) {

	var htmltext = '';

	for (var i = 0; i < tenderers.length; i++) {
		
		// insert each tenderer here

	}
}

function biddersListBuilder(bidders) {

	var htmltext = '';

	for (var i = 0; i < bidders.length; i++) {
		
		// insert each bidder here

	}
}
