<?php

namespace app\models;

require_once("core/db/DbModel.php");
require_once("core/UserModel.php");

use app\core\Application;
use app\core\db\DbModel;
use app\core\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public int $id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $username = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct0()
    {
    }

    public function __construct1($query)
    {
        $this->firstname = $query["firstname"];
        $this->lastname = $query["lastname"];
        $this->email = $query["email"];
        $this->username = $query["username"];
    }

    public function parseRSS(){
        $attributes = User::attributes();
        $values = $this->values();

        Application::$app->rssfeed.="<item>";
        for($i = 0; $i < count($attributes) - 2 ; ++$i){
            Application::$app->rssfeed.="<$attributes[$i]>";
            Application::$app->rssfeed.="<$values[$i]>";
            Application::$app->rssfeed.="</$attributes[$i]>";
        }
        Application::$app->rssfeed.="</item>";
    }

    public static function parseRSSs($collection){

        for($i = 0; $i < count($collection) ; ++$i){
            $collection[$i]->parseRss();
        }
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }


    public function getCreatedTime()
    {
        $statement = Application::$app->db->prepare("SELECT create_datetime as created FROM users WHERE id=$this->id;");
        $statement->execute();
        return $statement->fetchObject()->created;
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return ['username', 'firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function values(): array
    {
        return [$this->username,$this->firstname, $this->lastname, $this->email, $this->password, $this->status];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword ' => 'Confirm Password'
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public static function getHTMLCode($user): string
    {
        return
            "
        <div class=\"user-card\">
                <div class=\"user-card-image\">
                    <img  class=\"user-img-size\" src=\"../views/assets/blank-profile-picture.png\" alt=\"\" />
                </div>
                <div class=\"user-card-name\">
                        $user->firstname $user->lastname
                </div>
                <div class=\"user-card-username\">$user->username</div>
            </div>
        ";
    }

    public static function constructCollection($query): array
    {
        $collection = [];
        for ($i = 0; $i < count($query); ++$i) {
            $user = new User($query[$i]);
            array_push($collection, $user);
        }
        return $collection;
    }

    public static function getCollectionHTMLCode($collection): string
    {
        $result = "";

        for ($i = 0; $i < count($collection); ++$i) {
            $result .= User::getHTMLCode($collection[$i]);
        }

        return $result;
    }
}
