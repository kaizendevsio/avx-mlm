<?php
foreach (glob("overlays/*.php") as $filename)
{
    include $filename;
}
?>