<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<table width="600">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

<tr>
<td width="20%">Select file</td>
<td width="80%"><input type="file" name="file" id="file" /></td>
</tr>

<tr>
<td>Submit</td>
<td><input type="submit" name="submit" /></td>
</tr>

</form>
</table>
</body>
</html>
<?php 
require_once 'vendor/autoload.php';
use MaxMind\MinFraud;

$row=0;
if ( isset($_POST["submit"]) ) {

   if ( isset($_FILES["file"])) {

            //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

        }
        else {
                 //Print file details
           /*  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
             echo "Type: " . $_FILES["file"]["type"] . "<br />";
             echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
             echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
*/
                 //if file already exists
             if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
             }
             else {
                    //Store file in directory "upload" with the name of "uploaded_file.txt"
            $storagename = "uploaded_file.txt";
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
            //echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
            }
        }
     } else {
             echo "No file selected <br />";
     }
}


if ( isset($storagename) && $file = fopen( "upload/" . $storagename , 'r' ) ) {
	 while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
        if ($row > 0) {
            $array_data[$row] = $data;
        }
        $row++;
    }
fclose($file);
   
$mf = new MinFraud(231747,'X3MRhIz988pVLyHo');
echo '<div class="container">           
  <table class="table">
    <thead>
      <tr>
        <th>Transaction Id </th>
        <th>Ip Address</th>
        <th>Fraud Score</th>
      </tr>
    </thead>
    <tbody>';
//$count =0;
foreach ($array_data as $row) {

   list($ip_addres,
    $session_age,
    $session_id,
    $user_agent,
    $accept_language,
    $transaction_id,
    $shop_id,
    $time,
    $type,
    $user_id,
    $username_md5,
    $email_address,
    $domain,
    $first_name,
    $last_name,
    $company,
    $address,
    $address_2,
    $city,
    $region,
    $country,
    $postal,
    $phone_number,
    $phone_country_code,
    $ship_first_name,
    $ship_last_name,
    $ship_company,
    $ship_address,
    $ship_address_2,
    $ship_city,
    $ship_region,
    $ship_country,
    $ship_postal,
    $ship_phone_number,
    $ship_phone_country_code,
    $delivery_speed,
    $processor,
    $was_authorized,
    $decline_code,
    $issuer_id_number,
    $last_4_digits,
    $bank_name,
    $bank_phone_country_code,
    $bank_phone_number,
    $avs_result,
    $cvv_result,
    $amount,
    $currency,
    $discount_code,
    $is_gift,
    $has_gift_message,
    $affiliate_id,
    $subaffiliate_id,
    $referrer_uri,
    $category,
    $item_id,
    $quantity,
    $price,
    $section,
    $previous_purchases,
    $discount,
    $previous_user)=$row;
    
    $username_md5 =md5($username_md5);
    $request = $mf->withDevice([
            'ip_address'  => $ip_addres,
            'session_age' => $session_age,
            'session_id'  => $session_id,
            'user_agent'  => $user_agent,
            'accept_language' => $accept_language,
        ])->withEvent([
            'transaction_id' => $transaction_id,
            'shop_id'        => $shop_id,
            'time'           => $time,
            'type'           => $type,
        ])->withAccount([
            'user_id'      => $user_id,
            'username_md5' => $username_md5,
        ])->withEmail([
            'address' => $email_address,
            'domain'  => $domain,
        ])->withBilling([
            'first_name'         => $first_name,
            'last_name'          => $last_name,
            'company'            => $company,
            'address'            => $address,
            'address_2'          => $address_2,
            'city'               => $city,
            'region'             => $region,
            'country'            => $country,
            'postal'             => $postal,
            'phone_number'       => $phone_number,
            'phone_country_code' => $phone_country_code,
        ])->withShipping([
            'first_name'         => $ship_first_name,
            'last_name'          => $ship_last_name,
            'company'            => $ship_company,
            'address'            => $ship_address,
            'address_2'          => $ship_address_2,
            'city'               => $ship_city,
            'region'             => $ship_region,
            'country'            => $ship_country,
            'postal'             => $ship_postal,
            'phone_number'       => $ship_phone_number,
            'phone_country_code' => $ship_phone_country_code,
            'delivery_speed'     => $delivery_speed,
        ])->withPayment([
            'processor'             => $processor,
            'was_authorized'        => $was_authorized,
            'decline_code'          => $decline_code,
        ])->withCreditCard([
            'issuer_id_number'        => $issuer_id_number,
            'last_4_digits'           => $last_4_digits,
            'bank_name'               => $bank_name,
            'bank_phone_country_code' => $bank_phone_country_code,
            'bank_phone_number'       => $bank_phone_number,
            'avs_result'              => $avs_result,
            'cvv_result'              => $cvv_result,
        ])->withOrder([
            'amount'           => $amount,
            'currency'         => $currency,
            'discount_code'    => $discount_code,
            'is_gift'          => $is_gift,
            'has_gift_message' => $has_gift_message,
            'affiliate_id'     => $affiliate_id,
            'subaffiliate_id'  => $subaffiliate_id,
            'referrer_uri'     => $referrer_uri,
        ])->withShoppingCartItem([
            'category' => $category,
            'item_id'  => $item_id,
            'quantity' => $quantity,
            'price'    => $price,
        ])->withCustomInputs([
            'section'            => $section,
            'previous_purchases' => $previous_purchases,
            'discount'           => $discount,
            'previous_user'      => $previous_user,
        ]);
        // $count++;

# To get the score.
    $insightsResponse = $request->insights();
    //print($insightsResponse->riskScore . "\n");
    echo '<tr>
            <td>'.$transaction_id.'</td>
            <td>'.$ip_addres.'</td>
            <td>'.$insightsResponse->riskScore.'</td>
        </tr>';
/* if($count == 12){
    break;
 }*/
}
echo '</tbody>
  </table>
</div>
';
 
}
?>
