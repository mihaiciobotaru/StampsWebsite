<?php

namespace app\core;

use app\core\Application;

class Stamp
{
    public string $id = 'null';
    public string $name = 'null';
    public string $country = 'null';
    public string $category = 'null';
    public string $color = 'null';
    public string $width = 'null';
    public string $height = 'null';
    public string $price = 'null';
    public string $perforations = 'null';
    public string $issued = 'null';

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct' . $numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct4($mName, $mCountry, $mCategory, $mColor): void
    {
        $this->name = $mName;
        $this->country = $mCountry;
        $this->category = $mCategory;
        $this->color = $mColor;
    }

    public function __construct1($query): void
    {
        $this->id = $query["id"];
        $this->name = $query["name"];
        $this->country = $query["country"];
        $this->category = $query["category"];
        $this->color = $query["color"];
        $this->width = $query["width"];
        $this->height = $query["height"];
        $this->price = $query["price"];
        $this->perforations = $query["perforations"];
        $this->issued = $query["issued_datetime"];
    }

    public static function constructCollection($query): array
    {
        $collection = [];
        for ($i = 0; $i < count($query); ++$i) {
            $stamp = new Stamp($query[$i]);
            array_push($collection, $stamp);
        }
        return $collection;
    }

    public static function attributes(): array
    {
        return [
            'name', 'country', 'category',
            'color', 'width', 'height', 'price',
            'perforations', 'issued'
        ];
    }

    public function values(): array
    {
        return [
            $this->name, $this->country, $this->category,
            $this->color, $this->width, $this->height, $this->price,
            $this->perforations, $this->issued
        ];
    }

    ///
    /// FILE MANIPULATION
    ///

    /**
     * @throws DOMException
     */
    public function parseRSS()
    {
        $attributes = Stamp::attributes();
        $values = $this->values();

        Application::$app->rssfeed .= "<item>";
        for ($i = 0; $i < count($attributes) - 2; ++$i) {
            Application::$app->rssfeed .= "<$attributes[$i]>";
            Application::$app->rssfeed .= "<$values[$i]>";
            Application::$app->rssfeed .= "</$attributes[$i]>";
        }
        Application::$app->rssfeed .= "</item>";
    }

    public static function parseRSSs($collection)
    {

        for ($i = 0; $i < count($collection); ++$i) {
            $collection[$i]->parseRss();
        }
    }

    public function parseXML($name): void
    {
        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        $dom->xmlVersion = '1.0';
        $dom->formatOutput = true;

        $root = $dom->createElement('Stamp');
        $attributes = StampN::attributes();
        $values = $this->values();


        for ($i = 0; $i < count($attributes); ++$i) {
            $attr = $dom->createElement($attributes[$i], $values[$i]);
            $root->appendChild($attr);
        }

        $dom->appendChild($root);
        $dom->save($name . '.stp');
    }

    static public function loadFile($path): StampN
    {

        $xmlData = simplexml_load_file($path) or die("Failed to load");
        $attributes = StampN::attributes();

        $name = 'null';
        $country = 'null';
        $category = 'null';
        $color = 'null';
        $width = 'null';
        $height = 'null';
        $price = 'null';
        $perforations = 'null';
        $issued = 'null';

        for ($i = 0; $i < count($attributes); $i++) {
            $attr_name = $attributes[$i];
            $$attr_name = $xmlData->$attr_name;
        }

        return new Stamp($name, $country, $category, $color);
    }

    ///
    /// HTML CODE
    ///

    public static function getShortHTMLCode($stamp): string
    {
        return
            "
      <div class=\"stamp-card card1 trigger\" id=\"trigger$stamp->id\" style=\"margin: 15px\">
            <div class=\"stamp-card-image\">
                <img src=\"http://localhost/MaSTMVC/views/assets/stampimages/image$stamp->id.png\" alt=\"\" width='100' height='100'/>
            </div>
            <div class=\"stamp-card-title\">
                $stamp->name 
            </div>
            <div class=\"stamp-card-price\">
                $stamp->price
            </div>
            <div class=\"stamp-card-country\">
                $stamp->country 
            </div>
        </div>  
        " . $stamp->generateModalcontent() . $stamp->generateScriptCode();
    }

    static public function renderShortStamps($collection, $target): string
    {

        $result = "";
        for ($i = 0; $i < count($collection); ++$i) {

            $result .= Stamp::getShortHTMLCode($collection[$i]);
        }
        echo $result;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$target.php";
        return str_replace('{{stamps}}', $result, ob_get_clean());
    }

    private function generateScriptCode()
    {
        $userId = Application::$app->user->id ?? 0;
        return "<script>

const modal$this->id = document.getElementById('modal$this->id');
const trigger$this->id = document.getElementById('trigger$this->id');
const closeButton$this->id = document.getElementById('$this->id-close-button');


function toggleModal() {
	modal$this->id.classList.toggle('show-modal');
}

function likeStamp(){
  let url = '/MaSTMVC/index.php/likeStamp';
    let formData$this->id = new FormData();
formData$this->id.append('userId', '$userId');
formData$this->id.append('stampId', '$this->id');


fetch(url, { method: 'POST', body: formData$this->id })
.then(function (response) {
  return response.text();
})
.then(function (body) {
  console.log(body);
});
}

function windowOnClick(event) {
	if (event.target === modal$this->id) {
		toggleModal();
	}
}

trigger$this->id.addEventListener('click', toggleModal);
closeButton$this->id.addEventListener('click', toggleModal);
window.addEventListener('click', windowOnClick);
                </script>
";
    }

    private function generateModalcontent()
    {
        return "<div class=\"modal\" id=\"modal$this->id\">
    <div class=\"modal-content\">
        <span class=\"close-button\" id=\"$this->id-close-button\">×</span>
        <h1>$this->name</h1>
        <div class=\"modal-wrapper\">
            <div class=\"modal-description\">
                <img
                        src=\"http://localhost/MaSTMVC/views/assets/stampimages/image$this->id.png\"
                        alt=\"\"
                        class=\"modal-image\"
                />
                <br />
                <strong>Description: </strong>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Dolorem, eum.
                </p>
            </div>
            <div class=\"modal-details\">
                <table>
                    <tbody>
                    <tr>
                        <th>Date of Issue:</th>
                        <td>$this->issued</td>
                    </tr>
                    <tr>
                        <th>Perforations:</th>
                        <td>$this->perforations</td>
                    </tr>
                    <tr>
                        <th>Category:</th>
                        <td>$this->category</td>
                    </tr>
                    <tr>
                        <th>Color:</th>
                        <td>$this->color</td>
                    </tr>
                    <tr>
                        <th>Height/Width:</th>
                        <td>$this->height / $this->width</td>
                    </tr>
                    <tr>
                        <th>Price:</th>
                        <td>$this->price</td>
                    </tr>
                    </tbody>
                </table>
                <div style=\"display:flex;justify-content: space-evenly; flex-wrap: wrap;\">
                <div style=\"display:block\"><button class=\"modal-button\">Download</button></div>
                <div style=\"display:block\"><button class=\"modal-button\" onclick=\"likeStamp()\">Like</button></div>
                <div style=\"display:block\"><button class=\"modal-button\">Add </button></div>
                </div>
            </div>
        </div>
    </div>
</div>";
    }
}
