<?php

namespace app\controllers;

require_once ("core/Controller.php");
require_once ("core/Request.php");
require_once ("core/Request.php");


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class FunctionController extends Controller
{

    public function likeStamp(Request $request, Response $response)
    {
            if($request->isPost()){
                $body = $request->getBody();
                $stampId = $body['stampId'];
                $userId = $body['userId'];
                $username = Application::$app->user->username;
//                Application::$app->db->createCatalogueRelation("$username`s Liked Stamps", $userId, $stampId);
                $statement = Application::$app->db->prepare("UPDATE stamps SET likes = likes + 1 WHERE id = :stampId");
                $statement->bindValue(":stampId", $stampId);
                $statement->execute();

                header('Content-Type: application/json; charset=utf-8');
               var_dump($body);

//                echo json_encode($body);
            }
    }

}