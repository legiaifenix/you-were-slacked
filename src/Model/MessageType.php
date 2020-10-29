<?php


namespace legiaifenix\youWereSlacked\Model;


class MessageType
{
    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $body
     */
    protected $body;

    public function __construct(string $title, string $body)
    {
        $this->title    = $title;
        $this->body     = $body;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

}