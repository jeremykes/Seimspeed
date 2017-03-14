@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/msdropdown/dd.css') }}" rel="stylesheet">
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('corp-cars')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/cars/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales/car') }}">Car</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/cars/sales/car/edit') }}">Edit</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <h3 style="padding:10px">Create new car</h3>
            <div class="panel-body"> 

                @if ($carlimitreached)

                  <div class="col-md-12" style="text-align:center">
                    <h3>You have reached your maximum allowed cars <img src="{{ asset('imgs/crying.png') }}" style="height:40px;width:auto"></h3>
                    <hr>
                    <p>You have reached the maximum allowed number of cars for this <strong>{{ $subscription->name }}</strong> account</p>
                    <p>If you wish to add a new car, please delete, unpublish, or sell another car.</p>
                    <p>You may, however, <span class="btn btn-success btn-xs">upgrade</span> your account to increase the number of cars you can add.</p>
                  </div>

                @else

                  <div class="col-md-12">
                    Insert car details here and click the save button once you are done. Note that (*) fields are required.
                    <br>
                    <hr>
                  </div> 

                  <div class="col-md-12">

                      @include('common.errors')

                      <form action="{{ url('corporate/'.$corporate->id.'/cars/store') }}" method="post">
                        {!! csrf_field() !!}
                        
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
                          <label for="dateboughtat">Date bought</label>
                          <input type="text" class="form-control datepicker" id="dateboughtat" name="dateboughtat">
                          <span style="color:grey;font-size:10px">day/month/year</span>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="note">Note</label>
                          <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                          <span style="color:grey;font-size:10px">&nbsp;</span>
                        </div>
                        <div class="form-group col-md-6">
                          <select class="form-control col-md-6" id="published" name="published">
                              <option value="1" selected>Published</option>
                              <option value="0">Unpublished</option>
                          </select>
                          <span style="color:grey;font-size:10px">If car is UNPUBLISHED then it will NOT be accessible to the public.</span>
                        </div>
                        <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                          <label>Upload at least 3 pictures of your car.</label>
                          <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
                        </div>
                        <div class="form-group col-md-12">
                          <button type="submit" class="btn btn-default pull-right" id="savebutton" disabled>Save</button>
                        </div>
                      </form>
                  </div>

                  <span class="badge" id="errors"></span>

                @endif

            </div>
          </div>
        </div>  
@endsection


@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/msdropdown/jquery.dd.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>

<script type="text/javascript">

carmakes = [
              @foreach ($carmakes as $carmake)
                  '{{ $carmake }}',
              @endforeach
           ]

carmodels = [];

$(document).ready(function(e) {
    try {
        $(".bodytypeselect").msDropDown();
    } catch(e) {
        alert(e.message);
    }

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
                      url: "{{ url('/corporate/'.$corporate->id.'/car/deletetempimage') }}",
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
          url: "{{ url('/corporate/'.$corporate->id.'/car/uploadtempimage') }}",
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
          loadCarModels(ui.item.value, "{{ url('/loadcarmodels') }}");
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
