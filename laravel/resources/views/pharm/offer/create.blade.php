@extends('layouts.headfooter')

@section('headMeta')
<title>كل العروض</title>
@endsection

@section('allContent')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ url('pharm/offer?p=offer') }}" class="btn btn-primary newRecored pull-left"><i
                    class="fas fa-coffee"></i> كل العروض </a>
            <button id="submitFormCreate" type="submit" form="CreateUser" class="savebtn btn btn-primary">حفظ </button>
        </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST'
                action="{{ route('offer.store', []) }}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <input type='hidden' name='_method' value='POST'>

                <div class="form-group{{ $errors->has('offerName') ? ' has-error' : '' }}">
                    <label for="offerName">اسم العرض *</label>
                    <input value="{{ old('offerName') }}" type="text" name="offerName" required
                        class="form-control name" id="offerName" placeholder="اسم العرض">

                    @if ($errors->has('offerName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offerName') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                    <label for="desc"> وصف العرض </label>
                    <textarea name="desc" id="desc" class="form-control desc"
                        placeholder="وصف العرض">{{ old('desc') }}</textarea>
                    @if ($errors->has('desc'))
                    <span class="help-block">
                        <strong>{{ $errors->first('desc') }}</strong>
                    </span>
                    @endif
                </div>



                <div class="form-group{{ $errors->has('orderPrice') ? ' has-error' : '' }}">
                    <label for="orderPrice">سعر الأوردر *</label>
                    <input value="{{ old('orderPrice') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="orderPrice" class="form-control name" id="orderPrice" placeholder="سعر الأوردر *">
                    @if ($errors->has('orderPrice'))
                    <span class="help-block">
                        <strong>{{ $errors->first('orderPrice') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                    <label for="discount"> نسبة ربح الصيدلية *</label>
                    <input value="{{ old('discount') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="discount" class="form-control name" id="discount" placeholder="نسبة ربح الصيدلية *">
                    @if ($errors->has('discount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('discount') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('offerPrice') ? ' has-error' : '' }}">
                    <label for="offerPrice"> سعر العرض *</label>
                    <input readonly value="{{ old('offerPrice') }}" type="number" step="0.01" min="0" max='99999999999'
                        required name="offerPrice" class="form-control name" id="offerPrice" placeholder="سعر العرض *">
                    @if ($errors->has('offerPrice'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offerPrice') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('minPrice') ? ' has-error' : '' }} col-md-4">
                    <label for="minPrice"> سعر الحد الأدني - صيدلي *</label>
                    <input value="{{ old('minPrice') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="minPrice" class="form-control name" id="minPrice"
                        placeholder=" سعر الحد الأدني - صيدلي *">
                    @if ($errors->has('minPrice'))
                    <span class="help-block">
                        <strong>{{ $errors->first('minPrice') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('minPriceOrder') ? ' has-error' : '' }} col-md-4">
                    <label for="minPriceOrder"> سعر الحد الأدني - جمهور *</label>
                    <input value="{{ old('minPriceOrder') }}" type="number" step="0.01" min="0" max='99999999999'
                        required name="minPriceOrder" class="form-control name" id="minPriceOrder"
                        placeholder="سعر الحد الأدني - جمهور *">
                    @if ($errors->has('minPriceOrder'))
                    <span class="help-block">
                        <strong>{{ $errors->first('minPriceOrder') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('minPrice') ? ' has-error' : '' }} col-md-4">
                    <label for="minPricePrecent"> نسبة الحد الأدني من سعر العرض *</label>
                    <input value="{{ old('minPricePrecent') }}" type="number" step="0.01" min="0" max='99999999999'
                        required name="minPricePrecent" class="form-control name" id="minPricePrecent"
                        placeholder="نسبة الحد الأدني من سعر العرض *">
                    @if ($errors->has('minPricePrecent'))
                    <span class="help-block">
                        <strong>{{ $errors->first('minPricePrecent') }}</strong>
                    </span>
                    @endif
                </div>



                <div class="form-group{{ $errors->has('expireTotal') ? ' has-error' : '' }}">
                    <label for="expireTotal"> expireTotal *</label>
                    <input value="{{ old('expireTotal') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="expireTotal" class="form-control name" id="expireTotal" placeholder="expireTotal *">
                    @if ($errors->has('expireTotal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('expireTotal') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('charge') ? ' has-error' : '' }}">
                    <label for="charge"> مصاريف الشحن *</label>
                    <input value="{{ old('charge') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="charge" class="form-control name" id="charge" placeholder="مصاريف الشحن *">
                    @if ($errors->has('charge'))
                    <span class="help-block">
                        <strong>{{ $errors->first('charge') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('tolerance') ? ' has-error' : '' }}">
                    <label for="tolerance"> سماحية سعر الاكسبير المستبدل *</label>
                    <input value="{{ old('tolerance') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="tolerance" class="form-control name" id="tolerance"
                        placeholder="سماحية سعر الاكسبير المستبدل  *">
                    @if ($errors->has('tolerance'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tolerance') }}</strong>
                    </span>
                    @endif
                </div>

                <!--======================================
                priew image before uploaded
                =====================================-->
                <script type="text/javascript">
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#thumb').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>

                <div class="form-group">
                    <label for="thumb">الصورة المميزة
                        <img id="thumb" class="thumb-sm" src="" alt="">
                    </label>
                    <input type="file" accept="image/x-png, image/gif, image/jpeg" name="thumb" id="thumb"
                        onchange="readURL(this);" class="thumb">
                    <p class="inputNotes"> الصور المسموح بها (jpg, png, gif) </p>
                    @if ($errors->has('thumb'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thumb') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        الأصناف
                        <a id="rallexpired" class="savebtn btn btn-primary newRecored pull-left">إزالة كل الاكسبير</a>
                        <a id="allexpired" class="savebtn btn btn-primary newRecored pull-left">تحديد كل الاكسبير</a>
                        <a id="rallOffer" class="savebtn btn btn-primary newRecored pull-left">إزالة كل العروض</a>
                        <a id="allOffer" class="savebtn btn btn-primary newRecored pull-left">تحديد كل العروض</a>

                    </div><!-- .panel-body  -->
                    <div class="panel-body panelBodyForm">


                        <table id="usersTable"
                            class="table table-hover table-striped table-bordered order-column dataTable">

                            <thead>
                                <tr>
                                    <th>م</th>
                                    <th>الصنف</th>
                                    <th>صنف عرض</th>
                                    <th>أولوية الظهور</th>
                                    <th>صنف استبدال</th>
                                    <th>أولوية الظهور</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=1; ?>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a target="_blank"
                                            href="{{ url('pharm/product/'. $product->id . '?p=product' ) }}"><i
                                                class="fas fa-coffe attachIcon"></i>{{ $product->p_name }}</a>
                                        <input style="display: none !important" type="checkbox"
                                            value="{{ $product->id }}" name="products[]" id="product{{ $product->id }}">
                                    </td>
                                    <td>
                                        <input type="checkbox" proId="{{ $product->id }}"
                                            name="is_offer{{ $product->id }}" id="is_offer{{ $product->id }}"
                                            class="proType is_offer">
                                    </td>
                                    <td>
                                        <input type="number" name="offerPriority{{ $product->id }}"
                                            placeholder="الترتيب" class="priorityInput">
                                    </td>

                                    <td>
                                        <input type="checkbox" proid="{{ $product->id }}"
                                            name="is_expired{{ $product->id }}" id="is_expired{{ $product->id }}"
                                            class="proType is_expired">
                                    </td>
                                    <td>
                                        <input type="number" name="expiredPriority{{ $product->id }}"
                                            placeholder="الترتيب" class="priorityInput">
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ </button>
            </form>
            <!--#CreateUser .CreateUser -->


        </div><!-- .panel-body  -->
    </div>
</div>
@endsection

@section('scripts')

<!-- Initialize the editor. -->



<script>
$(document).ready(function() {
    $(document).on("change", '.proType', function(e) {
        proId = $(this).attr("proId");
        if ($("#is_offer" + proId).is(":checked") || $("#is_expired" + proId).is(":checked")) {
            $("#product" + proId).prop('checked', true);
        } else {
            $("#product" + proId).prop('checked', false);
        }
    });

    $(document).on("keyup", '#discount', function(e) {
        offerPriceVal = $('#orderPrice').val() - ($('#orderPrice').val() * $('#discount').val() / 100)
        $("#offerPrice").val(offerPriceVal)
    });

    $(document).on("keyup", '#orderPrice', function(e) {
        offerPriceVal = $('#orderPrice').val() - ($('#orderPrice').val() * $('#discount').val() / 100)
        $("#offerPrice").val(offerPriceVal)
    });

    $(document).on("keyup", '#minPricePrecent', function(e) {
        minPrice = (($('#minPricePrecent').val() * $('#offerPrice').val() / 100)).toFixed(2)
        $("#minPrice").val(minPrice)
        minPriceOrder = (($('#minPricePrecent').val() * $('#orderPrice').val() / 100)).toFixed(2)
        $("#minPriceOrder").val(minPriceOrder)
    });

    $(document).on("keyup", '#minPrice', function(e) {
        minPricePrecent = (($('#minPrice').val() / $('#offerPrice').val() * 100)).toFixed(2)
        $("#minPricePrecent").val(minPricePrecent)

        minPriceOrder = (($('#minPricePrecent').val() * $('#orderPrice').val() / 100)).toFixed(2)
        $("#minPriceOrder").val(minPriceOrder)
    });

    $(document).on("keyup", '#minPriceOrder', function(e) {
        minPricePrecent = (($('#minPriceOrder').val() / $('#orderPrice').val() * 100)).toFixed(2)
        $("#minPricePrecent").val(minPricePrecent)

        minPrice = (($('#minPricePrecent').val() * $('#offerPrice').val() / 100)).toFixed(2)
        $("#minPrice").val(minPrice)

    });

    $(document).on("click", '#allOffer', function(e) {
        $(".is_offer").prop('checked', true);
        return false;
    });

    $(document).on("click", '#rallOffer', function(e) {
        $(".is_offer").prop('checked', false);
        return false;
    });

    $(document).on("click", '#allexpired', function(e) {
        $(".is_expired").prop('checked', true);
        return false;
    });

    $(document).on("click", '#rallexpired', function(e) {
        $(".is_expired").prop('checked', false);
        return false;
    });
});
</script>
@endsection
