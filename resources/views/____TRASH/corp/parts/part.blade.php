@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('corp-part')
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
            <h3 style="padding:10px">Part</h3>
          <div class="panel-body" style="padding:0;margin:0">
            
            <div class="col-md-12">
              Part records here. Click edit part button to edit this record. <a class="btn btn-warning btn-sm pull-right" href="{{ url('/corporate/'.$corporate->id.'/parts/part/'.$part->id.'/edit') }}">Edit part</a>
              <br>
              <hr>
            </div>

            <div class="col-md-12">
              <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{ $part->name }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-6">
                <label for="serialnumber">Serial number</label>
                <input type="text" class="form-control partserialnumberautocomplete" value="{{ $part->serialnumber }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-6">
                <label for="descript">Description</label>
                <input type="text" class="form-control" value="{{ $part->descript }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" class="form-control" value="{{ $part->status }}" readonly>
                <span style="color:grey;font-size:10px">On sale, rent, sold, reserved, etc.</span>
              </div>
              <div class="form-group col-md-6">
                <label for="physicallocation">Physical location</label>
                <input type="text" class="form-control" value="{{ $part->physicallocation }}" readonly>
                <span style="color:grey;font-size:10px">The physical location of the part</span>
              </div>
              <div class="form-group col-md-6">
                <label for="note">Published/Unpublish</label><br>
                <select class="form-control col-md-6" id="published" name="published" disabled>
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
              <div class="form-group col-md-12">
                <label for="note">Note</label>
                <input type="text" class="form-control" value="{{ $part->note }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                <div class="panel panel-default">
                <div class="panel-heading">part Images</div>
                <div class="panel-body">
                  
                    @foreach ($partimages as $partimage)
                      <div class="col-md-4">
                        <div class="thumbnail">
                          <a href="{{ asset($partimage->img_url) }}" data-lightbox="image">
                            <img src="{{ asset($partimage->img_url) }}">
                          </a>
                        </div>
                      </div>
                    @endforeach
                  
                </div>
                </div>
              </div>
            </div>

          </div>
          </div>
        </div>
        
@endsection


@section('script')
<script src="{{ asset('js/lightbox/lightbox.min.js') }}"></script>
@endsection

