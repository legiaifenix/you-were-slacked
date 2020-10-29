<?php


namespace legiaifenix\youWereSlacked\Model;


use legiaifenix\youWereSlacked\Service\AlertTypes;

class Slack extends MessageType
{
    protected $icon;


    public function __construct(string $title, string $body, string $icon)
    {
        parent::__construct($title, $body);
        $this->icon = $icon;
        $this->parse();
    }

    private function parse()
    {
        if (empty($this->icon))
            $this->icon = AlertTypes::INFORMATION_ALERT;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}