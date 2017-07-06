@extends('layouts.app')

@section('content')

<div class="col-md-12">
	<div class="panel panel-primary">
	  <div class="panel-body">
	      <div class="col-md-3" id="car_images">
	          
	      </div>

	      <div class="col-md-9">

	        
	      </div>
	    </div>
	</div>
</div>


@if (Auth::check())
	<div class="col-md-12">
		<div class="col-md-12">
	      	<div class="col-md-8 col-md-offset-2" style="padding-top:20px;padding-bottom:10px;">
		        <form class="form-inline" id="offerform">
			        <div class="form-group">
			            <label>Your offer</label>
			            <div class="input-group">
			              	<div class="input-group-addon">K</div>
			              	<input type="text" class="form-control" placeholder="Amount" name="myoffer" id="myoffer">
			            </div>
			        </div>
			        <a class="btn btn-success btn-xs" onclick="submitoffer()">Offer</a>
		        </form>
		        <div class="col-md-12">
			        &nbsp;
			        <div class="alert alert-danger" style="display:none" id="offer_error"></div>
			        <div class="alert alert-success" style="display:none" id="offer_success"></div>
		        </div>
	      	</div>
	    </div>
	</div>
@endif

<div id="offers">

	@foreach ($offers as $offer)

	    <div class="list-group-item col-md-12" id="list-group-item-{{ $offer->id }}">
		    <div class="col-md-2">
		        <img class="img-responsive" src="{{ asset($offer->user->propic) }}"> 
		    </div>
		    <div class="col-md-10">
		        <p><strong><a href="#">{{ $offer->user->name }}</a></strong> <span class="pull-right"><span style="color:gray;font-size:11px" id="user-offer-created-at-{{ $offer->id }}">{{ $offer->created_at }}</span></span></p>
		        <p style="font-size:18px">K{{ number_format($offer->offer, 2, '.', ',') }} 

			        <span class="pull-right" id="reserved-offer-{{ $offer->id }}">

		                @if ($offer->reserve)
		                
		                  	<span class="label label-primary">reserved</span>  
		                
		                @endif

			        </span>

		        </p>

		        @if ($carsale->reserves()->count() < 3)
		        	<p class="pull-right" id="offer-options-{{ $offer->id }}">

			            @allowed('corporate.user', $corporate)

				            @role('sales|administrator')
				                
				                <span class="label label-danger" id="offerlisterror{{ $offer->id }}"></span>
				                <a style="font-size:9px" class="btn btn-xs btn-success" onclick="acceptOffer({{ $offer->id }})">accept offer</a> 
				                <a style="font-size:9px" class="btn btn-xs btn-default" onclick="deleteOffer({{ $offer->id }})">delete offer</a> 

				            @endrole

			            @endallowed

		        	</p>
		        @endif

		    </div>
	    </div>

	@endforeach

</div>

<div id="comments" style="display:none">
  <div id="commentslist" class="list-group" style="padding-top:0;margin-top:0">
    <div class="list-group-item col-md-12" style="border:10px solid rgb(231,231,231)">
      <div class="col-md-12">
            <input type="text" class="form-control" aria-label="Your comment" style="margin-bottom:5px">
            <a class="btn btn-default btn-xs">Comment</a>
      </div>
    </div>

    <!-- Comments are appended here -->
    @foreach ($comments as $comment)

    	<div class="list-group-item col-md-12">
    		<div class="col-md-1">
    			<img class="img-responsive" src="{{ $comments->comment_user_propic }}" style="height:40px;width:auto">
    		</div>
    		<div class="col-md-11">
    			<p>
    				<strong><a href="{{ $comments->comment_user_url'] }}">{{ $comments->comment_user_name'] }}</a></strong> 
    				<span class="pull-right">
    					<span style="color:gray;font-size:11px">{{ $comments->comment_created_at'] }}</span>
    				</span>
    			</p>
    			<p>
    				$comments->comment_comment'];
    			</p>
    		</div>
    	</div>

    @endforeach

  </div>
</div>

<div id="tails" style="display:none">
  	<div id="tailslist" class="list-group" style="padding-top:0;margin-top:0">

  	<!-- Tails are appended here -->

  	</div>
</div>
        
@endsection