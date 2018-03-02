<?php

    include('./MultipleChoice.php');

    $msXML = new MultipleChoice('multi');
    $msItem = $msXML->generate();
    print $msItem; 
    $ssXML = new MultipleChoice('single');
    $ssItem = $ssXML->generate();
    print $ssItem;

?>