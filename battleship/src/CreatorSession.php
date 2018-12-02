<?php
/**
 * @author GurSergey
 * Интерфейс создателя новой сессии. Необходи для работы с разными ипами хранилиш
 */
interface CreatorSession
{
    public function createSession():Session;
}