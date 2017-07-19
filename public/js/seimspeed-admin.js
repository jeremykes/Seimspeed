$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});

// ------------------- Trade Builders ------------------ //


// Carsale ==========
function CarSaleClosedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarSaleOfferReservePurchasedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarSaleOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
    $('#offer_is_reserved' + data['carsale']['id']).html('<span class="label label-primary">reserved</span>');
}

function CarSaleOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    CarSaleOfferCancelledBuildTrade(data);
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext =+ '<div class="list-group-item col-md-12" id="carcomment' + data['carsale']['id'] + '">';
    htmltext =+ '  <div class="col-md-1">';
    htmltext =+ '    <img class="img-responsive" src="' + data[i]['comment_user_propic'] + '" style="height:40px;width:auto">';
    htmltext =+ '  </div>';

    htmltext =+ '  <div class="col-md-11">';
    htmltext =+ '    <p>';
    htmltext =+ '      <strong><a href="'+data[i]['comment_user_url']+'">' + data[i]['comment_user_name'] + '</a></strong> ';
    htmltext =+ '      <span class="pull-right">';
    htmltext =+ '        <span style="color:gray;font-size:11px">' + data[i]['comment_created_at'] + '</span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);
}

function CarSaleOfferAddedBuildTrade(data) {
    // Append offer to offers
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="caroffer' + data['carsale']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carsale']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carsale']['offer']['user'] + '">' + data['carsale']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carsale']['id'] + '">' + data['carsale']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data['carsale']['id'] + '">' + data['carsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carsale']['id'] + '"></span>';
    htmltext += '    </p>';

    if (data['carsale']['reserves_count'] < 3) {
        
    }


    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);
}  

function CarSaleOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carsale']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carsale']['offer']['user'] + '">' + data['carsale']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carsale']['id'] + '">' + data['carsale']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data['carsale']['id'] + '">' + data['carsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data['carsale']['id']).html(htmltext);
}

function CarSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#carsale' + data['carsale']['id']).remove();
}


// Carrent ==========
function CarRentClosedBuildTrade(data) {
    // Reload Page
    location.reload();
} 

function CarRentOfferReservePurchasedBuildTrade(data) {
    // Reload Page
    location.reload();
} 

function CarRentOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
    $('#offer_is_reserved' + data['carrent']['id']).html('<span class="label label-primary">reserved</span>');
} 

function CarRentOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    CarRentOfferCancelledBuildTrade(data);
} 

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext =+ '<div class="list-group-item col-md-12" id="carcomment' + data['carrent']['id'] + '">';
    htmltext =+ '  <div class="col-md-1">';
    htmltext =+ '    <img class="img-responsive" src="' + data[i]['comment_user_propic'] + '" style="height:40px;width:auto">';
    htmltext =+ '  </div>';

    htmltext =+ '  <div class="col-md-11">';
    htmltext =+ '    <p>';
    htmltext =+ '      <strong><a href="'+data[i]['comment_user_url']+'">' + data[i]['comment_user_name'] + '</a></strong> ';
    htmltext =+ '      <span class="pull-right">';
    htmltext =+ '        <span style="color:gray;font-size:11px">' + data[i]['comment_created_at'] + '</span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);
} 

function CarRentOfferAddedBuildTrade(data) {
    // Append offer to offers
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="caroffer' + data['carrent']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carrent']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carrent']['offer']['user'] + '">' + data['carrent']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carrent']['id'] + '">' + data['carrent']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carrentofferamount' + data['carrent']['id'] + '">' + data['carrent']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carrent']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);
} 

function CarRentOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carrent']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carrent']['offer']['user'] + '">' + data['carrent']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carrent']['id'] + '">' + data['carrent']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carrentofferamount' + data['carrent']['id'] + '">' + data['carrent']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carrent']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data['carrent']['id']).html(htmltext);
}

function CarRentOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#carrent' + data['carrent']['id']).remove();
} 


// Cartender ==========
function CarTenderClosedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarTenderTenderReservePurchasedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarTenderTenderReservedBuildTrade(data) {
    // Tag Tender as Reserved
    // No action taken
}

function CarTenderTenderReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    // No action taken
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext =+ '<div class="list-group-item col-md-12" id="carcomment' + data['cartender']['id'] + '">';
    htmltext =+ '  <div class="col-md-1">';
    htmltext =+ '    <img class="img-responsive" src="' + data[i]['comment_user_propic'] + '" style="height:40px;width:auto">';
    htmltext =+ '  </div>';

    htmltext =+ '  <div class="col-md-11">';
    htmltext =+ '    <p>';
    htmltext =+ '      <strong><a href="'+data[i]['comment_user_url']+'">' + data[i]['comment_user_name'] + '</a></strong> ';
    htmltext =+ '      <span class="pull-right">';
    htmltext =+ '        <span style="color:gray;font-size:11px">' + data[i]['comment_created_at'] + '</span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);
}

