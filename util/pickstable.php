<div align = 'center'> <a href="../edit/inputpicks.php" align="center">Update Picks</a></div>
	<table border='0' align="center" style="width: 100%; height: 90%; background-color:#000000;">
        <tr>
            <th colspan="33" style="background-color:#FFFFFF;">Our Picks </th>
        </tr>
        <tr>
        	<th rowspan="2" style="background-color:#FFFFFF;"> Name</th>
        	<th colspan="8" style="background-color:#FFFFFF;"> Archimedes</th>
        	<th colspan="8" style="background-color:#FFFFFF;"> Curie</th>
        	<th colspan="8" style="background-color:#FFFFFF;"> Galileo</th>
        	<th colspan="8" style="background-color:#FFFFFF;"> Newton</th>
        </tr>
        <tr>
            <th colspan="3" style="background-color:#FFFFFF;"> Draft </th>
            <th colspan="5" style="background-color:#FFFFFF;"> Picks </th>
            <th colspan="3" style="background-color:#FFFFFF;"> Draft </th>
            <th colspan="5" style="background-color:#FFFFFF;"> Picks </th>
            <th colspan="3" style="background-color:#FFFFFF;"> Draft </th>
            <th colspan="5" style="background-color:#FFFFFF;"> Picks </th>
            <th colspan="3" style="background-color:#FFFFFF;"> Draft </th>
            <th colspan="5" style="background-color:#FFFFFF;"> Picks </th>
        </tr>
        <?php
			date_default_timezone_set("America/Chicago");
			ini_set('display_errors', true);
			ini_set('error_reporting', E_ALL);
			
			$cachefile = "../ffpicks.xml";
			//$cachefile = new DOMDocument();
			//$cachefile->load($xmlfilepath);
			//$players = simplexml_import_dom($cachefile);
			$players = simplexml_load_file($cachefile);
			$p = 0;
			
			foreach ($players as $row) //build table based on match data
			{
				echo "<tr style='background-color:". $players->player[$p]->bgcolor . "; color:" .
						$players->player[$p]->textcolor . ";'>";
				
				echo "<td align = 'center'>" . $players->player[$p]->name . "</td>";
				
				//Archimedes
				echo "<td align = 'center'> <b>" . $players->player[$p]->archimedes->ap1 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->archimedes->ap2 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->archimedes->ap3 . "</b></td>";
				echo "<td align = 'center'>" . $players->player[$p]->archimedes->ap4 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->archimedes->ap5 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->archimedes->ap6 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->archimedes->ap7 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->archimedes->ap8 . "</td>";
				
				//Curie
				echo "<td align = 'center'> <b>" . $players->player[$p]->curie->cp1 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->curie->cp2 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->curie->cp3 . "</b></td>";
				echo "<td align = 'center'>" . $players->player[$p]->curie->cp4 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->curie->cp5 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->curie->cp6 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->curie->cp7 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->curie->cp8 . "</td>";
				
				//Galileo
				echo "<td align = 'center'> <b>" . $players->player[$p]->galileo->gp1 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->galileo->gp2 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->galileo->gp3 . "</b></td>";
				echo "<td align = 'center'>" . $players->player[$p]->galileo->gp4 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->galileo->gp5 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->galileo->gp6 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->galileo->gp7 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->galileo->gp8 . "</td>";
				
				//Newton
				echo "<td align = 'center'> <b>" . $players->player[$p]->newton->np1 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->newton->np2 . "</b></td>";
				echo "<td align = 'center'> <b>" . $players->player[$p]->newton->np3 . "</b></td>";
				echo "<td align = 'center'>" . $players->player[$p]->newton->np4 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->newton->np5 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->newton->np6 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->newton->np7 . "</td>";
				echo "<td align = 'center'>" . $players->player[$p]->newton->np8 . "</td>";
				
				
				echo "</tr>";
				
				$p = $p + 1;
			};
		?>
        <tr>
            <td colspan="33" align="center" style="background-color:#FFFFFF"> Updated <?php echo date("n/j/y H:i:s O") ?> GMT</td>
        </tr>
    </table>
</div>