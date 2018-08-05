<?php

class UsersListComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        global $APPLICATION;

        $APPLICATION->RestartBuffer();
        $this->arResult = $this->getUsersList();

        $this->includeComponentTemplate();
    }

    protected function getUsersList()
    {

        if(CModule::IncludeModule("iblock"))
        {
            $id_block=1;
            $section_id = 0;
            // выберем 10 элементов из папки $ID информационного блока $BID
            $items = GetIBlockElementList($id_block, $section_id, Array("SORT"=>"ASC"), 3);

            $items->NavPrint("пользователи");

            while($arItem = $items->GetNext())
            {
                echo $arItem["ID"]."<br>";
                echo $arItem["NAME"]."<br>";

            }


        }

        if(CModule::IncludeModule('iblock')) {
            $arSort = Array("NAME" => "ASC");
            $arSelect = Array("ID", "NAME");
            $arFilter = Array("IBLOCK_ID" => 1);

            $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arItems = $ob->GetProperties();
                print_r($arFields['NAME']);
                print_r($arFields['ID']);
                print_r($arFields['DISPLAY_PROPERTIES']['NAME']['DISPLAY_VALUE'] );
                print_r($arItems['ID']);print_r($arItems['NAME']);
            }
        }
    //    $arIBlockElement = GetIBlockElement('1');
      //  print_r($arIBlockElement['PROPERTIES']['NAME']['VALUE']);

/*
        return [
            [
                'ID' => 1,
                'NAME' => 'Иван'
            ],
            [
                'ID' => 2,
                'NAME' => 'Петр'
            ],
            [
                'ID' => 3,
                'NAME' => 'Евгений'
            ]
        ];

*/





    }
}
