<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 02.12.2018
 * Time: 19:55
 */

class MakerOnOnePage implements MakerPage
{
    const FOLDER = 'on_one_computer';
    const JS_JQUERY = 'jquery-3.3.1.min.js';

    const ON_ONE_TEMPLATE = 'on_one_computer.html';
    const CONTAINER_SQUARE_TEMPLATE = 'container_square.html';
    const PLAY_AREA_TEMPLATE = 'play_area.html';

    public function getPage(): string
    {
        $templateEngine = new TemplateEngine();

        $cellTemplate = $templateEngine->getTemplate(self::FOLDER.DIRECTORY_SEPARATOR.
            self::CONTAINER_SQUARE_TEMPLATE);
        $playAreaTemplate = $templateEngine->getTemplate(self::FOLDER.DIRECTORY_SEPARATOR.
            self::PLAY_AREA_TEMPLATE);
        $onOneTemplate = $templateEngine->getTemplate(self::FOLDER.DIRECTORY_SEPARATOR.
            self::ON_ONE_TEMPLATE);

        $playAreaTemplate = $templateEngine->putBlock($playAreaTemplate,
            'containerSquare', $cellTemplate, ConstantsGame::SIZE_FIELD**2);
        $onOneTemplate = $templateEngine->putBlock($onOneTemplate,
            'playAreas', $playAreaTemplate, 2);

        $mainTemplate = $templateEngine->getMainTemplate();
        $mainTemplate = $templateEngine->addCSSFiles($mainTemplate,'styles.css');
        $mainTemplate = $templateEngine->addJSFiles($mainTemplate,  self::JS_JQUERY,'main.js');


        $doc = $templateEngine->putBlock($mainTemplate,
            TemplateEngine::NAME_BODY_BLOCK, $onOneTemplate);

        return $templateEngine->makeCompletedHTML($doc);
    }
}