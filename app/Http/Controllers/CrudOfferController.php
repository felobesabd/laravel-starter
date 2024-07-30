<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Scopes\OfferScope;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use LaravelLocalization;

//use LaravelLocalization;

class CrudOfferController extends Controller
{
    use OfferTraits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllOffer()
    {
        $offers = Offer::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale(). ' as name',
            'price',
            'photo',
            'details_'.LaravelLocalization::getCurrentLocale(). ' as details'
        )->paginate(PAGINATION_COUNT);

        return view('offer.all', compact('offers'));
    }

//    public function createOffer()
//    {
//        Offer::create([
//            'name' => 'offer3',
//            'price' => 500,
//            'details' => 'offer 3 details',
//        ]);
//
//        return 'created successfully';
//    }

    public function create()
    {
        return view('offer.create');
    }

    protected function getRules() {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    protected function getMessages() {
        return $messages = [
            'name.required' => __('validation.name_req'),
            'name.unique' => __('validation.name_unique'),
            'price.numeric' => 'the offer price must be number',
            'price.required' => 'offer price is required',
            'details.required' => 'offer details is required',
        ];
    }

    public function store(OfferRequest $request)
    {
        // validation
        //$rules = $this->getRules();
        //$messages = $this->getMessages();

        //$validate = Validator::make($request->all(), $rules, $messages);

//        if ($validate->fails()) {
//            //TODO Ask Mets save old value
//            return redirect()->back()->withErrors($validate)->withInputs($request->all());
//        }

        // save photo
        $file_name = $this->saveImage($request->photo, 'images/offer');

        Offer::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'photo' => $file_name,
            'details_en' => $request->details_en,
            'details_ar' => $request->details_ar,
        ]);

         return redirect()->back()->with(['success' => __('offer.success')]);
    }

    public function edit($id) {
        // return $id;
        // $offer = Offer::findOrFail($id);

        $offerFind = Offer::find($id);
        if (!$offerFind) {
            return redirect()->back();
        }

        $offer = Offer::select('id', 'name_en', 'name_ar', 'price', 'details_en', 'details_ar')->find($id);

        return view('offer.edit', compact('offer'));
    }

    public function update($id, OfferRequest $req) {
        $offer = Offer::find($id);
        if (!$offer) {
            return redirect()->back();
        }

        $offer->update($req->all());

        return redirect()->back()->with(['success' => 'created successfully']);
    }

    public function delete($id) {
        $offer = Offer::find($id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('offer.not_found')]);
        }

        $offer->delete();

        return redirect()->back()->with(['success' => __('offer.success')]);
    }

########################################### Scopes ##############################################
########################################### El local mnh ##############################################
    public function getInactiveStatusOffers() {
        // return Offer::inactive()->get();
        return Offer::Invalid()->get();
    }
########################################### El global mnh ##############################################
    public function getGlobalInactiveStatusOffers() {
        // return Offer::get();
        return Offer::withoutGlobalScope(OfferScope::class)->get();
    }
}
