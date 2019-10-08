<?php

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo "Idioma detectado: ".substr($lang,0,5);
        if (strcmp(substr($lang,0,5), "en-US")==0){
            $lang = "us";
        }else {
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }
    }else{
        $lang = 'en';

    }

    echo "LANG: ".$lang;

?>