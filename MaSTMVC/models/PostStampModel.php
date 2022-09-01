<?php

namespace app\models;

require_once("core/Model.php");
require_once("core/Application.php");


use app\core\Application;
use app\core\Model;

class PostStampModel extends Model
{
    public string $name;
    public string $ownerId = '';
    public string $postedId = '';
    public string $country;
    public string $category;
    public string $color;
    public string $height;
    public string $width;
    public string $price;
    public string $perforations;
    public string $issuedDateTime;
    public string $uploadCover;

    public function __construct()
    {
        $this->ownerId = Application::$app->user->id;
    }

    public function rules(): array
    {
    }

    public function postStampData()
    {
        $statement = Application::$app->db->prepare("
INSERT INTO 
    `stamps`
    (`id`, `name`, `country`, `owner_id`, `posted_id`, `category`, `color`, `likes`, `width`, `height`, `price`, `perforations` ,`posted_datetime`, `issued_datetime`) 
VALUES
    (NULL, '$this->name', '$this->country', '$this->ownerId', '$this->postedId', '$this->category', '$this->color', '', '$this->width', '$this->height', '$this->price', '$this->perforations', CURRENT_DATE(), '$this->issuedDateTime')");
        $statement->execute();
        $this->id = Application::$app->db->executeQuery("select id from stamps where name='$this->name'")[0]["id"];
    }


}