@extends('corp.layouts.app')

@section('css')
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/msdropdown/dd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection


@section('realtime')

<script>

    var corporateID = {{ $corporate->id }};

</script>

@endsection


@section('tabs')

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/dashboard') }}" aria-controls="dashboard" role="tab">Dashboard</a></li>
    <li role="presentation" class="active"><a href="{{ url('/corporate/' . $corporate->id . '/store') }}" aria-controls="store" role="tab">Store</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/members') }}" aria-controls="members" role="tab">Members</a></li>
    <li role="presentation"><a href="{{ url('/corporate/' . $corporate->id . '/settings') }}" aria-controls="settings" role="tab">Settings</a></li>
</ul>

@endsection


@section('dashboard-tab')
<div role="tab-panel" class="tab-pane" id="dashboard">
@endsection
@section('store-tab')
<div role="tab-panel" class="tab-pane active" id="store">
@endsection
@section('members-tab')
<div role="tab-panel" class="tab-pane" id="members">
@endsection
@section('settings-tab')
<div role="tab-panel" class="tab-pane" id="settings">
@endsection


@section('store-content')
<div class="col-md-12"><br></div>

<div class="col-md-12">

    <form action="{{ url('/corporate/' . $corporate->id .'/corpuser/sales/car/addsale') }}" method="post">

        @include('common.errors')

        <!-- To send carID into controller if user selects one. FUTURE -->
        <input type="hidden" id="car_id" name="car_id" value="0">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-12"><h3>Car details</h3></div>
        <div class="form-group col-md-6">
            <label for="webmenu">Body Type *</label>
            <select class="bodytypeselect" name="webmenu" id="webmenu" style="width:100%">
                <option value="cargovan" data-image="{{ asset('imgs/carbodytype/cargo-van-2.png') }}">Cargo Van</option>
                <option value="coupe" data-image="{{ asset('imgs/carbodytype/coupe.png') }}">Coupe</option>
                <option value="hatchback" data-image="{{ asset('imgs/carbodytype/hatchback-3.png') }}">Hatchback</option>
                <option value="jeep" data-image="{{ asset('imgs/carbodytype/suv-mini.png') }}">Jeep</option>
                <option value="limousine" data-image="{{ asset('imgs/carbodytype/limousine.png') }}">Limousine</option>
                <option value="bus" data-image="{{ asset('imgs/carbodytype/minibus-4-5.png') }}">Bus</option>
                <option value="pickup" data-image="{{ asset('imgs/carbodytype/pickup-full.png') }}">Pickup</option>
                <option value="sedan" data-image="{{ asset('imgs/carbodytype/sedan-4.png') }}" selected="">Sedan</option>
                <option value="suv" data-image="{{ asset('imgs/carbodytype/suv-full.png') }}">SUV</option>
                <option value="van" data-image="{{ asset('imgs/carbodytype/minivan.png') }}">Van</option>
                <option value="wagon" data-image="{{ asset('imgs/carbodytype/station-wagon-full.png') }}">Wagon</option>
                <option value="truck" data-image="{{ asset('imgs/carbodytype/truck-2.png') }}">Truck</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="make">Make *</label>
            <input type="text" class="form-control carmakeautocomplete" id="make" name="make" placeholder="Make">
            <span style="color:grey;font-size:10px">Toyota, Nassan, Porche, etc. Start typing to see hints.</span>
        </div>
        <div class="form-group col-md-6">
            <label for="model">Model *</label>
            <input type="text" class="form-control carmodelautocomplete" id="model" name="model" placeholder="Model">
            <span style="color:grey;font-size:10px">Land Cruiser, Sunny, Corola, etc. Start typing to see hints.</span>
        </div>
        <div class="form-group col-md-6">
            <label for="plates">Plates *</label>
            <input type="text" class="form-control" id="plates" name="plates" placeholder="Plates">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" placeholder="Color">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="weight">Weight</label>
            <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight">
            <span style="color:grey;font-size:10px">In tonnes</span>
        </div>
        <div class="form-group col-md-6">
            <label for="fueltype">Fuel Type</label>
            <select class="form-control" id="fueltype" name="fueltype" >
                <option value="diesel">Diesel</option>
                <option value="petrol">Petrol</option>
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="transmissiontype">Transmission Type</label>
            <select class="form-control" id="transmissiontype" name="transmissiontype" >
                <option value="automatic">Automatic</option>
                <option value="manual">Manual</option>
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="drivetype">Drive Type</label>
            <select class="form-control" id="drivetype" name="drivetype" >
                <option value="2 wheel drive">2 wheel drive</option>
                <option value="4 wheel drive">4 wheel drive</option>
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="steeringside">Steering side</label>
            <select class="form-control" id="steeringside" name="steeringside">
                <option value="right">right</option>
                <option value="left">left</option>
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="physicallocation">Physical location</label>
            <input type="text" class="form-control" id="physicallocation" name="physicallocation" placeholder="Physical location">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="datebought">Date bought</label>
            <input type="text" class="form-control datepicker" id="datebought" name="datebought">
            <span style="color:grey;font-size:10px">day/month/year</span>
        </div>
        <div class="form-group col-md-12">
            <label for="carnote">Car note</label>
            <input type="text" class="form-control" id="carnote" name="carnote" placeholder="Car note">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
            <label>Upload at least 3 pictures of your car.</label>
            <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
        </div>
        <div class="col-md-12"><hr></div>
        <div class="col-md-12"><h3>Sale details</h3></div>
        <div class="form-group col-md-6">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="price">
            <span style="color:grey;font-size:10px">In Kina</span>
        </div>
        <div class="form-group col-md-6">
            <label for="negotiable">negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable">
                <option value="1">yes</option>
                <option value="0">no</option>
            </select>
            <span style="color:grey;font-size:10px"></span>
        </div>
        <div class="form-group col-md-12">
            <label for="salenote">Sale note</label>
            <input type="text" class="form-control" id="salenote" name="salenote" placeholder="Sale note">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-default pull-right" id="savebutton">Save</button>
        </div>
    </form>

