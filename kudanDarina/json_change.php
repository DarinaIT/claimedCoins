<?php
include_once 'Claimed_coin.php';
$claimed = new Claimed_coin();


if ($_POST) {
    $claimed->claimCoins($_POST);

    // define("CONTACT_FORM", 'darina@booll.bg');
    // error_reporting (E_ALL ^ E_NOTICE);
    // $email = stripslashes($_POST['email']);
    // $voucherCode = stripslashes($_POST['voucherCode']);
    // $kudan = stripslashes($_POST['kudan']);
    // $walletAddress = stripslashes($_POST['walletAddress']);
    // $message = 'Email: '.$email.'; Voucher code: '.$voucherCode.'; Kudan: '.$kudan.'; Wallet address: '.$walletAddress;
    //
    // require_once dirname(__FILE__) . '/vendor/vendorEmail/autoload.php';
    // $from = 'darina@booll.bg';
    // // Create the Transport
    // $transport = (new Swift_SmtpTransport('bono.superhosting.bg', 26))
    //   ->setUsername($from)
    //   ->setPassword('darinada777')
    // ;
    //
    // // Create the Mailer using your created Transport
    // $mailer = new Swift_Mailer($transport);
    //
    // // Create a message
    // $message = (new Swift_Message('New claimed coins'))
    //   ->setFrom([$from => 'darina.targovec.bg'])
    //   ->setTo([$from])
    //   ->setBody($message)
    //   ;
    // // Send the message
    // $mail = $mailer->send($message);

    // based on successful operations
    echo json_encode(array('success' => 1));
    exit;
} else {
    echo json_encode(array('success' => 0));
    exit;
}
 ?>
