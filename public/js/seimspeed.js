$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});


// ------------------- Home & CorpHome Builders ------------------ //

function CarSaleAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carsale' + data['carsale']['id'] + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="carimage' + data['carsale']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['car']['imgurl'][0] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake' + data['carsale']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="carsaledetails' + data['carsale']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);
}

function CarRentAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carrent' + data['carrent']['id'] + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="carimage' + data['carrent']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['car']['imgurl'][0] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake' + data['carrent']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">rent</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="carrentdetails' + data['carrent']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);
}

function CarTenderAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="cartender' + data['cartender']['id'] + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="carimage' + data['cartender']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['car']['imgurl'][0] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake' + data['cartender']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">tender</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="cartenderdetails' + data['cartender']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Tender</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);
}

function CarAuctionAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carauction' + data['carauction']['id'] + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="carimage' + data['carauction']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['car']['imgurl'][0] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="carmake' + data['carauction']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">auction</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="carauctiondetails' + data['carauction']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Bid</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);
}

function PartSaleAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="partsale' + data['partsale']['id'] + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3" id="partimage' + data['partsale']['id'] + '">';
    htmltext += '      <img class="img-responsive" src="' + data['part']['imgurl'][0] +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span id="partmake' + data['partsale']['id'] + '">Toyota</span>, White, 4-wheel drive</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label>&nbsp;<span style="font-size:20px">K10,000</span></p>';
    htmltext += '        <p id="partsaledetails' + data['partsale']['id'] + '">Plates: Ivory. Location: Martinique Sequi unde doloribus voluptas consequatur. Possimus adipisci in labore.</p>';
    htmltext += '        <p>In group <a href="#"><span class="label label-primary">go to group</span></a> </p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-comment"></i> Comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-money"></i> Offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="#" style="cursor:pointer"><i class="fa fa-eye"></i> Tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);
}

function CarSaleClosedBuild(data) {
    // Remove item from newsfeed
    $('#carsale' + data['carsale']['id']).remove();
}

function CarRentClosedBuild(data) {
    // Remove item from newsfeed
    $('#carrent' + data['carrent']['id']).remove();
}

function CarTenderClosedBuild(data) {
    // Remove item from newsfeed
    $('#cartender' + data['cartender']['id']).remove();
}

function CarAuctionClosedBuild(data) {
    // Remove item from newsfeed
    $('#carauction' + data['carauction']['id']).remove();
}

function PartSaleClosedBuild(data) {
    // Remove item from newsfeed
    $('#partsale' + data['partsale']['id']).remove();
}

function CarSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carsale' + data['carsale']['id']).remove();
}

function CarRentOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carrent' + data['carrent']['id']).remove();
}

function CarTenderTenderReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#cartender' + data['cartender']['id']).remove();
}

function CarAuctionBidReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carauction' + data['carauction']['id']).remove();
}

function PartSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#partsale' + data['partsale']['id']).remove();
}




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

    htmltext += '<div class="list-group-item col-md-12" id="caroffer' + data.id + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
    updateTimestamps();
}  

function CarSaleOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data.id).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
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

    htmltext += '<div class="list-group-item col-md-12" id="caroffer' + data.id + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
    updateTimestamps();
} 

function CarRentOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#caroffer' + data.id).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
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
    // No action taken
}

