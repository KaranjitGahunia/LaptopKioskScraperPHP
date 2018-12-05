<?php
    include '../webscraper.php';
    // order of north laptops. used to scrape pages in correct order.
    $laptops = array(57,58,59,60,62,63,64,65,66,67,61,68,69,70,71,72);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>North Laptops</title>
    <link href="../style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/xhr.js"></script>
	<script type="text/javascript" src="../scripts/log_retriever.js"></script>
</head>
<body>
    <div class="header" style="background-color: #3d8dac; color: #3d8dac;">
        <a class="logo">Laptop Kiosk Site</a>
        <div class="header-right">
            <a class="blacktext header-citybutton" href="../city/">City</a>
            <a class="active" href="">North</a>
            <a class="blacktext header-southbutton" href="../south/">South</a>
        </div>
    </div>
    <?php scrape_kiosk_data($laptops); ?>
    <div class="footer" style="background-color: #3d8dac;">
        <div class="footerinfo">
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/Racks">All Racks</a>
            <a>|</a>
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/">All Kiosks</a>
        </div>
    </div>
    <div hidden id="laptoplist"><?php echo json_encode($laptops);?></div>
</body>
</html>