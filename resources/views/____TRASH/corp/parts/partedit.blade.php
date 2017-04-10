@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('corp-part')
        <div class="modal fade" id="confirmPartSave" tabindex="-1" role="dialog" aria-labelledby="confirmPartSave" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 style="text-align:center">Confirm Part Save</h4>
                    </div>
                    <div class="modal-body" style="text-align:center">
                            Are you sure you want to save this part record?<br><br>
                            
                            <a class="btn btn-success" onclick="$('#myform').submit();">Yes, save</a>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal">No, go back</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmPartDelete" tabindex="-1" role="dialog" aria-labelledby="confirmPartDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 style="text-align:center">Confirm Part Delete</h4>
                    </div>
                    <div class="modal-body" style="text-align:center">
                            Are you sure you want to delete this part record?<br><br>
                            There is no undo for this action.<br><br>
                            <form action="{{ url('/corporate/'.$corporate->id.'/parts/part/'.$part->id.'/delete') }}" method="POST">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Yes, delete</button>&nbsp;&nbsp;<a href="#" class="btn btn-default" data-dismiss="modal">No, go back</a>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <a style="color:grey;font-size:9px" class="btn btn-default btn-xs" href="{{ url('corporate/'.$corporate->id.'/parts') }}">Back</a>&nbsp;&nbsp;
            <span style="color:grey;font-size:10px">Breadcrumbs ></span> 
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts') }}">Parts</a>
            <span style="color:grey;font-size:10px">></span>
            <a style="color:grey;font-size:9px" class="btn btn-xs btn-default" href="{{ url('corporate/'.$corporate->id.'/parts/sales') }}">Sales</a>
            <span class="pull-right">
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales') }}">Sales</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/groups') }}">Groups</a>
              <a style="font-size:10px" class="btn btn-primary btn-xs" href="{{ url('corporate/parts/sales/reserves') }}">Reserved</a>
            </span>
        </div>

        <br>
        <hr>

        <div class="col-md-12">
          <div class="panel panel-primary">
            <h3 style="padding:10px">part</h3>
          <div class="panel-body" style="padding:0;margin:0">
            
            <div class="col-md-12">
              Update part records here. Click save if you are done. 
              <br>
              <hr>
            </div>

            <div class="col-md-12">

                @if (Session::has('ownermessage') || Session::has('salemessage') || Session::has('reportsmessage'))
                <div class="alert alert-danger">
                    @if (Session::has('ownermessage')) 
                      {{ Session::get('ownermessage') }} <br>
                    @endif
                    @if (Session::has('salemessage')) 
                      {{ Session::get('salemessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/parts/sales/sale/'.$part->sale->id) }}">see sale</a><br>
                    @endif
                    @if (Session::has('reportsmessage')) 
                      {{ Session::get('reportsmessage') }} <a href="{{ url('/corporate/'.$corporate->id.'/parts/reports') }}">see reports</a><br>
                    @endif

                </div>
                @endif

                @include('common.errors')

                <form action="{{ url('corporate/'.$corporate->id.'/parts/part/'.$part->id.'/update') }}" method="post" id="myform">
                  {!! csrf_field() !!}
                  
                  <div class="form-group col-md-6">
                    <label for="name">name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $part->name }}">
                    <span style="color:grey;font-size:10px">Toyota, Nassan, Porche, etc. Start typing to see hints.</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="serialnumber">Serial number</label>
                    <input type="text" class="form-control" id="serialnumber" name="serialnumber" value="{{ $part->serialnumber }}">
                    <span style="color:grey;font-size:10px">&nbsp;</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="descript">Description</label>
                    <input type="text" class="form-control" id="descript" name="descript" value="{{ $part->descript }}">
                    <span style="color:grey;font-size:10px">Land Cruiser, Sunny, Corola, etc. Start typing to see hints.</span>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" name="note" value="{{ $part->note }}">
                    <span style="color:grey;font-size:10px">&nbsp;</span>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="physicallocation">Physical location</label>
                    <input type="text" class="form-control" id="physicallocation" name="physicallocation" value="{{ $part->physicallocation }}">
                    <span style="color:grey;font-size:10px">The physical location of the part</span>
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control col-md-6" id="published" name="published">
                      @if ($part->published == true)
                        <option value="1" selected>Published</option>
                        <option value="0">Unpublished</option>
                      @else
                        <option value="1">Published</option>
                        <option value="0" selected>Upublished</option>
                      @endif
                    </select>
                    <span style="color:grey;font-size:10px">If part is UNPUBLISHED then it will NOT be accessible to the public.</span>
                  </div>
                  <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                    <label>Upload at least 3 pictures of your part.</label>
                    <div class="col-md-12 dropzone" id="myAwesomeDropzone"></div>
                  </div>
                  <div class="form-group col-md-12">
                    <hr>
                  </div>
                  <div class="form-group col-md-12">
                    <a class="btn btn-success" onclick="$('#confirmPartSave').modal()"><i class="fa fa-wrench"></i> Save</a> <a onclick="$('#confirmPartDelete').modal()" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Delete part</a>
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
<script src="{{ asset('js/dropzone.js') }}"></script>

<script type="text/javascript">

partimagearray = [

                      @foreach ($partimagearray as $partimage)
                        {
                            filename: "{{ $partimage['filename'] }}",
                            img_url: "{{ asset($partimage['img_url']) }}",
                            img_url_relative: "{{ $partimage['img_url'] }}",
                            img_count: {{ $partimage['img_count'] }},
                        },
                      @endforeach
                  ];

$(document).ready(function(e) {

    var addedFileCount = 1;

    Dropzone.options.myAwesomeDropzone = {
          init: function() {
              thisDropzone = this;

              for (var i = 0; i < partimagearray.length; i++) {
                var mockFile = { name: partimagearray[i]['img_url']};
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, partimagearray[i]['img_url']);
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete');

                $(mockFile.previewTemplate).append('<span class="server_filename" style="display:none">'+partimagearray[i]['filename']+'</span>');
                $(mockFile.previewTemplate).append('<span class="server_fileurl" style="display:none">'+partimagearray[i]['img_url_relative']+'</span>');
                $(mockFile.previewTemplate).append('<span class="server_filecount" style="display:none">'+partimagearray[i]['img_count']+'</span>');
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
                      url: "{{ url('/corporate/'.$corporate->id.'/parts/part/'.$part->id.'/deleteimage') }}",
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
          url: "{{ url('/corporate/'.$corporate->id.'/parts/part/'.$part->id.'/uploadimage') }}",
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
});

</script>
@endsection
