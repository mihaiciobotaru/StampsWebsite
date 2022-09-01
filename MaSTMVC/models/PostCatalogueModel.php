<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class PostCatalogueModel extends Model
{

    public string $title;
    public string $userId;

    public function __construct()
    {
        $this->userId = Application::$app->user->id;
    }


    public function rules(): array
    {
        return [];
    }

    public function postCatalogueData()
    {
        $statement = Application::$app->db->prepare("INSERT INTO `catalogue` (`id`, `name`, `id_user`, `id_stamp`, `created_datetime`) VALUES (NULL, '$this->title', '$this->userId', '', CURRENT_DATE())");
        $statement->execute();
    }
}