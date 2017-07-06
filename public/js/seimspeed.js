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
// function newsfeedbuilder(trades, htmlid) {
// 	// page = newsfeed
//     var htmltext = '<div class="panel panel-primary"><div class="panel-body" style="border-radius:0"><div class="col-md-4"><h5>';

//     for (var i = 0; i < trades.length; i++) {

//     	var carOrPart = '';
//     	var image = '';
//     	var corporateName = '';
//     	var timePosted = '';
//     	var type = '';
//     	var description = '';
//     	var numberOfComments = '';
//     	var numberOfTailing = '';
//     	var numberOfOffers = '';
//     	var negotiable = '';
//     	var price = '';

//     	if (trades[i].carorpart) {
//     		carOrPart = trades[i].carorpart;
//     	}
//     	if (trades[i].image) {
//     		image = trades[i].image;
//     	}
//     	if (trades[i].corporatename) {
//     		corporateName = trades[i].corporatename;
//     	}
//     	if (trades[i].timeposted) {
//     		timePosted = trades[i].timeposted;
//     	}
//     	if (trades[i].type) {
//     		type = trades[i].type;
//     	}
//     	if (trades[i].description) {
//     		description = trades[i].description;
//     	}
//     	if (trades[i].numberofcomments) {
//     		numberofcomments = trades[i].numberofcomments;
//     	}
//     	if (trades[i].numberoftailing) {
//     		numberOfTailing = trades[i].numberoftailing;
//     	}
//     	if (trades[i].numberofoffers) {
//     		numberOfOffers = trades[i].numberofoffers;
//     	}
//     	if (trades[i].negotiable) {
//     		negotiable = trades[i].negotiable;
//     	}
//     	if (trades[i].price) {
//     		price = trades[i].price;
//     	}

// 		htmltext += carOrPart;
// 		htmltext += '</h5><img class="img-responsive" src="';
// 		htmltext += image;
// 		htmltext += '"></div><div class="col-md-8"><p><strong>';
// 		htmltext += corporateName;
// 		htmltext += '</strong> <span class="pull-right" style="font-size:10px;color:gray">';
// 		htmltext += timePosted;
// 		htmltext += '&nbsp;&nbsp;<span class="label label-danger" style="font-size:15px">';
// 		htmltext += type;
// 		htmltext += '</span></span></p><p>';
// 		htmltext += description;
// 		htmltext += '</p><p><span style="color:gray;font-size:11px">';
// 		htmltext += numberOfComments;
// 		htmltext += ' <i class="fa fa-comment-o"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
// 		htmltext += numberOfOffers;
// 		htmltext += ' <i class="fa fa-money"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:gray;font-size:11px">';
// 		htmltext += numberOfTailing;
// 		htmltext += ' <i class="fa fa-eye"></i></span></p><p><span style="color:rgb(0,139,188)"><a href="#" style="text-decoration:underline;" onclick="showComments(this)">comment</a>';
// 		htmltext += '&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:underline;" onclick="tail(this)">tail</a>';
// 		htmltext += '</span><span class="pull-right"><span style="font-size:9px;color:grey">';
// 		htmltext += negotiable;
// 		htmltext += '</span>&nbsp;&nbsp;<span class="label label-default" style="font-size:15px">';
// 		htmltext += price;
// 		htmltext += '</span></span></p></div></div></div>';
//     }

//     $('#' + htmlid).prepend(htmltext);

// }

function carsaleBuilder(carsale, htmlid) {
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

	$('#' + htmlid).prepend(htmltext);
	
}

function carrentBuilder(carrent, htmlid) {
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

	$('#canvas').prepend(htmltext);

}

function cartenderBuilder(cartender, htmlid) {
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

	$('#' + htmlid).prepend(htmltext);

}

function carauctionBuilder(carauction, htmlid) {
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

	$('#' + htmlid).prepend(htmltext);

}

function partsaleBuilder(partsale, htmlid) {
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

	$('#' + htmlid).prepend(htmltext);

}

// ADD CARGROUP BUILDER AND PARTGROUP BUILDERS HERE TOO


// ===================================================================================
// 
// 
//     LIST BUILDERS   -   Comments, Offers, Tails, Reservations, Tenders, Bids, 
//     Tenderers, Bidders Builder
// 
// 
// ===================================================================================
function commentsListBuilder(comments, htmlid) {

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

    $('#' + htmlid).prepend(htmltext);

}

function offersListBuilder(offers, htmlid) {

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

	$('#' + htmlid).prepend(htmltext);

}

function tailsListBuilder(tails, htmlid) {

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

    $('#' + htmlid).prepend(htmltext);

}

function reservationListBuilder(reservations, htmlid) {

	var htmltext = '';

	for (var i = 0; i < reservations.length; i++) {
		
		// insert each reservation here

	}
}

function tendersListBuilder(tenders, htmlid) {

	var htmltext = '';

	for (var i = 0; i < tenders.length; i++) {
		
		// insert each tender here

	}
}

function bidsListBuilder(bids, htmlid) {

	var htmltext = '';

	for (var i = 0; i < bids.length; i++) {
		
		// insert each bid here

	}
}

function tenderersListBuilder(tenderers, htmlid) {

	var htmltext = '';

	for (var i = 0; i < tenderers.length; i++) {
		
		// insert each tenderer here

	}
}

function biddersListBuilder(bidders, htmlid) {

	var htmltext = '';

	for (var i = 0; i < bidders.length; i++) {
		
		// insert each bidder here

	}
}

















