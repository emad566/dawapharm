
@extends('layouts.headfooter')

@section('headMeta')
    <title>الصفحة الرئيسية</title>

    <!-- facebook meta -->

    <!-- facebook meta -->
 
    <meta property="og:image" content="{{ url('/fbn.jpg') }}" />
    <meta property="og:title" content=""/> 
  
    <meta property="og:description" content="" />



    <meta property="og:image" content="{{ url('images/soLogo.png') }}" />

    <link rel="icon" href="{{ url('images/soLogo.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ url('images/soLogo.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('images/soLogo.png') }}" />
    <meta name="msapplication-TileImage" content="{{ url('images/soLogo.png') }}" />

@endsection

@section('allContent')   
      <div class="container">
        <h1 style="text-align:center;">مرحبا بك في لوحة تحكم العروض _ اختر ما تريد من القائمة بالأعلي.</h1>
      </div>  
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        
    })
</script>
@endsection


