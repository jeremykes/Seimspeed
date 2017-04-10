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
        'App\Events\SomeEvent' => [],
        'App\Events\NewMessage' => [],
        'App\Events\MessageRead' => [],
        'App\Events\UserReported' => [],
        'App\Events\CorporateReported' => [],
        'App\Events\CarReported' => [],
        'App\Events\PartReported' => [],
        'App\Events\UserSettingsUpdated ' => [],
        'App\Events\CorporateSettingsUpdated' => [],
        'App\Events\CorporateCreated ' => [],
        'App\Events\CorporateUpdated ' => [],
        'App\Events\CorporateDeactivated' => [],
        'App\Events\CorporateImageAdded ' => [],
        'App\Events\CorporateImageUpdated ' => [],
        'App\Events\CorporateImageDeleted ' => [],
        'App\Events\SubscriptionAdded ' => [],
        'App\Events\SubscriptionUpdated ' => [],
        'App\Events\CorporateUserAdded' => [],
        'App\Events\CorporateUserUpdated' => [],
        'App\Events\CorporateUserDeleted' => [],
        'App\Events\CorporateUserRoleAdded' => [],
        'App\Events\CorporateUserRoleUpdated' => [],
        'App\Events\CorporateUserRoleDeleted' => [],
        'App\Events\CarAdded ' => [],
        'App\Events\CarUpdated' => [],
        'App\Events\CarDeleted ' => [],
        'App\Events\CarImageAdded ' => [],
        'App\Events\CarImageUpdated ' => [],
        'App\Events\CarImageDeleted ' => [],
        'App\Events\CarGroupAdded ' => [],
        'App\Events\CarGroupUpdated ' => [],
        'App\Events\CarGroupDeleted' => [],
        'App\Events\PartAdded ' => [],
        'App\Events\PartUpdated' => [],
        'App\Events\PartDeleted ' => [],
        'App\Events\PartImageAdded ' => [],
        'App\Events\PartImageUpdated ' => [],
        'App\Events\PartImageDeleted ' => [],
        'App\Events\PartGroupAdded ' => [],
        'App\Events\PartGroupUpdated ' => [],
        'App\Events\PartGroupDeleted' => [],
        'App\Events\CorporateRated' => [],
        'App\Events\CorporateTailed' => [],
        'App\Events\CorporateUntailed' => [],
        'App\Events\CarCommentAdded' => [],
        'App\Events\CarCommentUpdated' => [],
        'App\Events\CarCommentDeleted ' => [],
        'App\Events\CarLiked' => [],
        'App\Events\CarUnliked ' => [],
        'App\Events\CarTailed' => [],
        'App\Events\CarUntailed' => [],
        'App\Events\CarSaleOfferAdded' => [],
        'App\Events\CarSaleOfferCancelled' => [],
        'App\Events\CarRentOfferAdded' => [],
        'App\Events\CarRentOfferCancelled' => [],
        'App\Events\CarTenderTenderAdded' => [],
        'App\Events\CarTenderTenderCancelled' => [],
        'App\Events\CarAuctionBidAdded' => [],
        'App\Events\CarAuctionBidCancelled' => [],
        'App\Events\PartCommentAdded' => [],
        'App\Events\PartCommentUpdated' => [],
        'App\Events\PartCommentDeleted ' => [],
        'App\Events\PartLiked' => [],
        'App\Events\PartUnliked ' => [],
        'App\Events\PartTailed' => [],
        'App\Events\PartUntailed ' => [],
        'App\Events\PartSaleOfferAdded' => [],
        'App\Events\PartSaleOfferCancelled' => [],
        'App\Events\CarSaleAdded' => [],
        'App\Events\CarSaleUpdated' => [],
        'App\Events\CarSaleDeleted' => [],
        'App\Events\CarSaleClosed' => [],
        'App\Events\CarSaleOfferReserved' => [],
        'App\Events\CarSaleReserveExpired' => [],
        'App\Events\CarSaleOfferReserveCancelled' => [],
        'App\Events\CarSaleOfferPurchased' => [],
        'App\Events\CarRentAdded' => [],
        'App\Events\CarRentUpdated' => [],
        'App\Events\CarRentDeleted' => [],
        'App\Events\CarRentClosed' => [],
        'App\Events\CarRentOfferReserved' => [],
        'App\Events\CarRentReserveExpired' => [],
        'App\Events\CarRentPurchased' => [],
        'App\Events\CarRentReturned' => [],
        'App\Events\CarTenderAdded' => [],
        'App\Events\CarTenderUpdated' => [],
        'App\Events\CarTenderDeleted' => [],
        'App\Events\CarTenderClosed' => [],
        'App\Events\CarTenderDateStarted' => [],
        'App\Events\CarTenderDateEnded' => [],
        'App\Events\CarTenderTenderReserved' => [],
        'App\Events\CarTenderTenderReserveExpired' => [],
        'App\Events\CarTenderTenderPurchased ' => [],
        'App\Events\CarAuctionAdded' => [],
        'App\Events\CarAuctionUpdated' => [],
        'App\Events\CarAuctionDeleted' => [],
        'App\Events\CarAuctionClosed' => [],
        'App\Events\CarAuctionDateStarted' => [],
        'App\Events\CarAuctionDateEnded' => [],
        'App\Events\CarAuctionBidReserved' => [],
        'App\Events\CarAuctionBidReserveExpired' => [],
        'App\Events\CarAuctionBidPurchased' => [],
        'App\Events\PartSaleAdded' => [],
        'App\Events\PartSaleUpdated' => [],
        'App\Events\PartSaleDeleted' => [],
        'App\Events\PartSaleClosed' => [],
        'App\Events\PartSaleOfferReserved' => [],
        'App\Events\PartSaleReserveExpired' => [],
        'App\Events\PartSaleOfferReserveCancelled' => [],
        'App\Events\PartSaleOfferPurchased' => [],
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
