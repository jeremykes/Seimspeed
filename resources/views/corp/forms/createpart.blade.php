@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('corp-part')
        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/parts/sales') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts') }}">Parts</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts/sales') }}">Sales</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts/sales/part') }}">Part</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/parts/sales/part/edit') }}">Edit</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>
        <div class="col-md-12">
          <div class="panel panel-primary" style="padding-bottom:0;margin-bottom:0;">
            <h3 style="padding:10px">Create new part</h3>
            <div class="panel-body"> 
              <div class="col-md-12">
                Insert part details here and click the save button once you are done. Note that (*) fields are required.
                <br>
                <hr>
              </div>

              <div class="col-md-12">

                  @include('common.errors')

                  <form action="{{ url('corporate/'.$corporate->id.'/parts/store') }}" method="post">
                    {!! csrf_field() !!}
                    
                    <div class="form-group col-md-6">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Part name">
                      <span style="color:grey;font-size:10px">&nbsp;</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="serialnumber">Serial Number</label>
                      <input type="text" class="form-control" id="serialnumber" name="serialnumber" placeholder="Serial number">
                      <span style="color:grey;font-size:10px">&nbsp;</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="descript">Description</label>
                      <input type="text" class="form-control" id="descript" name="descript" placeholder="Description">
                      <span style="color:grey;font-size:10px">&nbsp;</span>
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
                      <span style="color:grey;font-size:10px">If part is UNPUBLISHED then it will NOT be accessible to the public.</span>
                    </div>
                    <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                      <label>Upload at least 3 pictures of your part.</label>
                      <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
                    </div>
                    <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-default pull-right">Save</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>  
@endsection

@section('script')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(e) {

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
                      url: "{{ url('/corporate/'.$corporate->id.'/part/deletetempimage') }}",
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
          url: "{{ url('/corporate/'.$corporate->id.'/part/uploadtempimage') }}",
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
