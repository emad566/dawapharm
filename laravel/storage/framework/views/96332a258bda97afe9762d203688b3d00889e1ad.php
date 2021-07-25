<?php $__env->startSection('headMeta'); ?>
<title>كل العروض</title>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            تعديل العرض: <?php echo e($offer->offerName); ?>

            <a href="<?php echo e(url('pharm/offer?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i
                    class="fas fa-coffee"></i> كل العروض </a>
            <a href="<?php echo e(url('pharm/offer/create?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i
                    class="fas fa-calendar-plus"></i> أضف جديد</a>
            <a href="<?php echo e(url('pharm/offer/'.$offer->id.'?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i
                    class="fas fa-eye"></i> عرض</a>
            <button id="submitFormCreate" type="submit" form="CreateUser" class="savebtn btn btn-primary">حفظ التعديلات
            </button>

            <a class="btn btn-primary action-btn pull-left" href="#" onclick="
                var result = confirm(' هل ترغب في حذف العرض : <?php echo e($offer->offerName); ?>');
                if(result) {
                    event.preventDefault();
                    document.getElementById('delete-form<?php echo e($offer->id); ?>').submit();
                }

            "><i class="fas fa-trash-alt"></i> حذف </a>

            <form id='delete-form<?php echo e($offer->id); ?>' class='delete-form' method='post'
                action='<?php echo e(route('offer.destroy', [$offer->id])); ?>'>
                <?php echo e(csrf_field()); ?>

                <input type='hidden' name='_method' value='DELETE'>
            </form>
            <!--#delete-form .delete-form -->

        </div>
        <div class="panel-body panelBodyForm">
            <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST'
                action="<?php echo e(route('offer.update', [$offer->id])); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>



                <input type='hidden' name='_method' value='PUT'>

                <div class="form-group<?php echo e($errors->has('offerName') ? ' has-error' : ''); ?>">
                    <label for="offerName">اسم العرض *</label>
                    <input value="<?php if(old('offerName')): ?><?php else: ?><?php echo e($offer->offerName); ?><?php endif; ?>" type="text" name="offerName"
                        required class="form-control name" id="offerName" placeholder="اسم العرض">

                    <?php if($errors->has('offerName')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('offerName')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('desc') ? ' has-error' : ''); ?>">
                    <label for="desc"> وصف العرض </label>
                    <textarea name="desc" id="desc" class="form-control desc editor"
                        placeholder="وصف العرض"><?php if(old('desc')): ?><?php echo e(old('desc')); ?><?php else: ?><?php echo e($offer->desc); ?><?php endif; ?></textarea>
                    <?php if($errors->has('desc')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('desc')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>



                <div class="form-group<?php echo e($errors->has('orderPrice') ? ' has-error' : ''); ?>">
                    <label for="orderPrice">سعر الأوردر *</label>
                    <input value="<?php if(old('orderPrice')): ?><?php else: ?><?php echo e($offer->orderPrice); ?><?php endif; ?>" type="number" min="0"
                        max='99999999999' step="0.01" required name="orderPrice" class="form-control name"
                        id="orderPrice" placeholder="سعر الأوردر *">
                    <?php if($errors->has('orderPrice')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('orderPrice')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('discount') ? ' has-error' : ''); ?>">
                    <label for="discount"> نسبة ربح الصيدلية *</label>
                    <input value="<?php if(old('discount')): ?><?php else: ?><?php echo e($offer->discount); ?><?php endif; ?>" type="number" step="0.01" min="0"
                        max='99999999999' required name="discount" class="form-control name" id="discount"
                        placeholder="نسبة ربح الصيدلية *">
                    <?php if($errors->has('discount')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('discount')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('offerPrice') ? ' has-error' : ''); ?>">
                    <label for="offerPrice"> سعر العرض *</label>
                    <input readonly value="<?php if(old('offerPrice')): ?><?php else: ?><?php echo e($offer->offerPrice); ?><?php endif; ?>" type="number"
                        step="0.01" min="0" max='99999999999' required name="offerPrice" class="form-control name"
                        id="offerPrice" placeholder="سعر العرض *">
                    <?php if($errors->has('offerPrice')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('offerPrice')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('minPrice') ? ' has-error' : ''); ?> col-md-4">
                    <label for="minPrice"> سعر الحد الأدني - صيدلي *</label>
                    <input value="<?php if(old('minPrice')): ?><?php else: ?><?php echo e($offer->minPrice); ?><?php endif; ?>" type="number" step="0.01" min="0"
                        max='99999999999' required name="minPrice" class="form-control name" id="minPrice"
                        placeholder="سعر الحد الأدني - صيدلي *">
                    <?php if($errors->has('minPrice')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('minPrice')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('minPriceOrder') ? ' has-error' : ''); ?> col-md-4">
                    <label for="minPriceOrder"> سعر الحد الأدني - جمهور *</label>
                    <input value="<?php if(old('minPriceOrder')): ?><?php else: ?><?php echo e($offer->minPriceOrder); ?><?php endif; ?>" type="number"
                        step="0.01" min="0" max='99999999999' required name="minPriceOrder" class="form-control name"
                        id="minPriceOrder" placeholder="سعر الحد الأدني - جمهور *">
                    <?php if($errors->has('minPriceOrder')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('minPriceOrder')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('minPrice') ? ' has-error' : ''); ?> col-md-4">
                    <label for="minPricePrecent"> نسبة الحد الأدني من سعر العرض *</label>
                    <input value="<?php if(old('minPricePrecent')): ?><?php else: ?><?php echo e($offer->minPricePrecent); ?><?php endif; ?>" type="number"
                        step="0.01" min="0" max='99999999999' required name="minPricePrecent" class="form-control name"
                        id="minPricePrecent" placeholder=" نسبة الحد الأدني من سعر العرض *">
                    <?php if($errors->has('minPricePrecent')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('minPricePrecent')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('expireTotal') ? ' has-error' : ''); ?>">
                    <label for="expireTotal"> سعر الاكسبير المستبدل *</label>
                    <input value="<?php if(old('expireTotal')): ?><?php else: ?><?php echo e($offer->expireTotal); ?><?php endif; ?>" type="number" min="0"
                        max='99999999999' step="0.01" required name="expireTotal" class="form-control name"
                        id="expireTotal" placeholder="سعر الاكسبير المستبدل *">
                    <?php if($errors->has('expireTotal')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('expireTotal')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('charge') ? ' has-error' : ''); ?>">
                    <label for="charge">مصاريف الشحن *</label>
                    <input value="<?php if(old('charge')): ?><?php else: ?><?php echo e($offer->charge); ?><?php endif; ?>" type="number" min="0"
                        max='99999999999' required name="charge" class="form-control name" id="charge"
                        placeholder="مصاريف الشحن *">
                    <?php if($errors->has('charge')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('charge')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('tolerance') ? ' has-error' : ''); ?>">
                    <label for="tolerance">سماحية سعر الاكسبير المستبدل *</label>
                    <input value="<?php if(old('tolerance')): ?><?php else: ?><?php echo e($offer->tolerance); ?><?php endif; ?>" type="number" min="0"
                        max='99999999999' required name="tolerance" class="form-control name" id="tolerance"
                        placeholder="سماحية سعر الاكسبير المستبدل  *">
                    <?php if($errors->has('tolerance')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('tolerance')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <!--======================================
                priew image before uploaded
                =====================================-->
                <script type="text/javascript">
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#thumb').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>

                <div class="form-group">
                    <label for="thumb">الصورة المميزة
                        <img id="thumb" class="thumb-sm"
                            src="<?php if(isset($offer->thumb)): ?> <?php echo e(url("/uploads/" . $offer->thumb)); ?><?php endif; ?>"
                            alt="<?php echo e($offer->offerName); ?>">
                    </label>
                    <input type="file" accept="image/x-png, image/gif, image/jpeg" name="thumb" id="thumb"
                        onchange="readURL(this);" class="thumb">
                    <p class="inputNotes"> الصور المسموح بها (jpg, png, gif) </p>
                    <?php if($errors->has('thumb')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('thumb')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        الأصناف
                        <a id="rallexpired" class="savebtn btn btn-primary newRecored pull-left">إزالة كل الاكسبير</a>
                        <a id="allexpired" class="savebtn btn btn-primary newRecored pull-left">تحديد كل الاكسبير</a>
                        <a id="rallOffer" class="savebtn btn btn-primary newRecored pull-left">إزالة كل العروض</a>
                        <a id="allOffer" class="savebtn btn btn-primary newRecored pull-left">تحديد كل العروض</a>

                    </div><!-- .panel-body  -->
                    <div class="panel-body panelBodyForm">

                        <table id="usersTable"
                            class="table table-hover table-striped table-bordered order-column dataTable">

                            <thead>
                                <tr>
                                    <th>م</th>
                                    <th>الصنف</th>
                                    <th>صنف عرض</th>
                                    <th>أولوية الظهور</th>
                                    <th>صنف استبدال</th>
                                    <th>أولوية الظهور</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $i=1; ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $checked = (in_array($product->id, array_column($relProducts, 'product_id')))? "checked" : "";

                                    $offerPriority = "";
                                    $is_offer_checked = "";
                                    $expiredPriority = "";
                                    $is_expired_checked = "";

                                    if($checked){
                                        $productI = $offer->products($product->id)->first();
                                        $offerPriority= $productI->pivot->offerPriority;
                                        $is_offer_checked = ($productI->pivot->is_offer)? "checked" : "";
                                        $expiredPriority= $productI->pivot->expiredPriority;
                                        $is_expired_checked = ($productI->pivot->is_expired)? "checked" : "";
                                    }

                                ?>

                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td>
                                        <a target="_blank"
                                            href="<?php echo e(url('pharm/product/'. $product->id . '?p=product' )); ?>"><i
                                                class="fas fa-coffe attachIcon"></i><?php echo e($product->p_name); ?></a>
                                        <input style="display: none !important;" type="checkbox"
                                            value="<?php echo e($product->id); ?>" <?php echo e($checked); ?> name="products[]"
                                            id="product<?php echo e($product->id); ?>">
                                    </td>
                                    <td>
                                        <input type="checkbox" proId="<?php echo e($product->id); ?>"
                                            name="is_offer<?php echo e($product->id); ?>" id="is_offer<?php echo e($product->id); ?>"
                                            class="proType is_offer" <?php echo e($is_offer_checked); ?>>
                                    </td>
                                    <td>
                                        <input type="number" name="offerPriority<?php echo e($product->id); ?>"
                                            placeholder="الترتيب" class="priorityInput" value="<?php echo e($offerPriority); ?>">
                                    </td>

                                    <td>
                                        <input type="checkbox" proid="<?php echo e($product->id); ?>"
                                            name="is_expired<?php echo e($product->id); ?>" id="is_expired<?php echo e($product->id); ?>"
                                            class="proType is_expired" <?php echo e($is_expired_checked); ?>>
                                    </td>
                                    <td>
                                        <input type="number" name="expiredPriority<?php echo e($product->id); ?>"
                                            placeholder="الترتيب" class="priorityInput" value="<?php echo e($expiredPriority); ?>">
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                    </div>
                </div>
                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ التعديلات
                </button>
            </form>
            <!--#CreateUser .CreateUser -->
        </div><!-- .panel-body  -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
$(document).ready(function() {
    $(document).on("change", '.proType', function(e) {
        // $('.proType').change(function(e) {
        proId = $(this).attr("proId");
        if ($("#is_offer" + proId).is(":checked") || $("#is_expired" + proId).is(":checked")) {
            $("#product" + proId).prop('checked', true);
        } else {
            $("#product" + proId).prop('checked', false);
        }
    });

    $(document).on("keyup", '#discount', function(e) {
        offerPriceVal = ($('#orderPrice').val() - ($('#orderPrice').val() * $('#discount').val() / 100))
            .toFixed(2)
        $("#offerPrice").val(offerPriceVal)
    });

    $(document).on("keyup", '#orderPrice', function(e) {
        offerPriceVal = ($('#orderPrice').val() - ($('#orderPrice').val() * $('#discount').val() / 100))
            .toFixed(2)
        $("#offerPrice").val(offerPriceVal)
    });

    $(document).on("keyup", '#minPricePrecent', function(e) {
        minPrice = (($('#minPricePrecent').val() * $('#offerPrice').val() / 100)).toFixed(2)
        $("#minPrice").val(minPrice)
        minPriceOrder = (($('#minPricePrecent').val() * $('#orderPrice').val() / 100)).toFixed(2)
        $("#minPriceOrder").val(minPriceOrder)
    });

    $(document).on("keyup", '#minPrice', function(e) {
        minPricePrecent = (($('#minPrice').val() / $('#offerPrice').val() * 100)).toFixed(2)
        $("#minPricePrecent").val(minPricePrecent)

        minPriceOrder = (($('#minPricePrecent').val() * $('#orderPrice').val() / 100)).toFixed(2)
        $("#minPriceOrder").val(minPriceOrder)
    });

    $(document).on("keyup", '#minPriceOrder', function(e) {
        minPricePrecent = (($('#minPriceOrder').val() / $('#orderPrice').val() * 100)).toFixed(2)
        $("#minPricePrecent").val(minPricePrecent)

        minPrice = (($('#minPricePrecent').val() * $('#offerPrice').val() / 100)).toFixed(2)
        $("#minPrice").val(minPrice)

    });

    $(document).on("click", '#allOffer', function(e) {
        $(".is_offer").prop('checked', true);
        return false;
    });

    $(document).on("click", '#rallOffer', function(e) {
        $(".is_offer").prop('checked', false);
        return false;
    });

    $(document).on("click", '#allexpired', function(e) {
        $(".is_expired").prop('checked', true);
        return false;
    });

    $(document).on("click", '#rallexpired', function(e) {
        $(".is_expired").prop('checked', false);
        return false;
    });

    // Auto check on sort change
    // $(document).on("keyup", ".priorityInput", function() {
    //     tname = $(this).attr("name");

    // });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>