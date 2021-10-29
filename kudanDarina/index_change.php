<?php
include_once 'Claimed_coin.php';
include_once 'Voucher.php';

// //Json file instead of request now
// $Json = file_get_contents("arrayJson.json");
// // Converts to an array
// $myarray = json_decode($Json, true);
// var_dump($myarray);
//
// exit;

$claimed = new Claimed_coin();
$vouchersData = new Voucher();

$allVouchers = $vouchersData->getAllVouchers();

$getAllVouchersCodes = [];
foreach($allVouchers as $key=>$value){
  $getAllVouchersCodes[$key] = $value['code'];
}

$getVoucherKudanInfo = [];
foreach($allVouchers as $value){
  $getVoucherKudanInfo[$value['code']] = $value['kudan'];
}


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kudan</title>
    <!-- Favicon icon -->
    <link rel="icon" href="https://bitbooll.io/img/core-img/favicon.ico">
	<link rel="apple-touch-icon" href="https://bitbooll.io/img/core-img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://bitbooll.io/img/core-img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://bitbooll.io/img/core-img/favicon-16x16.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.js"></script>
</head>

<body class="@@dashboard">

<div id="preloader"><i>.</i><i>.</i><i>.</i></div>

<div id="main-wrapper">

    <div class="header landing bg-dark light">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="navigation">
                    <nav class="navbar navbar-light">
                        <div class="brand-logo">
                            <a href="https://bitbooll.io">
                                <img width="60px" src="https://bitbooll.com/asset/images/logo_1622545756.png" alt="" class="logo-primary">
                                <img width="60px" src="https://bitbooll.com/asset/images/logo_1622545756.png" alt="" class="logo-white">
                            </a>
                        </div>
                        <div class="signin-btn">
                            <a href="index.html" class="btn btn-primary" href="#">Binance Smart Chain</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="intro2 section-padding bg-dark" id="intro">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-6 col-lg-6 col-12">
				<div class="intro-form-exchange">
                    <form method="post" id="myform" name="myform" class="currency_validate trade-form row g-3">
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                            </div>
                            <span class="error" id="emailValidation">Enter a valid email.</span>
                        </div>


                        <div class="col-12">
                            <label class="form-label">Wallet Address</label>
                            <div class="input-group">
                                <input type="text" id="walletAddress" name="walletAddress" class="form-control" placeholder="Enter your wallet address" required>
                            </div>
                            <span class="error" id="walletValidation">Enter a wallet address..</span>
                        </div>


                        <div class="col-12">
                            <label class="form-label">Voucher Code</label>
                            <div class="input-group">
                            <?php if(!$_GET["code"]): ?>
                                <input type="text" id="voucherCode" name="voucherCode" class="form-control" placeholder="Enter your voucher code" onmouseup="updateKudanAmount(event)" onkeyup="updateKudanAmount(event)">
                            <?php else: ?>
                                <input type="text" id="voucherCode" name="voucherCode" class="form-control" value="<?php echo $_GET['code']; ?>" onmouseup="updateKudanAmount(event)" onkeyup="updateKudanAmount(event)">
                            <?php endif; ?>
                            </div>
                            <div class="error" id="codeValidation">Enter a valid voucher code.</div>

                            <div class="input-group">
                            <select disabled class="form-control" style="padding:0px 0px 0px 45px;background-repeat:no-repeat;background-size: 30px 30px;background-position: left;background-position-x: 5px;background-image:url(images/bnb.png);" name="method">
								                 <option value="bank">USD</option>
                            </select>
                                <input readonly type="text" id="usd" name="usd" class="form-control" value="0">

                                <select disabled class="form-control" style="padding:0px 0px 0px 45px;background-repeat:no-repeat;background-size: 30px 30px;background-position: left;background-position-x: 5px;background-image:url(images/kudan.png);" name="method">
                    									<option value="bank">KUDAN</option>
                                </select>
                                <input readonly type="text" id="kudan" name="kudan" class="form-control" value="0">


                            </div>
                        </div>

                        <p class="mb-0">1 KUDAN ~ 0.00000025 USD </p>

                        <div class="successfrm" style="display:none;">
                            <div class="ui-success">
                                <svg viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Group-3" transform="translate(2.000000, 2.000000)">
                                <circle id="Oval-2" stroke="rgba(165, 220, 134, 0.2)" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
                                    <circle  class="ui-success-circle" id="Oval-2" fill="#000" stroke="#A5DC86" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
                                    <polyline class="ui-success-path" id="Path-2" stroke="#A5DC86" stroke-width="4" points="19 38.8036813 31.1020744 54.8046875 63.299221 28"></polyline>
                                </g>
                                </g>
                                </svg>
                            </div>
                        </div>
                       <div class="failform" style="display:none;">
                            <div class="ui-error">
                                <svg  viewBox="0 0 87 87" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Group-2" transform="translate(2.000000, 2.000000)">
                                    <circle id="Oval-2" stroke="rgba(252, 191, 191, .5)" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
                                    <circle fill="#000" class="ui-error-circle" stroke="#F74444" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
                                    <path class="ui-error-line1" d="M22.244224,22 L60.4279902,60.1837662" id="Line" stroke="#F74444" stroke-width="3" stroke-linecap="square"></path>
                                    <path class="ui-error-line2" d="M60.755776,21 L23.244224,59.8443492" id="Line" stroke="#F74444" stroke-width="3" stroke-linecap="square"></path>
                                    </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
						<button id="buy-button" type="button" class="btn btn-primary pay-button" type="button" name="buy-button" value="1">
                            Claim
                        </button>
                        

                    </form>
                </div>





            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="./js/plugins/sparkline-init.js"></script>
