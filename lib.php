<?php
require_once(__DIR__ . '/vendor/autoload.php');


function sumOfSuccessLeads($api = '23bc075b710da43f0ffb50ff9e889aed',$start , $end) {
    Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', $api);
    $api = new Introvert\ApiClient();
    $sum = 0;
        
    try {
        $result = $api->lead->getAll();
    } catch (Exception $e) {
        return false;
        
    }
    foreach ($result['result'] as $value){
        if ($value['status_id'] === '142' and $value['date_close'] > $start and $value['date_close'] < $end){
        $sum += (int) $value['price'];
        }
    }
    return $sum;
}



function getClients() {
    return [
    [
        'id' => 15173842,
        'name' => 'dev test',
        'api' => '23bc075b710da43f0ffb50ff9e889aed'
    ],
    [
        'id' => 12345,
        'name' => 'Error',
        'api' => '23bc075b710da43f0ffb50ff9e889aed'
    ]
    ];
}

