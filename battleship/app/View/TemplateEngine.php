<?php
/*
 * Простой шаблонизатор
 */
namespace app\View;

class TemplateEngine
{
    const FOLDER_TEMPLATE = 'template';
    const FOLDER_JS = 'javascript';
    const FOLDER_CSS = 'css';

    const MAIN_TEMPLATE = 'main.html';
    const JS_TEMPLATE = 'js_template.html';
    const CSS_TEMPLATE = 'css_template.html';

    const NAME_FILE_PARAM = 'file';
    const NAME_JS_BLOCK = 'js';
    const NAME_CSS_BLOCK = 'css';
    const NAME_BODY_BLOCK = 'body';

    public function getTemplate(string $src):string
    {
        return file_get_contents('./'.DIRECTORY_SEPARATOR.self::FOLDER_TEMPLATE.DIRECTORY_SEPARATOR.$src);
    }

    public function getMainTemplate():string
    {
        return $this->getTemplate(self::MAIN_TEMPLATE);
    }

    public function addJSFiles(string $template ,string ... $src):string
    {
        $finalSource = '';
        $templateJS = $this->getTemplate(self::JS_TEMPLATE);
        foreach ($src as $item)
        {
            $finalSource .= $this->putBlock($templateJS,  self::NAME_FILE_PARAM,
                self::FOLDER_JS.DIRECTORY_SEPARATOR.$item);
        }
        return $this->putBlock($template, self::NAME_JS_BLOCK, $finalSource);
    }

    public function addCSSFiles(string $template ,string ... $src):string
    {
        $finalSource = '';
        $templateJS = $this->getTemplate(self::CSS_TEMPLATE);
        foreach ($src as $item)
        {
            $finalSource .= $this->putBlock($templateJS,  self::NAME_FILE_PARAM,
                self::FOLDER_CSS.DIRECTORY_SEPARATOR.$item);
        }
        return $this->putBlock($template, self::NAME_CSS_BLOCK, $finalSource);
    }

    public function putBlock(string $template,string $nameBlock, string $block, int $num = 1):string
    {
        $block = str_repeat($block."\n", $num);
        return str_replace('{'.$nameBlock.'}', $block, $template);
    }


    public function makeCompletedHTML(string $template):string
    {
        return preg_replace('#{\w+}#','', $template );
    }

}