<script src="./js/scripts.js"></script>
<script type="text/javascript">

<script type="text/javascript">


$(document).ready(function() {
      $('.error').hide();
      <?php if($_GET["code"]){ ?>
        updateKudanAmount(event);
        <?php } ?>
      $('#buy-button').click(function(){
        var walletAddress = $('#walletAddress').val();
        var email = $('#email').val();
        var voucherCode = $('#voucherCode').val();

        if(email== '' || IsEmail(email)==false){
          $('#emailValidation').show();
          return false;
        }

        if(walletAddress== ''){
          $('#walletValidation').show();
          return false;
        }

        if(voucherCode== '' || isValidCode(voucherCode)==false){
          $('#codeValidation').show();
          return false;
        }

        // // LINK validation
        // var dataJson = [];
        // dataJson['customer_id'] = 5548026691738;
        // dataJson['email'] = "example@example.com";
        // dataJson['last_characters'] = "38h4";
        // if(dataJson.slice(dataJson.length - 4)!==dataJson['last_characters']){
        //   $('#codeValidation').show();
        //   return false;
        // }
        // if(email!==dataJson['email']){
        //   $('#emailValidation').show();
        //   return false;
        // }



        $.ajax({
            type: "POST",
            url: 'json.php',
            data: $("#myform input").serialize(),
            dataType: 'json',
            success: function(response)
            {
                if (response.success == 1)
                {
                    $(".successfrm").css("display", "block");
                }
                else
                {
                  $(".failform").css("display", "block");
                }
           }
        });


  });
 });
 function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function isValidCode(voucherCode){
  var getAllVouchersCodes = <?php echo json_encode($getAllVouchersCodes); ?>;
  if(inArray(voucherCode, getAllVouchersCodes)){
    return true;
  } else{
    return false;
  }
}
    function updateKudanAmount(event){
        var voucherCode = $('#voucherCode').val();
        var getVoucherKudanInfo = <?php echo json_encode($getVoucherKudanInfo); ?>;
        var kudan = getVoucherKudanInfo[voucherCode];

        $("#kudan").val(kudan);
        updateUSDAmount(kudan);
    }

    function updateUSDAmount(kudan){
        var usdAmount = kudan * 0.00000025;
        $("#usd").val(usdAmount);
    }


</script>
</body>

</html>
