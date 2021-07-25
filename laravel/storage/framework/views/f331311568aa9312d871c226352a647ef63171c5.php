


<?php $__env->startSection('headMeta'); ?>
    <title>كل المنتجات</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="<?php echo e(url('pharm/product?p=product')); ?>" class="btn btn-primary newRecored pull-left"><i class="fas fa-coffee"></i> كل المنتجات </a> </div>
        <div class="panel-body panelBodyForm">
            <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="<?php echo e(route('product.store', [])); ?>">
                <?php echo e(csrf_field()); ?>

                

                <input type='hidden' name='_method' value='POST'>
                
                <div class="form-group<?php echo e($errors->has('p_name') ? ' has-error' : ''); ?>">
                    <label for="p_name">اسم المنتج *</label>
                    <input value="<?php echo e(old('p_name')); ?>" type="text" name="p_name"  required class="form-control name" id="p_name" placeholder="اسم المنتج">
                    
                    <?php if($errors->has('p_name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('p_name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            
                <div class="form-group<?php echo e($errors->has('p_active_ingredient') ? ' has-error' : ''); ?>">
                    <label for="p_active_ingredient"> المادة الفعالة </label>
                    <input value="<?php echo e(old('p_active_ingredient')); ?>" type="text"  name="p_active_ingredient"  class="form-control name" id="p_active_ingredient" placeholder="المادة الفعالة ">
                    
                    <?php if($errors->has('p_active_ingredient')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('p_active_ingredient')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('p_price') ? ' has-error' : ''); ?>">
                    <label for="p_price"> سعر المنتج *</label>
                    <input value="<?php echo e(old('p_price')); ?>" type="number" step="0.01" min="0" max='99999999999' required name="p_price" class="form-control name" id="p_price" placeholder="سعر المنتج *">
                    <?php if($errors->has('p_price')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('p_price')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group<?php echo e($errors->has('sort_factor') ? ' has-error' : ''); ?>">
                    <label for="sort_factor">معامل الترتيب</label>
                    <input value="<?php echo e(old('sort_factor')); ?>" type="number" step="0.01" min="0" max='99999999999' required name="sort_factor" class="form-control name" id="sort_factor" placeholder="معامل الترتيب">
                    <?php if($errors->has('sort_factor')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('sort_factor')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">العروض المرتبطة</div><!-- .panel-body  -->
                    <div class="panel-body panelBodyForm">
                        <ul style="list-style: none;">
                            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <label for="offer<?php echo e($offer->id); ?>">
                                        <input type="checkbox" value="<?php echo e($offer->id); ?>" name="offers[]" id="offer<?php echo e($offer->id); ?>">
                                        <a target="_blank" href="<?php echo e(url('pharm/offer/'. $offer->id . '?p=offer' )); ?>"><i class="fas fa-coffe attachIcon"></i><?php echo e($offer->offerName); ?></a>
                                    </label>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                                
                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ </button>
            </form><!--#CreateUser .CreateUser -->   


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