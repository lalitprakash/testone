<?php
require_once 'vendor/autoload.php';
use MaxMind\MinFraud;

# The constructor for MinFraud takes your account ID, your license key, and
# optionally an array of options.
$mf = new MinFraud(231747,'X3MRhIz988pVLyHo');
//$mf = new MinFraud(14675, 'ABCD5690809907890');
# Note that each ->with*() call returns a new immutable object. This means
# that if you separate the calls into separate statements without chaining,
# you should assign the return value to a variable each time.
$request = $mf->withDevice([
    'ip_address'  => '70.228.106.84',
    'session_age' => '2',
    'session_id'  => 'null',
    'user_agent'  =>
        '',
    'accept_language' => '',
])->withEvent([
    'transaction_id' => ' ',
    'shop_id'        => 's2123',
    'time'           => '2012-04-12T23:20:50+00:00',
    'type'           => 'purchase',
])->withAccount([
    'user_id'      => 3132,
    'username_md5' => '4f9726678c438914fa04bdb8c1a24088',
])->withEmail([
    'address' => 'test@maxmind.com',
    'domain'  => 'maxmind.com',
])->withBilling([
    'first_name'         => 'First',
    'last_name'          => 'Last',
    'company'            => 'Company',
    'address'            => '101 Address Rd.',
    'address_2'          => 'Unit 5',
    'city'               => 'New Haven',
    'region'             => 'CT',
    'country'            => 'US',
    'postal'             => '06510',
    'phone_number'       => '323-123-4321',
    'phone_country_code' => '1',
])->withShipping([
    'first_name'         => 'ShipFirst',
    'last_name'          => 'ShipLast',
    'company'            => 'ShipCo',
    'address'            => '322 Ship Addr. Ln.',
    'address_2'          => 'St. 43',
    'city'               => 'Nowhere',
    'region'             => 'OK',
    'country'            => 'US',
    'postal'             => '73003',
    'phone_number'       => '403-321-2323',
    'phone_country_code' => '1',
    'delivery_speed'     => 'same_day',
])->withPayment([
    'processor'             => 'stripe',
    'was_authorized'        => false,
    'decline_code'          => 'invalid number',
])->withCreditCard([
    'issuer_id_number'        => '323132',
    'last_4_digits'           => '7643',
    'bank_name'               => 'Bank of No Hope',
    'bank_phone_country_code' => '1',
    'bank_phone_number'       => '800-342-1232',
    'avs_result'              => 'Y',
    'cvv_result'              => 'N',
])->withOrder([
    'amount'           => 323.21,
    'currency'         => 'USD',
    'discount_code'    => 'FIRST',
    'is_gift'          => true,
    'has_gift_message' => false,
    'affiliate_id'     => 'af12',
    'subaffiliate_id'  => 'saf42',
    'referrer_uri'     => 'http://www.amazon.com/',
])->withShoppingCartItem([
    'category' => 'pets',
    'item_id'  => 'leash-0231',
    'quantity' => 2,
    'price'    => 20.43,
])->withShoppingCartItem([
    'category' => 'beauty',
    'item_id'  => 'msc-1232',
    'quantity' => 1,
    'price'    => 100.00,
])->withCustomInputs([
    'section'            => 'news',
    'previous_purchases' => 19,
    'discount'           => 3.2,
    'previous_user'      => true,
]);
 
# To get the minFraud Factors response model, use ->factors():
/*$factorsResponse = $request->factors();

print($factorsResponse->subscores->email . "\n");
*/
# To get the minFraud Insights response model, use ->insights():
$insightsResponse = $request->insights();

print($insightsResponse->riskScore . "\n");
//print($insightsResponse->creditCard->issuer->name . "\n");

/*foreach ($insightsResponse->warnings as $warning) {
    print($warning->warning . "\n");
}*/

# To get the minFraud Score response model, use ->score():
/*$scoreResponse = $request->score();

print($scoreResponse->riskScore . "\n");

foreach ($scoreResponse->warnings as $warning) {
    print($warning->warning . "\n");
}*/