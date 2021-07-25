<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Offer;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pharm.product.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offers = Offer::all();
        return view('pharm.product.create', compact(['offers']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($product = Product::create($request->all())){
            $product->offers()->detach();
            $product->offers()->attach($request->offers);
            return redirect('pharm/product/?p=product')->with('success',   trans(' تم إضافة المنتج '.$request->productName.' بنجاح ')  );
        }else
            return back()->withInput()->withErrors(['backError' => trans('عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        return view('pharm.product.show', compact(['product']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        $offers = Offer::all();
        $relOffers = DB::select('select offer_id from offer_product where product_id = '.$product->id);
        return view('pharm.product.edit', compact(['product', 'offers', 'relOffers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        if($product->update($request->all())){
            $product->offers()->detach();
            $product->offers()->attach($request->offers);
            return redirect('pharm/product/?p=product')->with('success',   ' تم حفظ التعديلات علي المنتج '.$request->productName.' بنجاح '  );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $productName = $product->productName;
        $product->offers()->detach();
        if($product->delete()){
            return redirect('pharm/product/?p=product')->with('success',   '  تم حذف المنتج '.$productName.'  بنجاح  '  );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);

    }
}
