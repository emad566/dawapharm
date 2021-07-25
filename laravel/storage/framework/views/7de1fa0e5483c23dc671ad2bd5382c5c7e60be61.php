


<?php $__env->startSection('headMeta'); ?>
    <title>كل المنتجات</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"> كل المنتجات <a href="<?php echo e(url('pharm/product/create?p=product')); ?>" class="btn btn-primary newRecored pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> </div>
        <div class="panel-body panelBodyForm">
            <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if($products->count()<1): ?>
                <div id="" class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        <li>عذرا لا توجد منتجات، اذا اردت إضافة منتج - إضغط أضف جديد من الأعلي</li>
                    </strong>
                </div><!--#  .alert alert-dismissable alert-sucess -->
            <?php else: ?>

            <table id="usersTable" class="table table-hover table-striped table-bordered order-column dataTable"> 

                <thead>
                    <tr>
                        <th>م</th>
                        <th>تعديل/حذف</th>
                        <th>اسم المنتج</th>
                        <th>الماده الفعالة</th>
                        <th>سعر المنتج</th>
                        <th>معامل الترتيب</th>
                        <th>عرض</th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php $i=0; ?>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <a href="<?php echo e(url('pharm/product')); ?>/<?php echo e($product->id); ?>/edit?p=product"><i class="fas fa-edit delEdit"></i></a>
                                
                                <a href="#"
                                onclick="
                                    var result = confirm(' هل تريد حذف هذا العنصر : <?php echo e($product->p_name); ?>');
                                    if(result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form<?php echo e($product->id); ?>').submit();
                                    }
                
                                "
                                ><i class="fas fa-trash-alt delEdit"></i></a>
    
                                <form id='delete-form<?php echo e($product->id); ?>' class='delete-form' method='post' action='<?php echo e(route('product.destroy', [$product->id])); ?>'>
                                    <?php echo e(csrf_field()); ?>

                                    <input type='hidden' name='_method' value='DELETE'>
                                </form><!--#delete-form .delete-form -->
                            </td>
                            <td><?php echo e($product->p_name); ?></td>
                            <td><?php echo e($product->p_active_ingredient); ?></td>
                            <td><?php echo e($product->p_price); ?></td>
                            <td><?php echo e($product->sort_factor); ?></td>
                            <td><a href="<?php echo e(url('pharm/product/'.$product->id.'?p=product')); ?>"><i class="fas fa-eye"></i></a></td>
                        </tr>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
            
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