// NEW FUNCTIONS HERE. 
// Use the above ones if you want to reuse code.


// ------------------- Home & CorpHome ------------------ //

// JS Functions
function checkCorporate(corpID) {
    // Check if this Trade is for this corporation
}

function CarSaleAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carsale' + data['carsale']['id'] + '">';
    htmltext += '<div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="carimage' + data['carsale']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['car']['imgurl'] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <ul class="nav navbar-nav navbar-right">';
    htmltext += '          <li class="dropdown">';
    htmltext += '              <span style="font-size:10px" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">';
    htmltext += '                  Options <span class="caret"></span>';
    htmltext += '              </span>';
    htmltext += '              <ul class="dropdown-menu" role="menu">';
    htmltext += '                  <li><a href="#"><i class="fa fa-btn fa-edit"></i> Edit</a></li>';
    htmltext += '              </ul>';
    htmltext += '          </li>';
    htmltext += '        </ul>';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake' + data['carsale']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="carsaledetails' + data['carsale']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '        <p>';
    htmltext += '          <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>5</span>  <i class="fa fa-comment-o"></i></span></a>';
    htmltext += '          &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '          <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>20</span>  <i class="fa fa-money"></i></span></a>';
    htmltext += '          &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '          <a style="cursor:pointer"><span style="color:gray;font-size:11px"><span>6</span>  <i class="fa fa-eye"></i></span></a>';
    htmltext += '        </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '      <p style="text-align:center"><span style="cursor:pointer" onclick="$(\'#moreinfo\').toggle()"><i class="fa fa-angle-double-down"></i></span></p>';
    htmltext += '      <div style="display:none;" id="moreinfo' + data['carsale']['id'] + '">';
    htmltext += '        <h1>Hi hello!</h1>';
    htmltext += '      </div>';
    htmltext += '   </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('newsfeed').prepend(htmltext);
}

function CarRentAddedBuild(data) {
    // Add to Newsfeed
}

function CarTenderAddedBuild(data) {
    // Add to Newsfeed
}

function CarAuctionAddedBuild(data) {
    // Add to Newsfeed
}

function PartSaleAddedBuild(data) {
    // Add to Newsfeed
}

function CarSaleClosedBuild(data) {
    // Remove item from newsfeed
}

function CarRentClosedBuild(data) {
    // Remove item from newsfeed
}

function CarTenderClosedBuild(data) {
    // Remove item from newsfeed
}

function CarAuctionClosedBuild(data) {
    // Remove item from newsfeed
}

function PartSaleClosedBuild(data) {
    // Remove item from newsfeed
}

function CarSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
}

function CarRentOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
}

function CarTenderTenderReservePurchasedBuild(data) {
    // Remove item from newsfeed
}

function CarAuctionBidReservePurchasedBuild(data) {
    // Remove item from newsfeed
}

function PartSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
}

// ------------------- Home & CorpHome ------------------ //



// ------------------- Trade ------------------ //


// Carsale ==========
function CarSaleClosedBuildTrade(data) {
    // Reload Page
}

function CarSaleOfferReservePurchasedBuildTrade(data) {
    // Reload Page
}

function CarSaleOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
}

function CarSaleOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
}

function CarCommentUpdatedBuildTrade(data) {
    // Update specific comment
}

function CarSaleOfferAddedBuildTrade(data) {
    // Append offer to offers
}   

function CarSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
}


// Carrent ==========
function CarRentClosedBuildTrade(data) {
    // Reload Page
} 

function CarRentOfferReservePurchasedBuildTrade(data) {
    // Reload Page
} 

function CarRentOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
} 

function CarRentOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
} 

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
} 

function CarCommentUpdatedBuildTrade(data) {
    // Update specific comment
} 

function CarRentOfferAddedBuildTrade(data) {
    // Append offer to offers
} 

function CarRentOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
} 


// Cartender ==========
function CarTenderClosedBuildTrade(data) {
    // Reload Page
}

function CarTenderTenderReservePurchasedBuildTrade(data) {
    // Reload Page
}

function CarTenderTenderReservedBuildTrade(data) {
    // Tag Tender as Reserved
}

function CarTenderTenderReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
}

function CarCommentUpdatedBuildTrade(data) {
    // Update specific comment
}

function CarTenderTenderAddedBuildTrade(data) {
    // Append tender to tenders
}

function CarTenderTenderCancelledBuildTrade(data) {
    // Remove specific tender from tenders
}


// Carauction ==========
function CarAuctionClosedBuildTrade(data) {
    // Reload Page
}

function CarAuctionBidReservePurchasedBuildTrade(data) {
    // Reload Page
}

function CarAuctionBidReservedBuildTrade(data) {
    // Tag Bid as Reserved
}

function CarAuctionBidReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
}

function CarCommentUpdatedBuildTrade(data) {
    // Update specific comment
}

function CarAuctionBidAddedBuildTrade(data) {
    // Append bid to bids
}

function CarAuctionBidCancelledBuildTrade(data)) {
    // Remove specific bid from bids
}


// Partsale ==========
function PartSaleClosedBuildTrade(data) {
    // Reload Page
}

function PartSaleOfferReservePurchasedBuildTrade(data) {
    // Reload Page
}

function PartSaleOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
}

function PartSaleOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
}

function PartCommentAddedBuildTrade(data) {
    // Append comment to comments
}

function PartCommentUpdatedBuildTrade(data) {
    // Update specific comment
}

function PartSaleOfferAddedBuildTrade(data) {
    // Append offer to offers
}

function PartSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
}


// ------------------- Trade ------------------ //












