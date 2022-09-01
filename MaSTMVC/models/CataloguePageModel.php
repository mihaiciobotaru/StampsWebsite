<?php

namespace app\models;

require_once ("core/Application.php");

use app\core\Application;
use app\core\db\Database;
use app\core\Model;
use app\core\Stamp;

class CataloguePageModel extends Model
{

    public string $sort;
    public string $country;
    public string $startYear;
    public string $endYear;
    public string $theme;
    public string $color;
    public string $width;
    public string $height;
    public string $searchBar = "";


    public function rules(): array
    {
        return [];
    }
    public function generateStamps($query){
        if($query !== "SELECT * FROM stamps where "){
            $db = Application::$app->db;
            return $db->executeQuery($query);
        }else {
            $query = "SELECT * FROM stamps";
            $db = Application::$app->db;
            return $db->executeQuery($query);
        }

    }
    public function generateQuerry(): string
    {
        $isFirst = true;
        $query = "SELECT * FROM stamps where ";
        if(isset($this->searchBar)){
            if($this->searchBar!=""){
                if ($isFirst) {
                    $query .= "name LIKE '%$this->searchBar%' ";
                    $isFirst = false;
                } else {
                    $query .= "AND name LIKE '%$this->searchBar%' ";
                }
            }
        }
        if(isset($this->country)) {
            if($this->country!="Any"){
                if ($isFirst) {
                    $query .= "country='$this->country' ";
                    $isFirst = false;
                } else {
                    $query .= "AND country='$this->country' ";
                }
            }
        }
        if(isset($this->startYear)) {
            if($this->startYear!="Any") {
                if ($isFirst) {
                    $query .= "issued_datetime >= $this->startYear";
                    $isFirst = false;
                } else {
                    $query .= "AND issued_datetime >= $this->startYear ";
                }
            }
        }

        if(isset($this->endYear)) {
            if ($this->endYear != "Any") {
                if ($isFirst) {
                    $query .= "issued_datetime <= $this->endYear ";
                    $isFirst = false;
                } else
                    $query .= "AND issued_datetime <= $this->endYear ";
            }
        }

        if(isset($this->theme)) {
            if ($this->theme != "Any") {
                if ($isFirst) {
                    $query .= "category='$this->theme' ";
                    $isFirst = false;
                } else {
                    $query .= "AND category='$this->theme' ";
                }
            }
        }

        if(isset($this->color)) {
            if ($this->color != "Any") {
                if ($isFirst) {
                    $query .= "color='$this->color' ";
                    $isFirst = false;
                } else {
                    $query .= "AND color='$this->color' ";
                }
            }
        }


        if(isset($this->width)) {
            if ($this->width != 0) {
                if ($isFirst) {
                    $query .= "width=$this->width ";
                    $isFirst = false;
                } else {
                    $query .= "AND width=$this->width ";
                }
            }
        }

        if(isset($this->height)) {
            if ($this->height != 0) {
                if ($isFirst) {
                    $query .= "height=$this->height ";
                    $isFirst = false;
                } else {
                    $query .= "AND height=$this->height ";
                }
            }
        }

        if(isset($this->sort)){
            if ($this->sort != "Any") {
                if($query == "SELECT * FROM stamps where ")
                    $query = "SELECT * FROM stamps ";
                if ($this->sort == 1) {
                    $query .= "order by likes";
                } else
                    if ($this->sort == 2) {
                        $query .= "order by price";
                    } else
                        if ($this->sort == 3) {
                            $query .= "order by price DESC";
                        } else
                            if ($this->sort == 4) {
                                $query .= "order by country";
                            } else
                                if ($this->sort == 5) {
                                    $query .= "order by country DESC";
                                } else
                                    if ($this->sort == 6) {
                                        $query .= "order by name";
                                    } else
                                        if ($this->sort == 7) {
                                            $query .= "order by name DESC";
                                        }
            }
        }
        if($query == "SELECT * FROM stamps where ")
            $query = "SELECT * FROM stamps ";

        return $query;
    }

    public function getHTMLcode($collection): string
    {
        $result = "";
        for($i = 0; $i < count($collection) ; ++$i){
            $text = Stamp::getShortHTMLCode($collection[$i]);
            $result .= $text;
        }
        return $result;
    }
}