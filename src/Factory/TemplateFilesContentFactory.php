<?php


namespace legiaifenix\youWereSlacked\Factory;



class TemplateFilesContentFactory
{
    /**
     * @param string $name
     * @return false|string
     * @throws \Exception
     */
    public static function template(string $name)
    {
        $file = self::findTemplate($name);
        return $file->fread($file->getSize());
    }

    /**
     * @param string $name
     * @return \SplFileObject
     * @throws \Exception
     */
    private static function findTemplate(string $name)
    {
        switch ($name) {
            case 'original':
                return new \SplFileObject(__DIR__  . '/../Templates/original.slack', 'r');
            default:
                if (file_exists($name))
                    return new \SplFileObject($name);
                throw new \Exception(sprintf('[%s]: File template was not found. not possible to build a slack message without a template', get_class(self::class)));
        }
    }
}