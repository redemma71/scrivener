<?php

function generateCGI() {
        // curl call to cgi generator
        $curlSession = curl_init();
        curl_setopt($curlSession,CURLOPT_URL,"http://cms.cengage.info/cgi/v2/create/1");
        curl_setopt($curlSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curlSession,CURLOPT_HEADER,false);
        $newCGI = curl_exec($curlSession);
        $newCGI = str_replace("\r","",$newCGI);
        $newCGI = str_replace("\n","",$newCGI);
        curl_close($curlSession);
        return $newCGI;
    }

?>