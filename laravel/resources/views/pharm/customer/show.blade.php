
@extends('layouts.headfooter')

@section('headMeta')
    <title>عرض طلبيه</title>
@endsection

@section('allContent')
<style>
    @media print {
        #orderDetails{
            display: none;
        }
    }
</style>
<div class="container">
    <div class="panel panel-default">
        <a href="" onclick="printMyPage()" class="btn btn-primary newRecored pull-left"><i class="fas fa-print"></i> طباعة</a>
        <div class="panel-heading">
        بيانات العرض
        </div>

        <div class="panel-body panelBodyForm">
            <div class="col-md-6">
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <tbody>

                        <tr>
                            <th width="250px" offerID="{{ $customer->offer->id }}"> العرض </th>
                            <td>{{ $customer->offer->offerName }}</td>
                        </tr>

                        <tr>
                            <?php $offerPrice = $customer->offerTotal - ($customer->offerTotal * $customer->offer->discount / 100);?>
                            <th width="250px">سعر العرض</th>
                            <td>{{ $offerPrice }}</td>
                        </tr>

                        <tr>
                            <th width="250px">مصاريف الشحن</th>
                            <td>{{ $customer->offer->charge }}</td>
                        </tr>

                        <tr>
                            <th width="250px">إجمالي العرض بمصاريف الشحن</th>
                            <td>{{ $customer->offer->charge + $offerPrice }}</td>
                        </tr>

                        <tr>
                            <th>سعر الاكسبير المستبدل</th>
                            <td>{{ $customer->total }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <tbody>

                        <tr>
                            <th width="250px"> اسم الصيدلية</th>
                            <td>{{ $customer->name }}</td>
                        </tr>

                        <tr>
                            <th width="250px">عنوان الصيدلية</th>
                            <td>{{ $customer->title }}</td>
                        </tr>

                        <tr>
                            <th width="250px">رقم الوتس</th>
                            <td>{{ $customer->whats }}</td>
                        </tr>

                        <tr>
                            <th width="250px">تاريخ الطلب</th>
                            <td>{{ $customer->created_at }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>

    <div class="panel panel-default">
        <div class="panel-heading">
        بيانات أصناف العرض
        </div>

        <div class="panel-body panelBodyForm">
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->products()->where("type", "offer")->orderBy('sort_factor', 'asc')->get() as $product)
                        <tr>
                            <th>
                                {{$product->p_name}}
                                @if($product->p_active_ingredient)<span class="activeP">{{$product->p_active_ingredient}}</span>@endif
                            </th>
                            <th>{{$product->p_price}}</th>
                            <td>{{$product->pivot->amount}}</td>
                            <td>{{$product->pivot->amountPrice}}</td>
                        </tr>
                        @endforeach
                        </tr>
                        <tr id="" class="">
                            <td colspan="3" >الاجمالي</td>
                            <td>{{$customer->offerTotal}}</td>
                        </tr>
                    </tbody>
                </table>
        </div><!-- .panel-body  -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
        بيانات الأصناف المستبدلة
        </div>

        <div class="panel-body panelBodyForm">
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->products()->where("type", "expired")->orderBy('sort_factor', 'asc')->get() as $product)
                        <tr>
                            <th>
                                {{$product->p_name}}
                                @if($product->p_active_ingredient)<span class="activeP">{{$product->p_active_ingredient}}</span>@endif
                            </th>
                            <td>{{$product->pivot->amount}}</td>
                            <th>{{$product->p_price}}</th>
                            <td>{{$product->pivot->amountPrice}}</td>
                        </tr>
                        @endforeach
                        </tr>
                        <tr id="" class="">
                            <td colspan="3" >الاجمالي</td>
                            <td>{{$customer->total}}</td>
                        </tr>
                    </tbody>
                </table>
        </div><!-- .panel-body  -->
    </div>

    <div id="orderDetails" class="panel panel-default">
        <div class="panel-heading">
        معالجة الطلب
        </div>
        <div class="panel-body panelBodyForm">
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="{{ route('customer.update', [$customer->id]) }}">
                {{ csrf_field() }}
                <input type='hidden' name='_method' value='PUT'>

                <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                    <label for="statusId">- حالة الطلبية -</label>
                    <select required class="form-control" id="statusId" name="status_id" >
                        @foreach($statuses as $status)
                            <option
                                @if ($status->id == $customer->status_id)
                                    selected
                                @endif
                                value="{{ $status->id }}"
                            >{{ $status->sName }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('status_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    <label for="notes"> ملاحظات </label>
                    <textarea name="notes" id="notes" class="form-control notes" placeholder="ملاحظات">@if(old('notes')){{old('notes')}}@else{{$customer->notes}}@endif</textarea>
                    @if ($errors->has('notes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('notes') }}</strong>
                        </span>
                    @endif
                </div>

                <button id="submitFormCreate"  name="submit"  type="submit" form="CreateUser" class="btn btn-primary">حفظ التعديلات </button>
            </form><!--#CreateUser .CreateUser -->
        <div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

    })
</script>
@endsection


