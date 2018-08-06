<?php

class UsersListComponent extends \CBitrixComponent
{
    /**
     * \CBitrixComponent executeComponent
     * перекрывающий метод
     */
    public function executeComponent()
    {
        /**@global $APPLICATION
         */
        global $APPLICATION;

        $APPLICATION->RestartBuffer();
        $this->arResult = $this->getUsersList();

        $this->includeComponentTemplate();
    }

    /**
     * @return string
     *
     * Возвращает строку,содержащую элементы инфоблока и их св-ва
     */
    protected function getUsersList()
    {
        $sResult = "";
        if (CModule::IncludeModule('iblock')) {
            $iBlock = 1;
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
            $arFilter = array("IBLOCK_ID" => $iBlock, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $sResult = $sResult . "ID element: " . $arFields['ID'] . ". User: " . $arFields['NAME'];
                $arProps = $ob->GetProperties();
                $sResult = $sResult . "<br>ID User: " . $arProps['ID']['VALUE'] . ". Name user: " . $arProps['NAME']['VALUE'] . "<br>";
            }
        }
        return $sResult;
    }
}
