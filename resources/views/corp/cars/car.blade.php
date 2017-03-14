@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('corp-cars')
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
              Car records here. Click edit car button to edit this record. <a class="btn btn-warning btn-sm pull-right" href="{{ url('/corporate/'.$corporate->id.'/cars/car/'.$car->id.'/edit') }}">Edit car</a>
              <br>
              <hr>
            </div>

            <div class="col-md-12">
              <div class="form-group col-md-6">
                @if ($car->bodytype == 'cargovan')
                  <img src="{{ asset('imgs/carbodytype/cargo-van-2.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Cargo Van</strong>
                @elseif ($car->bodytype == 'coupe')
                  <img src="{{ asset('imgs/carbodytype/coupe.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Coupe</strong>
                @elseif ($car->bodytype == 'hatchback')
                  <img src="{{ asset('imgs/carbodytype/hatchback-3.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hatchback</strong>
                @elseif ($car->bodytype == 'jeep')
                  <img src="{{ asset('imgs/carbodytype/suv-mini.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Jeep</strong>
                @elseif ($car->bodytype == 'limousine')
                  <img src="{{ asset('imgs/carbodytype/limousine.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Limousine</strong>
                @elseif ($car->bodytype == 'bus')
                  <img src="{{ asset('imgs/carbodytype/minibus-4-5.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Bus</strong>
                @elseif ($car->bodytype == 'pickup')
                  <img src="{{ asset('imgs/carbodytype/pickup-full.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Pickup</strong>
                @elseif ($car->bodytype == 'sedan')
                  <img src="{{ asset('imgs/carbodytype/sedan-4.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sedan</strong>
                @elseif ($car->bodytype == 'suv')
                  <img src="{{ asset('imgs/carbodytype/suv-full.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>SUV</strong>
                @elseif ($car->bodytype == 'van')
                  <img src="{{ asset('imgs/carbodytype/minivan.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Van</strong>
                @elseif ($car->bodytype == 'wagon')
                  <img src="{{ asset('imgs/carbodytype/station-wagon-full.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Wagon</strong>
                @elseif ($car->bodytype == 'truck')
                  <img src="{{ asset('imgs/carbodytype/truck-2.png') }}">Body type:&nbsp;&nbsp;&nbsp;&nbsp;<strong>Truck</strong>
                @endif
              </div>
              <div class="form-group col-md-6">
                <label for="make">Make</label>
                <input type="text" class="form-control carmakeautocomplete" value="{{ $car->make }}" readonly>
                <span style="color:grey;font-size:10px">Toyota, Nassan, Porche, etc. Start typing to see hints.</span>
              </div>
              <div class="form-group col-md-6">
                <label for="model">Model</label>
                <input type="text" class="form-control carmodelautocomplete" value="{{ $car->model }}" readonly>
                <span style="color:grey;font-size:10px">Land Cruiser, Sunny, Corola, etc. Start typing to see hints.</span>
              </div>
              <div class="form-group col-md-6">
                <label for="plates">Plates</label>
                <input type="text" class="form-control" value="{{ $car->plates }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-6">
                <label for="color">Color</label>
                <input type="text" class="form-control" value="{{ $car->color }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-6">
                <label for="weight">Weight</label>
                <input type="text" class="form-control" value="{{ $car->weight }}" readonly>
                <span style="color:grey;font-size:10px">In tonnes</span>
              </div>
              <div class="form-group col-md-6">
                <label for="dateboughtat">Date bought</label>
                <input type="text" class="form-control datepicker" value="{{ $car->datebought->format('d/m/Y') }}" readonly>
                <span style="color:grey;font-size:10px">day/month/year</span>
              </div>
              <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" class="form-control" value="{{ $car->status }}" readonly>
                <span style="color:grey;font-size:10px">On sale, rent, sold, reserved, etc.</span>
              </div>
              <div class="form-group col-md-6">
                <label for="physicallocation">Physical location</label>
                <input type="text" class="form-control" value="{{ $car->physicallocation }}" readonly>
                <span style="color:grey;font-size:10px">The physical location of the car</span>
              </div>
              <div class="form-group col-md-6">
                <label for="note">Published/Unpublish</label><br>
                <select class="form-control col-md-6" id="published" name="published" disabled>
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
              <div class="form-group col-md-12">
                <label for="note">Note</label>
                <input type="text" class="form-control" value="{{ $car->note }}" readonly>
                <span style="color:grey;font-size:10px">&nbsp;</span>
              </div>
              <div class="form-group col-md-12" style="text-align:center;padding-top:20px">
                <div class="panel panel-default">
                <div class="panel-heading">Car Images</div>
                <div class="panel-body">
                  
                    @foreach ($carimages as $carimage)
                      <div class="col-md-4">
                        <div class="thumbnail">
                          <a href="{{ asset($carimage->img_url) }}" data-lightbox="image">
                            <img src="{{ asset($carimage->img_url) }}">
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

