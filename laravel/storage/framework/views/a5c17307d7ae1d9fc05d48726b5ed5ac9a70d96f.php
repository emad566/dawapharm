


<?php $__env->startSection('headMeta'); ?>
    <title>عرض طلبيه</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>  
<div class="container">
    <div class="panel panel-default">
    <a href="" onclick="printMyPage()" class="btn btn-primary newRecored pull-left"><i class="fas fa-print"></i> طباعة</a>
        <div class="panel-heading">
        بيانات العرض
        </div>

        <div class="panel-body panelBodyForm">
            <table id="usersTable" class="table table-hover table-striped table-bordered order-column"> 
                <tbody>
                    
                    <tr>
                        <th width="250px"> العرض</th>                    
                        <td><?php echo e($customer->offer->offerName); ?></td>
                    </tr>
                    
                    <tr>
                        <th width="250px">سعر العرض</th>                    
                        <td><?php echo e($customer->offer->offerPrice); ?></td>
                    </tr>

                    <tr>
                        <th width="250px">مصاريف الشحن</th>                    
                        <td><?php echo e($customer->offer->charge); ?></td>
                    </tr>

                    <tr>
                        <th width="250px">إجمالي العرض بمصاريف الشحن</th>                    
                        <td><?php echo e($customer->offer->charge + $customer->offer->offerPrice); ?></td>
                    </tr>
                    
                    <tr>
                        <th>سعر الاكسبير المستبدل</th>
                        <td><?php echo e($customer->offer->expireTotal); ?></td> 
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
        بيانات الصيديلة
        </div>

        <div class="panel-body panelBodyForm">
            <table id="usersTable" class="table table-hover table-striped table-bordered order-column"> 
                <tbody>
                    
                    <tr>
                        <th width="250px"> اسم الصيدلية</th>                    
                        <td><?php echo e($customer->name); ?></td>
                    </tr>
                    
                    <tr>
                        <th width="250px">عنوان الصيدلية</th>                    
                        <td><?php echo e($customer->title); ?></td>
                    </tr>

                    <tr>
                        <th width="250px">رقم الوتس</th>                    
                        <td><?php echo e($customer->whats); ?></td>
                    </tr>
                    
                    <tr>
                        <th width="250px">تاريخ الطلب</th>                    
                        <td><?php echo e($customer->created_at); ?></td>
                    </tr>

                    <tr>
                        <th width="250px">تاريخ أخر تعديل للطلب</th>                    
                        <td><?php echo e($customer->updated_at); ?></td>
                    </tr>
                    
                    <tr>
                        <th width="250px">حالة الطلب</th>                    
                        <td></td>
                    </tr>






                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
        بيانات الأصناف المستبدلة
        </div>

        <div class="panel-body panelBodyForm">
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column"> 
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customer->products()->orderBy('sort_factor', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th>
                                <?php echo e($product->p_name); ?>

                                <?php if($product->p_active_ingredient): ?><span class="activeP"><?php echo e($product->p_active_ingredient); ?></span><?php endif; ?>
                            </th>
                            <th><?php echo e($product->p_price); ?></th>
                            <td><?php echo e($product->pivot->amount); ?></td>
                            <td><?php echo e($product->pivot->amountPrice); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <tr id="" class="">
                            <td colspan="3" >الاجمالي</td>
                            <td><?php echo e($customer->total); ?></td>
                        </tr>
                    </tbody>
                </table>
        </div><!-- .panel-body  -->
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
        معالجة الطلب
        </div>
        <div class="panel-body panelBodyForm">
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="<?php echo e(route('customer.update', [$customer->id])); ?>">
                <?php echo e(csrf_field()); ?>

                <input type='hidden' name='_method' value='PUT'>
                
                <div class="form-group<?php echo e($errors->has('status_id') ? ' has-error' : ''); ?>">
                    <label for="statusId">- حالة الطلبة -</label>
                    <select required class="form-control" id="statusId" name="status_id" >
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php if($status->id == $customer->status_id): ?> 
                                    selected
                                <?php endif; ?> 
                                value="<?php echo e($status->id); ?>"
                            ><?php echo e($status->sName); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    
                    <?php if($errors->has('status_id')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('status_id')); ?></strong>
                        </span>
                    <?php endif; ?>    
                </div>

                <div class="form-group<?php echo e($errors->has('notes') ? ' has-error' : ''); ?>">
                    <label for="notes"> ملاحظات </label>
                    <textarea name="notes" id="notes" class="form-control notes" placeholder="ملاحظات"><?php if(old('notes')): ?><?php echo e(old('notes')); ?><?php else: ?><?php echo e($customer->notes); ?><?php endif; ?></textarea>
                    <?php if($errors->has('notes')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('notes')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <button id="submitFormCreate"  name="submit"  type="submit" form="CreateUser" class="btn btn-primary">حفظ التعديلات </button>
            </form><!--#CreateUser .CreateUser -->
        <div>
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