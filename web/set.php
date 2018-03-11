<?php
/**
 * README
 * This file is intended to set the webhook.
 * Uncommented parameters must be filled
 */
// Load composer
require_once __DIR__ . '/vendor/autoload.php';
// Add you bot's API key and name
$bot_api_key  = '566295728:AAFrqfGoM1P7FQxlEs2cjHbX9V747bIgH_k';
$bot_username = 'sedyh_bot';
// Define the URL to your hook.php file
$hook_url     = 'https://sedyhan.herokuapp.com/hook.php';
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    // To use a self-signed certificate, use this line instead
    //$result = $telegram->setWebhook($hook_url, ['certificate' => $certificate_path]);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}