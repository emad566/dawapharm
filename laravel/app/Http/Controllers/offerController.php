<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Offer;
use App\Product;
use App\OfferProduct;

class offerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id', "DESC")->get();
        return view('pharm.offer.index', compact(['offers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('pharm.offer.create', compact(['products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        unset($inputs['thumb']);
        if($file = $request->file('thumb'))
        {
            $photoName = time() . "-" . $file->getClientOriginalName();
            $file->move('uploads', $photoName);
            $inputs['thumb'] =  $photoName;

        }else{
            $inputs['thumb'] = null;
        }

        if($offer = Offer::create($inputs)){
            $offer->products()->detach();
            $i=0;
            foreach($request->products as $product) {
                $offerPriority = 'offerPriority'.$product;
                $is_offer = 'is_offer'.$product;
                $expiredPriority = 'expiredPriority'.$product;
                $is_expired = 'is_expired'.$product;

                $offer->products()->attach(
                    $product,
                    [
                        'offerPriority'=>($request->$offerPriority)? $request->$offerPriority : 0,
                        'is_offer'=>($request->$is_offer)? 1 : 0,
                        'expiredPriority'=>($request->$expiredPriority)? $request->$expiredPriority : 0,
                        'is_expired'=>($request->$is_expired)? 1 : 0,
                    ]
                );
                $i++;
            }
            return redirect('pharm/offer/?p=offer')->with('success',   trans(' تم إضافة العرض '.$request->offerName.' بنجاح ')  );
        }else
            return back()->withInput()->withErrors(['backError' => trans('عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        $products = Product::all();
        return view('pharm.offer.show', compact(['offer', 'products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $products = Product::all();
        $relProducts = DB::select('select product_id from offer_product where offer_id = '.$offer->id);
        // $offerProducts = $offer->products;
        // return $offer->products(1)->first();
        return view('pharm.offer.edit', compact(['offer', 'products', 'relProducts']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {

        $inputs = $request->all();
        $isNewThumb = false;
        if($file = $request->file('thumb'))
        {
            $isNewThumb = true;
            $photoName = time() . $file->getClientOriginalName();
            $file->move('uploads', $photoName);
            $inputs['thumb'] = $photoName;
        }
        $oldthumb = $offer->thumb;
        if($offer->update($inputs)){
            if ( $isNewThumb && $oldthumb && file_exists("uploads/" . $oldthumb))
            {
                unlink("uploads/" . $oldthumb);
            }
            $offer->products()->detach();

            $i=0;
            foreach($request->products as $product) {
                $offerPriority = 'offerPriority'.$product;
                $is_offer = 'is_offer'.$product;
                $expiredPriority = 'expiredPriority'.$product;
                $is_expired = 'is_expired'.$product;

                $offer->products()->attach(
                    $product,
                    [
                        'offerPriority'=>($request->$offerPriority)? $request->$offerPriority : 0,
                        'is_offer'=>($request->$is_offer)? 1 : 0,
                        'expiredPriority'=>($request->$expiredPriority)? $request->$expiredPriority : 0,
                        'is_expired'=>($request->$is_expired)? 1 : 0,
                    ]
                );
                $i++;
            }

            return redirect('pharm/offer/?p=offer')->with('success',   ' تم حفظ التعديلات علي العرض '.$request->offerName.' بنجاح '  );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offerName = $offer->offerName;
        $oldthumb = $offer->thumb;


        $offer->products()->detach();
        if($offer->delete()){

            if ($oldthumb && file_exists("uploads/" . $oldthumb))
            {
                unlink("uploads/" . $oldthumb);
            }
            return redirect('pharm/offer/?p=offer')->with('success',   '  تم حذف العرض '.$offerName.'  بنجاح  '  );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);

    }
}
