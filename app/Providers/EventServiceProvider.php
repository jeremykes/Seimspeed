<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CarAuctionAdded' => [],
        'App\Events\CarAuctionBidAdded' => [],
        'App\Events\CarAuctionBidCancelled' => [],
        'App\Events\CarAuctionBidReserveCancelled' => [],
        'App\Events\CarAuctionBidReserved' => [],
        'App\Events\CarAuctionBidReserveExpired' => [],
        'App\Events\CarAuctionBidReservePurchased' => [],
        'App\Events\CarAuctionClosed' => [],
        'App\Events\CarCommentAdded' => [], 
        'App\Events\CarCommentUpdated' => [],
        'App\Events\CarRentAdded' => [],
        'App\Events\CarRentClosed' => [],
        'App\Events\CarRentOfferAdded' => [],
        'App\Events\CarRentOfferCancelled' => [],
        'App\Events\CarRentOfferReserveCancelled' => [],
        'App\Events\CarRentOfferReserved' => [],
        'App\Events\CarRentOfferReserveExpired' => [],
        'App\Events\CarRentOfferReservePurchased' => [],
        'App\Events\CarSaleAdded' => [],
        'App\Events\CarSaleClosed' => [],
        'App\Events\CarSaleOfferAdded' => [],
        'App\Events\CarSaleOfferCancelled' => [],
        'App\Events\CarSaleOfferReserveCancelled' => [],
        'App\Events\CarSaleOfferReserved' => [],
        'App\Events\CarSaleOfferReserveExpired' => [],
        'App\Events\CarSaleOfferReservePurchased' => [],
        'App\Events\CarTenderAdded' => [],
        'App\Events\CarTenderClosed' => [],
        'App\Events\CarTenderTenderAdded' => [],
        'App\Events\CarTenderTenderCancelled' => [],
        'App\Events\CarTenderTenderReserveExpired' => [],
        'App\Events\CarTenderTenderReservePurchased ' => [],
        'App\Events\PartCommentAdded' => [],
        'App\Events\PartCommentUpdated' => [],
        'App\Events\PartSaleAdded' => [],
        'App\Events\PartSaleClosed' => [],
        'App\Events\PartSaleOfferAdded' => [],
        'App\Events\PartSaleOfferCancelled' => [],
        'App\Events\PartSaleOfferReserveCancelled' => [],
        'App\Events\PartSaleOfferReserved' => [],
        'App\Events\PartSaleOfferReserveExpired' => [],
        'App\Events\PartSaleOfferReservePurchased' => [],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
