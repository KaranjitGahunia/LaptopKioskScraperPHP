<?php
    include '../webscraper.php';
    // order of south laptops. used to scrape pages in correct order.
    $laptops = array(26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>South Laptops</title>
    <link href="../style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/xhr.js"></script>
	<script type="text/javascript" src="../scripts/log_retriever.js"></script>
</head>
<body>
    <div class="header" style="background-color: #bc3c3c; color: #bc3c3c;">
        <a class="logo">Laptop Kiosk Site</a>
        <div class="header-right">
            <a class="blacktext header-citybutton" href="../city/">City</a>
            <a class="blacktext header-northbutton" href="../north/">North</a>
            <a class="active" href="">South</a>
        </div>
    </div>
    <?php scrape_kiosk_data($laptops); ?>
    <div class="footer" style="background-color: #bc3c3c;">
        <div class="footerinfo">
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/Racks">All Racks</a>
            <a>|</a>
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/">All Kiosks</a>
        </div>
    </div>
    <div hidden id="laptoplist"><?php echo json_encode($laptops);?></div>
</body>
</html>