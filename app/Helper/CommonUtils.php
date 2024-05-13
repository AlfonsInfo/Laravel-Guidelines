<?php
namespace App\Helper;


//* formatter utility


//* utility for creating response 
function responseMessageSuccess($message, $status = 200, $header = []){
    $responseData = [
        "status" => true,
        "message" => $message
    ];
    return response()->json($responseData, $status, $header); 
}

//* others abstractions

