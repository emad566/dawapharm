
@extends('layouts.headfooter')

@section('headMeta')
    <title>كل العروض</title>
@endsection

@section('allContent')   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> كل العروض <a href="{{ url('pharm/offer/create?p=offer') }}" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            @if($offers->count()<1)
                <div id="" class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        <li>عذرا لا توجد عروض، اذا اردت إضافة عرض - إضغط أضف جديد من الأعلي</li>
                    </strong>
                </div><!--#  .alert alert-dismissable alert-sucess -->
            @else

            <table id="usersTable" class="table table-hover table-striped table-bordered order-column dataTable"> 

                <thead>
                    <tr>
                        <th>م</th>
                        <th>تعديل/حذف</th>
                        <th>اسم العرض</th>
                        <th>شهر العرض</th>
                        <th>قيمة العرض</th>                    
                        <th>سعر الاوردر</th>
                        <th>ExpireTotal</th>
                        <th>عرض</th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php $i=0; ?>
                    @foreach($offers as $offer)
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <a href="{{ url('pharm/offer') }}/{{ $offer->id }}/edit?p=offer"><i class="fas fa-edit delEdit"></i></a>
                                
                                <a href="#"
                                onclick="
                                    var result = confirm(' هل تريد حذف هذا العنصر : {{ $offer->offerName }}');
                                    if(result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form{{ $offer->id }}').submit();
                                    }
                
                                "
                                ><i class="fas fa-trash-alt delEdit"></i></a>
    
                                <form id='delete-form{{ $offer->id }}' class='delete-form' method='post' action='{{ route('offer.destroy', [$offer->id]) }}'>
                                    {{ csrf_field() }}
                                    <input type='hidden' name='_method' value='DELETE'>
                                </form><!--#delete-form .delete-form -->
                            </td>
                            <td>{{ $offer->offerName }}</td>
                            <td>{{ $offer->offerMonth }}</td>
                            <td>{{ $offer->offerPrice }}</td>
                            <td>{{ $offer->orderPrice }}</td>
                            <td>{{ $offer->expireTotal }}</td>
                            <td><a href="{{ url('pharm/offer/'.$offer->id.'?p=offer') }}"><i class="fas fa-eye"></i></a></td>
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


