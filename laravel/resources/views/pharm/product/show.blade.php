
@extends('layouts.headfooter')

@section('headMeta')
    <title>{{$product->p_name}}</title>
@endsection

@section('allContent')   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> 
         المنتج: {{ $product->p_name }}        
        <a href="{{ url('pharm/product/create?p=product') }}" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> 
        <a href="{{ url('pharm/product?p=product') }}" class="btn btn-primary action-btn pull-left"><i class="fas fa-coffee"></i> كل المنتجات </a>  
        <a href="{{ url('pharm/product/'.$product->id.'/edit?p=product') }}" class="btn btn-primary action-btn pull-left"><i class="fas fa-edit"></i> تعديل المنتج </a>  

        <a class="btn btn-primary action-btn pull-left" href="#"
            onclick="
                var result = confirm(' هل ترغب في حذف المنتج : {{ $product->p_name }}');
                if(result) {
                    event.preventDefault();
                    document.getElementById('delete-form{{ $product->id }}').submit();
                }

            "
            ><i class="fas fa-trash-alt"></i> حذف </a>

            <form id='delete-form{{ $product->id }}' class='delete-form' method='post' action='{{ route('product.destroy', [$product->id]) }}'>
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
                        <th width="150px">اسم المنتج</th>
                        <td>{{ $product->p_name }}</td>
                    </tr>
                    <tr>
                        <th>الماده الفعالة</th>
                        <td>{{ $product->p_active_ingredient }}</td>
                    </tr>
                    <tr>
                        <th>سعر المنتج</th>
                        <td>{{ $product->p_price }}</td>
                    </tr>
                    <tr>
                        <th>معامل الترتيب</th>
                        <td>{{ $product->sort_factor }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="panel panel-default">
                <div class="panel-heading">العروض المرتبطة</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        @foreach($product->offers as $offer)
                            <li>
                                <label for="offer{{ $offer->id }}">
                                    <a target="_blank" href="{{ url('pharm/offer/'. $offer->id . '?p=offer' ) }}"><i class="fas fa-coffe attachIcon"></i>{{ $offer->offerName }}</a>
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


