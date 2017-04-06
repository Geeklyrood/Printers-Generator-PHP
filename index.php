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
            
            if(!isset($printersInBuildings[$building])) {
              $printersInBuildings[$building] = 0;
            }
            
            $printersInBuildings[$building]++;
          }
             
        }
        
        foreach($printersInBuildings as $building=>$numPrinters) {
            
            // Mark up each table
            echo <<<TABLE
            
            <table>
              <tr class="firstRow">
                <td colspan="3">
                  <span class="headerText">$building</span>
                </td>
                <td>
                  # of printers = $numPrinters
                </td>
              </tr>
                    
            
TABLE;
            
            // write the table rows
            foreach($ips as $host=>$ip) {
              
              if($building == $buildings[$host]) {
                
                if($pTypes[$host] == "Lexmark") {
                  $className = "lexmark";
                } else if($pTypes[$host] == "HP LaserJet") {
                  $className = "laserJet";
                } else if($pTypes[$host] == "Epson") {
                  $className = "epson";
                } else {
                  $className = "other";
                }
                
              echo <<<TABLEROW

              <tr>
                <td class="$className">$host</td>
                <td>$ip</td>
                <td>$pTypes[$host]</td>
                <td>$roomNums[$host]</td>
              </tr>
TABLEROW;
              }
            }
            
            echo " </table>";
          } // end of for each building
        
        ?>
     
    </body>
</html>
