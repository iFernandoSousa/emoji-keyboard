<?php
$emoji = json_decode(file_get_contents("../emoji.json"));

$sheets = array("apple", "emojione", "google", "twitter");
$sizes = array(16, 20, 32, 64);

foreach($sheets as $sheet) {
    echo "Building ". $sheet ."...<br>";
    $file = fopen("../css/emoji-". $sheet .".css", "w");

    foreach($sizes as $size) {
        $fileName = "sheet_".$sheet."_".$size.".png";
        copy("../emoji-data/". $fileName, "../img/".$fileName);
        fwrite($file, "
.emoji-". $size ." .e{
    background-image: url('/../img/'". $fileName .");
    width: ". $size ."px;
    height: ". $size ."px;
    display: -moz-inline-stack;
    display: inline-block;
    vertical-align: top;
    zoom: 1;
}\n");

        foreach($emoji as $item) {
            fwrite($file, ".emoji-". $size ." .emoji.e". $item->unicode . "{background-position:-" . ($item->sheetX * $size) . "px -" . ($item->sheetY * $size) . "px;} ");
            foreach($item->skinVariations as $variation)
                fwrite($file, ".emoji-". $size ." .emoji.e". $variation->unicode . "{background-position:-" . ($variation->sheetX * $size) . "px -" . ($variation->sheetY * $size) . "px;} ");
        }
        fwrite($file, "\n\n");
    }

    fclose($file);
}