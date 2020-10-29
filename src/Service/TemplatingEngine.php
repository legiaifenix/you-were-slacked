<?php


namespace legiaifenix\youWereSlacked\Service;


use legiaifenix\youWereSlacked\Factory\TemplateFilesContentFactory;
use legiaifenix\youWereSlacked\Model\MessageType;

class TemplatingEngine implements TemplateInterface
{



    /**
     * @var MessageType $type
     */
    protected $type;

    /**
     * @var \SplFileObject $template
     */
    protected $template;

    protected $replacables = [
        '<icon>' => 'getIcon',
        '<title>' => 'getTitle',
        '<body>' => 'getBody'
    ];

    public function __construct(MessageType $messageType)
    {
        $this->type = $messageType;
    }

    public function template($name = 'original')
    {
        $this->template = TemplateFilesContentFactory::template($name);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function generate()
    {
        if (is_null($this->template))
            throw new \Exception(sprintf('[%s]: No template was selected for the message', get_class($this)));

        foreach ($this->replacables as $replaceable => $methodCall) {
            if (method_exists($this->type, $methodCall))
                $this->template = str_replace($replaceable, $this->type->$methodCall(), $this->template);
        }

        $this->template = str_replace('\n', PHP_EOL, $this->template);
    }

    public function getTemplate()
    {
        return $this->template;
    }




}