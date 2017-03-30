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
        'App\Events\SomeEvent' => ['App\Listeners\EventListener'],
        'App\Events\NewMessage' => ['App\Listeners\NewMessage'],
        'App\Events\MessageRead' => [],
        'App\Events\UserReported' => ['App\Listeners\UserReported'],
        'App\Events\CorporateReported' => ['App\Listeners\CorporateReported'],
        'App\Events\CarReported' => ['App\Listeners\CarReported'],
        'App\Events\PartReported' => ['App\Listeners\PartReported'],
        'App\Events\UserSettingsUpdated ' => [],
        'App\Events\CorporateSettingsUpdated' => [],
        'App\Events\CorporateCreated ' => [],
        'App\Events\CorporateUpdated ' => [],
        'App\Events\CorporateDeactivated' => ['App\Listeners\CorporateDeactivated'],
        'App\Events\ImageAdded ' => [],
        'App\Events\ImageUpdated ' => [],
        'App\Events\ImageDeleted ' => [],
        'App\Events\SubscriptionAdded ' => [],
        'App\Events\SubscriptionUpdated ' => [],
        'App\Events\CorporateUserAdded' => ['App\Listeners\CorporateUserAdded'],
        'App\Events\CorporateUserUpdated' => ['App\Listeners\CorporateUserUpdated'],
        'App\Events\CorporateUserDeleted' => ['App\Listeners\CorporateUserDeleted'],
        'App\Events\CorporateUserRoleAdded' => ['App\Listeners\CorporateUserRoleAdded'],
        'App\Events\CorporateUserRoleUpdated' => ['App\Listeners\CorporateUserRoleUpdated'],
        'App\Events\CorporateUserRoleDeleted' => ['App\Listeners\CorporateUserRoleDeleted'],
        'App\Events\CarAdded ' => [],
        'App\Events\CarUpdated' => ['App\Listeners\CarUpdated'],
        'App\Events\CarDeleted ' => [],
        'App\Events\CarImageAdded ' => [],
        'App\Events\CarImageUpdated ' => [],
        'App\Events\CarImageDeleted ' => [],
        'App\Events\CarGroupAdded ' => [],
        'App\Events\CarGroupUpdated ' => [],
        'App\Events\CarGroupDeleted' => [],
        'App\Events\PartAdded ' => [],
        'App\Events\PartUpdated' => ['App\Listeners\PartUpdated'],
        'App\Events\PartDeleted ' => [],
        'App\Events\PartImageAdded ' => [],
        'App\Events\PartImageUpdated ' => [],
        'App\Events\PartImageDeleted ' => [],
        'App\Events\PartGroupAdded ' => [],
        'App\Events\PartGroupUpdated ' => [],
        'App\Events\PartGroupDeleted' => [],
        'App\Events\CorporateRated' => ['App\Listeners\CorporateRated'],
        'App\Events\CorporateTailed' => ['App\Listeners\CorporateTailed'],
        'App\Events\CorporateUntailed' => [],
        'App\Events\CarCommentAdded' => ['App\Listeners\CarCommentAdded'],
        'App\Events\CarCommentUpdated' => ['App\Listeners\CarCommentUpdated'],
        'App\Events\CarCommentDeleted ' => [],
        'App\Events\CarLiked' => ['App\Listeners\CarLiked'],
        'App\Events\CarUnliked ' => [],
        'App\Events\CarTailed' => ['App\Listeners\CarTailed'],
        'App\Events\CarUntailed' => [],
        'App\Events\CarSaleOfferAdded' => ['App\Listeners\CarSaleOfferAdded'],
        'App\Events\CarSaleOfferCancelled' => ['App\Listeners\CarSaleOfferCancelled'],
        'App\Events\CarRentOfferAdded' => ['App\Listeners\CarRentOfferAdded'],
        'App\Events\CarRentOfferCancelled' => ['App\Listeners\CarRentOfferCancelled'],
        'App\Events\CarTenderTenderAdded' => ['App\Listeners\CarTenderTenderAdded'],
        'App\Events\CarTenderTenderCancelled' => ['App\Listeners\CarTenderTenderCancelled'],
        'App\Events\CarAuctionBidAdded' => ['App\Listeners\CarAuctionBidAdded'],
        'App\Events\CarAuctionBidCancelled' => ['App\Listeners\CarAuctionBidCancelled'],
        'App\Events\PartCommentAdded' => ['App\Listeners\PartCommentAdded'],
        'App\Events\PartCommentUpdated' => ['App\Listeners\PartCommentUpdated'],
        'App\Events\PartCommentDeleted ' => [],
        'App\Events\PartLiked' => ['App\Listeners\PartLiked'],
        'App\Events\PartUnliked ' => [],
        'App\Events\PartTailed' => ['App\Listeners\PartTailed'],
        'App\Events\PartUntailed ' => [],
        'App\Events\PartSaleOfferAdded' => ['App\Listeners\PartSaleOfferAdded'],
        'App\Events\PartSaleOfferCancelled' => ['App\Listeners\PartSaleOfferCancelled'],
        'App\Events\CarSaleAdded' => ['App\Listeners\CarSaleAdded'],
        'App\Events\CarSaleUpdated' => ['App\Listeners\CarSaleUpdated'],
        'App\Events\CarSaleDeleted' => ['App\Listeners\CarSaleDeleted'],
        'App\Events\CarSaleClosed' => ['App\Listeners\CarSaleClosed'],
        'App\Events\CarSaleOfferReserved' => ['App\Listeners\CarSaleOfferReserved'],
        'App\Events\CarSaleReserveExpired' => ['App\Listeners\CarSaleReserveExpired'],
        'App\Events\CarSaleOfferReserveCancelled' => ['App\Listeners\CarSaleOfferReserveCancelled'],
        'App\Events\CarSaleOfferPurchased' => ['App\Listeners\CarSaleOfferPurchased'],
        'App\Events\CarRentAdded' => ['App\Listeners\CarRentAdded'],
        'App\Events\CarRentUpdated' => ['App\Listeners\CarRentUpdated'],
        'App\Events\CarRentDeleted' => ['App\Listeners\CarRentDeleted'],
        'App\Events\CarRentClosed' => ['App\Listeners\CarRentClosed'],
        'App\Events\CarRentOfferReserved' => ['App\Listeners\CarRentOfferReserved'],
        'App\Events\CarRentReserveExpired' => ['App\Listeners\CarRentReserveExpired'],
        'App\Events\CarRentPurchased' => ['App\Listeners\CarRentPurchased'],
        'App\Events\CarRentReturned' => ['App\Listeners\CarRentReturned'],
        'App\Events\CarTenderAdded' => ['App\Listeners\CarTenderAdded'],
        'App\Events\CarTenderUpdated' => ['App\Listeners\CarTenderUpdated'],
        'App\Events\CarTenderDeleted' => ['App\Listeners\CarTenderDeleted'],
        'App\Events\CarTenderClosed' => ['App\Listeners\CarTenderClosed'],
        'App\Events\CarTenderDateStarted' => ['App\Listeners\CarTenderDateStarted'],
        'App\Events\CarTenderDateEnded' => ['App\Listeners\CarTenderDateEnded'],
        'App\Events\CarTenderTenderReserved' => ['App\Listeners\CarTenderTenderReserved'],
        'App\Events\CarTenderTenderReserveExpired' => ['App\Listeners\CarTenderTenderReserveExpired'],
        'App\Events\CarTenderTenderPurchased ' => ['App\Listeners\CarTenderTenderPurchased '],
        'App\Events\CarAuctionAdded' => ['App\Listeners\CarAuctionAdded'],
        'App\Events\CarAuctionUpdated' => ['App\Listeners\CarAuctionUpdated'],
        'App\Events\CarAuctionDeleted' => ['App\Listeners\CarAuctionDeleted'],
        'App\Events\CarAuctionClosed' => ['App\Listeners\CarAuctionClosed'],
        'App\Events\CarAuctionDateStarted' => ['App\Listeners\CarAuctionDateStarted'],
        'App\Events\CarAuctionDateEnded' => ['App\Listeners\CarAuctionDateEnded'],
        'App\Events\CarAuctionBidReserved' => ['App\Listeners\CarAuctionBidReserved'],
        'App\Events\CarAuctionBidReserveExpired' => ['App\Listeners\CarAuctionBidReserveExpired'],
        'App\Events\CarAuctionBidPurchased' => ['App\Listeners\CarAuctionBidPurchased'],
        'App\Events\PartSaleAdded' => ['App\Listeners\PartSaleAdded'],
        'App\Events\PartSaleUpdated' => ['App\Listeners\PartSaleUpdated'],
        'App\Events\PartSaleDeleted' => ['App\Listeners\PartSaleDeleted'],
        'App\Events\PartSaleClosed' => ['App\Listeners\PartSaleClosed'],
        'App\Events\PartSaleOfferReserved' => ['App\Listeners\PartSaleOfferReserved'],
        'App\Events\PartSaleReserveExpired' => ['App\Listeners\PartSaleReserveExpired'],
        'App\Events\PartSaleOfferReserveCancelled' => ['App\Listeners\PartSaleOfferReserveCancelled'],
        'App\Events\PartSaleOfferPurchased' => ['App\Listeners\PartSaleOfferPurchased'],
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
