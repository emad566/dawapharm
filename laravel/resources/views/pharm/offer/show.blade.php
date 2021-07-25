
@extends('layouts.headfooter')

@section('headMeta')
    <title>{{$offer->p_name}}</title>
@endsection

@section('allContent')   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> 
            العرض: {{ $offer->p_name }}        
            <a href="{{ url('pharm/offer/create?p=offer') }}" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> 
            <a href="{{ url('pharm/offer?p=offer') }}" class="btn btn-primary action-btn pull-left"><i class="fas fa-coffee"></i> كل العروض </a>  
            <a href="{{ url('pharm/offer/'.$offer->id.'/edit?p=offer') }}" class="btn btn-primary action-btn pull-left"><i class="fas fa-edit"></i> تعديل العرض </a>  
            <a class="btn btn-primary action-btn pull-left" href="#"
            onclick="
                var result = confirm(' هل ترغب في حذف العرض : {{ $offer->offerName }}');
                if(result) {
                    event.preventDefault();
                    document.getElementById('delete-form{{ $offer->id }}').submit();
                }

            "
            ><i class="fas fa-trash-alt"></i> حذف </a>

            <form id='delete-form{{ $offer->id }}' class='delete-form' method='post' action='{{ route('offer.destroy', [$offer->id]) }}'>
                {{ csrf_field() }}
                <input type='hidden' name='_method' value='DELETE'>
            </form><!--#delete-form .delete-form -->
            
        </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            <table id="usersTable" class="table table-hover table-striped table-bordered order-column"> 
                <tbody>

                    <tr>
                        <td>الصورة المميزة</td>
                        <td><img class="tumbShow" src="{{url('uploads/'.$offer->thumb)}}" alt="{{ $offer->offerName }}"></td>
                    </tr>

                    <tr>
                        <th width="150px">اسم العرض</th>
                        <td>{{ $offer->offerName }}</td>
                    </tr>
                    <tr>
                        <th width="150px">وصف العرض</th>
                        <td>{{ $offer->desc }}</td>
                    </tr>
                    <tr>
                        <th>شهر العرض</th>
                        <td>{{ $offer->offerMonth }}</td>
                    </tr>
                    <tr>
                        <th>قيمة العرض</th>                    
                        <td>{{ $offer->offerPrice }}</td>
                    </tr>
                    <tr>
                        <th>سعر الاوردر</th>
                        <td>{{ $offer->orderPrice }}</td>
                    </tr>
                    <tr>
                        <th>ExpireTotal</th>
                        <td>{{ $offer->expireTotal }}</td> 
                    </tr>

                    <tr>
                        <th>مصاريف الشحن</th>
                        <td>{{ $offer->charge }}</td>
                    </tr>
                    <tr>
                        <th>سماحية سعر الاكسبير المستبدل </th>
                        <td>{{ $offer->tolerance }}</td>
                    </tr>

                </tbody>
            </table>
            
            <div class="panel panel-default">
                <div class="panel-heading">منتجات العرض</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        @foreach($offer->products()->where('offer_product.is_offer', 1)->orderBy('offer_product.offerPriority', 'ASC')->get() as $product)
                            <li>
                                <label for="product{{ $product->id }}">
                                    <a target="_blank" href="{{ url('pharm/product/'. $product->id . '?p=product' ) }}"><i class="fas fa-coffe attachIcon"></i>{{ $product->p_name }}</a>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">منتجات الاستبدال</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        @foreach($offer->products()->where('offer_product.is_expired', 1)->orderBy('products.p_name', 'ASC')->get() as $product)
                            <li>
                                <label for="product{{ $product->id }}">
                                    <a target="_blank" href="{{ url('pharm/product/'. $product->id . '?p=product' ) }}"><i class="fas fa-coffe attachIcon"></i>{{ $product->p_name }}</a>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            
        </div><!-- .panel-body  -->
    </div>

</div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        
    })
</script>
@endsection


