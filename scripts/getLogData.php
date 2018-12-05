<?php

function log_retriever($drawer_id){
    $dom = new DomDocument;
    $url = "http://kiosk.aut.ac.nz/LockerBox/Drawers/Logs/".$drawer_id;
    $html = file_get_contents($url);
    $dom->loadHTML($html);
    $dom->preserveWhiteSpace = false;
    return get_log_data($dom);
}

function get_log_data($dom) {
    $log_data = null;
    $td_tags = $dom->getElementsByTagName('td');
    if (is_object($td_tags->item(0))){
        $value = $td_tags->item(0)->textContent;
        $log_data[0] = $value;
    }
    if (is_object($td_tags->item(1))){
        $value = $td_tags->item(1)->textContent;
        $log_data[1] = $value;
    }    
    return $log_data;
}

ini_set('max_execution_time', 0);
$laptop_list = json_decode($_GET['laptopList']);
$output = array();
$count = 0;
foreach ($laptop_list as $drawer_id){
    $output[$count] = log_retriever($drawer_id);
    $count++;
}
echo json_encode($output);
?>