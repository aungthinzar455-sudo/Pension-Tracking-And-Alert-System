<?php

function sendSMS($phone, $message){

    // Demo SMS logger instead of real SMS
    $log = date("Y-m-d H:i:s") . " | Phone: $phone | Message: $message\n";

    file_put_contents("sms_log.txt", $log, FILE_APPEND);

    return true;
}