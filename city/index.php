<?php 
    include '../webscraper.php';
    // order of city laptops. used to scrape pages in correct order.
    $laptops = array(1,2,3,4,5,6,7,8,9,10,11,14,13,15,16,17,18,19,20,21,12,22,23,24,25,56,73,74,75,76);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>City Laptops</title>
    <link href="../style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/xhr.js"></script>
	<script type="text/javascript" src="../scripts/log_retriever.js"></script>
</head>  
<body>
    <div class="header" style="background-color: #0072c6; color: #0072c6;">
        <a class="logo">Laptop Kiosk Site</a>
        <div class="header-right">
            <a class="active" href="">City</a>
            <a class="blacktext header-northbutton" href="../north/">North</a>
            <a class="blacktext header-southbutton" href="../south/">South</a>
        </div>
    </div>
    <?php scrape_kiosk_data($laptops); ?>
    <div class="footer" style="background-color: #0072c6;">
        <div class="footerinfo">
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/Racks">All Racks</a>
            <a>|</a>
            <a class="bottombutton blacktext" href="http://kiosk.aut.ac.nz/LockerBox/">All Kiosks</a>
        </div>
    </div>
    <div hidden id="laptoplist"><?php echo json_encode($laptops);?></div>
</body>
</html>