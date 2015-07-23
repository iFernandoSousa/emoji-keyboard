<?php
$emoji = json_decode(file_get_contents("../src/json/emoji.json"));

$sheets = array("apple", "emojione", "google", "twitter");
$sizes = array(16, 20, 32, 64);

/*
 * Generate example to demonstrate the supported emoji by css/images
 */
echo "Building supported emoji example...<br>";
$css = fopen("../src/supportedEmoji.html", "w");

fwrite($css, "
    <!doctype html>
    <html>
    <head>
        <title>View the supported emoji</title>
        <link rel='stylesheet' href='css/emoji-".array_shift(array_values($sheets)).".css' id='sheet' >
    </head>
    <body>
        <h1>View the supported emoji</h1>
        <div>
            Select the requested emoji style.<br>");

foreach($sheets as $sheet) {
    fwrite($css, "
            <button onclick='document.getElementById(\"sheet\").setAttribute(\"href\", \"css/emoji-". $sheet .".css\");'>". $sheet ."</button>");
}

fwrite($css, "
        </div>");

foreach($sizes as $size) {
    fwrite($css, "
        <h2>Size ". $size ."</h2>
        <div class='emoji-container emoji-".$size."'>");

    foreach($emoji as $item) {
        if($item->imageFile === null)
            continue;

        fwrite($css, "
        <i class='emoji e".$item->unicode." '></i>");

        foreach((array) $item->skinVariations as $variation)
            fwrite($css, "
        <i class='emoji e".$variation->unicode." '></i>");
    }

    fwrite($css, "
        </div>");
}
fwrite($css, "
    </body>
    </html>");
?>
