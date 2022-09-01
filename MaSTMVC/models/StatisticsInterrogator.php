<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use DateTime;

class StatisticsInterrogator extends Model
{

    public function getLastStampsPosted()
    {
        $dataPoints = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ];
        $userId = Application::$app->user->id;
        $statement = Application::$app->db->prepare("select DAYNAME(posted_datetime) AS day, count(*) as post_count
        from stamps
        where owner_id=$userId
        group by DAYNAME(posted_datetime)
        limit 7");
        $statement->execute();
        $stampsPostedThisWeek = $statement->fetchAll(\PDO::FETCH_OBJ);

        foreach ($stampsPostedThisWeek as $row) {
            $dataPoints[$row->day] = $row->post_count;
        }


        $graphData = [];

        foreach ($dataPoints as $day => $value) {
            $graphData[] = array("label" => $day, "y" => $value);
        }

        return $graphData;
    }

    public function getLikedStamps()
    {

        $userId = Application::$app->user->id;
        $userName = Application::$app->user->username;
        $statement = Application::$app->db->prepare(" select created_datetime AS day, count(*) as like_count\n"

            . "        from catalogue\n"

            . "        where id_user=$userId AND name='$userName`s Liked stamps'\n"

            . "        group by created_datetime\n"
            . "limit 30");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_OBJ);

        $graphData = [];

        foreach($result as $row){
            $date = DateTime::createFromFormat("Y-m-d", $row->day);
            $graphData[] = array("x" => $date->format("d"), "y" => $row->like_count);
        }

        return $graphData;

    }

    public function rules(): array
    {
        return [];
    }
}