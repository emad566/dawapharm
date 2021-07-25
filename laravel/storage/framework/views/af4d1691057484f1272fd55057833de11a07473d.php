


<?php $__env->startSection('headMeta'); ?>
    <title>الشهر الحالي</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">اكتب رقم الشهر الذي تريد عرض عروضه للعميل</div>
        <div class="panel-body panelBodyForm">

            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="<?php echo e(route('currentmonth.update', [1])); ?>">
                <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo e(csrf_field()); ?>

                <input type='hidden' name='_method' value='PUT'>

                <div class="form-group<?php echo e($errors->has('monthNumber') ? ' has-error' : ''); ?>">
                    <label for="monthNumber">الشهر الحالي</label>
                    <input value="<?php echo e(@$currentmonth->monthNumber); ?>" required type="number" min="0" max="12" name="monthNumber" class="form-control name" id="monthNumber" placeholder="الشهر الحالي">
                    <?php if($errors->has('monthNumber')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('monthNumber')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email">البريد الألكتروني</label>
                    <input value="<?php echo e(@$currentmonth->email); ?>" required type="text" name="email" class="form-control name" id="email" placeholder="البريد الألكتروني">
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            
                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ</button>
            </form><!--#file_id .file_id -->


        </div><!-- .panel-body  -->
    </div>
</div>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        
    })
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>