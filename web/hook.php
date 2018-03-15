<?php
/**
 * README
 * This configuration file is intended to run the bot with the webhook method.
 * Uncommented parameters must be filled
 *
 * Please note that if you open this file with your browser you'll get the "Input is empty!" Exception.
 * This is a normal behaviour because this address has to be reached only by the Telegram servers.
 */

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\Update;
// use Longman\TelegramBot\Entities\Message;

require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $rule_array = [
        'ололо' => 'Хуюлоло',
        '300' => 'Юморю про тракториста',
        'санек' => 'А?!',
        'круть' => 'Седыхуть',
        'Збс' => 'Сдхс',
        'ок' => 'Я - кок',
        'конечно' => 'Седыхечно',
        'нет' => 'Седонет',
        'так' => 'Седытак',
        //'' => '',
        'засранец' => 'Седысранец',
        'сколько' => 'Седысролько',
        'седых' => 'Седодых',
        'денис' => 'Во истину царя имя его поготворю, кланяюсь к плинтусу так низко, что лежу у ног Дениса!',
        'понедельник' => 'Седыхбездельник',
        'вторник' => 'Седыхзатворник',
        'среда' => 'Седыхрезеда',
        'четверг' => 'Седыхизверг',
        'пятница' => 'Седыхразвратница',
        'суббота' => 'Седыхота',
        'аренда' => 'Седыхоренда',
        'какает' => 'Седыхкакает',
        'бля' => 'Седобля',
    ];

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);

    // Enable admin users
    $telegram->enableAdmins($admin_users);

    // Enable MySQL
    //$telegram->enableMySql($mysql_credentials);

    // Logging (Error, Debug and Raw Updates)
    //Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . "/{$bot_username}_error.log");
    //Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . "/{$bot_username}_debug.log");
    //Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . "/{$bot_username}_update.log");

    // If you are using a custom Monolog instance for logging, use this instead of the above
    //Longman\TelegramBot\TelegramLog::initialize($your_external_monolog_instance);

    // Set custom Upload and Download paths
    //$telegram->setDownloadPath(__DIR__ . '/Download');
    //$telegram->setUploadPath(__DIR__ . '/Upload');

    // Here you can set some command specific parameters
    // e.g. Google geocode/timezone api key for /date command
    //$telegram->setCommandConfig('date', ['google_api_key' => 'your_google_api_key_here']);

    // Botan.io integration
    $telegram->enableBotan('a761547a-a436-406d-a9a2-1ef75b33abb5');

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    $telegram->enableLimiter();

    // Handle telegram webhook request
    $telegram->handle();

    $post = json_decode(Request::getInput(), true);
    $update = new Update($post, $bot_username);
    $a = serialize($update->getUpdateContent());
    Request::sendMessage(['chat_id' => '533910', 'text' => $a]);
    $message = $update->getMessage();
    
    $chat_id = $message->getChat()->getId();
    $text = $message->getText();

    $array_words = explode(' ', $text);
    if (count($array_words) == 1) {
        if (array_key_exists($text, $rule_array)) {
            $text = $rule_array[$text];
        }
        else {
            if (mb_strlen($text) < 3) return;
        
            if (mb_strlen($text) > 11) {
                Request::sendMessage(['chat_id' => $chat_id, 'text' => 'Пидора ответ']);
                return;
            }
            $text = mb_strtolower($text);
            $text = str_replace('ё', 'е', $text);

            foreach(['а', 'у', 'о', 'ы', 'и', 'э', 'я', 'ю', 'е'] as $letter) {
                $pos = mb_stripos($text, $letter);
                if ($pos === false) continue;
                $letter_array[$pos] = $letter;
            }
            ksort($letter_array);
            $pos_letter = reset($letter_array);
            $text = 'Седых'.($pos_letter ? mb_stristr($text, $pos_letter) : '');
        }
        Request::sendMessage(['chat_id' => $chat_id, 'text' => $text]);
    }


} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initialisation errors
    echo $e;
}

