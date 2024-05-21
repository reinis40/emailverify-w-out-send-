<?php
$string = readline('enter email: ');
$endPoint ='https://api.emailvalidation.io/v1/info?apikey=ema_live_EC7rWmyO3ps9nzezFFkzdpEV5U5Sn7JIGe86n5Tf&email='.$string;
$response = file_get_contents($endPoint);
$responseData = json_decode($response);
if (preg_match("/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$/", $string)) {
    if (
          $responseData->smtp_check === true &&
          $responseData->mx_found === true &&
          $responseData->state === 'deliverable' &&
          $responseData->reason === 'valid_mailbox' &&
          $responseData->format_valid === true)
    {
        $isValid = true;
    }
    else
    {
        $isValid = false;
    }
    if ($isValid === true) {
        echo "The email address is valid.\n";
    } else {
        echo "The email address is not valid.\n";
    }
} else {
    echo "The email address is not valid.";
    exit();
}


