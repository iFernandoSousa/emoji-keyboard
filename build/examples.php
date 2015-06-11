<?php
$emoji = json_decode(file_get_contents("../emoji.json"));

$sheets = array("apple", "emojione", "google", "twitter");
$sizes = array(16, 20, 32, 64);
/*
 * Generate basic example to demonstrate the css
 */

foreach($sheets as $sheet) {
    echo "Building ". $sheet ." example...<br>";
    $css = fopen("../examples/basic/". $sheet .".html", "w");

    fwrite($css, "
        <!doctype html>
        <html>
        <head>
            <title>Basic example ". $sheet ."</title>
            <link rel='stylesheet' href='/css/emoji-".$sheet.".css'>
        </head>
        <body>
            <h1>Basic example ". $sheet ."</h1>");

    foreach($sizes as $size) {
        fwrite($css, "
            <h2>Size ". $size ."</h2>
            <div class='emoji-container emoji-".$size."'>");

        foreach($emoji as $item) {
            fwrite($css, "
            <i class='emoji e".$item->unicode." '></i>");

            foreach($item->skinVariations as $variation)
                fwrite($css, "
            <i class='emoji e".$variation->unicode." '></i>");
        }

        fwrite($css, "
            </div>");
    }
    fwrite($css, "
        </body>
        </html>");
}
?>
<link href="../src/css/emoji-apple.css" rel="stylesheet"
