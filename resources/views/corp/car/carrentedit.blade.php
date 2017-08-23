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

    <form action="{{ url('/corporate/' . $corporate->id .'/corpuser/rents/car/addrent') }}" method="post">

        @include('common.errors')

        <!-- To send carID into controller if user selects one. FUTURE -->
        <input type="hidden" id="carrent_id" name="carrent_id" value="{{ $carrent->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-12">
            <h3>
                Car details 
                <span class="label label-default">Edit</span>
                <span class="pull-right"><a href="javascript:void(0);" onclick="confirmMe('Are you sure you want to close this car rent?', 'closeCarRent({{ $carrent->id }})', 'danger')" class="btn btn-xs btn-default">close</a></span>
            </h3>
        </div>
        <div class="form-group col-md-6">
            <label for="webmenu">Body Type *</label>
            <select class="bodytypeselect" name="webmenu" id="webmenu" style="width:100%">
                @if ($carrent->car->bodytype == 'cargovan')
                    <option value="cargovan" data-image="{{ asset('imgs/carbodytype/cargo-van-2.png') }}" selected>Cargo Van</option>
                @else 
                    <option value="cargovan" data-image="{{ asset('imgs/carbodytype/cargo-van-2.png') }}">Cargo Van</option>
                @endif
                @if ($carrent->car->bodytype == 'coupe')
                    <option value="coupe" data-image="{{ asset('imgs/carbodytype/coupe.png') }}" selected>Coupe</option>
                @else
                    <option value="coupe" data-image="{{ asset('imgs/carbodytype/coupe.png') }}">Coupe</option>
                @endif
                @if ($carrent->car->bodytype == 'hatchback')
                    <option value="hatchback" data-image="{{ asset('imgs/carbodytype/hatchback-3.png') }}" selected>Hatchback</option>
                @else 
                    <option value="hatchback" data-image="{{ asset('imgs/carbodytype/hatchback-3.png') }}">Hatchback</option>
                @endif
                @if ($carrent->car->bodytype == 'jeep')
                    <option value="jeep" data-image="{{ asset('imgs/carbodytype/suv-mini.png') }}" selected>Jeep</option>
                @else 
                    <option value="jeep" data-image="{{ asset('imgs/carbodytype/suv-mini.png') }}">Jeep</option>
                @endif
                @if ($carrent->car->bodytype == 'limousine')
                    <option value="limousine" data-image="{{ asset('imgs/carbodytype/limousine.png') }}" selected>Limousine</option>
                @else
                    <option value="limousine" data-image="{{ asset('imgs/carbodytype/limousine.png') }}">Limousine</option>
                @endif
                @if ($carrent->car->bodytype == 'bus')
                    <option value="bus" data-image="{{ asset('imgs/carbodytype/minibus-4-5.png') }}" selected>Bus</option>
                @else
                    <option value="bus" data-image="{{ asset('imgs/carbodytype/minibus-4-5.png') }}">Bus</option>
                @endif
                @if ($carrent->car->bodytype == 'pickup')
                    <option value="pickup" data-image="{{ asset('imgs/carbodytype/pickup-full.png') }}" selected>Pickup</option>
                @else 
                    <option value="pickup" data-image="{{ asset('imgs/carbodytype/pickup-full.png') }}">Pickup</option>
                @endif
                @if ($carrent->car->bodytype == 'sedan')
                    <option value="sedan" data-image="{{ asset('imgs/carbodytype/sedan-4.png') }}" selected>Sedan</option>
                @else
                    <option value="sedan" data-image="{{ asset('imgs/carbodytype/sedan-4.png') }}">Sedan</option>
                @endif
                @if ($carrent->car->bodytype == 'suv')
                    <option value="suv" data-image="{{ asset('imgs/carbodytype/suv-full.png') }}" selected>SUV</option>
                @else
                    <option value="suv" data-image="{{ asset('imgs/carbodytype/suv-full.png') }}">SUV</option>
                @endif
                @if ($carrent->car->bodytype == 'van')
                    <option value="van" data-image="{{ asset('imgs/carbodytype/minivan.png') }}" selected>Van</option>
                @else
                    <option value="van" data-image="{{ asset('imgs/carbodytype/minivan.png') }}">Van</option>
                @endif
                @if ($carrent->car->bodytype == 'wagon')
                    <option value="wagon" data-image="{{ asset('imgs/carbodytype/station-wagon-full.png') }}" selected>Wagon</option>
                @else 
                    <option value="wagon" data-image="{{ asset('imgs/carbodytype/station-wagon-full.png') }}">Wagon</option>
                @endif
                @if ($carrent->car->bodytype == 'truck')
                    <option value="truck" data-image="{{ asset('imgs/carbodytype/truck-2.png') }}" selected>Truck</option>
                @else
                    <option value="truck" data-image="{{ asset('imgs/carbodytype/truck-2.png') }}">Truck</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="make">Make *</label>
            <input type="text" class="form-control carmakeautocomplete" id="make" name="make" value="{{ $carrent->car->make }}">
            <span style="color:grey;font-size:10px">Toyota, Nassan, Porche, etc. Start typing to see hints.</span>
        </div>
        <div class="form-group col-md-6">
            <label for="model">Model *</label>
            <input type="text" class="form-control carmodelautocomplete" id="model" name="model" value="{{ $carrent->car->model }}">
            <span style="color:grey;font-size:10px">Land Cruiser, Sunny, Corola, etc. Start typing to see hints.</span>
        </div>
        <div class="form-group col-md-6">
            <label for="plates">Plates *</label>
            <input type="text" class="form-control" id="plates" name="plates" value="{{ $carrent->car->plates }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ $carrent->car->color }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="weight">Weight</label>
            <input type="text" class="form-control" id="weight" name="weight" value="{{ $carrent->car->weight }}">
            <span style="color:grey;font-size:10px">In tonnes</span>
        </div>
        <div class="form-group col-md-6">
            <label for="fueltype">Fuel Type</label>
            <select class="form-control" id="fueltype" name="fueltype">
                @if ($carrent->car->fueltype == 'diesel')
                    <option value="diesel" selected>Diesel</option>
                    <option value="petrol">Petrol</option>
                @else 
                    <option value="diesel">Diesel</option>
                    <option value="petrol" selected>Petrol</option>
                @endif
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="transmissiontype">Transmission Type</label>
            <select class="form-control" id="transmissiontype" name="transmissiontype" >
                @if ($carrent->car->fueltype == 'automatic')
                    <option value="automatic" selected>Automatic</option>
                    <option value="manual">Manual</option>
                @else
                    <option value="automatic">Automatic</option>
                    <option value="manual" selected>Manual</option>
                @endif
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="drivetype">Drive Type</label>
            <select class="form-control" id="drivetype" name="drivetype" >
                @if ($carrent->car->fueltype == '2 wheel drive')
                    <option value="2 wheel drive" selected>2 wheel drive</option>
                    <option value="4 wheel drive">4 wheel drive</option>
                @else
                    <option value="2 wheel drive">2 wheel drive</option>
                    <option value="4 wheel drive" selected>4 wheel drive</option>
                @endif
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="steeringside">Steering side</label>
            <select class="form-control" id="steeringside" name="steeringside">
                @if ($carrent->car->fueltype == 'right')
                    <option value="right" selected>right</option>
                    <option value="left">left</option>
                @else
                    <option value="right">right</option>
                    <option value="left" selected>left</option>
                @endif
            </select>
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="physicallocation">Physical location</label>
            <input type="text" class="form-control" id="physicallocation" name="physicallocation" value="{{ $carrent->car->physicallocation }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="datebought">Date bought</label>
            <input type="text" class="form-control datepicker" id="datebought" name="datebought" value="{{ $carrent->car->datebought->format('d/m/Y') }}">
            <span style="color:grey;font-size:10px">day/month/year</span>
        </div>
        <div class="form-group col-md-12">
            <label for="carnote">Car note</label>
            <input type="text" class="form-control" id="carnote" name="carnote" value="{{ $carrent->car->note }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
            <label>Upload at least 3 pictures of your car.</label>
            <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
        </div>
        <div class="col-md-12"><hr></div>
        <div class="col-md-12"><h3>Rent details</h3></div>
        <div class="form-group col-md-6">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $carrent->price }}">
            <span style="color:grey;font-size:10px">In Kina</span>
        </div>
        <div class="form-group col-md-6">
            <label for="negotiable">negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable">
                @if ($carrent->negotiable == '1')
                    <option value="1" selected>yes</option>
                    <option value="0">no</option>
                @else
                    <option value="1">yes</option>
                    <option value="0" selected>no</option>
                @endif
            </select>
            <span style="color:grey;font-size:10px"></span>
        </div>
        <div class="form-group col-md-12">
            <label for="rentnote">Rent note</label>
            <input type="text" class="form-control" id="rentnote" name="rentnote" value="{{ $carrent->note }}">
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

              var mockFile;
              var fileuploded;

              @foreach ($carrent->car->images as $carimage)
                  mockFile = { name: "preview", size: 0, filename: "preview" };
                  this.emit("addedfile", mockFile);
                  this.createThumbnailFromUrl(mockFile, "{{ $carimage->img_url }}");
                  this.emit("complete", mockFile);
                  fileuploded = mockFile.previewElement.querySelector("[data-dz-name]");
                  fileuploded.innerHTML = "preview";
              @endforeach


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
                      url: "{{ url('/corporate/' . $corporate->id . '/corpuser/rents/car/cardeletetempimage') }}",
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
          url: "{{ url('/corporate/' . $corporate->id . '/corpuser/rents/car/caruploadtempimage') }}",
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



