@extends('layouts.headfooter')

@section('headMeta')
<title>كل المنتجات</title>
@endsection

@section('allContent')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="{{ url('pharm/product?p=product') }}"
                class="btn btn-primary newRecored pull-left"><i class="fas fa-coffee"></i> كل المنتجات </a> </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST'
                action="{{ route('product.store', []) }}">
                {{ csrf_field() }}


                <input type='hidden' name='_method' value='POST'>

                <div class="form-group{{ $errors->has('p_name') ? ' has-error' : '' }}">
                    <label for="p_name">اسم المنتج *</label>
                    <input value="{{ old('p_name') }}" type="text" name="p_name" required class="form-control name"
                        id="p_name" placeholder="اسم المنتج">

                    @if ($errors->has('p_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('p_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('p_active_ingredient') ? ' has-error' : '' }}">
                    <label for="p_active_ingredient"> المادة الفعالة </label>
                    <input value="{{ old('p_active_ingredient') }}" type="text" name="p_active_ingredient"
                        class="form-control name" id="p_active_ingredient" placeholder="المادة الفعالة ">

                    @if ($errors->has('p_active_ingredient'))
                    <span class="help-block">
                        <strong>{{ $errors->first('p_active_ingredient') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('p_price') ? ' has-error' : '' }}">
                    <label for="p_price"> سعر المنتج *</label>
                    <input value="{{ old('p_price') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="p_price" class="form-control name" id="p_price" placeholder="سعر المنتج *">
                    @if ($errors->has('p_price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('p_price') }}</strong>
                    </span>
                    @endif
                </div>

                <!-- <div class="form-group{{ $errors->has('sort_factor') ? ' has-error' : '' }}">
                    <label for="sort_factor">معامل الترتيب</label>
                    <input value="{{ old('sort_factor') }}" type="number" step="0.01" min="0" max='99999999999' required
                        name="sort_factor" class="form-control name" id="sort_factor" placeholder="معامل الترتيب">
                    @if ($errors->has('sort_factor'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sort_factor') }}</strong>
                    </span>
                    @endif
                </div> -->

                <br>

                <div class="panel panel-default">
                    <div class="panel-heading">العروض المرتبطة</div><!-- .panel-body  -->
                    <div class="panel-body panelBodyForm">
                        <ul style="list-style: none;">
                            @foreach($offers as $offer)
                            <li>
                                <label for="offer{{ $offer->id }}">
                                    <input type="checkbox" value="{{ $offer->id }}" name="offers[]"
                                        id="offer{{ $offer->id }}">
                                    <a target="_blank" href="{{ url('pharm/offer/'. $offer->id . '?p=offer' ) }}"><i
                                            class="fas fa-coffe attachIcon"></i>{{ $offer->offerName }}</a>
                                </label>
                            </li>
                            @endforeach
                        </ul>
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
<script>
$(document).ready(function() {

})
</script>
@endsection