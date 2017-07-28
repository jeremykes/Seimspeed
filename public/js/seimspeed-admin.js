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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carsale']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data['carsale']['id'] + '">' + data['carsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count < 3) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="offerlisterror' + data['carsale']['offer']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="saleOfferReserve(' + data['carsale']['corporate']['id'] + ', ' + data['carsale']['offer']['id'] + ')">accept offer</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="saleOfferReserveCancel(' + data['carsale']['corporate']['id'] + ', ' + data['carsale']['offer']['id'] + ')">delete offer</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['carsale']['id'], data['carsale']['created_at']]);
    updateTimestamps();
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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carsale']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data['carsale']['id'] + '">' + data['carsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count < 3) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="offerlisterror' + data['carsale']['offer']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="saleOfferReserve(' + data['carsale']['corporate']['id'] + ', ' + data['carsale']['offer']['id'] + ')">accept offer</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="saleOfferReserveCancel(' + data['carsale']['corporate']['id'] + ', ' + data['carsale']['offer']['id'] + ')">delete offer</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data['carsale']['id']).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['carsale']['id'], data['carsale']['created_at']]);
    updateTimestamps();
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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carrent']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carrentofferamount' + data['carrent']['id'] + '">' + data['carrent']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carrent']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count == 0) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="offerlisterror' + data['carrent']['offer']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="rentOfferReserve(' + data['carrent']['corporate']['id'] + ', ' + data['carrent']['offer']['id'] + ')">accept offer</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="rentOfferReserveCancel(' + data['carrent']['corporate']['id'] + ', ' + data['carrent']['offer']['id'] + ')">delete offer</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['carrent']['id'], data['carrent']['created_at']]);
    updateTimestamps();
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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['carrent']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carrentofferamount' + data['carrent']['id'] + '">' + data['carrent']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['carrent']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count == 0) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="offerlisterror' + data['carrent']['offer']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="rentOfferReserve(' + data['carrent']['corporate']['id'] + ', ' + data['carrent']['offer']['id'] + ')">accept offer</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="rentOfferReserveCancel(' + data['carrent']['corporate']['id'] + ', ' + data['carrent']['offer']['id'] + ')">delete offer</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data['carrent']['id']).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['carrent']['id'], data['carrent']['created_at']]);
    updateTimestamps();
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
    $('#tender_is_reserved' + data['cartender']['id']).html('<span class="label label-primary">reserved</span>');
}

function CarTenderTenderReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    CarTenderOfferCancelledBuildTrade(data);
}

function CarTenderTenderAddedBuildTrade(data) {
    // Append tender to tenders
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="cartender' + data['cartender']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['cartender']['tender']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['cartender']['tender']['user'] + '">' + data['cartender']['tender']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="tenderdate' + data['cartender']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="cartendertenderamount' + data['cartender']['id'] + '">' + data['cartender']['tender'] + '</span>';
    htmltext += '      <span class="pull-right" id="tender_is_reserved' + data['cartender']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count == 0) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="tenderlisterror' + data['cartender']['tender']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="tenderTenderReserve(' + data['cartender']['corporate']['id'] + ', ' + data['cartender']['tender']['id'] + ')">accept tender</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="tenderTenderReserveCancel(' + data['cartender']['corporate']['id'] + ', ' + data['cartender']['tender']['id'] + ')">delete tender</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['tenderdate' + data['cartender']['id'], data['cartender']['created_at']]);
    updateTimestamps();
}

function CarTenderTenderChangedBuildTrade(data) {
    // Update tender
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['cartender']['tender']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['cartender']['tender']['user'] + '">' + data['cartender']['tender']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="tenderdate' + data['cartender']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="cartendertenderamount' + data['cartender']['id'] + '">' + data['cartender']['tender'] + '</span>';
    htmltext += '      <span class="pull-right" id="tender_is_reserved' + data['cartender']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count == 0) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="tenderlisterror' + data['cartender']['tender']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="tendertenderReserve(' + data['cartender']['corporate']['id'] + ', ' + data['cartender']['tender']['id'] + ')">accept tender</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="tendertenderReserveCancel(' + data['cartender']['corporate']['id'] + ', ' + data['cartender']['tender']['id'] + ')">delete tender</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#cartender' + data['cartender']['id']).html(htmltext);

    // moment.js stuff
    timeArray.push(['tenderdate' + data['cartender']['id'], data['cartender']['created_at']]);
    updateTimestamps();
}

function CarTenderTenderCancelledBuildTrade(data) {
    // Remove specific tender from tenders
    $('#cartender' + data['cartender']['id']).remove();
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
    $('#bid_is_reserved' + data['carauction']['id']).html('<span class="label label-primary">reserved</span>');
}

function CarAuctionBidReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    CarAuctionBidCancelledBuildTrade(data);
}

