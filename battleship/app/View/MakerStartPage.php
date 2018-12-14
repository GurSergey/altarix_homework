<?php
/**
 * создатель страницы
 */
namespace app\View;

class MakerStartPage implements MakerPage
{
    const START_TEMPLATE = 'start.html';

    public function getPage(): string
    {
        $templateEngine = new TemplateEngine();
        $menuBlock = $templateEngine->getTemplate(self::START_TEMPLATE);
        $doc = $templateEngine->putBlock($templateEngine->getMainTemplate(),
            TemplateEngine::NAME_BODY_BLOCK, $menuBlock);

        return $templateEngine->makeCompletedHTML($doc);
    }
}