function CarTenderTenderAddedBuildTrade(data) {
    // Append offer to offers
    // No action taken
}

function CarTenderTenderChangedBuildTrade(data) {
    // Update tender
    // No action taken
}

function CarTenderTenderCancelledBuildTrade(data) {
    // Remove specific tender from tenders
    // No action taken
}


// Carauction ==========
function CarAuctionClosedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarAuctionBidReservePurchasedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function CarAuctionBidReservedBuildTrade(data) {
    // Tag Bid as Reserved
    $('#offer_is_reserved' + data['carauction']['id']).html('<span class="label label-primary">reserved</span>');
}

function CarAuctionBidReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    CarAuctionBidCancelledBuildTrade(data);
}

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext =+ '<div class="list-group-item col-md-12" id="carcomment' + data['carauction']['id'] + '">';
    htmltext =+ '  <div class="col-md-1">';
    htmltext =+ '    <img class="img-responsive" src="' + data[i]['comment_user_propic'] + '" style="height:40px;width:auto">';
    htmltext =+ '  </div>';

    htmltext =+ '  <div class="col-md-11">';
    htmltext =+ '    <p>';
    htmltext =+ '      <strong><a href="'+data[i]['comment_user_url']+'">' + data[i]['comment_user_name'] + '</a></strong> ';
    htmltext =+ '      <span class="pull-right">';
    htmltext =+ '        <span style="color:gray;font-size:11px">' + data[i]['comment_created_at'] + '</span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);
}

function CarAuctionBidAddedBuildTrade(data) {
    // Append bid to bids
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="carbid' + data['carauction']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carauction']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carauction']['offer']['user'] + '">' + data['carauction']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carauction']['id'] + '">' + data['carauction']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carauctionofferamount' + data['carauction']['id'] + '">' + data['carauction']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="bid_is_reserved' + data['carauction']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);
}

function CarAuctionBidChangedBuildTrade(data) {
    // Update Bid
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carauction']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carauction']['offer']['user'] + '">' + data['carauction']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carauction']['id'] + '">' + data['carauction']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carauctionofferamount' + data['carauction']['id'] + '">' + data['carauction']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carauction']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#carbid' + data['carauction']['id']).html(htmltext);
}

function CarAuctionBidCancelledBuildTrade(data) {
    // Remove specific bid from bids
    $('#cartender' + data['cartender']['id']).remove();
}


// Partsale ==========
function PartSaleClosedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function PartSaleOfferReservePurchasedBuildTrade(data) {
    // Reload Page
    location.reload();
}

function PartSaleOfferReservedBuildTrade(data) {
    // Tag Offer as Reserved
    $('#offer_is_reserved' + data['partsale']['id']).html('<span class="label label-primary">reserved</span>');
}

function PartSaleOfferReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag
    PartSaleOfferCancelledBuildTrade(data);
}

function PartCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext =+ '<div class="list-group-item col-md-12" id="carcomment' + data['partsale']['id'] + '">';
    htmltext =+ '  <div class="col-md-1">';
    htmltext =+ '    <img class="img-responsive" src="' + data[i]['comment_user_propic'] + '" style="height:40px;width:auto">';
    htmltext =+ '  </div>';

    htmltext =+ '  <div class="col-md-11">';
    htmltext =+ '    <p>';
    htmltext =+ '      <strong><a href="'+data[i]['comment_user_url']+'">' + data[i]['comment_user_name'] + '</a></strong> ';
    htmltext =+ '      <span class="pull-right">';
    htmltext =+ '        <span style="color:gray;font-size:11px">' + data[i]['comment_created_at'] + '</span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);
}

function PartSaleOfferAddedBuildTrade(data) {
    // Append offer to offers
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="partoffer' + data['partsale']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['partsale']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['partsale']['offer']['user'] + '">' + data['partsale']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['partsale']['id'] + '">' + data['partsale']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data['partsale']['id'] + '">' + data['partsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['partsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);
}

function PartSaleOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['partsale']['offer']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['partsale']['offer']['user'] + '">' + data['partsale']['offer']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['partsale']['id'] + '">' + data['partsale']['created_at'] + '</span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data['partsale']['id'] + '">' + data['partsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['partsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#partoffer' + data['partsale']['id']).html(htmltext);
}

function PartSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#partsale' + data['partsale']['id']).remove();
}


// ------------------- Trade Actions ------------------ //

