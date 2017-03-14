@extends('layouts.corp')

@section('corp-part-active')
    active
@endsection

@section('css')
<link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
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
          <h3 style="padding:10px">All Parts</h3>
            <table class="table table-bordered table-hover" id="parttable"> 

                <thead>
                  <tr style="font-weight:bold">
                    <td>Name</td>
                    <td>Serial Number</td>
                    <td>Description</td>
                    <td>Note</td>
                    <td>Published</td>
                    <td>Physical Location</td>
                    <td>Status</td>
                    <td>View</td>
                  </tr>
                </thead>
                <tbody>
                  
                    @foreach ($parts as $part)
                      <tr>
                          <td>{{ $part->name }}</td>
                          <td>{{ $part->serailnumber }}</td>
                          <td>{{ $part->descript }}</td>
                          <td>{{ $part->note }}</td>
                          <td>
                              @if ($part->published == true)
                                Yes
                              @else
                                No
                              @endif
                          </td>
                          <td>{{ $part->physicallocation }}</td>
                          <td>{{ $part->status }}</td>
                          <td><a class="btn btn-primary btn-xs" href="{{ url('/corporate/'.$corporate->id.'/parts/part/'.$part->id) }}"><i class="fa fa-eye"></i></a></td>
                      </tr>
                    @endforeach

                </tbody>

            </table>
          <!-- </div> -->
          <!-- </div> -->
        </div>
        
@endsection

@section('script')

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
  
  $(document).ready(function(){
      $('#parttable').DataTable();
  });

</script>

@endsection
