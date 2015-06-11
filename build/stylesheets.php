<?php
$emoji = json_decode(file_get_contents("../src/emoji.json"));

$sheets = array("apple", "emojione", "google", "twitter");
$sizes = array(16, 20, 32, 64);

foreach($sheets as $sheet) {
    echo "Building ". $sheet ."...<br>";
    $css = fopen("../src/css/emoji-". $sheet .".css", "w");

    foreach($sizes as $size) {
        $fileName = "sheet_".$sheet."_".$size.".png";
        copy("../emoji-data/". $fileName, "../img/".$fileName);
            
        fwrite($css, "
.emoji-". $size ." .emoji{
    background-image: url('img/". $fileName ."');
    width: ". $size ."px;
    height: ". $size ."px;
    display: -moz-inline-stack;
    display: inline-block;
    vertical-align: top;
    zoom: 1;
}\n");

        foreach($emoji as $item) {
            fwrite($css, ".emoji-". $size ." .emoji.e". $item->unicode . "{background-position:-" . ($item->sheetX * $size) . "px -" . ($item->sheetY * $size) . "px;} ");
            foreach($item->skinVariations as $variation)
                fwrite($css, ".emoji-". $size ." .emoji.e". $variation->unicode . "{background-position:-" . ($variation->sheetX * $size) . "px -" . ($variation->sheetY * $size) . "px;} ");
        }
        fwrite($css, "\n\n");
    }

    fclose($css);
}