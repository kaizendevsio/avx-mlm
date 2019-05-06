<?php
foreach (glob("assets/js/Vendor/Master/*.js") as $filename)
{
    // echo $filename;
    echo '
<script src="' . $filename . '" type="text/javascript"></script>';
}

foreach (glob("assets/js/AppServices/*.js") as $filename)
{
    // echo $filename;
    echo '
<script src="' . $filename . '" type="text/javascript"></script>';
}

echo '
<script src="assets/js/App.js" type="text/javascript"></script>';
?>