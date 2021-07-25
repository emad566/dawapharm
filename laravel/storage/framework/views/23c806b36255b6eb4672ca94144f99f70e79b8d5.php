


<?php $__env->startSection('headMeta'); ?>
    <title>كل الطلبيات</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    
    <div class="panel panel-default">
        <div class="panel-heading"> كل الطلبيات 
        <a href="<?php echo e(url('/')); ?>?p=customerOrder" class="btn btn-primary action-btn pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a> 
        <a href="" onclick="printMyPage()" class="btn btn-primary action-btn  pull-left"><i class="fas fa-print"></i> طباعة</a>
        </div>
        <div class="panel-body panelBodyForm">
            <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if($customers->count()<1): ?>
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
                        <th>اسم الصيدلية</th>
                        <!-- <th>عنوان الصيدلية</th> -->
                        <th>رقم الواتس </th>
                        <th>القيمة</th>
                        <th>تاريخ الطلب</th>
                        <th>حالة الطلب</th>
                        <th>عرض</th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php $i=0; ?>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <a href="<?php echo e(url('pharm/customer')); ?>/<?php echo e($customer->id); ?>/edit?p=customer"><i class="fas fa-edit delEdit"></i></a>
                                
                                <a href="#"
                                onclick="
                                    var result = confirm(' هل تريد حذف هذا العنصر : <?php echo e($customer->name); ?>');
                                    if(result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form<?php echo e($customer->id); ?>').submit();
                                    }
                
                                "
                                ><i class="fas fa-trash-alt delEdit"></i></a>
    
                                <form id='delete-form<?php echo e($customer->id); ?>' class='delete-form' method='post' action='<?php echo e(route('customer.destroy', [$customer->id])); ?>'>
                                    <?php echo e(csrf_field()); ?>

                                    <input type='hidden' name='_method' value='DELETE'>
                                </form><!--#delete-form .delete-form -->
                            </td>
                            <td><?php echo e($customer->name); ?></td>
                            
                            <td><?php echo e($customer->whats); ?></td>
                            <td><?php echo e($customer->total); ?></td>
                            <td><?php echo e($customer->created_at); ?></td>
                            <td><?php echo e($customer->status->sName); ?></td>
                            <td><a href="<?php echo e(url('pharm/customer/'.$customer->id.'?p=customer')); ?>"><i class="fas fa-eye"></i></a></td>
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