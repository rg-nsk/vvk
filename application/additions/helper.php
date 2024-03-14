<?
/*
Файл, подключаемый index.php
> содержит класс Helper и методы упрощающие работу
*/

class Helper
{
    public static function convertAdventPeriodToString($adventPeriod)
    {
        $advent = explode("-", $adventPeriod);
        return ($advent[1] == "1" ? "Весна" : "Осень") . " " . $advent[0];
    }

    public static function getPreviousAdventPeriod()
    {
        $advent = explode("-", Database::getCurrentBase());
        return $advent[1] == "1" ? $advent[0]-1 . "-2" :  $advent[0] . "-1";
    }

    public static function formatDateToView($date) {
        return date('d.m.Y', strtotime($date));
    }

    public static function formatDateToBase($date) {
        return date('Y.m.d', strtotime($date));
    }

    public static function getVKNameById($vkId) {
        return Database::execute("SELECT * FROM vkList WHERE id=:id", ["id" => $vkId])[0];
    }

    public static function getVKNames() {
        return Database::execute("SELECT id, name FROM vkList");
    }
}