<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Scopes\OfferScope;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index() {
        $person = collect(['name', 'age']);
        return $person->combine(['phelo', 20]);
    }

    public function getOffers() {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers->each(function ($offer) {
           if ($offer->status == 0) {
               unset($offer->name_ar);
               unset($offer->details_ar);
           }
           $offer->phelo = 'yes';
        });
        return $offers;
    }

    public function getOffersFilter() {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();

        $offerResult = $offers->filter(function ($value, $key) {
           return $value['status'] == 0;
        });

        return array_values($offerResult->all());
    }

    public function getOffersTransform() {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();

        return $offerResult = $offers->transform(function ($value, $key) {
            $data = [];
            $data['name'] = $value['name_en'];
            $data['phelo'] = 'yes';

            return $data;
          //return 'my name is : '. $value['name_en'];
        });
    }
}
