@extends('layouts.headfooter')

@section('headMeta')
<title>تسجيل طلبيه</title>
<!-- Facebook Meta -->
@if($offerSelected)
<meta property="og:image" content="{{url('uploads/'.$offerSelected->thumb)}}" />
<meta property="og:title" content="{{$offerSelected->offerSelectedName}}"/>
<meta property="og:description" content="{{$offerSelected->desc}}"/>
<meta property="og:image" content="{{url('uploads/'.$offerSelected->thumb)}}" />
@endif
<!-- Facebook Meta -->
<style>
/* Style the form */
/* #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
} */

/* Style the input fields */
/* input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
} */

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>

@endsection


@section('allContent')

<div class="container" style="margin-bottom:150px">
@if(($monthNumber->is_site_active || Auth::check()) && $offerSelected)
    @if($isShowPage)
    @include("partials.errors")
    @include("partials.success")
    <?php $answer=0; ?>
    @if(session()->has('success'))
        <a class="btn btn-primary" style="display:block; width:80%; margin:auto;"  href="{{url('/')}}?p=customerOrder">أضف طلب جديد</a>
    @else


    <form id='regForm' class='regForm form-horizontal panelForm' method='POST'
        action="{{ url('/createcustomer') }}">
        {{ csrf_field() }}

        <input type='hidden' name='_method' value='POST'>
        <div id="offerInfo" class="panel panel-default tab">
            <div class="panel-heading">
                بيانات العرض
            </div>

            <div class="panel-body panelBodyForm offerDiv">
                <div class="form-group{{ $errors->has('offer_id') ? ' has-error' : '' }}">
                    <label for="offerId">- اختر عرض -</label>
                    <select required class="form-control" id="offerId" name="offer_id">
                        <!-- <option value="">- اختر عرض -</option> -->
                        @foreach($offers as $offer)
                        <?php $selected = (@$offerSelected->id == $offer->id)? "selected" : "" ?>
                        <option value="{{ $offer->id }}" {{$selected}}>{{ $offer->offerName }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('offer_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offer_id') }}</strong>
                    </span>
                    @endif
                </div>

                <br>
                @if($offerSelected->thumb || $offerSelected->desc)
                    @if($offerSelected->thumb)
                    <img class="thumbShowCustomer" src="{{url('uploads/'.$offerSelected->thumb)}}" alt="{{$offerSelected->offerName}}" title="{{$offerSelected->offerName}}">
                    @endif
                    @if($offerSelected->desc)
                    <div class="descContent">{!!$offerSelected->desc!!}</div>
                    @endif
                @endif
                <br>

                <div class="panel-heading bg-info">
                    قم بتحديد اصناف العرض المطلوبة وكمياتها
                </div>
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th style="min-width:10%;">الكمية</th>
                            <th style="min-width:10%;">السعر</th>
                            <th style="min-width:10%;">الخصم</th>
                            <th style="min-width:15%;">الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offerSelected->products()->where('offer_product.is_offer', 1)->orderBy('offer_product.offerPriority', 'ASC')->get() as $product)
                        <tr class="pro_id{{ $product->id }}">
                            <th >
                                {{$product->p_name}}
                                <input value="{{ $product->id }}" type="hidden" name="productOfferIds[]" class="pro_id{{ $product->id }}">
                                @if($product->p_active_ingredient)<span class="activeP">{{$product->p_active_ingredient}}</span>@endif
                            </th>
                            <td>
                                <input pro_id="pro_id{{ $product->id }}" value="{{ old('offerAmount'.$product->id) }}" type="number" min="0" step="1" max='99999999999'
                                    name="offerAmount{{$product->id}}" class="form-control offerAmount pro_id{{ $product->id }}"
                                    amountid="{{$product->id}}" id="offerAmount{{$product->id}}" placeholder="الكمية *">
                            </td>
                            <th>
                                <span id="offerpPrice{{$product->id}}" class='offerpPrice' value="{{$product->p_price}}">{{$product->p_price}}</span>

                                <input type="hidden" name="offerpPrices[]" value="{{$product->id}}" class="pro_id{{ $product->id }}">
                            </th>
                            <th>
                                <span id="discount{{$product->id}}" class='discount' value="{{$offer->discount}}">{{$offer->discount}} %</span>
                            </th>

                            <td>
                                <input  id="offerP{{$product->id}}" readonly="readonly" class="btnLabel offerPAmountVal pro_id{{ $product->id }}"
                                    value="@if(old('offerAmounts'.$product->id)){{ old('offerAmounts'.$product->id) }}@endif"
                                    name="offerAmounts{{$product->id}}" placeholder="0">
                            </td>
                        </tr>
                        @endforeach

                        <tr id="offerTotalTr" class="totalTr" width="100%">
                            <td colspan="1" width="80%" >أجمالي سعر طلبية العرض</td>
                            <td id="tdtotal" colspan="4">
                                <?php $z = 0; ?>
                                <input id="offerTotal" readonly class="btnLabel" type="text" name="offerTotal"
                                    value="@if(old('offerTotal')){{ old('offerTotal') }}@else{{$z}}@endif" placeholder="0">
                            </td>
                        </tr>

                        <tr>
                            <th id="winscrollto">ملحوظة</th>
                            <td colspan="4">  يجب ان يكون الحد الأدني لمنتجات العرض بسعر الجمهور {{ $offerSelected->minPrice }} ج.م.</td>
                        </tr>

                    </tbody>
                </table>

                @if($offerSelected)
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <tbody>

                        <tr>
                            <th colspan="2" style="text-align: center; background-color: #ccc;">بيانات الدفع </th>
                        </tr>

                                                <tr>
                                                    <th width="250px">سعر الجمهور (الطلبية)</th>
                                                    <td><span id="spanOrderPrice">0</span></td>
                                                </tr>
                        <tr>
                            <th width="250px"> سعر العرض (قبل حساب الشحن)</th>
                            <td><span id="spanOfferPrice">0</span></td>
                        </tr>

                        <tr>
                            <th width="250px">مصاريف الشحن</th>
                            <td>{{ $offerSelected->charge }}</td>
                        </tr>

                        <tr>
                            <th width="250px">إجمالي العرض بمصاريف الشحن</th>
                            <td><span id="spanCharge">0</span></td>
                        </tr>

                        <tr>
                            <th> سعر الاكسبير المستبدل</th>
                            <td><span class="spanExpireTotal" id="spanExpireTotal">0</span></td>
                        </tr>

                    </tbody>
                </table>

                <div id="offerPriceAlert" class="alert alert-info">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        عذرا القيمة الإجمالية لأصناف االعرض يجب ان تكون بحد ادني {{$offerSelected->minPrice}}
                        جنية،
                        الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.
                    </strong>
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> لعرض أصناف الإستبدال.
                </div>
            </div>
        </div>

        <div id="productsInfo" class="panel panel-default tab expireDiv">
            <div class="panel-heading">
                 حدد كميات أصناف الإستبدال التي تريد طلبها علي ان تكون في حدود
                 <span class="spanExpireTotal" id="spanExpireTotal">0</span>
                 جنية
            </div>

            <div class="panel-body panelBodyForm">

                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th style="min-width:10%;">السعر</th>
                            <th style="min-width:10%;">الكمية</th>
                            <th style="min-width:15%;">الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php //Sorted by name -- by Ahmed Suror Please DON'T EDIT the sorting EMAD  ?>
                    @foreach($offerSelected->products()->where('offer_product.is_expired', 1)->orderBy('products.p_name', 'ASC')->get() as $product)

                        <tr class="pro_id{{ $product->id }}">
                            <th>
                                {{$product->p_name}}
                                <input value="{{ $product->id }}" type="hidden" name="product_id[]" class="pro_id{{ $product->id }}">
                                @if($product->p_active_ingredient)<span class="activeP">{{$product->p_active_ingredient}}</span>@endif
                            </th>
                            <th><span id="pPrice{{$product->id}}" class='pPrice'
                                    value="{{$product->p_price}}">{{$product->p_price}}</span></th>
                                    <input type="hidden" name="pPrices[]" value="{{$product->p_price}}" class="pro_id{{ $product->id }}">
                            <td>
                                <input pro_id="pro_id{{ $product->id }}" value="{{ old('amount'.$product->id) }}" type="number" min="0" step="1" max='99999999999'
                                    name="amount{{$product->id}}" class="form-control name amount pro_id{{ $product->id }}"
                                    amountid="{{$product->id}}" id="amount{{$product->id}}" placeholder="الكمية *">
                            </td>
                            <td><input  id="p{{$product->id}}" readonly="readonly" class="btnLabel pAmountVal pro_id{{ $product->id }}"
                                    value="@if(old('amounts'.$product->id)){{ old('amounts'.$product->id) }}@endif"
                                    name="amounts{{$product->id}}" placeholder="0"></td>
                        </tr>
                        @endforeach
                        </tr>
                        <tr id="totalTr" class="totalTr">
                            <td colspan="2"  width="30%">إجمالي  الاكسبير المستبدل</td>
                            <td id="tdtotal" colspan="2">
                                <?php $z = 0; ?>
                                <input id="total" readonly class="btnLabel" type="text" name="total"
                                    value="@if(old('total')){{ old('total') }}@else{{$z}}@endif" placeholder="0">
                            </td>
                        </tr>
                        <tr>
                            <th id="winscrollto">ملحوظة</th>
                            <td colspan="3">الاوردرات يتم إرسالها خلال 15 يوم من وقت طلبها </td>
                        </tr>
                    </tbody>
                </table>

                <div id="priceAlert" class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        عذرا القيمة الإجمالية لأصناف الاستبدال يجب ان تكون في حدود مبلغ
                        <span class="spanExpireTotal" id="spanExpireTotal">0</span>
                        جنية،
                        الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.
                    </strong>
                </div>




                @endif

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> للإستمرار.
                </div>
            </div><!-- .panel-body  -->
        </div>

        <div id="pharmInfo" class="panel panel-default tab">
            <div class="panel-heading">
                بيانات الصيديلة
            </div>

            <div class="panel-body panelBodyForm">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">اسم الصيدلية *</label>
                    <input value="{{ old('name') }}" type="text" name="name" required class="form-control name"
                        id="name" placeholder="اسم الصيدلية *">

                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title"> عنوان الصيدلية *</label>
                    <input value="{{ old('title') }}" type="text" required name="title" class="form-control name"
                        id="title" placeholder="عنوان الصيدلية *">

                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('whats') ? ' has-error' : '' }}">
                    <label for="whats"> رقم الوتس *</label>
                    <input value="{{ old('whats') }}" type="number" min='1000000000' max='9999999999' required
                        name="whats" class="form-control name" id="whats" placeholder="رقم الوتس *">
                    @if ($errors->has('whats'))
                    <span class="help-block">
                        <strong>{{ $errors->first('whats') }}</strong>
                    </span>
                    @endif
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> للإستمرار.
                </div>
            </div>
        </div>

        <div id="ansInfo" class="panel panel-default tab">
            <div class="panel-heading">
                سؤال إجبارى
            </div>

            <div class="panel-body panelBodyForm">
                <?php
                session_start();
                $fn = rand(rand(1,5),rand(1,5));
                $sn = rand(rand(1,5), rand(1,5));
                $ops = [ '+', '×'];
                $op = rand(0, 1);
                $op = $ops[$op];
                $answer = 0;
                switch($op){
                    case "+":
                        $answer = $fn + $sn;
                        break;
                    /*
                    case "-":
                        $answer = $fn - $sn;
                        break; */

                    case "×":
                        $answer = $fn * $sn;
                        break;
                }

                $_SESSION['answer'] = $answer;

                ?>

                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <label class="lightP" for="answer">اكتب ناتج: {{ $sn }} {{ $op }} {{ $fn }} = </label>
                    <input type="number" min="0" max='99999999999' name="answer" required class="form-control name"
                        id="answer" placeholder="اكتب الإجابه هنا">

                    @if ($errors->has('answer'))
                    <span class="help-block">
                        <strong>{!! $errors->first('answer') !!}</strong>
                    </span>
                    @endif
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"تأكيد الأوردر"</span> للتأكيد.
                </div>

            </div>
        </div>


        <!--#  .alert alert-dismissable alert-sucess -->

        <div style="overflow:auto;">
            <div class="nextprevRow">
                <button type="button" id="prevBtn" class="btn btn-primary pull-right prev"> <i class="far fa-arrow-alt-circle-right"></i> السابق </button>
                <button type="button" id="nextBtn"  class="btn btn-primary pull-left next"> التالي <i class="far fa-arrow-alt-circle-left"></i> </button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    @endif
    <!--#regForm .regForm -->
    @else
    <div class="panel panel-default tab">
        <div class="panel-heading">
            بيانات العرض
        </div>

        <div class="panel-body panelBodyForm">
            <p>عذرا لا توجد عروض الأن - يرجى المتابعة على جروب الواتس او صفحة الفيسبوك لمعرفة مواعيد العرض التالى</p>
        </div>
    </div>
    @endif
