<?php

return [
    'token' => env('BOLETO_FACIL_TOKEN'),
    'sandbox' => env('BOLETO_FACIL_SANDBOX'),


    /*
    | Notification URL
    | A url for WebHook in Boleto Fácil
    | If has {{id}} on url, the system will override by the reference in payment
     */
    'notification_url' => ''
];
