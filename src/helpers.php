<?php

function getHTMLTemplate($name) {
    return file_get_contents('../resources/' . $name . '.html');
}
