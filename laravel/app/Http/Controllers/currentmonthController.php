<?php

namespace App\Http\Controllers;

use App\Currentmonth;
use Illuminate\Http\Request;
use App\Offer;

class currentmonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::OrderBy('id', 'DESC')->get();
        $currentmonth = Currentmonth::find(1);
        return view('pharm.currentmonth.index', compact(["currentmonth", 'offers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currentmonth  $currentmonth
     * @return \Illuminate\Http\Response
     */
    public function show(Currentmonth $currentmonth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currentmonth  $currentmonth
     * @return \Illuminate\Http\Response
     */
    public function edit(Currentmonth $currentmonth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currentmonth  $currentmonth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currentmonth $currentmonth)
    {
        $inputs = $request->all();
        $inputs['is_site_active'] = ($request->is_site_active)? 1 : 0;
        // return $request->all();
        if($currentmonth->update($inputs)){
            return redirect('pharm/currentmonth/?p=currentmonth')->with('success',   trans('تم حفظ التعديلات بنجاح')  );
        }else
            return back()->withInput()->withErrors(['backError' => trans('عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.')]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currentmonth  $currentmonth
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currentmonth $currentmonth)
    {
        //
    }
}
