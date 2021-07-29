@extends('layouts.headfooter')

@section('headMeta')
<title>كل الطلبيات</title>
@endsection

@section('allContent')
<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading"> كل الطلبيات
            <a href="{{ url('/') }}?p=customerOrder" class="btn btn-primary action-btn pull-left"><i
                    class="fas fa-calendar-plus"></i> أضف جديد</a>
            <a href="" onclick="printMyPage()" class="btn btn-primary action-btn  pull-left"><i
                    class="fas fa-print"></i> طباعة</a>
        </div>
        <div class="panel-body panelBodyForm">
            @include("partials.errors")
            @include("partials.success")
            @if($customers->count()<1) <div id="" class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    <li> لا توجد طلبيات!</li>
                </strong>
        </div>
        <!--#  .alert alert-dismissable alert-sucess -->
        @else

        <table id="usersTable" class="table table-hover table-striped table-bordered order-column dataTable">

            <thead>
                <tr>
                    <th>م</th>
                    <th>اسم الصيدلية</th>
                    <th>رقم الواتس </th>
                    <th>طلبية (صيدلى)</th><!-- Added by Ahmed Suror 10-12-2020 -->
                    <th>إكسبير (جمهور)</th><!-- Modified by Ahmed Suror 10-12-2020 -->
                    <th>تاريخ الطلب</th>
                    <th>حالة الطلب</th>
                    <!-- <th>عرض</th> Modified by Ahmed Suror 10-12-2020 -->
                    <th>حذف</th> <!-- Modified by Ahmed Suror 10-12-2020 -->
                </tr>
            </thead>

            <tbody>
                <?php $i = 0;?>
                @foreach($customers as $customer)
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td>
                        <a href="{{ url('pharm/customer/'.$customer->id.'?p=customer') }}">
                            {{ $customer->name }}</a>
                    </td>
                    {{-- <td>{{ $customer->title }}
                    </td> --}}
                    <td>{{ $customer->whats }}</td>
                    <td>{{ ($customer->offerTotal) }}</td> <!-- Added by Ahmed Suror 10-12-2020 -->
                    <td>{{ $customer->total }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{$customer->status->sName}}</td>
                    <!--<td><a href="{{ url('pharm/customer/'.$customer->id.'?p=customer') }}"><i class="fas fa-eye"></i></a></td> -->
                    <td>
                        <!--<a href="{{ url('pharm/customer') }}/{{ $customer->id }}/edit?p=customer"><i class="fas fa-edit delEdit"></i></a> Modified by Ahmed Suror 10-12-2020-->

                        <a href="#" onclick="
                                    var result = confirm(' هل تريد حذف هذا العنصر : {{ $customer->name }}');
                                    if(result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form{{ $customer->id }}').submit();
                                    }

                                "><i class="fas fa-trash-alt delEdit"></i></a>

                        <form id='delete-form{{ $customer->id }}' class='delete-form' method='post'
                            action='{{ route('customer.destroy', [$customer->id]) }}'>
                            {{ csrf_field() }}
                            <input type='hidden' name='_method' value='DELETE'>
                        </form>
                        <!--#delete-form .delete-form -->
                    </td>
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
$(document).ready(function() {

})
</script>
@endsection