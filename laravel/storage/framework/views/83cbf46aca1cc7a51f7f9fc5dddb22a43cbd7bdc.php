
<?php if(isset($errors) && count($errors) > 0): ?>
    <div id="" class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            <?php 
                if(is_object ($errors))
                {
            ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li> <?php echo $error; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php }else{?>
                <li> <?php echo $errors; ?></li>
            <?php } ?>
        </strong>
    </div><!--#  .alert alert-dismissable alert-sucess -->
<?php endif; ?>