// Carsale ===============
function saleOfferReserve(corporateID, carsaleOfferID) {
	// Reserve carsale offer
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/saleofferreserve",
        type: "POST",
        data: { 
            'carsaleoffer_id': carsaleOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carsale offer as reserved
            } else {
                // small model to display status
            }
        }
    });
}

function saleOfferReserveCancel(corporateID, carsaleOfferID) {
	// Cancel reserve carsale offer
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/saleofferreservecancel",
        type: "POST",
        data: { 
            'carsaleoffer_id': carsaleOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carsale offer as not reserved
            } else {
                // small model to display status
            }
        }
    });
}

function purchaseSale(corporateID, carsaleReserveID) {
	// Purchase carsale reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/purchasesale",
        type: "POST",
        data: { 
            'carsaleofferreserve_id': carsaleOfferReserveID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}

// Carrent ===============
function rentOfferReserve(corporateID, carrentOfferID) {
	// Reserve carrent offer
	$.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/rentofferreserve",
        type: "POST",
        data: { 
            'carrentoffer_id': carrentOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carrent offer as reserved
            } else {
                // small model to display status
            }
        }
    });
}

function rentOfferReserveCancel(corporateID, carrentOfferID) {
	// Cancel reserve carrent offer
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/rentofferreservecancel",
        type: "POST",
        data: { 
            'carrentoffer_id': carrentOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carrent offer as not reserved
            } else {
                // small model to display status
            }
        }
    });
}

function purchaseRent(corporateID, carrentReserveID) {
	// Purchase carrent reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/purchaserent",
        type: "POST",
        data: { 
            'carrentofferreserve_id': carrentOfferReserveID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}

function rentReturned(corporateID, carrentPurchaseID) {
    // Purchase carrent reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/rentreturned",
        type: "POST",
        data: { 
            'carrentpurchase_id': carrentPurchaseID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}

// Cartender ===============
function tenderTenderReserve(corporateID, cartenderTenderID) {
	// Reserve cartender tender
	$.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/tendertenderreserve",
        type: "POST",
        data: { 
            'cartendertender_id': cartenderTenderID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag cartender tender as reserved
            } else {
                // small model to display status
            }
        }
    });
}

function tenderTenderReserveCancel(corporateID, cartenderTenderID) {
	// Cancel reserve cartender tender
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/tendertenderreservecancel",
        type: "POST",
        data: { 
            'cartendertender_id': cartenderTenderID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag cartender tender as not reserved
            } else {
                // small model to display status
            }
        }
    });
}

function purchaseTender(corporateID, cartenderReserveID) {
	// Purchase cartender reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/purchasetender",
        type: "POST",
        data: { 
            'cartendertenderreserve_id': cartenderTenderReserveID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}

// Carauction ===============
function auctionBidReserve(corporateID, carauctionBidID) {
	// Reserve carauction bid
	$.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/auctionbidreserve",
        type: "POST",
        data: { 
            'carauctionbid_id': carauctionBidID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carauction bid as reserved
            } else {
                // small model to display status
            }
        }
    });
}

function auctionBidReserveCancel(corporateID, carauctionBidID) {
	// Cancel reserve carauction bid
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/auctionbidreservecancel",
        type: "POST",
        data: { 
            'carauctionbid_id': carauctionBidID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag carauction bid as not reserved
            } else {
                // small model to display status
            }
        }
    });
}

function purchaseAuction(corporateID, carauctionReserveID) {
	// Purchase carauction reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/car/purchaseauction",
        type: "POST",
        data: { 
            'carauctionbidreserve_id': carauctionBidReserveID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}

// Partsale ===============
function partSaleOfferReserve(corporateID, partsaleOfferID) {
	// Reserve partsale offer
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/part/saleofferreserve",
        type: "POST",
        data: { 
            'partsaleoffer_id': partsaleOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag partsale offer as reserved
            } else {
                // small model to display status
            }
        }
    });
}

function partSaleOfferReserveCancel(corporateID, partsaleOfferID) {
	// Cancel reserve partsale offer
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/part/saleofferreservecancel",
        type: "POST",
        data: { 
            'partsaleoffer_id': partsaleOfferID
        },
        success: function(data) {

            if (data['success'] == true) {
                // tag partsale offer as not reserved
            } else {
                // small model to display status
            }
        }
    });
}

function partPurchaseSale(corporateID, partsaleReserveID) {
	// Purchase partsale reserve
    $.ajax({
        url: "/corporate/" + corporateID + "/corpuser/sales/part/purchasesale",
        type: "POST",
        data: { 
            'partsaleofferreserve_id': partsaleOfferReserveID
        },
        success: function(data) {

            if (data['success'] == true) {
                location.reload();
            } else {
                // small model to display status
            }
        }
    });
}
