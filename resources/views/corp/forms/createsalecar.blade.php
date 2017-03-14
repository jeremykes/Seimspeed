@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/lightbox/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('modal')
        <div class="modal fade" id="selectCar" tabindex="-1" role="dialog" aria-labelledby="selectCarlabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="selectCarlabel">Select your Car</h4>
              </div>
              <div class="modal-body col-md-12">
                <span style="font-size:12px;color:grey;">Select your car from the list. Only published cars are displayed here. If the car you want is not listed here then it is most likely unpublished. Please contact your Administrator or Maintainer to publish the car.</span><br><br>
                <table class="table table-bordered table-hover" id="cartable"> 

                <thead>
                  <tr style="font-weight:bold">
                    <td>Body Type</td>
                    <td>Make</td>
                    <td>Model</td>
                    <td>Plates</td>
                    <td>Image</td>
                    <td>Select</td>
                  </tr>
                </thead>
                <tbody>
                  
                    @foreach ($cars as $car)
                      <tr>
                          <td id="bodytype{{ $car->id }}">{{ $car->bodytype }}</td>
                          <td id="make{{ $car->id }}">{{ $car->make }}</td>
                          <td id="model{{ $car->id }}">{{ $car->model }}</td>
                          <td id="plates{{ $car->id }}">{{ $car->plates }}</td>
                          <td><a href="{{ asset($car->images()->first()->img_url) }}" data-lightbox="image"><img src="{{ asset($car->images()->first()->img_url) }}" style="width:33px;height:auto"></a></td>
                          <td><input type="checkbox" class="selectcarcheckbox" name="{{ $car->id }}"></td>
                      </tr>
                    @endforeach

                </tbody>

            </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="selectCargroup" tabindex="-1" role="dialog" aria-labelledby="selectGrouplabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="selectGrouplabel">Select group</h4>
              </div>
              <div class="modal-body col-md-12">
                <div class="col-md-12">Select a group from the list. You can always add this sale into a group later.<br><br></div>
                <table class="table table-bordered table-hover" id="cartable"> 

                  <thead>
                    <tr style="font-weight:bold">
                      <td>Title</td>
                      <td>Description</td>
                      <td>Select</td>
                    </tr>
                  </thead>
                  <tbody>
                    
                      @foreach ($cargroups as $cargroup)
                        <tr>
                            <td id="title{{ $cargroup->id }}">{{ $cargroup->title }}</td>
                            <td id="descript{{ $cargroup->id }}">{{ $cargroup->descript }}</td>
                            <td><input type="checkbox" class="selectcargroupcheckbox" name="{{ $cargroup->id }}"></td>
                        </tr>
                      @endforeach

                  </tbody>

              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>
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
            <h3 style="padding:10px">Create new car sale</h3>
            <div class="panel-body"> 
              <div class="col-md-12">Select a car and then fill in the sale details of the car. Fields marked with (*) are mandatory.</div>
              <hr>
              <div class="col-md-12">

                @if (Session::has('errormessage'))
                <div class="alert alert-danger">
                      {{ Session::get('errormessage') }}
                </div>
                @endif

                @include('common.errors')

                <form action="{{ url('/corporate/'.$corporate->id.'/cars/sales/store') }}" method="post">
                  {!! csrf_field() !!}
                  <div class="form-group">
                    <label for="car_id">Select Car *</label>
                    <div class="input-group">
                      <div class="input-group-addon">Car</div>
                      <input type="hidden" class="form-control" id="car_id" name="car_id">
                      <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Select car" data-toggle="modal" data-target="#selectCar" onclick="initSelectedCar()" readonly>
                      <div class="input-group-addon"><span style="cursor:pointer" data-toggle="modal" data-target="#selectCar" onclick="initSelectedCar()">add +</span></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                        <label for="price">Price (in Kina) *</label>
                        <div class="input-group">
                          <div class="input-group-addon">K</div>
                          <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                          <div class="input-group-addon">.00</div>
                        </div>
                      </div>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="negotiable"> Negotiable &nbsp;&nbsp;&nbsp;<span style="font-size:12px;color:grey;">Is the price negotible?</span>
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="note">Note</label>
                    <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                  </div>
                  <div class="form-group">
                    <label for="cargroup_name">Add to group (optional)</label>
                    <div class="input-group">
                      <div class="input-group-addon">Group name</div>
                      <input type="hidden" class="form-control" id="cargroup_id" name="cargroup_id">
                      <input type="text" class="form-control" id="cargroup_name" name="cargroup_name" placeholder="Add to group" data-toggle="modal" data-target="#selectCargroup" onclick="initSelectedCargroup()" readonly>
                      <div class="input-group-addon"><span style="cursor:pointer" data-toggle="modal" data-target="#selectCargroup" onclick="initSelectedCargroup()">add +</span></div>
                    </div>
                  </div>
                  
                  <button type="submit" class="btn btn-default">Create sale</button>
                </form>
              </div>
            </div>
          </div>
        </div>  
@endsection


@section('script')
<script src="{{ asset('js/lightbox/lightbox.min.js') }}"></script>

<script type="text/javascript">
    var selectedCarID = 0;
    var selectedCargroupID = 0;

    function initSelectedCar() {
        $('.selectcarcheckbox').prop('checked', false);
        if (selectedCarID > 0) {
            $('input[name="'+selectedCarID+'"').prop('checked', true);
        }      
    }

    $('.selectcarcheckbox').change(function(){
        if ($(this).is(':checked')){
            $('.selectcarcheckbox').prop('checked', false);
            $(this).prop('checked', true);
            selectedCarID = $(this).attr('name');
            $('#car_id').val(selectedCarID);
            $('#car_name').val(
              $('#plates'+selectedCarID).html() +
              ' - ' +
              $('#make'+selectedCarID).html() +
              ' ' +
              $('#model'+selectedCarID).html() +
              ', ' +
              $('#color'+selectedCarID).html() +
              ' ' +
              $('#bodytype'+selectedCarID).html()
            );
        } else {
            $('.selectcarcheckbox').prop('checked', false);
        }

    });

    function initSelectedCargroup() {
        $('.selectcargroupcheckbox').prop('checked', false);
        if (selectedCargroupID > 0) {
            $('input[name="'+selectedCargroupID+'"').prop('checked', true);
        }      
    }

    $('.selectcargroupcheckbox').change(function(){
        if ($(this).is(':checked')){
            $('.selectcargroupcheckbox').prop('checked', false);
            $(this).prop('checked', true);
            selectedCargroupID = $(this).attr('name');
            $('#cargroup_id').val(selectedCargroupID);
            $('#cargroup_name').val($('#title'+selectedCargroupID).html() + ' - ' + $('#descript'+selectedCargroupID).html());
        } else {
            $('.selectcargroupcheckbox').prop('checked', false);
        }

    });
      
</script>
@endsection
