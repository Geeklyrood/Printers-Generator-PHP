<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Printers Generator</title>
        <link href="css/printersGen.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        <?php
        
        $fp = fopen("printers.txt", "r");
        
        $ips = array();
        $pTypes = array();
        $buildings = array();
        $roomNums = array();
        
        $printersInBuildings = array();
        
        while(!feof($fp)) {
          
          $line = rtrim(fgets($fp));
          
          if($line) {
            list($ip, $host, $pType, $building, $roomNum) = explode(",", $line);
          
            $ips[$host] = $ip;
            $pTypes[$host] = $pType;
            $buildings[$host] = $building;
            $roomNums[$host] = $roomNum;
          }
          
          
          
        }
        
        ?>
    </body>
</html>
