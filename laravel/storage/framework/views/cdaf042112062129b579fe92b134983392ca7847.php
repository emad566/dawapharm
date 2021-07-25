<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="<?php echo e(url('images/dLogo.png')); ?>" sizes="32x32" />
    <link rel="icon" href="<?php echo e(url('images/dLogo.png')); ?>" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(url('images/dLogo.png')); ?>" />
    <meta name="msapplication-TileImage" content="<?php echo e(url('images/dLogo.png')); ?>" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php echo $__env->yieldContent('headMeta'); ?>
  <?php
  $p = (@$_GET['p'] =="") ? "home" : @$_GET['p'];
  $version = 12;
  ?>
    <!-- Styles Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap RTL-->

     <!-- Fontawesome Fonts-->
     <script src="https://kit.fontawesome.com/c7125b87e6.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css"> -->

    <!-- datatables css-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">


    <?php echo $__env->yieldContent('styles'); ?>

    <!-- web Emadeleen CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/webcss.css?v='.$version)); ?>">


    <style type="text/css" media="print">
    @page  {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js does not work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '185366359237683');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=185366359237683&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


  </head>
  <body id="body">

  <!=============================
  | Main nav bar
  ===========================-->
  <nav id="mainNav" class="navbar nav-right  navbar-default ">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->

      <a class="navbar-brand pull-right" style="float: left !important; " href="http://dawapharm.com/"><img class="barn-logo" src="<?php echo e(url('images/dLogo.png')); ?>" alt=""></a>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right">
          <?php if(Auth::check() && Auth::user()->isAdmin()): ?>
          <li class="<?php if($p == "home") echo "hover";?>"><a href="<?php echo e(url('/home')); ?>"><i class="fas fa-house-user navBarIco"></i> الرئيسية </a></li>
          <?php endif; ?>
          <?php if(Auth::check() && Auth::user()->isSupperAdmin()): ?>
          <li class="<?php if($p == "currentmonth") echo "hover";?>"><a href="<?php echo e(url('/pharm/currentmonth')); ?>?p=currentmonth"><i class="far fa-calendar-alt navBarIco"></i> الاعدادات العامة </a></li>
          <li class="<?php if($p == "offer") echo "hover";?>"><a href="<?php echo e(url('/pharm/offer')); ?>?p=offer"><i class="fas fa-coffee navBarIco"></i> العروض </a></li>
          <li class="<?php if($p == "product") echo "hover";?>"><a href="<?php echo e(url('/pharm/product')); ?>?p=product"><i class="fab fa-product-hunt navBarIco"></i> المنتجات   </a></li>
          <?php endif; ?>
          <?php if(Auth::check() && Auth::user()->isAdmin()): ?>
          <li class="<?php if($p == "customer") echo "hover";?>"><a href="<?php echo e(url('/pharm/customer')); ?>?p=customer"><i class="fas fa-users navBarIco"></i> الطلبيات   </a></li>
          <?php endif; ?>
          <li class="<?php if($p == "customerOrder") echo "hover";?>"><a href="<?php echo e(url('/')); ?>?p=customerOrder"><i class="far fa-clipboard navBarIco"></i> حجز عرض  </a></li>
          <?php if(Auth::check()): ?>
          <li class="<?php if($p == "logout") echo "hover";?>">
            <a href="<?php echo e(route('logout')); ?>"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt navBarIco"></i> تسجيل خروج </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
          </li>
          <?php endif; ?>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <?php echo $__env->yieldContent('allContent'); ?>
    <!-- jQuery (necessary for Bootstrap s JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- upload progrss bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <!-- Include datatables js -->
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!--
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
  -->


    <script>
      $(document).ready(function() {

        $( ".close" ).click(function() {
          $('.alert-dismissable').hide();
        });
        //dropzone file types

      /*======================================
        Main nav bar
        =====================================*/
        $('.dataTable').dataTable( {
          "language": {
            "search": "بحث :",
            "sLengthMenu ": "اعرض ",
          },
          "lengthMenu": [[-1], ["All"]],
          "oLanguage": {
            "sProcessing":   "جارٍ التحميل...",
            "sLengthMenu":   "أظهر _MENU_ مدخلات",
            "sZeroRecords":  "لم يعثر على أية سجلات",
            "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix":  "",
            "sSearch":       "ابحث:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "الأول",
                "sPrevious": "السابق",
                "sNext":     "التالي",
                "sLast":     "الأخير"
            }
        }
        } );

      });
    </script>

    <!-- webjs Emadeldeen js -->
    <script src="<?php echo e(asset('js/webjs.js?'.$version)); ?>" ></script>

    <?php echo $__env->yieldContent('scripts'); ?>

    <script>
        $(document).ready(function() {

          <?php echo $__env->yieldContent('jqScript'); ?>
        })
    </script>
  </body>

    <script>
	    function printMyPage() {
        window.print();
      }
    </script>
</html>