@else
    <p class="alert alert-info">عذرا لا توجد عروض الأن - يرجى المتابعة على جروب الواتس او صفحة الفيسبوك لمعرفة مواعيد العرض التالى</p>
@endif
</div>

<!-- Counter -->
<center style="margin: 30px;">
<a href="https://info.flagcounter.com/Xhs4"><img src="https://s01.flagcounter.com/count2/Xhs4/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_12/viewers_3/labels_1/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
</center>
<!-- END Counter -->

@endsection


@section('scripts')
@if(($monthNumber->is_site_active || Auth::check()) && $offerSelected)
<script>
$(document).ready(function() {

    $("#offerId").change(function() {
        window.location.replace('{{ url('/') }}/' + $("#offerId").val() +
            '?p=customerOrder')
    });
    screenWidth = $( document ).width()
    // Window scroll to
    sUsrAg = navigator.userAgent

    $(window).scroll(function() {
        var hT = $('#winscrollto').offset().top,
            hH = $('#winscrollto').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        /*if (wS > (hT - wH)) {
            console.log('H1 on the view!');
            // focused = $(':focus');
            if (sUsrAg.indexOf("Firefox") > -1 && $(window).width()<768) {
                $('#totalTr').css({
                    'position': 'fixed',
                })
            }else{
                $('#totalTr').css({
                    'position': 'relative',
                })
            }
            // focused.focus();
            // alert(focused.focus())
        } else {
            $('#totalTr').css({
                'position': 'fixed'
            })
        }*/
    });

    //For Offer
    offerIsvalid = false
    $(".offerAmount").on('keyup change', function() {
        offerpPrice = $("#offerpPrice" + $(this).attr('amountid')).attr('value')
        offerpAmount = $(this).val()
        if(!$.isNumeric($(this).val()) ) {
            $(this).val("")
        }else{
            $(this).val(parseInt( $(this).val()))
        }

        $("#offerP" + $(this).attr('amountid')).val(parseFloat(offerpPrice * offerpAmount * (100-{{ $offerSelected->discount }})/100).toFixed(2))

        offerTotalAmount = parseFloat(0)
        $(".offerPAmountVal").each(function(i, obj) {
            if ($(this).val() != "") {
                offerTotalAmount += parseFloat($(this).val())
            }


        })
        $("#offerTotal").val(offerTotalAmount)
        $("#spanOrderPrice").html(parseFloat(offerTotalAmount / ((100- {{ $offerSelected->discount }}) /100)).toFixed(2) )

        // spanOfferPrice = offerTotalAmount - (offerTotalAmount * {{ $offerSelected->discount }} /100)
        spanOfferPrice = offerTotalAmount
        $("#spanOfferPrice").html(spanOfferPrice)
        $("#spanCharge").html(spanOfferPrice + {{ $offerSelected->charge }})
        spanExpireTotal = (( {{ $offerSelected->expireTotal }} / {{ $offerSelected->offerPrice }}) * offerTotalAmount).toFixed(2)
        $(".spanExpireTotal").html(spanExpireTotal)



        if (offerTotalAmount >= {{ $offerSelected->minPrice }}) {
            $('#offerTotalTr').css({
                'background': '#0084BF'
            })
            $('#offerPriceAlert').css({
                'display': 'none'
            })
            $('#submitFormCreate').attr("disabled", false);
            $('#nextBtn').attr("disabled", false);
            offerIsvalid = true
        } else {
            $('#offerTotalTr').css({
                'background': 'red'
            })
            $('#offerPriceAlert').css({
                'display': 'block'
            })
            $('#submitFormCreate').attr("disabled", true);
            $('#nextBtn').attr("disabled", true);
            offerIsvalid = false
        }
    });

    isvalid = false
    $(".amount").on('keyup change', function() {
        pPrice = $("#pPrice" + $(this).attr('amountid')).attr('value')
        pAmount = $(this).val()
        if(!$.isNumeric($(this).val()) ) {
            $(this).val("")
        }else{
            $(this).val(parseInt( $(this).val()))
        }

        $("#p" + $(this).attr('amountid')).val(parseFloat(pPrice * pAmount ).toFixed(2))
        totalAmount = parseFloat(0)
        $(".pAmountVal").each(function(i, obj) {
            if ($(this).val() != "") {
                totalAmount += parseFloat($(this).val())
            }


        })
        $("#total").val(totalAmount)

        maxprice = parseInt(spanExpireTotal) + parseInt({{$offerSelected->tolerance}})
        minprice = parseInt(spanExpireTotal) - parseInt({{$offerSelected->tolerance}})
        if (totalAmount >= minprice && totalAmount <= maxprice) {
            $('#totalTr').css({
                'background': '#0084BF'
            })
            $('#priceAlert').css({
                'display': 'none'
            })
            $('#submitFormCreate').attr("disabled", false);
            $('#nextBtn').attr("disabled", false);
            isvalid = true
        } else {
            $('#totalTr').css({
                'background': 'red'
            })
            $('#priceAlert').css({
                'display': 'block'
            })
            $('#submitFormCreate').attr("disabled", true);
            $('#nextBtn').attr("disabled", true);
            isvalid = false
        }
    });


    // MultiStep Form JS
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "تأكيد الأوردر";
    } else {
        document.getElementById("nextBtn").innerHTML = ' التالي <i class="far fa-arrow-alt-circle-left"></i> ';
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        // $('input[value=""]').remove();
        $('input.offerAmount').each(function(){
            pid = $(this).attr('pro_id')
            if($(this).val() == ""){
                // alert(pid  + " remove offerAmount= "+ $(this).val())
                $(".offerDiv tr."+pid).remove()
            }else{
                // alert(pid  + " offerAmount= "+ $(this).val())
            }
        })
        $('input.amount').each(function(){
            pid = $(this).attr('pro_id')
            if($(this).val() == ""){
                // alert(pid + " Remove  amount" + $(this).val())
                $(".expireDiv tr."+pid).remove()
            }else{
                // alert(pid + "  amount" + $(this).val())
            }
        })
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }


    $msg = ""
    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");

        y = x[currentTab].getElementsByTagName("input");

        if(x[currentTab].getAttribute("id") == "offerInfo"){
            valid = offerIsvalid
            if(valid == false){
                $('#offerTotalTr').css({
                    'background': 'red'
                })
                $('#offerPriceAlert').css({
                    'display': 'block'
                })
                $('#nextBtn').attr("disabled", true);

                alert("عذرا القيمة الإجمالية لأصناف االعرض يجب ان تكون بحد ادني {{$offerSelected->minPrice}} ، جنية الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.")

            }
        }else if(x[currentTab].getAttribute("id") == "productsInfo"){
            valid = isvalid
            if(valid == false){
                $('#totalTr').css({
                    'background': 'red'
                })
                $('#priceAlert').css({
                    'display': 'block'
                })
                $('#nextBtn').attr("disabled", true);

                alert("عذرا القيمة الإجمالية لأصناف الاستبدال يجب ان تكون في حدود مبلغ "+spanExpireTotal+" ، جنية الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.")

            }

        }else if(x[currentTab].getAttribute("id") == "pharmInfo"){
            valid = false;
            if($("#name").val() =="" || $("#title").val() == ""){
                alert("تأكد من ادخال اسم الصيديلة وعنوانها  بشكل صحيح")

            }else if(!($.isNumeric($("#whats").val()) && $("#whats").val().length ==11)){
                alert("رقم الواتس يجب ان يتكون من 11 رقم")
            }else{
                valid = true;
            }
        }else if(x[currentTab].getAttribute("id") == "ansInfo"){
            if($("#answer").val() != {{$answer}}){
                alert("من فضلك أجب علي السؤاال الإجباري بشكل صحيح لضمان ارسال البيانات بأمان")
                valid = false;
            }else{
                valid = true;
            }
        }else if(false){
            for (i = 0; i < y.length; i++) {
                //Check empty Fields
                if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
                }
            }
        }

        // A loop that checks every input field in the current tab:

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

    $('#prevBtn').on('click', function(){
        nextPrev(-1)
        window.scrollTo(0, 0);
        $('#nextBtn').attr("disabled", false);
    })

    $('#nextBtn').on('click', function(){
        window.scrollTo(0, 0);
        nextPrev(1)
    })

});
</script>
@endif
@endsection
