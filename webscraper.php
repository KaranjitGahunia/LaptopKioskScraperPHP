<?php

function get_input_tag_by_id($id, $post_data, $dom)
{
    $input_tag = $dom->getElementByID($id);
    $name = $id;
    $value = 'null';
    if ($input_tag != null){
        $value = $input_tag->getAttribute('value');
    }
    $post_data[$name] = $value;
    return $post_data;
}

function get_checkbox_tag_by_id($id, $post_data, $dom)
{
    $input_tag = $dom->getElementByID($id);
    $name = $id;
    $value = 'null';
    if ($input_tag != null){
        $value = $input_tag->hasAttribute('checked');
        if ($value == true){
            $value = 'True';
        } else {
            $value = 'False';
        }
    }
    $post_data[$name] = $value;
    return $post_data;
}

function get_select_tag_by_id($id, $post_data, $dom)
{
    $input_tag = $dom->getElementByID($id);
    $name = $id;
    $value = null;
    if ($input_tag != null){
        $option_tags = $input_tag->getElementsByTagName('option');
        for ($i = 0; $i < $option_tags->length; $i++) 
        {
            if(is_object($option_tags->item($i)) )
            {
                $isSelected = $option_tags->item($i)->attributes->getNamedItem('selected');
                $value = $option_tags->item($i)->attributes->getNamedItem('value')->value;
                if(is_object($isSelected))
                {
                    $value = (int)$value % 3;
                    if ($value === 0){
                        $value = 3;
                    }
                    break;
                }
            }
        }
    }
    $post_data[$name] = $value;
    return $post_data;
}

function tag_finder($drawer_id)
{
    $post_data = array();
    $dom = new DomDocument;
    $url = "http://kiosk.aut.ac.nz/LockerBox/Drawers/Edit/".$drawer_id;
    $html = file_get_contents($url);
    $dom->loadHTML($html); 
    $dom->preserveWhiteSpace = false;

    $post_data = get_checkbox_tag_by_id('IsTakenOut', $post_data, $dom);
    $post_data = get_checkbox_tag_by_id('IsOpen', $post_data, $dom);
    $post_data = get_checkbox_tag_by_id('IsInError', $post_data, $dom);
    $post_data = get_select_tag_by_id('RackId', $post_data, $dom);
    $post_data = get_input_tag_by_id('BarcodeInDrawer', $post_data, $dom);
    $post_data = get_input_tag_by_id('RFIDTagOnItem', $post_data, $dom);
    $post_data = get_input_tag_by_id('StudentIDInLastWithdrawal', $post_data, $dom);
    $post_data = get_input_tag_by_id('Note', $post_data, $dom);
    return $post_data;
}

function scrape_kiosk_data($location_laptops){
    error_reporting(~E_WARNING);

    // stores output. initialise object as null
    $output = null;
    
    $count = 0;
    foreach ($location_laptops as $drawer_id) {
        $output[$count] = tag_finder($drawer_id);
        $count++;
    }

    echo "<table>";
    echo "<tr>";
    echo "<th>Drawer Number</th>";
    echo "<th>Checked Out</th>";
    echo "<th>Open</th>";
    echo "<th>In Error</th>";
    echo "<th>Rack</th>";
    echo "<th>Barcode</th>";
    echo "<th>RFID</th>";
    echo "<th>Student last used</th>";
    echo "<th>Note</th>";
    echo "<th>Drawer Logs <div class=\"loader\"></div></th>";
    echo "<th>Timestamp <div class=\"loader\"></div></th>";
    echo "</tr>";

    $drawer_counter = 1;
    foreach ($output as $drawer){
        echo "<tr>";
        echo "<td><a href=\"http://kiosk.aut.ac.nz/LockerBox/Drawers/Edit/".$location_laptops[$drawer_counter - 1]."\">{$drawer_counter}</a></td>";
        $column_counter = 1;
        foreach ($drawer as $column){
            $column_counter++;
            echo "<td>".$column."</td>";
            if ($column_counter == 9){
                echo "<td class=\"logMessage\"></td>";
                echo "<td class=\"timeStamp\"></td>";
            }
        }
        echo "</tr>";
        $drawer_counter++;
    }
    echo "</table>";
}
?>