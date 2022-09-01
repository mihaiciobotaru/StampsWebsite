<?php

namespace app\core;

class Catalogue
{
    public $name = '';
    public $collection ;

    public function __construct($userId, $catalogueName)
    {
        $db = Application::$app->db;
        $userId = Application::$app->user->id;

        $result = $db->executeQuery("select * from stamps where id=any(select id_stamp from catalogue where id_user=$userId AND name='$catalogueName')");
        $this->collection = Stamp::constructCollection($result);
        $this->name = $catalogueName;
    }

    public function getHtmlCode() : string{
        $catalogueHtmlCode = "";
        $stampsHtmlCode = "";
        for($i = 0; $i < count($this->collection) ; ++$i){
            $stampsHtmlCode .= Stamp::getShortHTMLCode($this->collection[$i]);
        }

        $catalogueHtmlCode .= " <div class=\"horizontal-list\">
                                <div class=\"list-header-container\">
                                    <div class=\"list-buttons\">
                                        <h1 class=\"list-header\">$this->name</h1>
                                        <label class=\"b-contain\">
                                            <input type=\"checkbox\"/>
                                            <div class=\"b-input\"></div>
                                        </label>
                                    </div>
                                    <div class=\"list-buttons\">
                                        <img
                                                src=\"../../views/assets/delete-icon.png\"
                                                alt=\"\"
                                                class=\"icon\"
                                        />
                                        <img
                                                src=\"../../views/assets/download-icon.png\"
                                                alt=\"\"
                                                class=\"icon\"
                                        />
                                    </div>
                                </div>
                                <div class=\"slider\">";
        $catalogueHtmlCode .= $stampsHtmlCode;
        $catalogueHtmlCode .= "</div></div>";
        return $catalogueHtmlCode;
    }
}