


<?php $__env->startSection('headMeta'); ?>
    <title>كل العروض</title>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('allContent'); ?>   
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            تعديل العرض: <?php echo e($offer->offerName); ?>

            <a href="<?php echo e(url('pharm/offer?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-coffee"></i> كل العروض </a>  
            <a href="<?php echo e(url('pharm/offer/create?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-calendar-plus"></i> أضف جديد</a>
            <a href="<?php echo e(url('pharm/offer/'.$offer->id.'?p=offer')); ?>" class="btn btn-primary action-btn pull-left"><i class="fas fa-eye"></i> عرض</a>

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
            <form id='CreateUser' class='CreateUser form-horizontal panelForm' method='POST' action="<?php echo e(route('offer.update', [$offer->id])); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                

                <input type='hidden' name='_method' value='PUT'>

                <div class="form-group<?php echo e($errors->has('offerName') ? ' has-error' : ''); ?>">
                    <label for="offerName">اسم العرض *</label>
                    <input value="<?php if(old('offerName')): ?><?php else: ?><?php echo e($offer->offerName); ?><?php endif; ?>" type="text" name="offerName"  required class="form-control name" id="offerName" placeholder="اسم العرض">
                    
                    <?php if($errors->has('offerName')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('offerName')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('desc') ? ' has-error' : ''); ?>">
                    <label for="desc"> وصف العرض </label>
                    <textarea name="desc" id="desc" class="form-control desc editor" placeholder="وصف العرض"><?php if(old('desc')): ?><?php echo e(old('desc')); ?><?php else: ?><?php echo e($offer->desc); ?><?php endif; ?></textarea>
                    <?php if($errors->has('desc')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('desc')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            
                <div class="form-group<?php echo e($errors->has('offerMonth') ? ' has-error' : ''); ?>">
                    <label for="offerMonth"> شهر العرض - اكتب رقم الشهر *</label>
                    <input value="<?php if(old('offerMonth')): ?><?php else: ?><?php echo e($offer->offerMonth); ?><?php endif; ?>" type="number" min="0" max="12" required  name="offerMonth"  class="form-control name" id="offerMonth" placeholder="شهر العرض - اكتب رقم الشهر *">
                    
                    <?php if($errors->has('offerMonth')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('offerMonth')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('offerPrice') ? ' has-error' : ''); ?>">
                    <label for="offerPrice"> سعر العرض *</label>
                    <input value="<?php if(old('offerPrice')): ?><?php else: ?><?php echo e($offer->offerPrice); ?><?php endif; ?>" type="number" step="0.01" min="0" max='99999999999' required name="offerPrice" class="form-control name" id="offerPrice" placeholder="سعر العرض *">
                    <?php if($errors->has('offerPrice')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('offerPrice')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group<?php echo e($errors->has('orderPrice') ? ' has-error' : ''); ?>">
                    <label for="orderPrice">سعر الأوردر *</label>
                    <input value="<?php if(old('orderPrice')): ?><?php else: ?><?php echo e($offer->orderPrice); ?><?php endif; ?>" type="number" min="0" max='99999999999' step="0.01" required name="orderPrice" class="form-control name" id="orderPrice" placeholder="سعر الأوردر *">
                    <?php if($errors->has('orderPrice')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('orderPrice')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group<?php echo e($errors->has('expireTotal') ? ' has-error' : ''); ?>">
                    <label for="expireTotal"> سعر الاكسبير المستبدل *</label>
                    <input value="<?php if(old('expireTotal')): ?><?php else: ?><?php echo e($offer->expireTotal); ?><?php endif; ?>" type="number" min="0" max='99999999999' step="0.01" required name="expireTotal" class="form-control name" id="expireTotal" placeholder="سعر الاكسبير المستبدل *">
                    <?php if($errors->has('expireTotal')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('expireTotal')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('charge') ? ' has-error' : ''); ?>">
                    <label for="charge">مصاريف الشحن *</label>
                    <input value="<?php if(old('charge')): ?><?php else: ?><?php echo e($offer->charge); ?><?php endif; ?>" type="number" min="0" max='99999999999'  required name="charge" class="form-control name" id="charge" placeholder="مصاريف الشحن *">
                    <?php if($errors->has('charge')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('charge')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('tolerance') ? ' has-error' : ''); ?>">
                    <label for="tolerance">سماحية سعر الاكسبير المستبدل *</label>
                    <input value="<?php if(old('tolerance')): ?><?php else: ?><?php echo e($offer->tolerance); ?><?php endif; ?>" type="number" min="0" max='99999999999'  required name="tolerance" class="form-control name" id="tolerance" placeholder="سماحية سعر الاكسبير المستبدل  *">
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
            
                            reader.onload = function (e) {
                                $('#thumb').attr('src', e.target.result);
                            }
            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <div class="form-group">
                    <label for="thumb">الصورة المميزة 
                        <img id="thumb" class="thumb-sm" src="<?php if(isset($offer->thumb)): ?> <?php echo e(url("/uploads/" . $offer->thumb)); ?><?php endif; ?>" alt="<?php echo e($offer->offerName); ?>">
                    </label>
                    <input type="file" accept="image/x-png, image/gif, image/jpeg" name="thumb" id="thumb" onchange="readURL(this);" class="thumb">
                    <p class="inputNotes"> الصور المسموح بها (jpg, png, gif) </p>
                    <?php if($errors->has('thumb')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('thumb')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">منتجات الاستبدال</div><!-- .panel-body  -->
                    <div class="panel-body panelBodyForm">
                        <ul style="list-style: none;">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <label for="product<?php echo e($product->id); ?>">
                                        <?php   $checked = (in_array($product->id, array_column($relProducts, 'product_id')))? "checked" : "" ?>
                                        <input type="checkbox" value="<?php echo e($product->id); ?>" <?php echo e($checked); ?> name="products[]" id="product<?php echo e($product->id); ?>">
                                        <a target="_blank" href="<?php echo e(url('pharm/product/'. $product->id . '?p=product' )); ?>"><i class="fas fa-coffe attachIcon"></i><?php echo e($product->p_name); ?></a>
                                    </label>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <button id="submitFormCreate" type="submit" form="CreateUser" class="btn btn-primary">حفظ التعديلات </button>
            </form><!--#CreateUser .CreateUser -->
        </div><!-- .panel-body  -->
    </div>
</div>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


<!-- Initialize the editor. -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
var editor_config = {
    directionality : 'rtl',
    path_absolute : "/", 
    selector: "textarea.editor",
    //'images_dir' => 'photos/', // default value : public/photos
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | copy cut paste| fontselect | fontsizeselect | forecolor backcolor | ltr rtl | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent blockquote pastetext searchreplace | subscript superscript  | emoticons hr charmap anchor link unlink image media | code | preview fullscreen",
    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt',
    menubar: "file edit view insert format tools table",
    code_dialog_height: 500,
    code_dialog_width: 1000,
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
        } else {
        cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
        });
    }
};

tinymce.init(editor_config);
</script>

<script>
    $(document).ready(function(){
        
    })
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>