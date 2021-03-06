<?php
/*---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Project URI: http://altocms.com
 * @Description: Advanced Community Engine
 * @Copyright: Alto CMS Team
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 * Based on
 *   LiveStreet Engine Social Networking by Mzhelskiy Maxim
 *   Site: www.livestreet.ru
 *   E-mail: rus.engine@gmail.com
 *----------------------------------------------------------------------------
 */

/**
 * Модуль Tools - различные вспомогательные методы
 *
 * @package modules.tools
 * @since   1.0
 */
class ModuleTools extends Module {
    /**
     * Инициализация
     *
     */
    public function Init() {

    }

    /**
     * Строит логарифмическое облако - расчитывает значение size в зависимости от count
     * У объектов в коллекции обязательно должны быть методы getCount() и setSize()
     *
     * @param aray $aCollection    Список тегов
     * @param int  $iMinSize       Минимальный размер
     * @param int  $iMaxSize       Максимальный размер
     *
     * @return array
     */
    public function MakeCloud($aCollection, $iMinSize = 1, $iMaxSize = 10) {
        if (count($aCollection)) {
            $iSizeRange = $iMaxSize - $iMinSize;

            $iMin = 10000;
            $iMax = 0;
            foreach ($aCollection as $oObject) {
                if ($iMax < $oObject->getCount()) {
                    $iMax = $oObject->getCount();
                }
                if ($iMin > $oObject->getCount()) {
                    $iMin = $oObject->getCount();
                }
            }
            $iMinCount = log($iMin + 1);
            $iMaxCount = log($iMax + 1);
            $iCountRange = $iMaxCount - $iMinCount;
            if ($iCountRange == 0) {
                $iCountRange = 1;
            }
            foreach ($aCollection as $oObject) {
                $iTagSize = $iMinSize + (log($oObject->getCount() + 1) - $iMinCount) * ($iSizeRange / $iCountRange);
                $oObject->setSize(round($iTagSize));
            }
        }
        return $aCollection;
    }

    /**
     * Преобразует спец символы в html последовательнось, поведение аналогично htmlspecialchars,
     * кроме преобразования амперсанта "&"
     *
     * @param string $sText
     *
     * @return string
     */
    public function Urlspecialchars($sText) {
        $aTable = get_html_translation_table();
        unset($aTable['&']);
        return strtr($sText, $aTable);
    }

    /**
     * Удаляет из строки все теги, используется как аналог strip_tags там,
     * где последний удаляет часть текста вместе с не валидными тегами, например
     * при обработке строки ">>> Hello <<<". Подробнее в задаче #151
     * {@see https://github.com/altocms/altocms/issues/151}
     *
     * @param $sText
     * @param null $aError
     * @return string
     */
    public function RemoveAllTags($sText, &$aError = null) {
        F::File_IncludeLib('Jevix/jevix.class.php');

        /** @var Jevix $oJevix */
        $oJevix = new Jevix();

        return htmlspecialchars_decode($oJevix->parse($sText, $aError));
    }

}

// EOF