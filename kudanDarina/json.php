<?php
include_once 'Claimed_coin.php';
$claimed = new Claimed_coin();


if ($_POST) {
    //recaptcha
    $secret="6LerRP8cAAAAAPkiN4ESre3DDc1EsR3DviJG1PfO";
    $response=$_POST["captcha"];
    $verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
      //This user was not verified by recaptcha.
      echo json_encode(array('success' => 0));
      exit;
    }
    else if ($captcha_success->success==true) {
      $dbResult = $claimed->claimCoins($_POST);
    }



    if ($dbResult){
      // SEND EMAIL
      $email = stripslashes($_POST['email']);
      $phone = stripslashes($_POST['phone']);
      $fname = stripslashes($_POST['fname']);
      $lname = stripslashes($_POST['lname']);
      $deliveryAddress = stripslashes($_POST['deliveryAddress']);
      $voucherCode = stripslashes($_POST['voucherCode']);
      $kudan = stripslashes($_POST['kudan']);
      $walletAddress = stripslashes($_POST['walletAddress']);
      $to = $email;
      $subject = "Claim coin";
      $txt = 'Email: '.$email.'; Phone: '.$phone.'; First name: '.$fname.'; Last name: '.$lname.'; Delivery Address: '.$deliveryAddress.'; Voucher code: '.$voucherCode.'; Kudan: '.$kudan.'; Wallet address: '.$walletAddress;

      $resultMail = mail($to,$subject,$txt);


      if($resultMail){
        echo json_encode(array('success' => 1));
        exit;
      } else{
        echo json_encode(array('success' => 0));
        exit;
      }

    } else{
      echo json_encode(array('success' => 0));
      exit;
    }

} else {
    echo json_encode(array('success' => 0));
    exit;
}
 ?>
