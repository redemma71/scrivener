<?php

    include('./Item.php');
    include('./MultipleChoice.php');

    $itemXML = new Item;
    $msXML = new MultipleChoice('multi');
    $msItem = $msXML->generate($itemXML->generate());
    print $msItem;
    $item2XML = new Item;
    $ssXML = new MultipleChoice('single');
    $ssItem = $ssXML->generate($item2XML->generate());
    print $ssItem;

?>