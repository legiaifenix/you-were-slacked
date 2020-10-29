<?php


namespace legiaifenix\youWereSlacked\Config;


class EnvCredentials
{
    public function __invoke()
    {
        return [
            'app'       => $_ENV['SLACK_APP'],
            'hook'      => $_ENV['SLACK_WEBHOOK_URL'],
            'channel'   => $_ENV['SLACK_WEBHOOK_CHANNEL'],
            'bot'       => $_ENV['SLACK_BOTNAME'],
        ];
    }
}