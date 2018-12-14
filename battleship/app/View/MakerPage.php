<?php
/**
 *Интерфейс создателя HTML страницы
 */
namespace app\View;

interface MakerPage
{
    public function getPage():string;
}