</div>

<div class="col-md-12"><br></div>

@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/msdropdown/jquery.dd.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>

<script>

var carmakes = [
              @foreach ($carmakes as $carmake)
                  '{{ $carmake }}',
              @endforeach
           ]

var carmodels = [];


$(document).ready(function(e) {
    $(".bodytypeselect").msDropDown();

    var addedFileCount = 1;

    Dropzone.options.myAwesomeDropzone = {
          init: function() {
              this.on("addedfile", function(file) { 
                  if (addedFileCount >= 3) {
                    $('#savebutton').prop('disabled', false);
                  }
              });
              this.on('removedfile', function(file, response) {
                  var server_filename = $(file.previewTemplate).children('.server_filename').text();
                  var server_fileurl = $(file.previewTemplate).children('.server_fileurl').text();
                  var server_filecount = $(file.previewTemplate).children('.server_filecount').text();

                  $.ajax({
                      url: "{{ url('/corporate/' . $corporate->id . '/corpuser/sales/car/cardeletetempimage') }}",
                      type: "POST",
                      data: { 
                          'serverfilename': server_filename,
                          'serverfileurl': server_fileurl,
                          'serverfilecount': server_filecount
                      },
                      success: function(report) {
                          if (report.success == true) {
                              addedFileCount--;
                              if (addedFileCount < 3) {
                                $('#savebutton').prop('disabled', true);
                              }
                          } else {
                              $('#errors').html(report.message);
                          }
                              
                      }
                  });

                  
              });
          },
          url: "{{ url('/corporate/' . $corporate->id . '/corpuser/sales/car/caruploadtempimage') }}",
          method: 'post',
          headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') },
          maxFilesize: 2, 
          addRemoveLinks: true,
          dictDefaultMessage: 'Click here to upload images or simply drop them here',
          acceptedFiles: 'image/*',
          success: function(file, response) {
            $(file.previewTemplate).append('<span class="server_filename" style="display:none">'+response.filename+'</span>');
            $(file.previewTemplate).append('<span class="server_fileurl" style="display:none">'+response.img_url+'</span>');
            $(file.previewTemplate).append('<span class="server_filecount" style="display:none">'+response.img_count+'</span>');
            addedFileCount++;
          }
    };

    $('.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'd/m/yy'
    });

    $(".carmakeautocomplete").autocomplete({
        source: carmakes,
        minLength: 2,
        select: function( event, ui ) {
          loadCarModels(ui.item.value, "{{ url('/corporate/' . $corporate->id . '/corpuser/loadcarmodels') }}");
        },
        change: function( event, ui ) {
          if ($('.carmakeautocomplete').val() == null || $('.carmakeautocomplete').val() == '') 
          {
            carmodels = [];
            initCarModelAutocomplete();
          }
        }
    });
});

</script>

@endsection



