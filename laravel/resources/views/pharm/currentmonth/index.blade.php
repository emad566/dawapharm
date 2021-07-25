
@extends('layouts.headfooter')

@section('headMeta')
    <title>الشهر الحالي</title>
@endsection

@section('allContent')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">اكتب رقم الشهر الذي تريد عرض عروضه للعميل</div>
        <div class="panel-body panelBodyForm">

            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="{{ route('currentmonth.update', [1]) }}">
                @include("partials.errors")
                @include("partials.success")
                {{ csrf_field() }}
                <input type='hidden' name='_method' value='PUT'>

                <div class="form-group{{ $errors->has('offer_id') ? ' has-error' : '' }}">
                    <label for="offer_id">الشهر الحالي</label>
                    <select name="offer_id" id="offer_id" class="form-control">
                        <option value="0">الشهر الحالي</option>
                        @foreach ($offers as $offer)
                            <option @if($currentmonth->offer_id == $offer->id) selected @endif value="{{ $offer->id }}">{{ $offer->id }} :- {{ $offer->offerName }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('offer_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">البريد الألكتروني</label>
                    <input value="{{ @$currentmonth->email }}" required type="text" name="email" class="form-control name" id="email" placeholder="البريد الألكتروني">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('is_site_active') ? ' has-error' : '' }}">
                    <label for="is_site_active">
                        <input style="display: inline; width:23px; height: 33px; padding-top: 10px" value="1" type="checkbox" name="is_site_active"
                        class="form-control is_site_active" id="is_site_active"
                        @if($currentmonth->is_site_active) checked="checked" @endif
                        >

                        تفعيل الموقع
                    </label>

                    @if ($errors->has('is_site_active'))
                        <span class="help-block">
                            <strong>{{ $errors->first('is_site_active') }}</strong>
                        </span>
                    @endif
                </div>



                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ</button>
            </form><!--#file_id .file_id -->


        </div><!-- .panel-body  -->
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // $('#offer_id').change(function() {

        // });
    })
</script>
@endsection