function CarAuctionBidAddedBuildTrade(data) {
    // Append bid to bids
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="carbid' + data['carauction']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carauction']['bid']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carauction']['bid']['user'] + '">' + data['carauction']['bid']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="biddate' + data['carauction']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carauctionbidamount' + data['carauction']['id'] + '">' + data['carauction']['bid'] + '</span>';
    htmltext += '      <span class="pull-right" id="bid_is_reserved' + data['carauction']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count < 3) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="bidlisterror' + data['carauction']['bid']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="auctionBidReserve(' + data['carauction']['corporate']['id'] + ', ' + data['carauction']['bid']['id'] + ')">accept bid</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="auctionBidReserveCancel(' + data['carauction']['corporate']['id'] + ', ' + data['carauction']['bid']['id'] + ')">delete bid</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    timeArray.push(['biddate' + data['carauction']['id'], data['carauction']['created_at']]);
    updateTimestamps();
}

function CarAuctionBidChangedBuildTrade(data) {
    // Update Bid
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data['carauction']['bid']['user']['imgurl'] + '"> ';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="' + data['carauction']['bid']['user'] + '">' + data['carauction']['bid']['user']['name'] + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="biddate' + data['carauction']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carauctionbidamount' + data['carauction']['id'] + '">' + data['carauction']['bid'] + '</span>';
    htmltext += '      <span class="pull-right" id="bid_is_reserved' + data['carauction']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count < 3) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="bidlisterror' + data['carauction']['bid']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="auctionBidReserve(' + data['carauction']['corporate']['id'] + ', ' + data['carauction']['bid']['id'] + ')">accept bid</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="auctionBidReserveCancel(' + data['carauction']['corporate']['id'] + ', ' + data['carauction']['bid']['id'] + ')">delete bid</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#carbid' + data['carauction']['id']).html(htmltext);

    timeArray.push(['biddate' + data['carauction']['id'], data['carauction']['created_at']]);
    updateTimestamps();
}

function CarAuctionBidCancelledBuildTrade(data) {
    // Remove specific bid from bids
    $('#carauction' + data['carauction']['id']).remove();
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
    htmltext =+ '        <span style="color:gray;font-size:11px" id="partcomment_created_at' + data['partsale']['id'] + '"></span>';
    htmltext =+ '      </span>';
    htmltext =+ '    </p>';
    htmltext =+ '    <p>' + data[i]['comment_comment'] + '</p>';
    htmltext =+ '  </div>';
    htmltext =+ '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['partcomment_created_at' + data['partsale']['id'], data['partsale']['carcomment']['created_at']]);
    updateTimestamps();
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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['partsale']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data['partsale']['id'] + '">' + data['partsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['partsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p class="pull-right">';

    // TODO: set dynamic JS variable reserves_count on page load.
    if (reserves_count < 3) {
        if (user_corp_role == 'sales' || user_corp_role == 'administrator') {
            htmltext += '<span class="label label-danger" id="offerlisterror' + data['partsale']['offer']['user'] + '"></span>';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-success" onclick="partSaleOfferReserve(' + data['partsale']['corporate']['id'] + ', ' + data['partsale']['offer']['id'] + ')">accept offer</a> ';
            htmltext += '<a style="font-size:9px" class="btn btn-xs btn-default" onclick="partSaleOfferReserveCancel(' + data['partsale']['corporate']['id'] + ', ' + data['partsale']['offer']['id'] + ')">delete offer</a> ';
        }
    }

    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['partsale']['id'], data['partsale']['created_at']]);
    updateTimestamps();
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
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data['partsale']['id'] + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data['partsale']['id'] + '">' + data['partsale']['offer'] + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data['partsale']['id'] + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#partoffer' + data['partsale']['id']).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data['partsale']['id'], data['partsale']['created_at']]);
    updateTimestamps();
}

function PartSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#partsale' + data['partsale']['id']).remove();
}


// ------------------- Car/Part Comment Added Functions ------------------ //

function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="carcomment' + data.id + '">';
    htmltext += '  <div class="col-md-1">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '" style="height:40px;width:auto">';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-11">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '        <span style="color:gray;font-size:11px" id="carcomment_created_at' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p>' + data.comment + '</p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['carcomment_created_at' + data.id, data.created_at]);
    updateTimestamps();
}

function PartCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="partcomment' + data.id + '">';
    htmltext += '  <div class="col-md-1">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '" style="height:40px;width:auto">';
    htmltext += '  </div>';

    htmltext += '  <div class="col-md-11">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '        <span style="color:gray;font-size:11px" id="partcomment_created_at' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p>' + data.comment + '</p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['partcomment_created_at' + data.id, data.created_at]);
    updateTimestamps();
}


// ------------------- Trade Actions ------------------ //

// Carsale ===============
function saleOfferReserve(corporateID, carsaleOfferID) {
	// Reserve carsale offer
    $.ajax({
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/saleofferreserve",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/saleofferreservecancel",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/purchasesale",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/rentofferreserve",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/rentofferreservecancel",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/purchaserent",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/rentreturned",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/tendertenderreserve",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/tendertenderreservecancel",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/purchasetender",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/auctionbidreserve",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/auctionbidreservecancel",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/car/purchaseauction",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/part/saleofferreserve",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/part/saleofferreservecancel",
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
        url: base_url + "/corporate/" + corporateID + "/corpuser/sales/part/purchasesale",
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


// ------------------- Misc. Functions ------------------ //

function updateTimestamps() {
    // Update all timestamps on the page using array.
    for (var i = 0; i < timeArray.length; i++) {
        $('#' + timeArray[i][0]).html(moment(timeArray[i][1]).fromNow());
    }
}

