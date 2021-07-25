<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Currentmonth;
use App\Offer;
use App\Status;
use App\Product;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'm/Exception.php';
require 'm/PHPMailer.php';
require 'm/SMTP.php';

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::OrderBy('status_id', 'ASC')->OrderBy('id', 'DESC')->get();
        return view('pharm.customer.index', compact(['customers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($offer_id = "")
    {
        $monthNumber = Currentmonth::find(1);
        if($monthNumber)
            $offer_id =$monthNumber->offer_id;
        else return "Page 404: Not Found";

        $offerSelected = "";
        $isShowPage=1;
        $offers = Offer::where('id', '=', $offer_id )->whereHas('products')->orderBy('id', "asc")->get();
        if(!$offers->isEmpty() && $offers){
            if ($offer_id != ""){
                $offerSelected = Offer::find($offer_id);
            }else{
                $offerSelected = $offers->first();
            }
            if(!$offerSelected) return "Page 404: not Found";
        }else{
            $isShowPage=0;
        }

        return view('pharm.customer.create', compact(['monthNumber', 'offers', 'offerSelected', 'offer_id', "isShowPage"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $Emsg = "لم يتم تسجيل الطلب، من فضلك راجع الكميات المطلوبه بشكل جيد بحيث توافق شرط العرض، او قم بالاتصال بصاحب الموقع للتفاصيل وشكرا.";
        $inputs = $request->all();
        // return $inputs;
        session_start();

        if ($request->answer == "") {
            // return "empty";
            return back()->withInput()->withErrors(['backError' => '
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     من فضلك أجب علي السؤال الاجباري قبل الضغط علي ارسال.
                </div>
                '
            ]);
        }elseif($request->answer != $_SESSION['answer']){
            // return "error";
            return back()->withInput()->withErrors(['answer' => '
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     إجابة السؤال الاجباري خطأ حاول مرة إخري
                </div>
                '
            ]);
        }
        $offer = Offer::find($request->offer_id);


        //Count offer values

        $offerAmounts = [];
        $attacharr = [];
        $offertotal = 0;
        foreach($request->offerpPrices as $pId){
            array_push ($offerAmounts, $inputs['offerAmount'.$pId]);
            if($inputs['offerAmount'.$pId]){
                // return $inputs['offerAmount'.$pId];
                $attacharr[$pId] = [
                    'offer_id'=>$offer->id,

                    'amountPrice'=>$inputs['offerAmounts'.$pId],
                    'amount'=>$inputs['offerAmount'.$pId],
                    'type'=>'offer',
                ];
                $offertotal += $inputs['offerAmounts'.$pId];
            }

            $getProduct = Product::find($pId);
            $getPrice = $getProduct->p_price;
            if ((number_format($getPrice*$inputs['offerAmount'.$pId] * (100-$offer->discount)/100, 2)) != (number_format($inputs['offerAmounts'.$pId],2))){
                $Emsg .= "<br> (عرض) راجع كمية الصنف: " . $getProduct->p_name;
                return back()->withInput()->withErrors(['backError' => $Emsg]);
            }
            // return "no";

        }

        if ($offertotal != $inputs['offerTotal'] || $offertotal < $offer->minPrice){
            return back()->withInput()->withErrors(['backError' => $Emsg  . "<br> راجع جملة العروض"]);
        }else{
            // Count expired values
            $amounts = [];
            $attacharrExpired=[];
            $total = 0;
            foreach($request->product_id as $pId){
                array_push ($amounts, $inputs['amount'.$pId]);
                if($inputs['amount'.$pId]){
                    // return $inputs['amount'.$pId];
                    $attacharrExpired[$pId] = [
                        'offer_id'=>$offer->id,
                        'amountPrice'=>$inputs['amounts'.$pId],
                        'amount'=>$inputs['amount'.$pId],
                        'type'=>'expired',
                    ];
                    $total += $inputs['amounts'.$pId];
                }
                $getProduct = Product::find($pId);
                $getPrice = $getProduct->p_price;
                if ((number_format($getPrice*$inputs['amount'.$pId],2)) != (number_format($inputs['amounts'.$pId],2))){
                    $Emsg .= "<br> (اكسبايرد) راجع كمية الصنف: " . $getProduct->p_name . "<br> Price= " .$getPrice . " * amount " .  $inputs['amount'.$pId] . " = amounts " . $inputs['amounts'.$pId];
                    return back()->withInput()->withErrors(['backError' => $Emsg]);
                }
                // return "no";
            }

            $spanExpireTotal = round((( $offer->expireTotal / $offer->offerPrice) * $offertotal), 2);
            $maxprice =$spanExpireTotal + $offer->tolerance;
            $minprice =$spanExpireTotal - $offer->tolerance;
            //  return $total . " > " .$spanExpireTotal;
            if ($total != $inputs['total'] || !($total >= $minprice && $total <= $maxprice)){
                return back()->withInput()->withErrors(['backError' => $Emsg . "<br> راجع جمله الأكسبايرد"]);
            }
        }
        $inputs['offerTotal'] = $offertotal;
        if($customer = Customer::create($inputs)){
            $customer->products()->attach($attacharr);
            $customer->products()->attach($attacharrExpired);

            //
            $to = Currentmonth::find(1)->email;
            $subject = $request->name . " - " . $request->whats . " رسالة من داوا فارم";
            date_default_timezone_set('Africa/Cairo');
            $time = date("Y-m-d h:i:sa");
            $message = "
            <html>
            <head>
            <title>$subject</title>
            </head>
            <body dir='trl'>
            <div style='direction:rtl'>
            <h1>هذه الرسالة مرسلة من صفحة حجز عرض من موقع داوا فارم!</h1>
            <h2>تم حجز عرض من قبل: </h2>
            <table border='1' width='100%'>
                <tr>
                    <th><p style='font-size:18 color:blue; font-weight: bold;'>اسم الصيدلية</p></th>
                    <td><p style='font-size:18 color:#999;'>".$request->name."</p></td>
                </tr>
                <tr>
                    <th><p style='font-size:18 color:blue; font-weight: bold;'>عنوان الصيدلية</p></th>
                    <td><p style='font-size:18 color:#999;'>".$request->title."</p></td>
                </tr>
                <tr>
                    <th><p style='font-size:18 color:blue; font-weight: bold;'>رقم الواتس</p></th>
                    <td><p style='font-size:18 color:#999; text-align:left;'>".$request->whats."</p></td>
                </tr>
                <tr>
                    <th><p style='font-size:18 color:blue; font-weight: bold;'>وفقت الحجز</p></th>
                    <td><p style='font-size:18 color:#999;'>$time</p></td>
                </tr>
            </table>
               <h3> لعرض بيانات الحجز و الطلب بالكامل من فضلك اضغط علي الرابط التالي</h3>
                <p><a href='".url('pharm/customer/'.$customer->id.'?p=customer')."'>".url('pharm/customer/'.$customer->id.'?p=customer')."</a></p>
            </div>
            </body>
            </html>
            ";


            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <order@dawapharm.com>' . "\r\n";

            $msg="";

            //mail($to,$subject,$message,$headers);
            // if(mail($to,$subject,$message,$headers))
            // {
            //     $msg = " و تم ارسال بريد الكتروني للتأكيد ";
            // }else{
            //     $msg = " لم يتم ارسال بريد ألكتروني للتأكيد";
            // }

			$mail = new PHPMailer();

			//$mail->SMTPDebug = 1;
			$mail->IsSMTP();                      // send via SMTP
			$mail->Host     = "mail.dawapharm.com"; // SMTP servers

			$mail->SMTPAuth = true;
			$mail->SMTPAutoTLS = false;

			$mail->Username = "order@dawapharm.com";   // SMTP username
			$mail->Password = "lvA8t@63"; // SMTP password

			$mail->From     = "order@dawapharm.com";
			$mail->FromName = "Dawa Orders";

			$tos = explode(",", $to);
			foreach($tos as $t)
			{
				$mail->AddAddress($t,"Hamdy");
			}

			$mail->AddReplyTo("order@dawapharm.com","Dawa Orders");

			$mail->WordWrap = 50;                 // set word wrap

			$mail->IsHTML(true);                     // send as HTML

			$mail->CharSet = 'UTF-8';

			$mail->Subject  =  $subject;
			$mail->Body     =  $message;
			//$mail->AltBody  =  "This is the text-only body";

			$mail->Send();
			//if(!$mail->Send())
			//{
			 //  echo "Message was not sent <p>";
			  // echo "Mailer Error: " . $mail->ErrorInfo;
			  // exit;
			//}

			//echo "Message has been sent";


            return redirect('/?p=customerOrder')->with('success',   ' تم ارسال الطلب بنجاح ' . $msg );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.' . $msg]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $statuses = Status::OrderBy('id', 'ASC')->get();
        return view('pharm.customer.show', compact(['customer', 'statuses']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('pharm.customer.edit', compact(['customer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $cName =  $customer->name;
        if($customer = $customer->update($request->all())){
            return redirect('pharm/customer/?p=customer')->with('success',   ' تم حفظ تعديلات الطلب  ' .$cName );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customerName = $customer->name;
        $customer->products()->detach();
        if($customer->delete()){
            return redirect('pharm/customer/?p=customer')->with('success',   '  تم حذف الطلب '.$customerName.'  بنجاح  '  );
        }else
            return back()->withInput()->withErrors(['backError' => 'عذرا حدث خطأ أثناء الحفظ، الرجاء الاتصال بمطور البرنامج.']);

    }
}

