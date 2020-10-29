<?php

namespace legiaifenix\youWereSlacked\Config;

use legiaifenix\youWereSlacked\Model\Slack;
use legiaifenix\youWereSlacked\Service\TemplatingEngine;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Logger;

class SlackSystem
{
    /**
     * @var Logger $logger
     */
    private static $logger;

    /**
     * Function call that delegates the information towards the slack channel requested.
     * The variables SLACK_CHANNEL and SLACK_TOKEN need to exist otherwise throws an error
     *
     * @param string $icon
     * @param string $title
     * @param string $message
     */
    public static function slack(string $icon, string $title, string $message)
    {
        //slack
        self::init();
        $engine = new TemplatingEngine(new Slack($title, $message, $icon));
        $engine->template()->generate();

        self::$logger->critical($engine->getTemplate(), []);
    }

    private static function init()
    {
        try{
            $credentials = (new EnvCredentials)();

            self::$logger = new Logger($credentials['app']);
            self::$logger->pushHandler(new SlackWebhookHandler($credentials['hook'], $credentials['channel']));
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }
}