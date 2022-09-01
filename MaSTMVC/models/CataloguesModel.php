<?php

namespace app\models;

require_once ("core/Model.php");
require_once ("core/Catalogue.php");


use app\core\Application;
use app\core\Catalogue;
use app\core\Model;

class CataloguesModel extends Model
{
    public function getUserCatalogues() : string
    {
        $db = Application::$app->db;
        $userId = Application::$app->user->id;

        $result = $db->executeQuery("select DISTINCT name from catalogue where id_user=$userId ");
        $HtmlCode = "";
        for($i = 0; $i < count($result) ; ++$i){
            $catalogue = new Catalogue($userId, $result[$i]["name"]);
            $HtmlCode .= $catalogue->getHtmlCode();
        }
        return $HtmlCode;
    }

    public function rules(): array
    {
        return [];
    }
}