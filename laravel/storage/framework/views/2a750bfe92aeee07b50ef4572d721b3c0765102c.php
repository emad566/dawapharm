


<?php $__env->startSection('headMeta'); ?>
    <title>الصفحة الرئيسية</title>

    <!-- facebook meta -->

    <!-- facebook meta -->
 
    <meta property="og:image" content="<?php echo e(url('/fbn.jpg')); ?>" />
    <meta property="og:title" content=""/> 
  
    <meta property="og:description" content="" />



    <meta property="og:image" content="<?php echo e(url('images/soLogo.png')); ?>" />

    <link rel="icon" href="<?php echo e(url('images/soLogo.png')); ?>" sizes="32x32" />
    <link rel="icon" href="<?php echo e(url('images/soLogo.png')); ?>" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(url('images/soLogo.png')); ?>" />
    <meta name="msapplication-TileImage" content="<?php echo e(url('images/soLogo.png')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
      <div class="container">
        <h1 style="text-align:center;">مرحبا بك في لوحة تحكم العروض _ اختر ما تريد من القائمة بالأعلي.</h1>
      </div>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        
    })
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>