function CarTenderTenderReserveCancelledBuildTrade(data) {
    // Remove Reserved Tag 
    // No action taken
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

function CarAuctionBidAddedBuildTrade(data) {
    // Append bid to bids
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="carbid' + data['carauction']['id'] + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="biddate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsalebidamount' + data.id + '">K' + formatCurrency(data.bid) + '</span>';
    htmltext += '      <span class="pull-right" id="bid_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['biddate' + data.id, data.created_at]);
    updateTimestamps();
}

function CarAuctionBidChangedBuildTrade(data) {
    // Update Bid
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="carsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#carbid' + data.id).html(htmltext);

    // moment.js stuff
    timeArray.push(['biddate' + data.id, data.created_at]);
    updateTimestamps();
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

function PartSaleOfferAddedBuildTrade(data) {
    // Append offer to offers
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="partoffer' + data.id + '">';
    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#list').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
    updateTimestamps();
}

function PartSaleOfferChangedBuildTrade(data) {
    // Update offer
    var htmltext = '';

    htmltext += '  <div class="col-md-2">';
    htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p>';
    htmltext += '      <strong><a href="'+ base_url + '/user/' + data.user_id + '">' + data.name + '</a></strong> ';
    htmltext += '      <span class="pull-right">';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '      </span>';
    htmltext += '    </p>';
    htmltext += '    <p style="font-size:18px"><span id="partsaleofferamount' + data.id + '">K' + formatCurrency(data.offer) + '</span>';
    htmltext += '      <span class="pull-right" id="offer_is_reserved' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '  </div>';

    $('#partoffer' + data.id).html(htmltext);

    // moment.js stuff
    timeArray.push(['offerdate' + data.id, data.created_at]);
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


// ------------------- Ajax Call Functions ------------------ //


function belongsToThisCorp(corpID,dataCorpID) {
    // Check events to see if they belong to THIS corporate (CorpHome Events)
    if (corpID == dataCorpID) {
        return true;
    } else {
        return false;
    }
}

// Submit/Cancel Offers/Bids/Tenders ============
function submitCarSaleOffer(carsaleID) {
    // Submit Offer for CarSale
    $.ajax({
        url: base_url + "/auth/carsaleoffer",
        type: "POST",
        data: { 
            'carsale_id': carsaleID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully submitted your offer.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function cancelCarSaleOffer(carsaleID, carsaleOfferID) {
    // cancel Offer for CarSale
    $.ajax({
        url: base_url + "/auth/carsaleoffercancel",
        type: "POST",
        data: { 
            'carsale_id': carsaleID,
            'carsaleoffer_id': carsaleOfferID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully cancelled your offer.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function submitCarRentOffer(carrentID) {
    // Submit Offer for CarRent
    $.ajax({
        url: base_url + "/auth/carrentoffer",
        type: "POST",
        data: { 
            'carrent_id': carrentID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully submitted your offer.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function cancelCarRentOffer(carrentID, carrentOfferID) {
    // cancel Offer for CarRent
    $.ajax({
        url: base_url + "/auth/carrentoffercancel",
        type: "POST",
        data: { 
            'carrent_id': carrentID,
            'carrentoffer_id': carrentOfferID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function submitCarTenderTender(cartenderID) {
    // Submit Tender for CarTender
    $.ajax({
        url: base_url + "/auth/cartendertender",
        type: "POST",
        data: { 
            'cartender_id': cartenderID,
            'tender': $('#tender').val()
        },
        success: function(data) {
            $('#tender').val('');

            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully submitted your tender.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function cancelCarTenderTender(cartenderID, cartenderTenderID) {
    // cancel Tender for CarTender
    $.ajax({
        url: base_url + "/auth/carrentoffercancel",
        type: "POST",
        data: { 
            'cartender_id': cartenderID,
            'cartendertender_id': cartenderTenderID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully cancelled your tender.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function submitCarAuctionBid(carauctionID) {
    // Submit Bid for CarAuction
    $.ajax({
        url: base_url + "/auth/carauctionbid",
        type: "POST",
        data: { 
            'carauction_id': carauctionID,
            'bid': $('#bid').val()
        },
        success: function(data) {
            $('#bid').val('');

            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully submitted your bid.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function cancelCarAuctionBid(carauctionID, carauctionBidID) {
    // cancel Bid for CarAuction
    $.ajax({
        url: base_url + "/auth/carauctionbidcancel",
        type: "POST",
        data: { 
            'carauction_id': carauctionID,
            'carauctionbid_id': carauctionBidID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully cancelled your bid.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function submitPartSaleOffer(partsaleID) {
    // Submit Offer for PartSale
    $.ajax({
        url: base_url + "/auth/partsaleoffer",
        type: "POST",
        data: { 
            'partsale_id': partsaleID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully submitted your offer.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

function cancelPartSaleOffer(partsaleID, partsaleOfferID) {
    // cancel Offer for PartSale
    $.ajax({
        url: base_url + "/auth/partsaleoffercancel",
        type: "POST",
        data: { 
            'partsale_id': partsaleID,
            'partsaleoffer_id': partsaleOfferID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
                $('#statudModalBody').html('You have successfully cancelled your offer.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            } else {
                // small model to display status
                $('#statudModalBody').html('Oops something went wrong :( <br>Please refresh and try again.');
                setTimeout(function() {
                    $('#statusModal').modal('hide');
                }, 2000);
            }
        }
    });
}

// Get Offers/Bids/Tenders ============
function getCarSaleOffers(carsaleID) {
    // get car offers and append
    $.ajax({
        url: base_url + "/getcarsaleoffers",
        type: "GET",
        data: { 
            'carsale_id': carsaleID
        },
        success: function(data) {
            if (data['success'] == true) {
                var carSaleOffers = data['carsaleoffers'];
                $('#list').html('');
                for (var i = 0; i < carSaleOffers.length; i++) {
                    CarSaleOfferAddedBuildTrade(carSaleOffers[i]);
                }
            }
        }
    });
}

function getCarRentOffers(carrentID) {
    // get car offers and append
    $.ajax({
        url: base_url + "/getcarrentoffers",
        type: "GET",
        data: { 
            'carrent_id': carrentID
        },
        success: function(data) {
            if (data['success'] == true) {
                var carRentOffers = data['carrentoffers'];

                for (var i = 0; i < carRentOffers; i++) {
                    CarRentOfferAddedBuildTrade(carRentOffers[i]);
                }
            }
        }
    });
}

function getCarTenderTenders(cartenderID) {
    // get car tenders and append
    $.ajax({
        url: base_url + "/getcartendertenders",
        type: "GET",
        data: { 
            'cartender_id': cartenderID
        },
        success: function(data) {
            if (data['success'] == true) {
                var carTenderTenders = data['cartendertenders'];

                for (var i = 0; i < carTenderTenders; i++) {
                    CarTenderTenderAddedBuildTrade(carTenderTenders[i]);
                }
            }
        }
    });
}

function getCarAuctionBids(carauctionID) {
    // get car bids and append
    $.ajax({
        url: base_url + "/getcarauctionbids",
        type: "GET",
        data: { 
            'carauction_id': carauctionID
        },
        success: function(data) {
            if (data['success'] == true) {
                var carAuctionBids = data['carauctionbids'];

                for (var i = 0; i < carAuctionBids; i++) {
                    CarAuctionBidAddedBuildTrade(carAuctionBids[i]);
                }
            }
        }
    });
}

function getPartSaleOffers(partsaleID) {
    // get part comments and append
    $.ajax({
        url: base_url + "/getpartsaleoffers",
        type: "GET",
        data: { 
            'partsale_id': partsaleID
        },
        success: function(data) {
            if (data['success'] == true) {
                var PartSaleOffers = data['Partsaleoffers'];

                for (var i = 0; i < PartSaleOffers; i++) {
                    partSaleOfferAddedBuildTrade(PartSaleOffers[i]);
                }
            }
        }
    });
}

// Get Comments/Tails ============
function getCarComments(carID) {
	// get car comments and append
    $.ajax({
        url: base_url + "/getcarcomments",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            if (data.success == true) {
                $('#list').html('');
                for (var i = 0; i < data.carcomments.length; i++) {
                    CarCommentAddedBuildTrade(data.carcomments[i]);
                }
            }
        }
    });
} 

function getPartComments(partID) {
	// get part comments and append
    $.ajax({
        url: base_url + "/getpartcomments",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            if (data.success == true) {
                $('#list').html('');
                for (var i = 0; i < data.partcomments.length; i++) {
                    PartCommentAddedBuildTrade(data.carcomments[i]);
                }
            }
        }
    });
}

function getCarTails(carID) {
	// get car Tails and append
    $.ajax({
        url: base_url + "/getcartails",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            if (data.success == true) {
                $('#list').html('');
                htmltext = '';
                for (var i = 0; i < data.cartails.length; i++) {
                    htmltext += '<div class="list-group-item col-md-12">';
                    htmltext += '  <div class="col-md-12" style="padding:10px;">';
                    htmltext += '    <a href="'+ base_url + '/user/' + data.cartails[i].user_id + '">';
                    htmltext += '      <img src="' + data.cartails[i].propic + '" style="height:50px;width:auto">';
                    htmltext += '      &nbsp;&nbsp;&nbsp;';
                    htmltext += '      <strong>' + data.cartails[i].name + '</strong>';
                    htmltext += '    </a>';
                    htmltext += '  </div>';
                    htmltext += '</div>';
                }

                $('#list').append(htmltext);
            }
        }
    });
}

function getPartTails(partID) {
	// get part Tails and append
    $.ajax({
        url: base_url + "/getparttails",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            if (data.success == true) {
                htmltext = '';
                for (var i = 0; i < data.parttails.length; i++) {
                    htmltext += '<div class="list-group-item col-md-12">';
                    htmltext += '  <div class="col-md-12" style="padding:10px;">';
                    htmltext += '    <a href="'+ base_url + '/user/' + data.parttails[i].user_id + '">';
                    htmltext += '      <img src="' + data.parttails[i].propic + '" style="height:50px;width:auto">';
                    htmltext += '      &nbsp;&nbsp;&nbsp;';
                    htmltext += '      <strong>' + data.parttails[i].name + '</strong>';
                    htmltext += '    </a>';
                    htmltext += '  </div>';
                    htmltext += '</div>';
                }

                $('#list').append(htmltext);
            }
        }
    });
}


// ------------------- Post Functions ------------------ //


function rate(corporateID, rate) {
    // tail the corporate/also untail corporate is same function (backend function toggles it)
    $.ajax({
        url: base_url + "/auth/rate",
        type: "POST",
        data: { 
            'corporate_id': corporateID,
            'rate': rate
        },
        success: function(data) {
            if (data['success'] == true) {
                // color icon
            }
        }
    });
}

function tailCorporate(corporateID) {
    // tail the corporate/also untail corporate is same function (backend function toggles it)
    $.ajax({
        url: base_url + "/auth/tailcorporate",
        type: "POST",
        data: { 
            'corporate_id': corporateID
        },
        success: function(data) {
            if (data['success'] == true) {
                // color icon
            }
        }
    });
}

function postNewCarComment(carID) {
	// post new comment from user
    $.ajax({
        url: base_url + "/auth/addcarcomment",
        type: "POST",
        data: { 
            'comment': $('#comment').val(),
            'car_id': carID
        },
        success: function(data) {
            $('#comment').val('');
        }
    });
}

function postReplyCarComment(carID, parentCommentID) {
	// post reply comment from user to another comment
    $.ajax({
        url: base_url + "/auth/addcarcomment",
        type: "POST",
        data: { 
            'comment': $('#commentreply').val(),
            'parentcomment_id': parentCommentID,
            'car_id': carID
        },
        success: function(data) {
            $('#commentreply').val('');
        }
    });
}

function deleteCarComment(carID, commentID) {
	// delete users car comment
    $.ajax({
        url: base_url + "/auth/deletecarcomment",
        type: "POST",
        data: { 
            'comment_id': commentID
        },
        success: function(data) {
            if (data['success'] == true) {
                $('#comment' + commentID).remove();
            }
        }
    });
}

function postNewPartComment(partID) {
	// post new comment from user
    $.ajax({
        url: base_url + "/auth/addpartcomment",
        type: "POST",
        data: { 
            'comment': $('#comment').val(),
            'part_id': partID
        },
        success: function(data) {
            $('#comment').val('');
        }
    });
}

function postReplyPartComment(partID, parentCommentID) {
	// post reply comment from user to another comment
    $.ajax({
        url: base_url + "/auth/addpartcomment",
        type: "POST",
        data: { 
            'comment': $('#commentreply').val(),
            'parentcomment_id': parentCommentID,
            'part_id': partID
        },
        success: function(data) {
            $('#commentreply').val('');
        }
    });
}

function deletePartComment(partID) {
	// delete users part comment
    $.ajax({
        url: base_url + "/auth/deletepartcomment",
        type: "POST",
        data: { 
            'comment_id': commentID
        },
        success: function(data) {
            if (data['success'] == true) {
                $('#comment' + commentID).remove();
            }
        }
    });
}

function tailCar(carID) {
	// tail the car/also untail car is same function (backend function toggles it)
    $.ajax({
        url: base_url + "/auth/tailcar",
        type: "POST",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            if (data['success'] == true) {
                // color icon
            }
        }
    });
}

function tailPart(partID) {
	// tail the part/also untail part is same function (backend function toggles it)
    $.ajax({
        url: base_url + "/auth/tailcar",
        type: "POST",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            if (data['success'] == true) {
                // color icon
            }
        }
    });
}


// ------------------- Misc. Functions ------------------ //

function isCorpUser(corpID) {
    // check if the current user is a corp user for this corp.
    $.ajax({
        url: base_url + "/iscorpuser",
        type: "POST",
        data: { 
            'corp_id': corpID
        },
        success: function(data) {
            if (data['success'] == true) {
                // continue
                return true;
            } else {
                // discontinue
                return false;
            }
        }
    });
}

function hasCorpUserRole(corpID, role) {
    // check if the current user has this corp user role for this corp.
    $.ajax({
        url: base_url + "/hascorpuserrole",
        type: "POST",
        data: { 
            'corp_id': corpID,
            'role': role,
        },
        success: function(data) {
            if (data['success'] == true) {
                // continue
                return true;
            } else {
                // discontinue
                return false;
            }
        }
    });
}

function updateTimestamps() {
    // Update all timestamps on the page using array.
    for (var i = 0; i < timeArray.length; i++) {
        $('#' + timeArray[i][0]).html(moment(timeArray[i][1]).fromNow());
    }
}

function formatCurrency(nStr) {
    // Function to format number into currency format
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
















