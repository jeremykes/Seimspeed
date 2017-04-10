@extends('layouts.corp')

@section('corp-cars-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
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
          <h3 style="padding:10px">All Cars</h3>
            <table class="table table-bordered table-hover" id="cartable"> 

                <thead>
                  <tr style="font-weight:bold">
                    <td>Make</td>
                    <td>Model</td>
                    <td>Plates</td>
                    <td>Color</td>
                    <td>Published</td>
                    <td>Status</td>
                    <td>View</td>
                  </tr>
                </thead>
                <tbody>
                  
                    @foreach ($cars as $car)
                      <tr>
                          <td>{{ $car->make }}</td>
                          <td>{{ $car->model }}</td>
                          <td>{{ $car->plates }}</td>
                          <td>{{ $car->color }}</td>
                          <td>
                              @if ($car->published == true)
                                Yes
                              @else
                                No
                              @endif
                          </td>
                          <td>{{ $car->status }}</td>
                          <td><a class="btn btn-primary btn-xs" href="{{ url('/corporate/'.$corporate->id.'/cars/car/'.$car->id) }}"><i class="fa fa-eye"></i></a></td>
                      </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        
@endsection

@section('script')

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
  
  $(document).ready(function(){
      $('#cartable').DataTable();
  });

</script>

@endsection
