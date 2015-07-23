<?php
const UNKNOWN_EMOJI_CATEGORY_DEFAULT_ORDER = 9999;
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
    $emoji->categoryOrder = (int) $data->category_order;

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
foreach($unified as $key => $emoji) {
    if(!isset($emoji->sheetX) || !isset($emoji->sheetY)) {
        unset($unified[$key]);
    }
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

    if(!$cat) {
        if(strpos($emoji->shortname, "man") !== false) {
            $cat = "emoticons";
        } else if (strpos($emoji->name, "modifier") !== false) {
            //We do not include modifiers in this list..
            continue;
        } else {
            $cat = "other";
            var_dump($emoji);
        }
        $emoji->category = $cat;
        $emoji->categoryOrder = UNKNOWN_EMOJI_CATEGORY_DEFAULT_ORDER;
    }


    if($cat) {
        if (!isset($cats->$cat)) {
            $cats->$cat = array();
            $catsString .= ",".$cat;
        }

        $name = (!empty($emoji->name)) ? $emoji->name : $emoji->shortname;
        if($name)
            $cats->$cat += array($name => $emoji->unicode);
    } else {
        var_dump($emoji);
    }

    unset($name, $cat);
}
var_dump($catsString);
//Sort the cats for easy use.
foreach($cats as $key => $cat) {
    $success = usort($cat, function($a, $b) {
        global $unified;
//        var_dump($unified[$a]->categoryOrder, $unified[$b]->categoryOrder,($unified[$a]->categoryOrder > $unified[$b]->categoryOrder)   );
        return $unified[$a]->categoryOrder == $unified[$b]->categoryOrder ? 0 : ( $unified[$a]->categoryOrder > $unified[$b]->categoryOrder ) ? 1 : -1;
    });
    $cats->$key = $cat;
}
var_dump(json_encode($cats));

$newJson = json_encode($cats);

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