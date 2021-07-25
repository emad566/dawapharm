
@extends('layouts.headfooter')

@section('headMeta')
    <title>كل المنتجات</title>
@endsection

@section('allContent')   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> كل المنتجات <a href="{{ url('pharm/product/create?p=product') }}" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            @if($products->count()<1)
                <div id="" class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        <li>عذرا لا توجد منتجات، اذا اردت إضافة منتج - إضغط أضف جديد من الأعلي</li>
                    </strong>
                </div><!--#  .alert alert-dismissable alert-sucess -->
            @else

            <table id="usersTable" class="table table-hover table-striped table-bordered order-column dataTable"> 

                <thead>
                    <tr>
                        <th>م</th>
                        <th>تعديل/حذف</th>
                        <th>اسم المنتج</th>
                        <th>الماده الفعالة</th>
                        <th>سعر المنتج</th>
                        <th>معامل الترتيب</th>
                        <th>عرض</th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php $i=0; ?>
                    @foreach($products as $product)
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <a href="{{ url('pharm/product') }}/{{ $product->id }}/edit?p=product"><i class="fas fa-edit delEdit"></i></a>
                                
                                <a href="#"
                                onclick="
                                    var result = confirm(' هل تريد حذف هذا العنصر : {{ $product->p_name }}');
                                    if(result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form{{ $product->id }}').submit();
                                    }
                
                                "
                                ><i class="fas fa-trash-alt delEdit"></i></a>
    
                                <form id='delete-form{{ $product->id }}' class='delete-form' method='post' action='{{ route('product.destroy', [$product->id]) }}'>
                                    {{ csrf_field() }}
                                    <input type='hidden' name='_method' value='DELETE'>
                                </form><!--#delete-form .delete-form -->
                            </td>
                            <td>{{ $product->p_name }}</td>
                            <td>{{ $product->p_active_ingredient }}</td>
                            <td>{{ $product->p_price }}</td>
                            <td>{{ $product->sort_factor }}</td>
                            <td><a href="{{ url('pharm/product/'.$product->id.'?p=product') }}"><i class="fas fa-eye"></i></a></td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
            @endif
            
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


