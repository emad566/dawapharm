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

                <div class="form-group<?php echo e($errors->has('offer_id') ? ' has-error' : ''); ?>">
                    <label for="offer_id">الشهر الحالي</label>
                    <select name="offer_id" id="offer_id" class="form-control">
                        <option value="0">الشهر الحالي</option>
                        <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($currentmonth->offer_id == $offer->id): ?> selected <?php endif; ?> value="<?php echo e($offer->id); ?>"><?php echo e($offer->id); ?> :- <?php echo e($offer->offerName); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('offer_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('offer_id')); ?></strong>
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
        // $('#offer_id').change(function() {

        // });
    })
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>