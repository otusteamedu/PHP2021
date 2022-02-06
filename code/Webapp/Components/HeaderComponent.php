<?php

namespace code\Components;

Class HeaderComponent {

    public function sendheader($header, $string) {
        header($header);
        echo $string;
        exit();
    }

}
