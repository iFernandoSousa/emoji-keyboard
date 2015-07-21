<?php
$emojiData = json_decode(file_get_contents("../emoji-data/emoji.json"));
$emojione = json_decode(file_get_contents("../emoji-data/emojione/emoji.json"));

$unified = array();

foreach($emojione as $key => $data) {
    $emoji = new Emoji();

    $emoji->addUnicode($data->unicode);
    $emoji->addUnicodeAlternative($data->unicode_alternates);
    $emoji->addName($data->name);

    $emoji->addShortname(str_replace(":","",$data->shortname));

    $emoji->category = $data->category;
    $emoji->categoryOrder = $data->category_order;

    $emoji->keywords = $data->keywords;

    $unified[$data->unicode] = $emoji;
}
foreach($emojiData as $key => $data) {
    if(!empty($unified[$data->unified])) {
        $emoji = $unified[$data->unified];
    } else {
        $emoji = new Emoji();
    }

    $emoji->addUnicode($data->unified);
    $emoji->addUnicodeAlternative($data->variations);
    $emoji->addName($data->name);
    $emoji->docomo = $data->docomo;
    $emoji->au = $data->au;
    $emoji->softbank = $data->softbank;
    $emoji->google = $data->google;

    $emoji->addShortname($data->short_name);
    foreach((array) $data->short_names as $short)
        $emoji->addShortname($short);

    $emoji->imageFile = $data->image;
    $emoji->sheetX = $data->sheet_x;
    $emoji->sheetY = $data->sheet_y;

    $emoji->addVariations($data->skin_variations);

    $emoji->clean();

    $unified[$data->unified] = $emoji;
}

$newJson = json_encode(array_values($unified));

$jsonFile = fopen("../src/json/emoji.json", "w") or die("Unable to open file!");
fwrite($jsonFile, $newJson);
fclose($jsonFile);

include("../assets/nicejson.php");

$jsonFile = fopen("../src/json/emoji-pretty.json", "w") or die("Unable to open file!");
fwrite($jsonFile, json_format($newJson));
fclose($jsonFile);

$testJson = json_decode($newJson);
if(json_last_error()) {
    echo "Something went wrong";
} else {
    echo "Successfully updated emoji.json";
}

/** @var $emoji Emoji */
$cats = new stdClass();
foreach($unified as $emoji) {
    $cat = $emoji->category;
    if($cat) {
        if(!isset($cats->$cat))
            $cats->$cat = array();

        array_push($cats->$cat, $emoji);
    } else {
        var_dump($emoji);
    }
}
var_dump($cats);
//Sort the cats for easy use.
foreach($cats as $cat) {
    usort($cat, function($a, $b) {
        return strcmp($a->categoryOrder, $b->categoryOrder);
    });
}

$newJson = json_encode(array_values($cats));

$jsonFile = fopen("../src/json/categorized.json", "w") or die("Unable to open file!");
fwrite($jsonFile, $newJson);
fclose($jsonFile);


class Emoji {
    public $unicode;
    public $unicodeAlternatives = array();
    public $docomo;
    public $au;
    public $softbank;
    public $google;

    public $name;
    public $alternatives = array();
    public $shortname;
    public $shortnameAlternatives = array();
    public $category;
    public $categoryOrder;

    public $imageFile;
    public $sheetX;
    public $sheetY;

    public $keywords; //short_names

    public $skinVariations = array();

    public function addName($name) {
        $name = strtolower($name);

        if(empty($this->name)) {
            $this->name = $name;
        } else {
            if($this->name != $name && array_search($name, $this->alternatives) === false)
                $this->alternatives[] = $name;
        }
    }

    public function addUnicode($unicode) {
        if(empty($this->unicode)) {
            $this->unicode = $unicode;
        } else {
            if($this->unicode != $unicode && array_search($unicode, $this->unicodeAlternatives) === false)
                $this->unicodeAlternatives[] = $unicode;
        }
    }

    public function addUnicodeAlternative($alternatives) {
        if(!is_array($alternatives))
            $alternatives = array($alternatives);

        foreach($alternatives as $alternative) {
            if(array_search($alternative, $this->unicodeAlternatives) === false)
                $this->unicodeAlternatives[] = $alternative;
        }
    }

    public function addShortname($shortname) {
        if(empty($this->shortname)) {
            $this->shortname = $shortname;
        } else {
            if($this->shortname != $shortname && array_search($shortname, $this->shortnameAlternatives) === false)
                $this->shortnameAlternatives[] = $shortname;
        }
    }

    public function addVariations($variations) {
        if(!empty($variations)) {
            foreach((array)$variations as $variation) {
                $this->skinVariations[] = array(
                    "unicode"   => $variation->unified,
                    "sheetX"    => $variation->sheet_x,
                    "sheetY"    => $variation->sheet_y,
                );
            }
        }
    }

    public function clean() {
        foreach($this as $var => $value) {
            if(empty($value))
                $this->$var = null;
        }
    }
}