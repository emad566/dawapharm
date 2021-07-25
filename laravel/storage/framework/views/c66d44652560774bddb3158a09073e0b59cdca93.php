<?php $__env->startSection('headMeta'); ?>
<title>تسجيل طلبيه</title>
<!-- Facebook Meta -->
<?php if($offerSelected): ?>
<meta property="og:image" content="<?php echo e(url('uploads/'.$offerSelected->thumb)); ?>" />
<meta property="og:title" content="<?php echo e($offerSelected->offerSelectedName); ?>"/>
<meta property="og:description" content="<?php echo e($offerSelected->desc); ?>"/>
<meta property="og:image" content="<?php echo e(url('uploads/'.$offerSelected->thumb)); ?>" />
<?php endif; ?>
<!-- Facebook Meta -->
<style>
/* Style the form */
/* #regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
} */

/* Style the input fields */
/* input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
} */

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('allContent'); ?>

<div class="container" style="margin-bottom:150px">
<?php if($offerSelected): ?>
    <?php if($isShowPage): ?>
    <?php echo $__env->make("partials.errors", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("partials.success", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $answer=0; ?>
    <?php if(session()->has('success')): ?>
        <a class="btn btn-primary" style="display:block; width:80%; margin:auto;"  href="<?php echo e(url('/')); ?>?p=customerOrder">أضف طلب جديد</a>
    <?php else: ?>


    <form id='regForm' class='regForm form-horizontal panelForm' method='POST'
        action="<?php echo e(url('/createcustomer')); ?>">
        <?php echo e(csrf_field()); ?>


        <input type='hidden' name='_method' value='POST'>
        <div id="offerInfo" class="panel panel-default tab">
            <div class="panel-heading">
                بيانات العرض
            </div>

            <div class="panel-body panelBodyForm">
                <div class="form-group<?php echo e($errors->has('offer_id') ? ' has-error' : ''); ?>">
                    <label for="offerId">- اختر عرض -</label>
                    <select required class="form-control" id="offerId" name="offer_id">
                        <!-- <option value="">- اختر عرض -</option> -->
                        <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $selected = (@$offerSelected->id == $offer->id)? "selected" : "" ?>
                        <option value="<?php echo e($offer->id); ?>" <?php echo e($selected); ?>><?php echo e($offer->offerName); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <?php if($errors->has('offer_id')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('offer_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <br>
                <?php if($offerSelected->thumb || $offerSelected->desc): ?>
                    <?php if($offerSelected->thumb): ?>
                    <img class="thumbShowCustomer" src="<?php echo e(url('uploads/'.$offerSelected->thumb)); ?>" alt="<?php echo e($offerSelected->offerName); ?>" title="<?php echo e($offerSelected->offerName); ?>">
                    <?php endif; ?>
                    <?php if($offerSelected->desc): ?>
                    <div class="descContent"><?php echo $offerSelected->desc; ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <br>

                <div class="panel-heading bg-info">
                    قم بتحديد اصناف العرض المطلوبة وكمياتها
                </div>
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th style="min-width:10%;">السعر</th>
                            <th style="min-width:10%;">الكمية</th>
                            <th style="min-width:15%;">الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $offerSelected->products()->where('offer_product.is_offer', 1)->orderBy('offer_product.offerPriority', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th>
                                <?php echo e($product->p_name); ?>

                                <input value="<?php echo e($product->id); ?>" type="hidden" name="productOfferIds[]">
                                <?php if($product->p_active_ingredient): ?><span class="activeP"><?php echo e($product->p_active_ingredient); ?></span><?php endif; ?>
                            </th>
                            <th>
                                <span id="offerpPrice<?php echo e($product->id); ?>" class='offerpPrice' value="<?php echo e($product->p_price); ?>"><?php echo e($product->p_price); ?></span>

                                <input type="hidden" name="offerpPrices[]" value="<?php echo e($product->id); ?>">
                            </th>

                            <td>
                                <input value="<?php echo e(old('offerAmount'.$product->id)); ?>" type="number" min="0" step="1" max='99999999999'
                                    name="offerAmount<?php echo e($product->id); ?>" class="form-control offerAmount"
                                    amountid="<?php echo e($product->id); ?>" id="offerAmount<?php echo e($product->id); ?>" placeholder="الكمية *">
                            </td>

                            <td>
                                <input id="offerP<?php echo e($product->id); ?>" readonly="readonly" class="btnLabel offerPAmountVal"
                                    value="<?php if(old('offerAmounts'.$product->id)): ?><?php echo e(old('offerAmounts'.$product->id)); ?><?php endif; ?>"
                                    name="offerAmounts<?php echo e($product->id); ?>" placeholder="0">
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr id="offerTotalTr" class="totalTr" width="100%">
                            <td colspan="1" width="70%" >أجمالي سعر طلبية العرض</td>
                            <td id="tdtotal" colspan="3">
                                <?php $z = 0; ?>
                                <input id="offerTotal" readonly class="btnLabel" type="text" name="offerTotal"
                                    value="<?php if(old('offerTotal')): ?><?php echo e(old('offerTotal')); ?><?php else: ?><?php echo e($z); ?><?php endif; ?>" placeholder="0">
                            </td>
                        </tr>

                        <tr>
                            <th id="winscrollto">ملحوظة</th>
                            <td colspan="3">  يجب ان يكون الحد الأدني لمنتجات العرض بسعر الجمهور <?php echo e($offerSelected->minPriceOrder); ?> ج.م.</td>
                        </tr>

                    </tbody>
                </table>

                <?php if($offerSelected): ?>
                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <tbody>

                        <tr>
                            <th colspan="2" style="text-align: center; background-color: #ccc;">بيانات الدفع </th>
                        </tr>
                        
                                                <tr>
                                                    <th width="250px">سعر الجمهور (الطلبية)</th>
                                                    <td><span id="spanOrderPrice">0</span></td>
                                                </tr>
                        <tr>
                            <th width="250px"> سعر العرض (قبل حساب الشحن)</th>
                            <td><span id="spanOfferPrice">0</span></td>
                        </tr>

                        <tr>
                            <th width="250px">مصاريف الشحن</th>
                            <td><?php echo e($offerSelected->charge); ?></td>
                        </tr>

                        <tr>
                            <th width="250px">إجمالي العرض بمصاريف الشحن</th>
                            <td><span id="spanCharge">0</span></td>
                        </tr>

                        <tr>
                            <th> سعر الاكسبير المستبدل</th>
                            <td><span class="spanExpireTotal" id="spanExpireTotal">0</span></td>
                        </tr>

                    </tbody>
                </table>

                <div id="offerPriceAlert" class="alert alert-info">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        عذرا القيمة الإجمالية لأصناف االعرض يجب ان تكون بحد ادني <?php echo e($offerSelected->minPriceOrder); ?>

                        جنية،
                        الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.
                    </strong>
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> لعرض أصناف الإستبدال.
                </div>
            </div>
        </div>

        <div id="productsInfo" class="panel panel-default tab">
            <div class="panel-heading">
                 حدد كميات أصناف الإستبدال التي تريد طلبها علي ان تكون في حدود 
                 <span class="spanExpireTotal" id="spanExpireTotal">0</span>
                 جنية
            </div>

            <div class="panel-body panelBodyForm">

                <table id="usersTable" class="table table-hover table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th style="min-width:10%;">السعر</th>
                            <th style="min-width:10%;">الكمية</th>
                            <th style="min-width:15%;">الإجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $offerSelected->products()->where('offer_product.is_expired', 1)->orderBy('offer_product.expiredPriority', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th>
                                <?php echo e($product->p_name); ?>

                                <input value="<?php echo e($product->id); ?>" type="hidden" name="product_id[]">
                                <?php if($product->p_active_ingredient): ?><span class="activeP"><?php echo e($product->p_active_ingredient); ?></span><?php endif; ?>
                            </th>
                            <th><span id="pPrice<?php echo e($product->id); ?>" class='pPrice'
                                    value="<?php echo e($product->p_price); ?>"><?php echo e($product->p_price); ?></span></th>
                                    <input type="hidden" name="pPrices[]" value="<?php echo e($product->p_price); ?>">
                            <td>
                                <input value="<?php echo e(old('amount'.$product->id)); ?>" type="number" min="0" step="1" max='99999999999'
                                    name="amount<?php echo e($product->id); ?>" class="form-control name amount"
                                    amountid="<?php echo e($product->id); ?>" id="amount<?php echo e($product->id); ?>" placeholder="الكمية *">
                            </td>
                            <td><input id="p<?php echo e($product->id); ?>" readonly="readonly" class="btnLabel pAmountVal"
                                    value="<?php if(old('amounts'.$product->id)): ?><?php echo e(old('amounts'.$product->id)); ?><?php endif; ?>"
                                    name="amounts<?php echo e($product->id); ?>" placeholder="0"></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <tr id="totalTr" class="totalTr">
                            <td colspan="2"  width="30%">إجمالي  الاكسبير المستبدل</td>
                            <td id="tdtotal" colspan="2">
                                <?php $z = 0; ?>
                                <input id="total" readonly class="btnLabel" type="text" name="total"
                                    value="<?php if(old('total')): ?><?php echo e(old('total')); ?><?php else: ?><?php echo e($z); ?><?php endif; ?>" placeholder="0">
                            </td>
                        </tr>
                        <tr>
                            <th id="winscrollto">ملحوظة</th>
                            <td colspan="3">الاوردرات يتم إرسالها خلال 15 يوم من وقت طلبها </td>
                        </tr>
                    </tbody>
                </table>

                <div id="priceAlert" class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>
                        عذرا القيمة الإجمالية لأصناف الاستبدال يجب ان تكون في حدود مبلغ  
                        <span class="spanExpireTotal" id="spanExpireTotal">0</span>
                        جنية،
                        الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.
                    </strong>
                </div>




                <?php endif; ?>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> للإستمرار.
                </div>
            </div><!-- .panel-body  -->
        </div>

        <div id="pharmInfo" class="panel panel-default tab">
            <div class="panel-heading">
                بيانات الصيديلة
            </div>

            <div class="panel-body panelBodyForm">

                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name">اسم الصيدلية *</label>
                    <input value="<?php echo e(old('name')); ?>" type="text" name="name" required class="form-control name"
                        id="name" placeholder="اسم الصيدلية *">

                    <?php if($errors->has('name')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                    <label for="title"> عنوان الصيدلية *</label>
                    <input value="<?php echo e(old('title')); ?>" type="text" required name="title" class="form-control name"
                        id="title" placeholder="عنوان الصيدلية *">

                    <?php if($errors->has('title')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('title')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('whats') ? ' has-error' : ''); ?>">
                    <label for="whats"> رقم الوتس *</label>
                    <input value="<?php echo e(old('whats')); ?>" type="number" min='1000000000' max='9999999999' required
                        name="whats" class="form-control name" id="whats" placeholder="رقم الوتس *">
                    <?php if($errors->has('whats')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('whats')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"التالى"</span> للإستمرار.
                </div>
            </div>
        </div>

        <div id="ansInfo" class="panel panel-default tab">
            <div class="panel-heading">
                سؤال إجبارى
            </div>

            <div class="panel-body panelBodyForm">
                <?php
                session_start();
                $fn = rand(rand(1,5),rand(1,5));
                $sn = rand(rand(1,5), rand(1,5));
                $ops = [ '+', '×'];
                $op = rand(0, 1);
                $op = $ops[$op];
                $answer = 0;
                switch($op){
                    case "+":
                        $answer = $fn + $sn;
                        break;
                    /*
                    case "-":
                        $answer = $fn - $sn;
                        break; */

                    case "×":
                        $answer = $fn * $sn;
                        break;
                }

                $_SESSION['answer'] = $answer;

                ?>

                <div class="form-group<?php echo e($errors->has('answer') ? ' has-error' : ''); ?>">
                    <label class="lightP" for="answer">اكتب ناتج: <?php echo e($sn); ?> <?php echo e($op); ?> <?php echo e($fn); ?> = </label>
                    <input type="number" min="0" max='99999999999' name="answer" required class="form-control name"
                        id="answer" placeholder="اكتب الإجابه هنا">

                    <?php if($errors->has('answer')): ?>
                    <span class="help-block">
                        <strong><?php echo $errors->first('answer'); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div style="color: red;">
                    اضغط <span style="font-weight: bold; text-decoration: underline;">"تأكيد الأوردر"</span> للتأكيد.
                </div>

            </div>
        </div>


        <!--#  .alert alert-dismissable alert-sucess -->

        <div style="overflow:auto;">
            <div class="nextprevRow">
                <button type="button" id="prevBtn" class="btn btn-primary pull-right prev"> <i class="far fa-arrow-alt-circle-right"></i> السابق </button>
                <button type="button" id="nextBtn"  class="btn btn-primary pull-left next"> التالي <i class="far fa-arrow-alt-circle-left"></i> </button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    <?php endif; ?>
    <!--#regForm .regForm -->
    <?php else: ?>
    <div class="panel panel-default tab">
        <div class="panel-heading">
            بيانات العرض
        </div>

        <div class="panel-body panelBodyForm">
            <p>عذرا لا توجد عروض الأن - يرجى المتابعة على جروب الواتس او صفحة الفيسبوك لمعرفة مواعيد العرض التالى</p>
        </div>
    </div>
    <?php endif; ?>
<?php else: ?>
    <p class="alert alert-info">عذرا لا توجد عروض الأن - يرجى المتابعة على جروب الواتس او صفحة الفيسبوك لمعرفة مواعيد العرض التالى</p>
<?php endif; ?>
</div>

<!-- Counter -->
<center style="margin: 30px;">
<a href="https://info.flagcounter.com/Xhs4"><img src="https://s01.flagcounter.com/count2/Xhs4/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_12/viewers_3/labels_1/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
</center>
<!-- END Counter -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<?php if($offerSelected): ?>

<script>
$(document).ready(function() {

    $("#offerId").change(function() {
        window.location.replace('<?php echo e(url('/')); ?>/' + $("#offerId").val() +
            '?p=customerOrder')
    });
    screenWidth = $( document ).width()
    // Window scroll to
    sUsrAg = navigator.userAgent

    $(window).scroll(function() {
        var hT = $('#winscrollto').offset().top,
            hH = $('#winscrollto').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        /*if (wS > (hT - wH)) {
            console.log('H1 on the view!');
            // focused = $(':focus');
            if (sUsrAg.indexOf("Firefox") > -1 && $(window).width()<768) {
                $('#totalTr').css({
                    'position': 'fixed',
                })
            }else{
                $('#totalTr').css({
                    'position': 'relative',
                })
            }
            // focused.focus();
            // alert(focused.focus())
        } else {
            $('#totalTr').css({
                'position': 'fixed'
            })
        }*/
    });

    //For Offer
    offerIsvalid = false
    $(".offerAmount").on('keyup change', function() {
        offerpPrice = $("#offerpPrice" + $(this).attr('amountid')).attr('value')
        offerpAmount = $(this).val()
        if(!$.isNumeric($(this).val()) ) {
            $(this).val("")
        }else{
            $(this).val(parseInt( $(this).val()))
        }

        $("#offerP" + $(this).attr('amountid')).val(parseFloat(offerpPrice * offerpAmount ).toFixed(2))

        offerTotalAmount = parseFloat(0)
        $(".offerPAmountVal").each(function(i, obj) {
            if ($(this).val() != "") {
                offerTotalAmount += parseFloat($(this).val())
            }


        })
        $("#offerTotal").val(offerTotalAmount)
        $("#spanOrderPrice").html(offerTotalAmount)

        spanOfferPrice = offerTotalAmount - (offerTotalAmount * <?php echo e($offerSelected->discount); ?> /100)
        $("#spanOfferPrice").html(spanOfferPrice)
        $("#spanCharge").html(spanOfferPrice + <?php echo e($offerSelected->charge); ?>)
        spanExpireTotal = (( <?php echo e($offerSelected->expireTotal); ?> / <?php echo e($offerSelected->orderPrice); ?>) * offerTotalAmount).toFixed(2)
        $(".spanExpireTotal").html(spanExpireTotal)



        if (offerTotalAmount >= <?php echo e($offerSelected->minPriceOrder); ?>) {
            $('#offerTotalTr').css({
                'background': '#0084BF'
            })
            $('#offerPriceAlert').css({
                'display': 'none'
            })
            $('#submitFormCreate').attr("disabled", false);
            $('#nextBtn').attr("disabled", false);
            offerIsvalid = true
        } else {
            $('#offerTotalTr').css({
                'background': 'red'
            })
            $('#offerPriceAlert').css({
                'display': 'block'
            })
            $('#submitFormCreate').attr("disabled", true);
            $('#nextBtn').attr("disabled", true);
            offerIsvalid = false
        }
    });

    isvalid = false
    $(".amount").on('keyup change', function() {
        pPrice = $("#pPrice" + $(this).attr('amountid')).attr('value')
        pAmount = $(this).val()
        if(!$.isNumeric($(this).val()) ) {
            $(this).val("")
        }else{
            $(this).val(parseInt( $(this).val()))
        }

        $("#p" + $(this).attr('amountid')).val(parseFloat(pPrice * pAmount ).toFixed(2))
        totalAmount = parseFloat(0)
        $(".pAmountVal").each(function(i, obj) {
            if ($(this).val() != "") {
                totalAmount += parseFloat($(this).val())
            }


        })
        $("#total").val(totalAmount)

        maxprice = parseInt(spanExpireTotal) + parseInt(<?php echo e($offerSelected->tolerance); ?>)
        minprice = parseInt(spanExpireTotal) - parseInt(<?php echo e($offerSelected->tolerance); ?>)
        if (totalAmount >= minprice && totalAmount <= maxprice) {
            $('#totalTr').css({
                'background': '#0084BF'
            })
            $('#priceAlert').css({
                'display': 'none'
            })
            $('#submitFormCreate').attr("disabled", false);
            $('#nextBtn').attr("disabled", false);
            isvalid = true
        } else {
            $('#totalTr').css({
                'background': 'red'
            })
            $('#priceAlert').css({
                'display': 'block'
            })
            $('#submitFormCreate').attr("disabled", true);
            $('#nextBtn').attr("disabled", true);
            isvalid = false
        }
    });


    // MultiStep Form JS
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "تأكيد الأوردر";
    } else {
        document.getElementById("nextBtn").innerHTML = ' التالي <i class="far fa-arrow-alt-circle-left"></i> ';
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }


    $msg = ""
    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");

        y = x[currentTab].getElementsByTagName("input");

        if(x[currentTab].getAttribute("id") == "offerInfo"){
            valid = offerIsvalid
            if(valid == false){
                $('#offerTotalTr').css({
                    'background': 'red'
                })
                $('#offerPriceAlert').css({
                    'display': 'block'
                })
                $('#nextBtn').attr("disabled", true);

                alert("عذرا القيمة الإجمالية لأصناف االعرض يجب ان تكون بحد ادني <?php echo e($offerSelected->minPriceOrder); ?> ، جنية الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.")

            }
        }else if(x[currentTab].getAttribute("id") == "productsInfo"){
            valid = isvalid
            if(valid == false){
                $('#totalTr').css({
                    'background': 'red'
                })
                $('#priceAlert').css({
                    'display': 'block'
                })
                $('#nextBtn').attr("disabled", true);

                alert("عذرا القيمة الإجمالية لأصناف الاستبدال يجب ان تكون في حدود مبلغ "+spanExpireTotal+" ، جنية الرجاء حاول تغيير الكميات المطلوبة بحيث توافق هذا الشرط.")

            }

        }else if(x[currentTab].getAttribute("id") == "pharmInfo"){
            valid = false;
            if($("#name").val() =="" || $("#title").val() == ""){
                alert("تأكد من ادخال اسم الصيديلة وعنوانها  بشكل صحيح")

            }else if(!($.isNumeric($("#whats").val()) && $("#whats").val().length ==11)){
                alert("رقم الواتس يجب ان يتكون من 11 رقم")
            }else{
                valid = true;
            }
        }else if(x[currentTab].getAttribute("id") == "ansInfo"){
            if($("#answer").val() != <?php echo e($answer); ?>){
                alert("من فضلك أجب علي السؤاال الإجباري بشكل صحيح لضمان ارسال البيانات بأمان")
                valid = false;
            }else{
                valid = true;
            }
        }else if(false){
            for (i = 0; i < y.length; i++) {
                //Check empty Fields
                if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
                }
            }
        }

        // A loop that checks every input field in the current tab:

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

    $('#prevBtn').on('click', function(){
        nextPrev(-1)
        window.scrollTo(0, 0);
        $('#nextBtn').attr("disabled", false);
    })

    $('#nextBtn').on('click', function(){
        window.scrollTo(0, 0);
        nextPrev(1)
    })

});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.headfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>