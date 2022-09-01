<?php


namespace app\controllers;

require_once("core/Controller.php");
require_once("core/Response.php");
require_once("core/Request.php");
require_once("models/ContactForm.php");
require_once("models/CataloguePageModel.php");
require_once("core/Stamp.php");
require_once("models/User.php");


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Stamp;
use app\models\CataloguePageModel;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    public function home()
    {
        $catalogueController = new CataloguePageModel();

        $db = Application::$app->db;

        $result = $db->executeQuery("select * from stamps order by likes limit 15");
        $stampCollection = Stamp::constructCollection($result);
        $popularStampsHTMLcode = $catalogueController->getHTMLcode($stampCollection);

        $result = $db->executeQuery("select * from users order by create_datetime limit 15");
        $usersCollection1 = User::constructCollection($result);
        $newUsersHTMLcode = User::getCollectionHTMLCode($usersCollection1);

        $result = $db->executeQuery("select * from users order by stamps_owned limit 15");
        $usersCollection2 = User::constructCollection($result);
        $activeUsersHTMLcode = User::getCollectionHTMLCode($usersCollection2);

        $params = [
            'name' => "Radu",
            'popularStamps' => $popularStampsHTMLcode,
            'newUsers' => $newUsersHTMLcode,
            'activeUsers' => $activeUsersHTMLcode

        ];

        Stamp::parseRSSs($stampCollection,"PopularStamps");
        User::parseRSSs($usersCollection1,"NewestUsers");

        $myfile = fopen("rssfeed.xml", "w") or die("Unable to open file!");
        Application::$app->rssfeed.="</channel></rss>";
        fwrite($myfile, Application::$app->rssfeed);
        Application::$app->rssfeed="";

        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect("/" . basename(Application::$ROOT_DIR) . "/index.php/");
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
    public function catalogue(Request $request, Response $response)
    {
        $catalogueController = new CataloguePageModel();
        $stampsHTMLcode = "";
        if(count($request->getBody())>0){

            if ($request->isGet()){
                $catalogueController->loadData($request->getBody());
                $query = $catalogueController->generateQuerry();
                $stampsResult = $catalogueController->generateStamps($query);
                $stampCollection = Stamp::constructCollection($stampsResult);
                $stampsHTMLcode = $catalogueController->getHTMLcode($stampCollection);
            }}else {
            $stampsResult = $catalogueController->generateStamps("SELECT * FROM stamps");
            $stampCollection = Stamp::constructCollection($stampsResult);
            $stampsHTMLcode = $catalogueController->getHTMLcode($stampCollection);

        }

        return $this->render('catalogue', [
            'resultingStamps' => $stampsHTMLcode
        ]);
    }

}
