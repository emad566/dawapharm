


<?php $__env->startSection('headMeta'); ?>
    <title><?php echo e($offer->p_name); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> 
            العرض: <?php echo e($offer->p_name); ?>        
            <a href="<?php echo e(url('pharm/offer/create?p=offer')); ?>" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> 
            <a href="<?php echo e(url('pharm/offer?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-coffee"></i> كل العروض </a>  
            <a href="<?php echo e(url('pharm/offer/'.$offer->id.'/edit?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-edit"></i> تعديل العرض </a>  
            <a class="btn btn-primary action-btn pull-left" href="#"
            onclick="
                var result = confirm(' هل ترغب في حذف العرض : <?php echo e($offer->offerName); ?>');
                if(result) {
                    event.preventDefault();
                    document.getElementById('delete-form<?php echo e($offer->id); ?>').submit();
                }

            "
            ><i class="fas fa-trash-alt"></i> حذف </a>

            <form id='delete-form<?php echo e($offer->id); ?>' class='delete-form' method='post' action='<?php echo e(route('offer.destroy', [$offer->id])); ?>'>
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
                        <td>الصورة المميزة</td>
                        <td><img class="tumbShow" src="<?php echo e(url('uploads/'.$offer->thumb)); ?>" alt="<?php echo e($offer->offerName); ?>"></td>
                    </tr>

                    <tr>
                        <th width="150px">اسم العرض</th>
                        <td><?php echo e($offer->offerName); ?></td>
                    </tr>
                    <tr>
                        <th width="150px">وصف العرض</th>
                        <td><?php echo e($offer->desc); ?></td>
                    </tr>
                    <tr>
                        <th>شهر العرض</th>
                        <td><?php echo e($offer->offerMonth); ?></td>
                    </tr>
                    <tr>
                        <th>قيمة العرض</th>                    
                        <td><?php echo e($offer->offerPrice); ?></td>
                    </tr>
                    <tr>
                        <th>سعر الاوردر</th>
                        <td><?php echo e($offer->orderPrice); ?></td>
                    </tr>
                    <tr>
                        <th>ExpireTotal</th>
                        <td><?php echo e($offer->expireTotal); ?></td> 
                    </tr>

                    <tr>
                        <th>مصاريف الشحن</th>
                        <td><?php echo e($offer->charge); ?></td>
                    </tr>
                    <tr>
                        <th>سماحية سعر الاكسبير المستبدل </th>
                        <td><?php echo e($offer->tolerance); ?></td>
                    </tr>

                </tbody>
            </table>
            
            <div class="panel panel-default">
                <div class="panel-heading">منتجات العرض</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        <?php $__currentLoopData = $offer->products()->where('offer_product.is_offer', 1)->orderBy('offer_product.offerPriority', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <label for="product<?php echo e($product->id); ?>">
                                    <a target="_blank" href="<?php echo e(url('pharm/product/'. $product->id . '?p=product' )); ?>"><i class="fas fa-coffe attachIcon"></i><?php echo e($product->p_name); ?></a>
                                </label>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">منتجات الاستبدال</div><!-- .panel-body  -->
                <div class="panel-body panelBodyForm">
                    <ul style="list-style: none;">
                        <?php $__currentLoopData = $offer->products()->where('offer_product.is_expired', 1)->orderBy('offer_product.expiredPriority', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <label for="product<?php echo e($product->id); ?>">
                                    <a target="_blank" href="<?php echo e(url('pharm/product/'. $product->id . '?p=product' )); ?>"><i class="fas fa-coffe attachIcon"></i><?php echo e($product->p_name); ?></a>
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