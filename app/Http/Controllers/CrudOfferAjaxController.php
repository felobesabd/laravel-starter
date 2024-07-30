<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use LaravelLocalization;

class CrudOfferAjaxController extends Controller
{
    use OfferTraits;

    public function all()
    {
        $offers = Offer::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale(). ' as name',
            'price',
            'photo',
            'details_'.LaravelLocalization::getCurrentLocale(). ' as details'
        )->get();
        return view('ajaxOffer.all', compact('offers'));
    }

    public function create()
    {
        return view('ajaxOffer.create');
    }

    public function store(OfferRequest $request)
    {
        // save photo
        $file_name = $this->saveImage($request->photo, 'images/offer');

        $offer = Offer::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'photo' => $file_name,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
        ]);

        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'created successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'created Failed',
            ]);
        }
    }

    public function edit(Request $request) {
        $offerFind = Offer::find($request->id);

        if (!$offerFind) {
            return response()->json([
                'status' => false,
                'msg' => 'not found',
            ]);
        }

        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details_en', 'details_ar')->find($request->id);

        return view('ajaxOffer.edit', compact('offer'));
    }

    public function update(Request $request) {
//        return $request;
        $offer = Offer::find($request->id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'not found',
            ]);
        }

        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'updated successfully',
        ]);
    }

    public function delete(Request $request) {
//        echo $request->id;
//        return $request->id;
        $offer = Offer::find($request->id);

        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'not found',
            ]);
        }

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'deleted successfully',
            'id' => $request->id,
        ]);
    }
}
