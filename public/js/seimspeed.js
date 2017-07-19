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
        url: "/auth/carsaleoffer",
        type: "POST",
        data: { 
            'carsale_id': carsaleID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function cancelCarSaleOffer(carsaleID, carsaleOfferID) {
    // cancel Offer for CarSale
    $.ajax({
        url: "/auth/carsaleoffercancel",
        type: "POST",
        data: { 
            'carsale_id': carsaleID,
            'carsaleoffer_id': carsaleOfferID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function submitCarRentOffer(carrentID) {
    // Submit Offer for CarRent
    $.ajax({
        url: "/auth/carrentoffer",
        type: "POST",
        data: { 
            'carrent_id': carrentID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function cancelCarRentOffer(carrentID, carrentOfferID) {
    // cancel Offer for CarRent
    $.ajax({
        url: "/auth/carrentoffercancel",
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
            }
        }
    });
}

function submitCarTenderTender(cartenderID) {
    // Submit Tender for CarTender
    $.ajax({
        url: "/auth/cartendertender",
        type: "POST",
        data: { 
            'cartender_id': cartenderID,
            'tender': $('#tender').val()
        },
        success: function(data) {
            $('#tender').val('');

            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function cancelCarTenderTender(cartenderID, cartenderTenderID) {
    // cancel Tender for CarTender
    $.ajax({
        url: "/auth/carrentoffercancel",
        type: "POST",
        data: { 
            'cartender_id': cartenderID,
            'cartendertender_id': cartenderTenderID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function submitCarAuctionBid(carauctionID) {
    // Submit Bid for CarAuction
    $.ajax({
        url: "/auth/carauctionbid",
        type: "POST",
        data: { 
            'carauction_id': carauctionID,
            'bid': $('#bid').val()
        },
        success: function(data) {
            $('#bid').val('');

            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function cancelCarAuctionBid(carauctionID, carauctionBidID) {
    // cancel Bid for CarAuction
    $.ajax({
        url: "/auth/carauctionbidcancel",
        type: "POST",
        data: { 
            'carauction_id': carauctionID,
            'carauctionbid_id': carauctionBidID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function submitPartSaleOffer(partsaleID) {
    // Submit Offer for PartSale
    $.ajax({
        url: "/auth/partsaleoffer",
        type: "POST",
        data: { 
            'partsale_id': partsaleID,
            'offer': $('#offer').val()
        },
        success: function(data) {
            $('#offer').val('');

            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

function cancelPartSaleOffer(partsaleID, partsaleOfferID) {
    // cancel Offer for PartSale
    $.ajax({
        url: "/auth/partsaleoffercancel",
        type: "POST",
        data: { 
            'partsale_id': partsaleID,
            'partsaleoffer_id': partsaleOfferID
        },
        success: function(data) {
            if (data['success'] == true) {
                // small model to display status
            } else {
                // small model to display status
            }
        }
    });
}

// Get Offers/Bids/Tenders ============
function getCarSaleOffers(carsaleID) {
    // get car offers and append
    $.ajax({
        url: "/getcarsaleoffers",
        type: "GET",
        data: { 
            'carsale_id': carsaleID
        },
        success: function(data) {
            if (data['success'] == true) {
                var carSaleOffers = data['carsaleoffers'];

                for (var i = 0; i < carSaleOffers; i++) {
                    CarSaleOfferAddedBuildTrade(carSaleOffers[i]);
                }
            }
        }
    });
}

function getCarRentOffers(carrentID) {
    // get car offers and append
    $.ajax({
        url: "/getcarrentoffers",
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
        url: "/getcartendertenders",
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
        url: "/getcarauctionbids",
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
        url: "/getpartsaleoffers",
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
        url: "/getcarcomments",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                CarCommentAddedBuildTrade(data[i]);
            }
        }
    });
}

function getPartComments(partID) {
	// get part comments and append
    $.ajax({
        url: "/getpartcomments",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                PartCommentAddedBuildTrade(data[i]);
            }
        }
    });
}

function getCarTails(carID) {
	// get car Tails and append
    $.ajax({
        url: "/getcartails",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            htmltext = '';
            for (var i = 0; i < data.length; i++) {
                htmltext += '<div class="list-group-item col-md-12">';
                htmltext += '  <div class="col-md-12" style="padding:10px;">';
                htmltext += '    <a href="' + data[i]['tail_user_url'] + '">';
                htmltext += '      <img src="' + data[i]['tail_user_propic'] + '" style="height:50px;width:auto">';
                htmltext += '      &nbsp;&nbsp;&nbsp;';
                htmltext += '      <strong>' + data[i]['tail_user_name'] + '</strong>';
                htmltext += '    </a>';
                htmltext += '  </div>';
                htmltext += '</div>';
            }

            $('#list').append(htmltext);
        }
    });
}

function getPartTails(partID) {
	// get part Tails and append
    $.ajax({
        url: "/getparttails",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            htmltext = '';
            for (var i = 0; i < data.length; i++) {
                htmltext += '<div class="list-group-item col-md-12">';
                htmltext += '  <div class="col-md-12" style="padding:10px;">';
                htmltext += '    <a href="' + data[i]['tail_user_url'] + '">';
                htmltext += '      <img src="' + data[i]['tail_user_propic'] + '" style="height:50px;width:auto">';
                htmltext += '      &nbsp;&nbsp;&nbsp;';
                htmltext += '      <strong>' + data[i]['tail_user_name'] + '</strong>';
                htmltext += '    </a>';
                htmltext += '  </div>';
                htmltext += '</div>';
            }

            $('#list').append(htmltext);
        }
    });
}


// ------------------- Post Functions ------------------ //


function rate(corporateID, rate) {
    // tail the corporate/also untail corporate is same function (backend function toggles it)
    $.ajax({
        url: "/auth/rate",
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
        url: "/auth/tailcorporate",
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
        url: "/auth/addcarcomment",
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
        url: "/auth/addcarcomment",
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
        url: "/auth/deletecarcomment",
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
        url: "/auth/addpartcomment",
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
        url: "/auth/addpartcomment",
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
        url: "/auth/deletepartcomment",
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
        url: "/auth/tailcar",
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
        url: "/auth/tailcar",
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
        url: "/iscorpuser",
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
        url: "/hascorpuserrole",
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
















