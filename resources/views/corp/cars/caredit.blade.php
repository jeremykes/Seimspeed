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
        <div class="modal fade" id="confirmCarSave" tabindex="-1" role="dialog" aria-labelledby="confirmCarSave" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 style="text-align:center">Confirm Car Save</h4>
                    </div>
                    <div class="modal-body" style="text-align:center">
                            Are you sure you want to save this car record?<br><br>
                            
                            <a class="btn btn-success" onclick="$('#myform').submit();">Yes, save</a>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal">No, go back</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmCarDelete" tabindex="-1" role="dialog" aria-labelledby="confirmCarDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 style="text-align:center">Confirm Car Delete</h4>
                    </div>
                    <div class="modal-body" style="text-align:center">
                            Are you sure you want to delete this car record?<br><br>
                            There is no undo for this action.<br><br>
                            <form action="{{ url('/corporate/'.$corporate->id.'/cars/car/'.$car->id.'/delete') }}" method="POST">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Yes, delete</button>&nbsp;&nbsp;<a href="#" class="btn btn-default" data-dismiss="modal">No, go back</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars') }}">Cars</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/cars/sales') }}">Sales</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/cars/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
            <h3 style="padding:10px">Car</h3>
          <div class="panel-body" style="padding:0;margin:0">
            
            <div class="col-md-12">
              Update car records here. Click save if you are done. 
              <br>
              <hr>
            </div>

            <div class="col-md-12">

                @if (Session::has('ownermessage') || Session::has('salemessage') || Session::has('rentmessage') || Session::has('auctionmessage') || Session::has('tendermessage') || Session::has('reportsmessage'))
                <div class="alert alert-danger">
                    @if (Session::has('ownermessage')) 
                      {{ Session::get('ownermessage') }} <br>
                    @endif
                    @if (Session::has('salemessage')) 
                      {{ Session::get('salemessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/cars/sales/sale/'.$car->sale->id) }}">see sale</a><br>
                    @endif
                    @if (Session::has('rentmessage')) 
                      {{ Session::get('rentmessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/cars/rents/rent/'.$car->rent->id) }}">see rent</a><br>
                    @endif
                    @if (Session::has('auctionmessage')) 
                      {{ Session::get('auctionmessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/cars/auctions/auction/'.$car->auction->id) }}">see auction</a><br>
                    @endif
                    @if (Session::has('tendermessage')) 
                      {{ Session::get('tendermessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$car->tender->id) }}">see tender</a><br>
                    @endif
                    @if (Session::has('reportsmessage')) 
                      {{ Session::get('reportsmessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/cars/reports') }}">see reports</a><br>
                    @endif

                </div>
                @endif

                @include('common.errors')

                <form action="{{ url('corporate/'.$corporate->id.'/cars/car/'.$car->id.'/update') }}" method="post" id="myform">
                  {!! csrf_field() !!}
                  
                  <div class="form-group col-md-6">
                    <label for="webmenu">Body Type *</label>
                    <select class="bodytypeselect" name="webmenu" id="webmenu" style="width:100%">

                        @if ($car->bodytype == 'cargovan')
                          <option value="cargovan" data-image="{{ asset('imgs/carbodytype/cargo-van-2.png') }}" selected>Cargo Van</option>
                        @else
                          <option value="cargovan" data-image="{{ asset('imgs/carbodytype/cargo-van-2.png') }}">Cargo Van</option>
                        @endif
                        @if ($car->bodytype == 'coupe')
                          <option value="coupe" data-image="{{ asset('imgs/carbodytype/coupe.png') }}" selected>Coupe</option>
                        @else
                          <option value="coupe" data-image="{{ asset('imgs/carbodytype/coupe.png') }}">Coupe</option>
                        @endif
                        @if ($car->bodytype == 'hatchback')
                          <option value="hatchback" data-image="{{ asset('imgs/carbodytype/hatchback-3.png') }}" selected>Hatchback</option>
                        @else
                          <option value="hatchback" data-image="{{ asset('imgs/carbodytype/hatchback-3.png') }}">Hatchback</option>
                        @endif
                        @if ($car->bodytype == 'jeep')
                          <option value="jeep" data-image="{{ asset('imgs/carbodytype/suv-mini.png') }}" selected>Jeep</option>
                        @else
                          <option value="jeep" data-image="{{ asset('imgs/carbodytype/suv-mini.png') }}">Jeep</option>
                        @endif
                        @if ($car->bodytype == 'limousine')
                          <option value="limousine" data-image="{{ asset('imgs/carbodytype/limousine.png') }}" selected>Limousine</option>
                        @else
                          <option value="limousine" data-image="{{ asset('imgs/carbodytype/limousine.png') }}">Limousine</option>
                        @endif
                        @if ($car->bodytype == 'bus')
                          <option value="bus" data-image="{{ asset('imgs/carbodytype/minibus-4-5.png') }}" selected>Bus</option>
                        @else
                          <option value="bus" data-image="{{ asset('imgs/carbodytype/minibus-4-5.png') }}">Bus</option>
                        @endif
                        @if ($car->bodytype == 'pickup')
                          <option value="pickup" data-image="{{ asset('imgs/carbodytype/pickup-full.png') }}" selected>Pickup</option>
                        @else
                          <option value="pickup" data-image="{{ asset('imgs/carbodytype/pickup-full.png') }}">Pickup</option>
                        @endif
                        @if ($car->bodytype == 'sedan')
                          <option value="sedan" data-image="{{ asset('imgs/carbodytype/sedan-4.png') }}" selected>Sedan</option>
                        @else
                          <option value="sedan" data-image="{{ asset('imgs/carbodytype/sedan-4.png') }}">Sedan</option>
                        @endif
                        @if ($car->bodytype == 'suv')
                          <option value="suv" data-image="{{ asset('imgs/carbodytype/suv-full.png') }}" selected>SUV</option>
                        @else
                          <option value="suv" data-image="{{ asset('imgs/carbodytype/suv-full.png') }}">SUV</option>
                        @endif
                        @if ($car->bodytype == 'van')
                          <option value="van" data-image="{{ asset('imgs/carbodytype/minivan.png') }}" selected>Van</option>
                        @else
                          <option value="van" data-image="{{ asset('imgs/carbodytype/minivan.png') }}">Van</option>
                        @endif
                        @if ($car->bodytype == 'wagon')
                          <option value="wagon" data-image="{{ asset('imgs/carbodytype/station-wagon-full.png') }}" selected>Wagon</option>
                        @else
                          <option value="wagon" data-image="{{ asset('imgs/carbodytype/station-wagon-full.png') }}">Wagon</option>
                        @endif
                        @if ($car->bodytype == 'truck')
                          <option value="truck" data-image="{{ asset('imgs/carbodytype/truck-2.png') }}" selected>Truck</option>
                        @else
                          <option value="truck" data-image="{{ asset('imgs/carbodytype/truck-2.png') }}">Truck</option>
                        @endif
                      
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="make">Make *</label>
                    <input type="text" class="form-control carmakeautocomplete" id="make" name="make" value="{{ $car->make }}">
                    <span style="color:grey;font-size:10px">Toyota, Nassan, Porche, etc. Start typing to see hints.</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="model">Model *</label>
                    <input type="text" class="form-control carmodelautocomplete" id="model" name="model" value="{{ $car->model }}">
                    <span style="color:grey;font-size:10px">Land Cruiser, Sunny, Corola, etc. Start typing to see hints.</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="plates">Plates *</label>
                    <input type="text" class="form-control" id="plates" name="plates" value="{{ $car->plates }}">
                    <span style="color:grey;font-size:10px">&nbsp;</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ $car->color }}">
                    <span style="color:grey;font-size:10px">&nbsp;</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" id="weight" name="weight" value="{{ $car->weight }}">
                    <span style="color:grey;font-size:10px">In tonnes</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="dateboughtat">Date bought</label>
                    <input type="text" class="form-control datepicker" id="dateboughtat" name="dateboughtat" value="{{ $car->datebought->format('d/m/Y') }}">
                    <span style="color:grey;font-size:10px">day/month/year</span>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" name="note" value="{{ $car->note }}">
                    <span style="color:grey;font-size:10px">&nbsp;</span>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="physicallocation">Physical location</label>
                    <input type="text" class="form-control" id="physicallocation" name="physicallocation" value="{{ $car->physicallocation }}">
                    <span style="color:grey;font-size:10px">The physical location of the car</span>
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control col-md-6" id="published" name="published">
                      @if ($car->published == true)
                        <option value="1" selected>Published</option>
                        <option value="0">Unpublished</option>
                      @else
                        <option value="1">Published</option>
                        <option value="0" selected>Upublished</option>
                      @endif
                    </select>
                    <span style="color:grey;font-size:10px">If car is UNPUBLISHED then it will NOT be accessible to the public.</span>
                  </div>
                  <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                    <label>Upload at least 3 pictures of your car.</label>
                    <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
                    
                  </div>
                  <div class="form-group col-md-12">
                    <hr>
                  </div>
                  <div class="form-group col-md-12">
                    <a class="btn btn-success" onclick="$('#confirmCarSave').modal()"><i class="fa fa-wrench"></i> Save</a> <a onclick="$('#confirmCarDelete').modal()" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete car</a>
                  </div>
                </form>
                <span class="badge" id="errors"></span>
            </div>

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

carimagearray = [

                      @foreach ($carimagearray as $carimage)
                        {
                            filename: "{{ $carimage['filename'] }}",
                            img_url: "{{ asset($carimage['img_url']) }}",
                            img_url_relative: "{{ $carimage['img_url'] }}",
                            img_count: {{ $carimage['img_count'] }},
                        },
                      @endforeach
                  ];

$(document).ready(function(e) {
    try {
        $(".bodytypeselect").msDropDown();
    } catch(e) {
        alert(e.message);
    }

    var addedFileCount = 1;

    Dropzone.options.myAwesomeDropzone = {
          init: function() {
              thisDropzone = this;

              for (var i = 0; i < carimagearray.length; i++) {
                var mockFile = { name: carimagearray[i]['img_url']};
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, carimagearray[i]['img_url']);
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');

                $(mockFile.previewTemplate).append('<span class="server_filename" style="display:none">'+carimagearray[i]['filename']+'</span>');
                $(mockFile.previewTemplate).append('<span class="server_fileurl" style="display:none">'+carimagearray[i]['img_url_relative']+'</span>');
                $(mockFile.previewTemplate).append('<span class="server_filecount" style="display:none">'+carimagearray[i]['img_count']+'</span>');
                addedFileCount++;
              }

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
                      url: "{{ url('/corporate/'.$corporate->id.'/cars/car/'.$car->id.'/deleteimage') }}",
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
          url: "{{ url('/corporate/'.$corporate->id.'/cars/car/'.$car->id.'/uploadimage') }}",
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
