$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});


// ------------------- Home & CorpHome Builders ------------------ //

function CarSaleAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    var cardata = data.car;
    var carsaledata = data.carsale;
    var carimagedata = data.carimages;

    htmltext += '<div class="panel" id="carsale' + carsaledata.id + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + carsaledata.car_id + '" src="' + carimagedata[0].thumb_img_url +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p style="font-size:16px">' + carsaledata + '</p>';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + cardata.make + '</span> ' + cardata.model + ', ' + cardata.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(carsaledata.price) + '</span></span></p>';
    htmltext += '        <p id="carsale_created_at' + carsaledata.id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + cardata.bodytype + '. Weight: ' + cardata.weight + 'Kg\'s. Fuel Type: ' + cardata.fueltype + '. Transmission: ' + cardata.transmissiontype + '. Steering side: ' + cardata.steeringside + '. Location: ' + cardata.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + cardata.note + '</p>';

    if (cardata.negotiable == 'true') {
        htmltext += '    <p><span class="label label-warning">Negotiable</span></p>';
    } else {
        htmltext += '    <p><span class="label label-warning">Not negotiable</span></p>';
    }

    htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + carsaledata.note + '</span></p>';

    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + carsaledata.corporate_id + '/car/' + carsaledata.id + '/carsale/' + carsaledata.id + '" style="cursor:pointer"><i class="fa fa-comment"></i> ' + data.comment_count + ' comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carsaledata.corporate_id + '/car/' + carsaledata.id + '/carsale/' + carsaledata.id + '" style="cursor:pointer"><i class="fa fa-money"></i> ' + data.offer_count + ' offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carsaledata.corporate_id + '/car/' + carsaledata.id + '/carsale/' + carsaledata.id + '" style="cursor:pointer"><i class="fa fa-eye"></i> ' + data.tail_count + ' tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['carsale_created_at' + carsaledata.id, carsaledata.created_at]);
    updateTimestamps();
}

function CarRentAddedBuild(data) {
    // Add to Newsfeed
    // Add to Newsfeed
    var htmltext = '';

    var cardata = data.car;
    var carrentdata = data.carrent;
    var carimagedata = data.carimages;

    htmltext += '<div class="panel" id="carrent' + carrentdata.id + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + carrentdata.car_id + '" src="' + carimagedata[0].thumb_img_url +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + cardata.make + '</span> ' + cardata.model + ', ' + cardata.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">rent</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(carrentdata.rateperday) + '/day</span></span></p>';
    htmltext += '        <p id="carrent_created_at' + carrentdata.id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + cardata.bodytype + '. Weight: ' + cardata.weight + 'Kg\'s. Fuel Type: ' + cardata.fueltype + '. Transmission: ' + cardata.transmissiontype + '. Steering side: ' + cardata.steeringside + '. Location: ' + cardata.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + cardata.note + '</p>';
    htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + carrentdata.note + '</span></p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + carrentdata.corporate_id + '/car/' + carrentdata.id + '/carrent/' + carrentdata.id + '" style="cursor:pointer"><i class="fa fa-comment"></i> ' + data.comment_count + ' comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carrentdata.corporate_id + '/car/' + carrentdata.id + '/carrent/' + carrentdata.id + '" style="cursor:pointer"><i class="fa fa-money"></i> ' + data.offer_count + ' offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carrentdata.corporate_id + '/car/' + carrentdata.id + '/carrent/' + carrentdata.id + '" style="cursor:pointer"><i class="fa fa-eye"></i> ' + data.tail_count + ' tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['carrent_created_at' + carrentdata.id, carrentdata.created_at]);
    updateTimestamps();
}

function CarTenderAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    var cardata = data.car;
    var cartenderdata = data.cartender;
    var carimagedata = data.carimages;

    htmltext += '<div class="panel" id="cartender' + cartenderdata.id + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + cartenderdata.car_id + '" src="' + carimagedata[0].thumb_img_url +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + cardata.make + '</span> ' + cardata.model + ', ' + cardata.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">tender</label><span class="pull-right"><span style="font-size:20px"></span></span></p>';
    htmltext += '        <p id="cartender_created_at' + cartenderdata.id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + cardata.bodytype + '. Weight: ' + cardata.weight + 'Kg\'s. Fuel Type: ' + cardata.fueltype + '. Transmission: ' + cardata.transmissiontype + '. Steering side: ' + cardata.steeringside + '. Location: ' + cardata.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + cardata.note + '</p>';
    htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + cartenderdata.note + '</span></p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + cartenderdata.corporate_id + '/car/' + cartenderdata.id + '/cartender/' + cartenderdata.id + '" style="cursor:pointer"><i class="fa fa-comment"></i> ' + data.comment_count + ' comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + cartenderdata.corporate_id + '/car/' + cartenderdata.id + '/cartender/' + cartenderdata.id + '" style="cursor:pointer"><i class="fa fa-money"></i> ' + data.tender_count + ' offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + cartenderdata.corporate_id + '/car/' + cartenderdata.id + '/cartender/' + cartenderdata.id + '" style="cursor:pointer"><i class="fa fa-eye"></i> ' + data.tail_count + ' tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['cartender_created_at' + cartenderdata.id, cartenderdata.created_at]);
    updateTimestamps();
}

function CarAuctionAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    var cardata = data.car;
    var carauctiondata = data.carauction;
    var carimagedata = data.carimages;
    var carauctionbid = data.carauction_bid;

    htmltext += '<div class="panel" id="carauction' + carauctiondata.id + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + carauctiondata.car_id + '" src="' + carimagedata[0].thumb_img_url +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + cardata.make + '</span> ' + cardata.model + ', ' + cardata.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">auction</label><span class="pull-right"><span style="font-size:20px"></span></span></p>';
    htmltext += '        <p id="carauction_created_at' + carauctiondata.id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + cardata.bodytype + '. Weight: ' + cardata.weight + 'Kg\'s. Fuel Type: ' + cardata.fueltype + '. Transmission: ' + cardata.transmissiontype + '. Steering side: ' + cardata.steeringside + '. Location: ' + cardata.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + cardata.note + '</p>';
    htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + carauctiondata.note + '</span></p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + carauctiondata.corporate_id + '/car/' + carauctiondata.id + '/carauction/' + carauctiondata.id + '" style="cursor:pointer"><i class="fa fa-comment"></i> ' + data.comment_count + ' comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carauctiondata.corporate_id + '/car/' + carauctiondata.id + '/carauction/' + carauctiondata.id + '" style="cursor:pointer"><i class="fa fa-money"></i> ' + data.bid_count + ' offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + carauctiondata.corporate_id + '/car/' + carauctiondata.id + '/carauction/' + carauctiondata.id + '" style="cursor:pointer"><i class="fa fa-eye"></i> ' + data.tail_count + ' tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['carauction_created_at' + carauctiondata.id, carauctiondata.created_at]);
    updateTimestamps();
}

function PartSaleAddedBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    var partdata = data.part;
    var partsaledata = data.partsale;
    var partimagedata = data.partimages;

    htmltext += '<div class="panel" id="partsale' + partsaledata.id + '">';
    htmltext += '  <div class="panel-body">';
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="partimage' + partsaledata.part_id + '" src="' + partimagedata[0].thumb_img_url +  '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + partdata.name + '</span> ' + partdata.serialnumber + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(partsaledata.price) + '</span></span></p>';
    htmltext += '        <p id="partsale_created_at' + partsaledata.id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>' + partdata.descript + '</p>';
    htmltext += '        <p>Location: ' + partdata.physicallocation + '</p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + partdata.note + '</p>';

    if (partdata.negotiable == 'true') {
        htmltext += '    <p><span class="label label-warning">Negotiable</span></p>';
    } else {
        htmltext += '    <p><span class="label label-warning">Not negotiable</span></p>';
    }

    htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + partsaledata.note + '</span></p>';

    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + partsaledata.corporate_id + '/part/' + partsaledata.id + '/partsale/' + partsaledata.id + '" style="cursor:pointer"><i class="fa fa-comment"></i> ' + data.comment_count + ' comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + partsaledata.corporate_id + '/part/' + partsaledata.id + '/partsale/' + partsaledata.id + '" style="cursor:pointer"><i class="fa fa-money"></i> ' + data.offer_count + ' offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + partsaledata.corporate_id + '/part/' + partsaledata.id + '/partsale/' + partsaledata.id + '" style="cursor:pointer"><i class="fa fa-eye"></i> ' + data.tail_count + ' tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    $('#newsfeed').prepend(htmltext);

    // moment.js stuff
    timeArray.push(['partsale_created_at' + partsaledata.id, partsaledata.created_at]);
    updateTimestamps();
}

function CarSaleClosedBuild(data) {
    // Remove item from newsfeed
    $('#carsale' + data.id).remove();
}

function CarRentClosedBuild(data) {
    // Remove item from newsfeed
    $('#carrent' + data.id).remove();
}

function CarTenderClosedBuild(data) {
    // Remove item from newsfeed
    $('#cartender' + data.id).remove();
}

function CarAuctionClosedBuild(data) {
    // Remove item from newsfeed
    $('#carauction' + data.id).remove();
}

function PartSaleClosedBuild(data) {
    // Remove item from newsfeed
    $('#partsale' + data.id).remove();
}

function CarSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carsale' + data.id).remove();
}

function CarRentOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carrent' + data.id).remove();
}

function CarTenderTenderReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#cartender' + data.id).remove();
}

function CarAuctionBidReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#carauction' + data.id).remove();
}

function PartSaleOfferReservePurchasedBuild(data) {
    // Remove item from newsfeed
    $('#partsale' + data.id).remove();
}



function CarSaleBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carsale' + data.carsale_id + '">';
    htmltext += '  <div class="panel-body">';

    if (corpHome == false) {
        htmltext += '    <div class="col-md-12">';
        htmltext += '       <a href="' + base_url + '/corporate/' + data.corporate_id + '"><span style="font-size:20px;font-weight:bold">' + data.corporate_name + '</span></a>';
        htmltext += '       <hr style="padding:5px;margin:0">';
        htmltext += '    </div>';
    }

    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + data.car_id + '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + data.make + '</span> ' + data.model + ', ' + data.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(data.price) + '</span></span></p>';
    htmltext += '        <p id="carsale_created_at' + data.carsale_id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + data.bodytype + '. Weight: ' + data.weight + 'Kg\'s. Fuel Type: ' + data.fueltype + '. Transmission: ' + data.transmissiontype + '. Steering side: ' + data.steeringside + '. Location: ' + data.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + data.note + '</p>';

    if (data.negotiable == 'true') {
        htmltext += '    <p><span class="label label-warning">Negotiable</span></p>';
    } else {
        htmltext += '    <p><span class="label label-warning">Not negotiable</span></p>';
    }

    // htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + data.note + '</span></p>';

    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carsale_id + '/carsale/' + data.carsale_id + '" style="cursor:pointer"><i class="fa fa-money"></i> <span id="carsale_offer_count' + data.carsale_id + '"></span> offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carsale_id + '/carsale/' + data.carsale_id + '" style="cursor:pointer"><i class="fa fa-comment"> </i><span id="carsale_comment_count' + data.carsale_id + '"></span> comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carsale_id + '/carsale/' + data.carsale_id + '" style="cursor:pointer"><i class="fa fa-eye"></i> <span id="carsale_tail_count' + data.carsale_id + '"></span> tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    tradesArray.push({
        'carsale_created_at':data.carsales_created_at, 
        'htmltext':htmltext, 
        'car_id':data.car_id, 
        'trade_type':'carsale', 
        'trade_id':data.carsale_id
    });

    // moment.js stuff
    timeArray.push(['carsale_created_at' + data.carsale_id, data.carsales_created_at]);
    updateTimestamps();
}

function CarRentBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carrent' + data.carrent_id + '">';
    htmltext += '  <div class="panel-body">';

    if (corpHome == false) {
        htmltext += '    <div class="col-md-12">';
        htmltext += '       <a href="' + base_url + '/corporate/' + data.corporate_id + '"><span style="font-size:20px;font-weight:bold">' + data.corporate_name + '</span></a>';
        htmltext += '       <hr style="padding:5px;margin:0">';
        htmltext += '    </div>';
    }
    
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + data.car_id + '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + data.make + '</span> ' + data.model + ', ' + data.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">rent</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(data.rateperday) + '/day</span></span></p>';
    htmltext += '        <p id="carrent_created_at' + data.carrent_id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + data.bodytype + '. Weight: ' + data.weight + 'Kg\'s. Fuel Type: ' + data.fueltype + '. Transmission: ' + data.transmissiontype + '. Steering side: ' + data.steeringside + '. Location: ' + data.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + data.note + '</p>';
    // htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + data.note + '</span></p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carrent_id + '/carrent/' + data.carrent_id + '" style="cursor:pointer"><i class="fa fa-money"></i> <span id="carrent_offer_count' + data.carrent_id + '"></span> offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carrent_id + '/carrent/' + data.carrent_id + '" style="cursor:pointer"><i class="fa fa-comment"></i> <span id="carrent_comment_count' + data.carrent_id + '"></span> comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carrent_id + '/carrent/' + data.carrent_id + '" style="cursor:pointer"><i class="fa fa-eye"></i> <span id="carrent_tail_count' + data.carrent_id + '"></span> tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    tradesArray.push({
        'carrent_created_at':data.carrents_created_at, 
        'htmltext':htmltext, 
        'car_id':data.car_id, 
        'trade_type':'carrent', 
        'trade_id':data.carrent_id
    });

    // moment.js stuff
    timeArray.push(['carrent_created_at' + data.carrent_id, data.carrents_created_at]);
    updateTimestamps();
}

function CarTenderBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="cartender' + data.cartender_id + '">';
    htmltext += '  <div class="panel-body">';

    if (corpHome == false) {
        htmltext += '    <div class="col-md-12">';
        htmltext += '       <a href="' + base_url + '/corporate/' + data.corporate_id + '"><span style="font-size:20px;font-weight:bold">' + data.corporate_name + '</span></a>';
        htmltext += '       <hr style="padding:5px;margin:0">';
        htmltext += '    </div>';
    }

    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + data.car_id + '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + data.make + '</span> ' + data.model + ', ' + data.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">tender</label><span class="pull-right"><span style="font-size:20px"></span></span></p>';
    htmltext += '        <p id="cartender_created_at' + data.cartender_id + '" style="color:rgb(255,75,87);font-size:11px"></p>';   
    htmltext += '        <p>Body type: ' + data.bodytype + '. Weight: ' + data.weight + 'Kg\'s. Fuel Type: ' + data.fueltype + '. Transmission: ' + data.transmissiontype + '. Steering side: ' + data.steeringside + '. Location: ' + data.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + data.note + '</p>';
    htmltext += '        <p style="color:rgb(255,75,87);font-size:11px">Tender ends <strong id="cartender_end_date' + data.cartender_id + '" style="font-size:13px"></strong></p>'; 
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.cartender_id + '/cartender/' + data.cartender_id + '" style="cursor:pointer"><i class="fa fa-money"></i> <span id="cartender_tender_count' + data.cartender_id + '"></span> tender</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.cartender_id + '/cartender/' + data.cartender_id + '" style="cursor:pointer"><i class="fa fa-comment"></i> <span id="cartender_comment_count' + data.cartender_id + '"></span> comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.cartender_id + '/cartender/' + data.cartender_id + '" style="cursor:pointer"><i class="fa fa-eye"></i> <span id="cartender_tail_count' + data.cartender_id + '"></span> tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    tradesArray.push({
        'cartender_created_at':data.cartenders_created_at, 
        'htmltext':htmltext, 
        'car_id':data.car_id, 
        'trade_type':'cartender', 
        'trade_id':data.cartender_id
    });

    // moment.js stuff
    timeArray.push(['cartender_created_at' + data.cartender_id, data.cartenders_created_at]);
    timeArray.push(['cartender_end_date' + data.cartender_id, data.enddate]);
    updateTimestamps();
}

function CarAuctionBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="carauction' + data.carauction_id + '">';
    htmltext += '  <div class="panel-body">';

    if (corpHome == false) {
        htmltext += '    <div class="col-md-12">';
        htmltext += '       <a href="' + base_url + '/corporate/' + data.corporate_id + '"><span style="font-size:20px;font-weight:bold">' + data.corporate_name + '</span></a>';
        htmltext += '       <hr style="padding:5px;margin:0">';
        htmltext += '    </div>';
    }
    
    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="carimage' + data.car_id + '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + data.make + '</span> ' + data.model + ', ' + data.color + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">auction</label><span class="pull-right"><span style="font-size:20px"></span></span></p>';
    htmltext += '        <p id="carauction_created_at' + data.carauction_id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>Body type: ' + data.bodytype + '. Weight: ' + data.weight + 'Kg\'s. Fuel Type: ' + data.fueltype + '. Transmission: ' + data.transmissiontype + '. Steering side: ' + data.steeringside + '. Location: ' + data.location + '. </p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + data.note + '</p>';
    // htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + data.note + '</span></p>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carauction_id + '/carauction/' + data.carauction_id + '" style="cursor:pointer"><i class="fa fa-money"></i> <span id="carauction_bid_count' + data.carauction_id + '"></span> bid</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carauction_id + '/carauction/' + data.carauction_id + '" style="cursor:pointer"><i class="fa fa-comment"></i> <span id="carauction_comment_count' + data.carauction_id + '"></span> comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/car/' + data.carauction_id + '/carauction/' + data.carauction_id + '" style="cursor:pointer"><i class="fa fa-eye"></i> <span id="carauction_tail_count' + data.carauction_id + '"></span> tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    tradesArray.push({
        'carauction_created_at':data.carauctions_created_at, 
        'htmltext':htmltext, 
        'car_id':data.car_id, 
        'trade_type':'carauction', 
        'trade_id':data.carauction_id
    });

    // moment.js stuff
    timeArray.push(['carauction_created_at' + data.carauction_id, data.carauctions_created_at]);
    updateTimestamps();
}

