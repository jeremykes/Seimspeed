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

    <form action="{{ url('/corporate/' . $corporate->id .'/corpuser/sales/part/updatesale') }}" method="post">

        @include('common.errors')

        <!-- To send partID into controller if user selects one. FUTURE -->
        <input type="hidden" id="partsale_id" name="partsale_id" value="{{ $partsale->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-12"><h3>Part details</h3></div>
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $partsale->part->name }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="serialnumber">Serial number</label>
            <input type="text" class="form-control" id="serialnumber" name="serialnumber" value="{{ $partsale->part->serialnumber }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="descript">Description</label>
            <input type="text" class="form-control" id="descript" name="descript" value="{{ $partsale->part->descript }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-6">
            <label for="physicallocation">Physical location</label>
            <input type="text" class="form-control" id="physicallocation" name="physicallocation" value="{{ $partsale->part->physicallocation }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-12">
            <label for="partnote">Part note</label>
            <input type="text" class="form-control" id="partnote" name="partnote" value="{{ $partsale->part->note }}">
            <span style="color:grey;font-size:10px">&nbsp;</span>
        </div>
        <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
            <label>Upload at least 3 pictures.</label>
            <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
        </div>
        <div class="col-md-12"><hr></div>
        <div class="col-md-12"><h3>Sale details</h3></div>
        <div class="form-group col-md-6">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $partsale->price }}">
            <span style="color:grey;font-size:10px">In Kina</span>
        </div>
        <div class="form-group col-md-6">
            <label for="negotiable">negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable">
                @if ($partsale->negotiable == '1')
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
            <label for="salenote">Sale note</label>
            <input type="text" class="form-control" id="salenote" name="salenote" value="{{ $partsale->note }}">
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


$(document).ready(function(e) {
    $(".bodytypeselect").msDropDown();

    var addedFileCount = 1;

    Dropzone.options.myAwesomeDropzone = {
          init: function() {

              var mockFile;
              var fileuploded;

              @foreach ($partsale->part->images as $partimage)
                  mockFile = { name: "preview", size: 0, filename: "preview" };
                  this.emit("addedfile", mockFile);
                  this.createThumbnailFromUrl(mockFile, "{{ $partimage->img_url }}");
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
                      url: "{{ url('/corporate/' . $corporate->id . '/corpuser/sales/part/partdeletetempimage') }}",
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
          url: "{{ url('/corporate/' . $corporate->id . '/corpuser/sales/part/partuploadtempimage') }}",
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

});

</script>

@endsection



