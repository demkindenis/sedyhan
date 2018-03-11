<?php
/**
 * README
 * This configuration file is intended to run the bot with the webhook method.
 * Uncommented parameters must be filled
 *
 * Please note that if you open this file with your browser you'll get the "Input is empty!" Exception.
 * This is a normal behaviour because this address has to be reached only by the Telegram servers.
 */

// use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\Update;
// use Longman\TelegramBot\Entities\Message;

require_once '../vendor/autoload.php';
require_once 'config.php';

class MyTelegram extends Longman\TelegramBot\Telegram {
    public function processUpdate(Longman\TelegramBot\Entities\Update $update) {
      if($message = $update->getMessage()) {
        $sender = $message->getFrom();
        $sender_id = $sender->getId();
        $sender_username = $sender->getUsername();
        $chat = $message->getChat();
        $chat_id = $chat->getId();
        $message_text = $message->getText();
        // etc etc ....
      }
  
      return parent::processUpdate($update);
    }
  }

try {
    // Create Telegram API object
    $telegram = new MyTelegram($bot_api_key, $bot_username);

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
    //$telegram->enableBotan('your_botan_token');

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    $telegram->enableLimiter();

    // Handle telegram webhook request
    $telegram->handle();

    // $result = Request::sendMessage(['chat_id' => '533910', 'text' => 'Your utf8 text 😜 ...']);

    // $text = $telegram ->getMessage()->getText(true);

    // Request::sendMessage(['chat_id' => '533910', 'text' => serialize($telegram ->getMessage())]);
    Request::sendMessage(['chat_id' => '533910', 'text' => $telegram->message]);

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