function PartSaleBuild(data) {
    // Add to Newsfeed
    var htmltext = '';

    htmltext += '<div class="panel" id="partsale' + data.partsale_id + '">';
    htmltext += '  <div class="panel-body">';

    if (corpHome == false) {
        htmltext += '    <div class="col-md-12">';
        htmltext += '       <a href="' + base_url + '/corporate/' + data.corporate_id + '"><span style="font-size:20px;font-weight:bold">' + data.corporate_name + '</span></a>';
        htmltext += '       <hr style="padding:5px;margin:0">';
        htmltext += '    </div>';
    }

    htmltext += '    <div class="col-md-3">';
    htmltext += '      <img class="img-responsive" id="partimage' + data.part_id + '"></img>';
    htmltext += '    </div>';
    htmltext += '    <div class="col-md-9">';
    htmltext += '        <p><span style="text-decoration:bold;font-size:14px;color:gray"><span>' + data.name + '</span> ' + data.serialnumber + '</span>&nbsp;&nbsp;&nbsp;<label class="label label-danger" style="font-size:16px">sale</label><span class="pull-right"><span style="font-size:20px">K' + formatCurrency(data.price) + '</span></span></p>';
    htmltext += '        <p id="partsale_created_at' + data.partsale_id + '" style="color:rgb(255,75,87);font-size:11px"></p>'   
    htmltext += '        <p>' + data.descript + '</p>';
    htmltext += '        <p>Location: ' + data.physicallocation + '</p>';
    htmltext += '        <p style="font-size:11px;color:grey">' + data.note + '</p>';

    if (data.negotiable == 'true') {
        htmltext += '    <p><span class="label label-warning">Negotiable</span></p>';
    } else {
        htmltext += '    <p><span class="label label-warning">Not negotiable</span></p>';
    }

    // htmltext += '        <p><hr style="margin:2px"><span style="font-size:11px;color:grey">' + data.note + '</span></p>';

    htmltext += '    </div>';
    htmltext += '    <div class="col-md-12">';
    htmltext += '        <hr style="margin:10px">';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/part/' + data.partsale_id + '/partsale/' + data.partsale_id + '" style="cursor:pointer"><i class="fa fa-money"></i> <span id="partsale_offer_count' + data.partsale_id + '"></span> offer</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/part/' + data.partsale_id + '/partsale/' + data.partsale_id + '" style="cursor:pointer"><i class="fa fa-comment"></i> <span id="partsale_comment_count' + data.partsale_id + '"></span> comment</a>';
    htmltext += '        &nbsp;&nbsp;&nbsp;&nbsp;';
    htmltext += '        <a href="' + base_url + '/corporate/' + data.corporate_id + '/part/' + data.partsale_id + '/partsale/' + data.partsale_id + '" style="cursor:pointer"><i class="fa fa-eye"></i> <span id="partsale_tail_count' + data.partsale_id + '"></span> tail</a>';
    htmltext += '    </div>';
    htmltext += '  </div>';
    htmltext += '</div>';

    tradesArray.push({
        'partsale_created_at':data.partsales_created_at, 
        'htmltext':htmltext, 
        'part_id':data.part_id, 
        'trade_type':'partsale', 
        'trade_id':data.partsale_id
    });

    // moment.js stuff
    timeArray.push(['partsale_created_at' + data.partsale_id, data.partsales_created_at]);
    updateTimestamps();
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
    $('#offer_is_reserved' + data.id).html('<span class="label label-primary">reserved</span>');
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

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png"> ';
    }

    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p class="pull-left">';
    htmltext += '      <strong><a href="#">' + data.name + '</a></strong>&nbsp;&nbsp;&nbsp;';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:red" href="javascript:void(0);" onclick="confirmMe(\'' + carsaleCancelMessage + '\', \'cancelCarSaleOffer(' + data.id + ')\', \'danger\')">cancel</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }

    htmltext += '    </p>';
    htmltext += '    <br>';
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

function CarSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#caroffer' + data.id).remove();
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
    $('#offer_is_reserved' + data.id).html('<span class="label label-primary">reserved</span>');
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

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png"> ';
    }

    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p class="pull-left">';
    htmltext += '      <strong><a href="#">' + data.name + '</a></strong> ';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:red" href="javascript:void(0);" onclick="confirmMe(\'' + carrentCancelMessage + '\', \'cancelCarRentOffer(' + data.id + ')\', \'danger\')">cancel</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }

    htmltext += '    </p>';
    htmltext += '    <br>';
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

function CarRentOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#caroffer' + data.id).remove();
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
    $('#offer_is_reserved' + data.id).html('<span class="label label-primary">reserved</span>');
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

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png"> ';
    }

    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p class="pull-left">';
    htmltext += '      <strong><a href="#">' + data.name + '</a></strong> ';
    htmltext += '      <span style="color:gray;font-size:11px" id="biddate' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:red" href="javascript:void(0);" onclick="confirmMe(\'' + carauctionCancelMessage + '\', \'cancelCarAuctionOffer(' + data.id + ')\', \'danger\')">cancel</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }

    htmltext += '    </p>';
    htmltext += '    <br>';
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

function CarAuctionBidCancelledBuildTrade(data) {
    // Remove specific bid from bids
    $('#carbid' + data.id).remove();
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
    $('#offer_is_reserved' + data.id).html('<span class="label label-primary">reserved</span>');
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

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png"> ';
    }

    htmltext += '  </div>';
    htmltext += '  <div class="col-md-10">';
    htmltext += '    <p class="pull-left">';
    htmltext += '      <strong><a href="#">' + data.name + '</a></strong> ';
    htmltext += '      <span style="color:gray;font-size:11px" id="offerdate' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:red" href="javascript:void(0);" onclick="confirmMe(\'' + partsaleCancelMessage + '\', \'cancelPartSaleOffer(' + data.id + ')\', \'danger\')">cancel</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }

    htmltext += '    </p>';
    htmltext += '    <br>';
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

function PartSaleOfferCancelledBuildTrade(data) {
    // Remove specific offer from offers
    $('#partoffer' + data.id).remove();
}


// ------------------- Car/Part Comment Added Functions ------------------ //


function CarCommentAddedBuildTrade(data) {
    // Append comment to comments
    var htmltext = '';

    htmltext += '<div class="list-group-item col-md-12" id="comment' + data.id + '">';
    htmltext += '  <div class="col-md-1">';

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '" style="height:40px;width:auto"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png" style="height:40px;width:auto"> ';
    }

    htmltext += '  </div>';

    htmltext += '  <div class="col-md-11">';
    htmltext += '    <p class="pull-left">';
    htmltext += '        <strong><a href="#">' + data.name + '</a></strong>&nbsp;&nbsp;&nbsp;';
    htmltext += '        <span style="color:gray;font-size:11px" id="carcomment_created_at' + data.id + '"></span>';
    htmltext += '    </p><p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:grey" href="javascript:void(0);" onclick="deleteCarComment(' + data.car_id + ',' + data.id + ')">delete</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }
    
    htmltext += '    </p>';
    htmltext += '    <br>';
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

    htmltext += '<div class="list-group-item col-md-12" id="comment' + data.id + '">';
    htmltext += '  <div class="col-md-1">';

    if (data.propic != null) {
        htmltext += '    <img class="img-responsive" src="' + data.propic + '" style="height:40px;width:auto"> ';
    } else {
        htmltext += '    <img class="img-responsive" src="' + base_url + '/imgs/no-images.png" style="height:40px;width:auto"> ';
    }

    htmltext += '  </div>';

    htmltext += '  <div class="col-md-11">';
    htmltext += '    <p class="pull-left">';
    htmltext += '      <strong><a href="#">' + data.name + '</a></strong>&nbsp;&nbsp;&nbsp;';
    htmltext += '      <span style="color:gray;font-size:11px" id="partcomment_created_at' + data.id + '"></span>';
    htmltext += '    </p>';
    htmltext += '    <p>';

    if (data.user_id == user_id) {
        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
        htmltext += '        <li class="dropdown">';
        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        htmltext += '                <span class="caret"></span>';
        htmltext += '            </a>';
        htmltext += '            <ul class="dropdown-menu" role="menu">';
        htmltext += '                <li><a style="font-size:9px;color:grey" href="javascript:void(0);" onclick="deletePartComment(' + data.part_id + ',' + data.id + ')">delete</a></li>';
        htmltext += '            </ul>';
        htmltext += '        </li>';
        htmltext += '    </ul>';
    }

    htmltext += '    </p>';
    htmltext += '    <br>';
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

            if (data.success == true) {
                alertMe('You have successfully submitted your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

function cancelCarSaleOffer(carsaleOfferID) {
    // cancel Offer for CarSale
    $.ajax({
        url: base_url + "/auth/carsaleoffercancel",
        type: "POST",
        data: { 
            'carsaleoffer_id': carsaleOfferID
        },
        success: function(data) {
            if (data.success == true) {
                alertMe('You have successfully cancelled your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
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

            if (data.success == true) {
                alertMe('You have successfully submitted your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

function cancelCarRentOffer(carrentOfferID) {
    // cancel Offer for CarRent
    $.ajax({
        url: base_url + "/auth/carrentoffercancel",
        type: "POST",
        data: { 
            'carrentoffer_id': carrentOfferID
        },
        success: function(data) {
            if (data.success == true) {
                alertMe('You have successfully cancelled your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
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

            if (data.success == true) {
                alertMe('You have successfully submitted your tender.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

function cancelCarTenderTender(cartenderTenderID) {
    // cancel Tender for CarTender
    $.ajax({
        url: base_url + "/auth/carrentoffercancel",
        type: "POST",
        data: { 
            'cartendertender_id': cartenderTenderID
        },
        success: function(data) {
            if (data.success == true) {
                alertMe('You have successfully cancelled your tender.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
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

            if (data.success == true) {
                alertMe('You have successfully submitted your bid.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

function cancelCarAuctionBid(carauctionBidID) {
    // cancel Bid for CarAuction
    $.ajax({
        url: base_url + "/auth/carauctionbidcancel",
        type: "POST",
        data: { 
            'carauctionbid_id': carauctionBidID
        },
        success: function(data) {
            if (data.success == true) {
                alertMe('You have successfully cancelled your bid.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
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

            if (data.success == true) {
                alertMe('You have successfully submitted your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

function cancelPartSaleOffer(partsaleOfferID) {
    // cancel Offer for PartSale
    $.ajax({
        url: base_url + "/auth/partsaleoffercancel",
        type: "POST",
        data: { 
            'partsaleoffer_id': partsaleOfferID
        },
        success: function(data) {
            if (data.success == true) {
                alertMe('You have successfully cancelled your offer.');
            } else {
                alertMe('Oops something went wrong :( <br>Please refresh and try again.');
            }
        }
    });
}

// Get Offers/Bids/Tenders ============
function getNewsFeed(pageurl) {

    // Loading spinner
    $('#loading').html('<p><i class="fa fa-life-buoy fa-spin"></i></p>');
    $('#loading').show();

    // Check if any next page available to load.
    if (noNextPage == false) {
        // Grab trades for page
        $.ajax({
            url: pageurl,
            type: "GET",
            success: function(data) {
                // console.log(data);
                if (data.success == true) {
                    // Hide loading spinner
                    $('#loading').hide();

                    if (data.carsales.data.length > 0) {
                        for (var i = 0; i < data.carsales.data.length; i++) {
                            CarSaleBuild(data.carsales.data[i]);
                        }
                        if (data.carsales.next_page_url != null) {
                            nextPageURL = data.carsales.next_page_url;
                        } 
                    }
                    if (data.carrents.data.length > 0) {
                        for (var i = 0; i < data.carrents.data.length; i++) {
                            CarRentBuild(data.carrents.data[i]);
                        }
                        if (data.carrents.next_page_url != null) {
                            nextPageURL = data.carrents.next_page_url;
                        }
                    }
                    if (data.cartenders.data.length > 0) {
                        for (var i = 0; i < data.cartenders.data.length; i++) {
                            CarTenderBuild(data.cartenders.data[i]);
                        }
                        if (data.cartenders.next_page_url != null) {
                            nextPageURL = data.cartenders.next_page_url;
                        }
                    }
                    if (data.carauctions.data.length > 0) {
                        for (var i = 0; i < data.carauctions.data.length; i++) {
                            CarAuctionBuild(data.carauctions.data[i]);
                        }
                        if (data.carauctions.next_page_url != null) {
                            nextPageURL = data.carauctions.next_page_url;
                        }
                    }
                    if (data.partsales.data.length > 0) {
                        for (var i = 0; i < data.partsales.data.length; i++) {
                            PartSaleBuild(data.partsales.data[i]);
                        }
                        if (data.partsales.next_page_url != null) {
                            nextPageURL = data.partsales.next_page_url;
                        }
                    }

                    if (data.carsales.next_page_url == null && data.carrents.next_page_url == null && data.cartenders.next_page_url == null && data.carauctions.next_page_url == null && data.partsales.next_page_url == null) {
                        noNextPage = true;
                        nextPageURL = null;
                    }
                }
                
                // Sort array by timestamp
                tradesArray.sort(function(x, y){
                    return x[0] - y[0];
                })

                // comments,offer and tail array
                var carArray = [];
                var partArray = [];

                // Append sorted array to newsfeed
                for (var i = 0; i < tradesArray.length; i++) {
                    $('#newsfeed').append(tradesArray[i].htmltext);
                    if (tradesArray[i].trade_type == 'carsale' || tradesArray[i].trade_type == 'carrent' || tradesArray[i].trade_type == 'cartender' || tradesArray[i].trade_type == 'carauction') {
                        carArray.push({
                            'car_id':tradesArray[i].car_id,
                            'trade_type':tradesArray[i].trade_type,
                            'trade_id':tradesArray[i].trade_id
                        });
                    } else if (tradesArray[i].trade_type == 'partsale') {
                        partArray.push({
                            'part_id':tradesArray[i].part_id,
                            'trade_type':tradesArray[i].trade_type,
                            'trade_id':tradesArray[i].trade_id
                        });
                    }
                }
                // Reset tradesArray for new trades to be appended next
                tradesArray = [];

                // Get all comment_count,offer_count, tail_count, images for cars
                if (carArray.length > 0) {
                    getCarCounts(carArray);
                    getCarImages(carArray);
                }
                // Get all comment_count,offer_count, tail_count, images for parts
                if (partArray.length > 0) {
                    getPartCounts(partArray);
                    getPartImages(partArray);
                }

            }
        });
    } else {
        // Loading spinner
        $('#loading').html('<p>No more items</p>');
        $('#loading').show();
    }
}

function getCarCounts(data) {
    $.ajax({
        url: base_url + "/getcarcounts",
        type: "GET",
        data: { 
            'car_array': data
        },
        success: function(ajaxdata) {
            if (ajaxdata.success == true) {
                if (data.length == ajaxdata.counts.length) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].trade_type == 'carsale') {
                            $('#carsale_comment_count' + data[i].trade_id).html(ajaxdata.counts[i].comment_count);
                            $('#carsale_offer_count' + data[i].trade_id).html(ajaxdata.counts[i].trade_count);
                            $('#carsale_tail_count' + data[i].trade_id).html(ajaxdata.counts[i].tail_count);
                        } else if (data[i].trade_type == 'carrent') {
                            $('#carrent_comment_count' + data[i].trade_id).html(ajaxdata.counts[i].comment_count);
                            $('#carrent_offer_count' + data[i].trade_id).html(ajaxdata.counts[i].trade_count);
                            $('#carrent_tail_count' + data[i].trade_id).html(ajaxdata.counts[i].tail_count);
                        } else if (data[i].trade_type == 'cartender') {
                            $('#cartender_comment_count' + data[i].trade_id).html(ajaxdata.counts[i].comment_count);
                            $('#cartender_tender_count' + data[i].trade_id).html(ajaxdata.counts[i].trade_count);
                            $('#cartender_tail_count' + data[i].trade_id).html(ajaxdata.counts[i].tail_count);
                        } else if (data[i].trade_type == 'carauction') {
                            $('#carauction_comment_count' + data[i].trade_id).html(ajaxdata.counts[i].comment_count);
                            $('#carauction_bid_count' + data[i].trade_id).html(ajaxdata.counts[i].trade_count);
                            $('#carauction_tail_count' + data[i].trade_id).html(ajaxdata.counts[i].tail_count);
                        }
                    }
                }
            }
        }
    });
}

function getPartCounts(data) {
    $.ajax({
        url: base_url + "/getpartcounts",
        type: "GET",
        data: { 
            'part_array': data
        },
        success: function(ajaxdata) {
            if (ajaxdata.success == true) {
                if (data.length == ajaxdata.counts.length) {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].trade_type == 'partsale') {
                            $('#partsale_comment_count' + data[i].trade_id).html(ajaxdata.counts[i].comment_count);
                            $('#partsale_offer_count' + data[i].trade_id).html(ajaxdata.counts[i].trade_count);
                            $('#partsale_tail_count' + data[i].trade_id).html(ajaxdata.counts[i].tail_count);
                        }
                    }
                }
            }
        }
    });
}

function getCarImages(data) {
    $.ajax({
        url: base_url + "/getcarimages",
        type: "GET",
        data: { 
            'car_array': data
        },
        success: function(ajaxdata) {
            if (ajaxdata.success == true) {
                if (data.length == ajaxdata.carimages.length) {
                    for (var i = 0; i < data.length; i++) {
                        $('#carimage' + data[i].car_id).attr('src', ajaxdata.carimages[i].thumb_img_url);
                    }
                }
            }
        }
    });
}

function getPartImages(data) {
    $.ajax({
        url: base_url + "/getpartimages",
        type: "GET",
        data: { 
            'part_array': data
        },
        success: function(ajaxdata) {
            if (ajaxdata.success == true) {
                if (data.length == ajaxdata.partimages.length) {
                    for (var i = 0; i < data.length; i++) {
                        $('#partimage' + data[i].part_id).attr('src', ajaxdata.partimages[i].thumb_img_url);
                    }
                }
            }
        }
    });
}

function getCarSaleOffers(carsaleID) {
    // Display option for user to enter their offer
    $('#commentinput').hide();
    $('#tailinput').hide();
    $('#amountinput').show();

    // get car offers and append
    $.ajax({
        url: base_url + "/getcarsaleoffers",
        type: "GET",
        data: { 
            'carsale_id': carsaleID
        },
        success: function(data) {
            if (data.success == true) {
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
    $('#commentinput').hide();
    $('#tailinput').hide();
    $('#amountinput').show();

    $.ajax({
        url: base_url + "/getcarrentoffers",
        type: "GET",
        data: { 
            'carrent_id': carrentID
        },
        success: function(data) {
            if (data.success == true) {
                var carRentOffers = data['carrentoffers'];
                $('#list').html('');
                for (var i = 0; i < carRentOffers; i++) {
                    CarRentOfferAddedBuildTrade(carRentOffers[i]);
                }
            }
        }
    });
}

function getCarTenderTenders(cartenderID) {
    // get car tenders and append
    $('#commentinput').hide();
    $('#tailinput').hide();
    $('#amountinput').show();

    $.ajax({
        url: base_url + "/getcartendertenders",
        type: "GET",
        data: { 
            'cartender_id': cartenderID
        },
        success: function(data) {
            if (data.success == true) {
                var carTenderTenders = data['cartendertenders'];
                $('#list').html('');
                for (var i = 0; i < carTenderTenders; i++) {
                    CarTenderTenderAddedBuildTrade(carTenderTenders[i]);
                }
            }
        }
    });
}

function getCarAuctionBids(carauctionID) {
    // get car bids and append
    $('#commentinput').hide();
    $('#tailinput').hide();
    $('#amountinput').show();

    $.ajax({
        url: base_url + "/getcarauctionbids",
        type: "GET",
        data: { 
            'carauction_id': carauctionID
        },
        success: function(data) {
            if (data.success == true) {
                var carAuctionBids = data['carauctionbids'];
                $('#list').html('');
                for (var i = 0; i < carAuctionBids; i++) {
                    CarAuctionBidAddedBuildTrade(carAuctionBids[i]);
                }
            }
        }
    });
}

function getPartSaleOffers(partsaleID) {
    // get part comments and append
    $('#commentinput').hide();
    $('#tailinput').hide();
    $('#amountinput').show();

    $.ajax({
        url: base_url + "/getpartsaleoffers",
        type: "GET",
        data: { 
            'partsale_id': partsaleID
        },
        success: function(data) {
            if (data.success == true) {
                var PartSaleOffers = data['Partsaleoffers'];
                $('#list').html('');
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
    $('#commentinput').show();
    $('#tailinput').hide();
    $('#amountinput').hide();

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
    $('#commentinput').hide();
    $('#tailinput').show();
    $('#amountinput').hide();

    $.ajax({
        url: base_url + "/getcartails",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            if (data.success == true) {
                isTailingCar(carID);

                $('#list').html('');
                htmltext = '';
                for (var i = 0; i < data.cartails.length; i++) {
                    htmltext += '<div class="list-group-item col-md-12">';
                    htmltext += '  <div class="col-md-12" style="padding:10px;">';
                    htmltext += '    <a href="#">';

                    if (data.cartails[i].propic != null) {
                        htmltext += '      <img src="' + data.cartails[i].propic + '" style="height:50px;width:auto">';
                    } else {
                        htmltext += '      <img src="' + base_url + '/imgs/no-images.png" style="height:50px;width:auto">';
                    }

                    htmltext += '      &nbsp;&nbsp;&nbsp;';
                    htmltext += '      <strong>' + data.cartails[i].name + '</strong>';
                    htmltext += '    </a>';

                    if (data.user_id == user_id) {
                        htmltext += '    <ul class="nav navbar-nav navbar-right" style="padding:0;margin:0">';
                        htmltext += '        <li class="dropdown">';
                        htmltext += '            <a style="font-size:10px;padding:0;margin:0" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                        htmltext += '                <span class="caret"></span>';
                        htmltext += '            </a>';
                        htmltext += '            <ul class="dropdown-menu" role="menu">';
                        htmltext += '                <li><a style="font-size:9px;color:red" href="javascript:void(0);" onclick="tailCar(' + carID + ')">cancel</a></li>';
                        htmltext += '            </ul>';
                        htmltext += '        </li>';
                        htmltext += '    </ul>';
                    }

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
    $('#commentinput').hide();
    $('#tailinput').show();
    $('#amountinput').hide();

    $.ajax({
        url: base_url + "/getparttails",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            if (data.success == true) {
                isTailingPart(partID);

                htmltext = '';
                for (var i = 0; i < data.parttails.length; i++) {
                    htmltext += '<div class="list-group-item col-md-12">';
                    htmltext += '  <div class="col-md-12" style="padding:10px;">';
                    htmltext += '    <a href="#">';
                    
                    if (data.parttails[i].propic != null) {
                        htmltext += '      <img src="' + data.parttails[i].propic + '" style="height:50px;width:auto">';
                    } else {
                        htmltext += '      <img src="' + base_url + '/imgs/no-images.png" style="height:50px;width:auto">';
                    }

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

function getNotifications() {
    console.log('test1');
    // get notifications for user
    $.ajax({
        url: base_url + "/auth/getnotifications",
        type: "GET",
        success: function(data) {
            if (data.success == true) {
                $('#notificationCount').attr('data-count',data.notifications.length);

                var htmltextNotifications = '';
                var htmltextMessages = '';
                var notificationCount = 0;
                var messageCount = 0;
                var uniqueUserIDArray = [];

                for (var i = 0; i < data.notifications.length; i++) {
                    if (data.notifications[i].type == "App\\Notifications\\NewMessageNotification") {
                        // Dont print messages from this user
                        if (data.notifications[i].data.user_sending_id != user_id) {
                            // Only print messages from a user only once
                            if (jQuery.inArray(data.notifications[i].data.user_sending_id, uniqueUserIDArray) < 0) {
                                uniqueUserIDArray.push(data.notifications[i].data.user_sending_id);
                                
                                htmltextMessages += '<p id="' + data.notifications[i].id + '" style="padding-left:5px;padding-right:5px;cursor:pointer" onclick="window.location=\'' + base_url + '/user\'"><span style="font-weight:bold">' + data.notifications[i].data.user_sending_name + '</span><span class="pull-right" style="font-size:8px;color:grey" id="mess' + data.notifications[i].id + '"></span><br>';
                                htmltextMessages += data.notifications[i].data.message;
                                htmltextMessages += '<hr style="padding:0;margin:0"></p>';

                                timeArray.push(['mess' + data.notifications[i].id, data.notifications[i].created_at]);
                                messageCount++;
                            }
                        }
                    } else {
                        htmltextNotifications += '<p id="' + data.notifications[i].id + '" style="padding-left:5px;padding-right:5px;cursor:pointer" onclick="window.location=\'' + data.notifications[i].data.url + '/' + data.notifications[i].id + '\'"><span class="pull-right" style="font-size:8px;color:grey" id="noti' + data.notifications[i].id + '"></span>';
                        htmltextNotifications += data.notifications[i].data.message;
                        htmltextNotifications += '<hr style="padding:0;margin:0"></p>';

                        timeArray.push(['noti' + data.notifications[i].id, data.notifications[i].created_at]);
                        notificationCount++;
                    }
                }

                if (notificationCount > 0) {
                    $('#notificationCount').attr('data-count', notificationCount);
                } else {
                    $('#notificationCount').removeAttr('data-count');
                }

                if (messageCount > 0) {
                    $('#messageCount').attr('data-count', messageCount);
                } else {
                    $('#messageCount').removeAttr('data-count');
                }

                $('#notificationList').html(htmltextNotifications);
                $('#messageList').html(htmltextMessages);

                updateTimestamps();
            }
        }
    });
}

// To be UTILIZED LATER.
function markNotificationAsRead(notiID) {
    // mark notification as read
    $.ajax({
        url: base_url + "/auth/marknotificationasread/" + notiID,
        type: "GET",
        success: function(data) {
            if (data.success == true) {
                $('#' + notiID).remove();
            }
        }
    });
}


// ------------------- Tender/Auction Functions for Bidders ------------------ //

function carTenderSignUp(cartenderID) {
    $.ajax({
        url: base_url + "/user/tender/" + cartenderID + "/signup",
        type: "POST",
        success: function(data) {
            if (data.success == true) {
                location.reload();
            } else {
                alertMe("There was an error in processing your request. Please refresh the page and try again.");
            }
        }
    });
}



// ------------------- Message Functions ------------------ //


function getUserMessages(userID) {
    friendUserID = userID;

    $.ajax({
        url: base_url + "/user/getusermessages",
        type: "GET",
        data: { 
            'user_id': friendUserID
        },
        success: function(data) {
            var alertClass = '';
            var pullClass = '';
            var htmltext = '';

            if (data.success == true) {
                $('#usermessages').html('');

                for (var i = 0; i < data.messages.length; i++) {
                    if (data.messages[i].message != "") {
                        if (data.messages[i].user_id_sending == user_id) {
                            alertClass = 'alert alert-success';
                            pullClass = 'pull-right';
                        } else {
                            alertClass = 'alert alert-info';
                            pullClass = 'pull-left';
                        }

                        htmltext += '<div class="col-md-12"><p style="padding:2px;margin:2px;" class="' + alertClass + ' ' + pullClass + '">';
                        htmltext += data.messages[i].message;
                        htmltext += '</p><span style="font-size:10px;color:gray;padding-top:9px" class="' + pullClass + '" id="messagetime' + data.messages[i].id + '"></span></div>';

                        timeArray.push(['messagetime' + data.messages[i].id, data.messages[i].created_at]);
                    }
                }

                $('#usermessages').html(htmltext);

                updateTimestamps();

                $('#message_input').show();
            }
        }
    });
}

function getUserMessagesAndUser(userID) {
    friendUserID = userID;

    $('#messageModal').modal('show');

    $.ajax({
        url: base_url + "/user/getusermessagesanduser",
        type: "GET",
        data: { 
            'user_id': friendUserID
        },
        success: function(data) {
            var alertClass = '';
            var pullClass = '';
            var htmltext = '';

            if (data.success == true) {

                if (data.user.propic != null) {
                    $('#user-info').html('<img src="' + data.user.propic + '" style="width:20px;height:20px"/> ' + data.user.name);
                } else {
                    $('#user-info').html('<img src="' + base_url + '/imgs/no-images.png" style="width:20px;height:20px"/> ' + data.user.name);
                }

                for (var i = 0; i < data.messages.length; i++) {
                    if (data.messages[i].message != "") { 
                        if (data.messages[i].user_id_sending == user_id) {
                            alertClass = 'alert alert-success';
                            pullClass = 'pull-right';
                        } else {
                            alertClass = 'alert alert-info';
                            pullClass = 'pull-left';
                        }

                        htmltext += '<div class="col-md-12"><p style="padding:2px;margin:2px;" class="' + alertClass + ' ' + pullClass + '">';
                        htmltext += data.messages[i].message;
                        htmltext += '</p><span style="font-size:10px;color:gray;padding-top:9px" class="' + pullClass + '" id="messagetime' + data.messages[i].id + '"></span></div>';

                        timeArray.push(['messagetime' + data.messages[i].id, data.messages[i].created_at]);
                    }
                }

                $('#usermessages').append(htmltext);

                updateTimestamps();

                $('#message_input').show();
            }
        }
    });
}

function sendMessage() {
    $.ajax({
        url: base_url + "/user/sendmessage",
        type: "POST",
        data: { 
            'user_id': friendUserID,
            'message': $('.message_input').val()
        },
        success: function(data) {
            if (data.success == true) {
                var htmltext = '';
                alertClass = 'alert alert-success';
                pullClass = 'pull-right';

                htmltext += '<div class="col-md-12"><p style="padding:2px;margin:2px;" class="' + alertClass + ' ' + pullClass + '">';
                htmltext += $('.message_input').val();
                htmltext += '</p><span style="font-size:10px;color:gray;padding-top:9px" class="' + pullClass + '" id="messagetime' + data.message.id + '"></span></div>';

                timeArray.push(['messagetime' + data.message.id, data.message.created_at]);

                $('#usermessages').append(htmltext);

                updateTimestamps();

                $('.message_input').val('');
            }
        }
    });
}


function getNewUsers(partial) {
    $.ajax({
        url: base_url + "/user/getnewusers",
        type: "GET",
        data: { 
            'partial': partial
        },
        success: function(data) {
            var htmltext = '';

            if (data.success == true) {
                for (var i = 0; i < data.users.length; i++) {
                    htmltext += '<a href="javascript:void(0);" onclick="addnewmessageuser(\'' + data.users[i].name + '\', ' + data.users[i].id + ', \'' + data.users[i].propic + '\')" class="list-group-item" data-dismiss="modal">';
                    
                    if (data.users[i].propic != null) {
                        htmltext += '   <img src="' + data.users[i].propic + '" style="width:20px;height:20px"/> ';
                    } else {
                        htmltext += '   <img src="' + base_url + '/imgs/no-images.png" style="width:20px;height:20px"/> ';
                    }

                    htmltext +=     data.users[i].name;
                    htmltext += '   <span style="font-size:9px;color:gray">' + data.users[i].email + '</span>';
                    htmltext += '</a>';
                }

                $('#newUserList').html(htmltext);
            }
        }
    });
}

function addnewmessageuser(userName,userID,propic) {
    var htmltext = '';

    htmltext += '<li class="list-group-item">';
    htmltext += '    <a href="javascript:void(0)" onclick="getUserMessages(' + userID + ')">';

    if (propic != null) {
        htmltext += '        <img src="' + propic + '" style="width:20px;height:20px"> ' + userName;
    } else {
        htmltext += '        <img src="' + base_url + '/imgs/no-images.png" style="width:20px;height:20px"> ' + userName;
    }

    htmltext += '    </a>';
    htmltext += '</li>';

    $('#userList').append(htmltext);

    getUserMessages(userID);
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
            if (data.success == true) {
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
            if (data.success == true) {
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
            'car_id': carID,
            'comment_id': commentID
        },
        success: function(data) {
            if (data.success == true) {
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

function deletePartComment(partID, commentID) {
	// delete users part comment
    $.ajax({
        url: base_url + "/auth/deletepartcomment",
        type: "POST",
        data: { 
            'part_id': partID,
            'comment_id': commentID
        },
        success: function(data) {
            if (data.success == true) {
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
            getCarTails(carID);
        }
    });
}

function tailPart(partID) {
	// tail the part/also untail part is same function (backend function toggles it)
    $.ajax({
        url: base_url + "/auth/tailpart",
        type: "POST",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            getPartTails(partID);
        }
    });
}



// ------------------- Misc. Functions ------------------ //

function isCorpUser(corpID) {
    // check if the current user is a corp user for this corp.
    $.ajax({
        url: base_url + "/auth/iscorpuser",
        type: "POST",
        data: { 
            'corp_id': corpID
        },
        success: function(data) {
            if (data.success == true) {
                // continue
                return true;
            } else {
                // discontinue
                return false;
            }
        }
    });
}

function isTailingCar(carID) {
    // check if the current user is a corp user for this corp.
    $.ajax({
        url: base_url + "/auth/istailingcar",
        type: "GET",
        data: { 
            'car_id': carID
        },
        success: function(data) {
            if (data.success == true) {
                $('#cartailbutton').html('Stop tailing car');
            } else {
                $('#cartailbutton').html('Tail car');
            }
        }
    });
}

function isTailingPart(partID) {
    // check if the current user is a corp user for this corp.
    $.ajax({
        url: base_url + "/auth/istailingpart",
        type: "GET",
        data: { 
            'part_id': partID
        },
        success: function(data) {
            if (data.success == true) {
                $('#parttailbutton').html('Stop tailing part');
            } else {
                $('#parttailbutton').html('Tail part');
            }
        }
    });
}

function hasCorpUserRole(corpID, role) {
    // check if the current user has this corp user role for this corp.
    $.ajax({
        url: base_url + "/auth/hascorpuserrole",
        type: "POST",
        data: { 
            'corp_id': corpID,
            'role': role,
        },
        success: function(data) {
            if (data.success == true) {
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

function loadCarModels(make,url) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            make: make,
        },
        dataType: 'json',
        success: function(data) {
            carmodels = data;
            initCarModelAutocomplete();
        }
    });
}

function initCarModelAutocomplete() {
    $(".carmodelautocomplete").autocomplete({
        source: carmodels,
        minLength: 2
    });
}


function selectPlan(planClass) {
    $('#btn-basic-plan').removeClass();
    $('#btn-small-plan').removeClass();
    $('#btn-business-plan').removeClass();
    $('#btn-premium-plan').removeClass();

    $('#btn-basic-plan').addClass('btn btn-default');
    $('#btn-small-plan').addClass('btn btn-default');
    $('#btn-business-plan').addClass('btn btn-default');
    $('#btn-premium-plan').addClass('btn btn-default');

    $('#btn-basic-plan').html('choose');
    $('#btn-small-plan').html('choose');
    $('#btn-business-plan').html('choose');
    $('#btn-premium-plan').html('choose');

    $('#btn-' + planClass + '-plan').removeClass();
    $('#btn-' + planClass + '-plan').addClass('btn btn-primary');
    $('#btn-' + planClass + '-plan').html('selected');

    $('#subscription').val(planClass);
}


// ------------------- Alert Messages Functions ------------------ //

function alertMe(message) {
    $('#statusModalBody').html(message);
    $('#statusModal').modal('show');
    setTimeout(function() {
        $('#statusModal').modal('hide');
    }, 5000);
}

function confirmMe(message, callback, alert) {
    var htmltext = '';

    htmltext += '<p>' + message + '</p>';
    htmltext += '<p>';
    htmltext += '<button class="btn btn-dafault" data-dismiss="modal">No</button>&nbsp;&nbsp;&nbsp;';
    htmltext += '<button class="btn btn-' + alert + '" onclick="' + callback + '" data-dismiss="modal">Yes</button>';
    htmltext += '<p>';

    $('#statusModalBody').html(htmltext);
    $('#statusModal').modal('show');
}

// ------------------- Variables ------------------ //

var carsaleCancelMessage = 'Are you sure you want to cancel this offer?';
var carrentCancelMessage = 'Are you sure you want to cancel this offer?';
var cartenderCancelMessage = 'Are you sure you want to cancel this tender?';
var carauctionCancelMessage = 'Are you sure you want to cancel this bid?';
var partsaleCancelMessage = 'Are you sure you want to cancel this offer?';














