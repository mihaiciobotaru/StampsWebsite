<?php

namespace app\models;

require_once ("core/Model.php");
require_once ("core/Stamp.php");

use app\core\Application;
use app\core\Model;
use app\core\Stamp;

class StampsModel extends Model
{
    public function getUserStamps() : string
    {
        $db = Application::$app->db;
        $userId = Application::$app->user->id;

        $result = $db->executeQuery("select * from stamps where owner_id=$userId ");
        $collection = Stamp::constructCollection($result);
        $result = "";
        for($i = 0; $i < count($collection) ; ++$i){

            $result .= Stamp::getShortHTMLCode($collection[$i]);
        }
        return $result;
    }

    public function rules(): array
    {
        return [];
    }
}