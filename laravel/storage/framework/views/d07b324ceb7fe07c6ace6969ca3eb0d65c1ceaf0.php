


<?php $__env->startSection('headMeta'); ?>
    <title><?php echo e($product->p_name); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> 
         المنتج: <?php echo e($product->p_name); ?>        
        <a href="<?php echo e(url('pharm/product/create?p=product')); ?>" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> 
        <a href="<?php echo e(url('pharm/product?p=product')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-coffee"></i> كل المنتجات </a>  
        <a href="<?php echo e(url('pharm/product/'.$product->id.'/edit?p=product')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-edit"></i> تعديل المنتج </a>  

        <a class="btn btn-primary action-btn pull-left" href="#"
            onclick="
                var result = confirm(' هل ترغب في حذف المنتج : <?php echo e($product->p_name); ?>');
                if(result) {
                    event.preventDefault();
                    document.getElementById('delete-form<?php echo e($product->id); ?>').submit();
                }

            "
            ><i class="fas fa-trash-alt"></i> حذف </a>

            <form id='delete-form<?php echo e($product->id); ?>' class='delete-form' method='post' action='<?php echo e(route('product.destroy', [$product->id])); ?>'>
                <?php echo e(csrf_field()); ?>

                <input type='hidden' name='_method' value='DELETE'>
            </form><!--#delete-form .delete-form -->
            
        </div>
        <div class="panel-body panelBodyForm">
            <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <table id="usersTable" class="table table-hover table-striped table-bordered order-column"> 
                <tbody>
                    <tr>
                        <th width="150px">اسم المنتج</th>
                        <td><?php echo e($product->p_name); ?></td>
                    </tr>
                    <tr>
                        <th>الماده الفعالة</th>
                        <td><?php echo e($product->p_active_ingredient); ?></td>
                    </tr>
                    <tr>
                        <th>سعر المنتج</th>
                        <td><?php echo e($product->p_price); ?></td>
                    </tr>
                    <tr>
                        <th>معامل الترتيب</th>
                        <td><?php echo e($product->sort_factor); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="panel panel-default">
                <div class="panel-heading">العروض المرتبطة</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        <?php $__currentLoopData = $product->offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <label for="offer<?php echo e($offer->id); ?>">
                                    <a target="_blank" href="<?php echo e(url('pharm/offer/'. $offer->id . '?p=offer' )); ?>"><i class="fas fa-coffe attachIcon"></i><?php echo e($offer->offerName); ?></a>
                                </label>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            
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