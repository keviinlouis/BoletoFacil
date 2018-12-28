<?php

return [
    /*
     * Token gerado pelo painel do boleto facil
     */
    'token' => env('BOLETO_FACIL_TOKEN'),

    /*
     * Controlador do endpoint para produção ou para sandbox
     */
    'sandbox' => env('BOLETO_FACIL_SANDBOX'),

    /*
     * Url de notificação para o boleto fácil
     * Se caso for definido na criação de um PaymentResource o NotificationUrl, o mesmo irá sobrescrever a url definida aqui
     * Sempre é bom deixar uma url padrão para caso ocorra algum erro ao recuperar a NotificationUrl do PaymentResource
     */
    'notification_url' => '',
];
