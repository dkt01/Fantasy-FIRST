<!DOCTYPE html>
<html>
<head>
<title> Fantasy FIRST </title>
<link rel="stylesheet" type="text/css" href="./util/style.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="./util/ffmain.js"></script>
<!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css"> -->
<!-- <link rel="stylesheet" href="./util/pureskin.css"> -->
</head>

<body>

<h1 align="center"> Fantasy <i>FIRST</i> </h1>

<!--<iframe style="width: 100%;" height='500' src='./util/pickstable.php' frameborder = '0'></iframe>-->

<div align = 'center'> <a href="./edit/inputpicks.php" align="center">Update Picks</a></div>
	<table align="center" style="width: 100%;">
        <thead>
        <tr>
            <th colspan="33">Our Picks </th>
        </tr>
        <tr>
        	<th rowspan="2" > Name</th>
        	<th colspan="8" > Archimedes</th>
        	<th colspan="8" > Curie</th>
        	<th colspan="8" > Galileo</th>
        	<th colspan="8" > Newton</th>
        </tr>
        <tr>
            <th colspan="3" > Draft </th>
            <th colspan="5" > Picks </th>
            <th colspan="3" > Draft </th>
            <th colspan="5" > Picks </th>
            <th colspan="3" > Draft </th>
            <th colspan="5" > Picks </th>
            <th colspan="3" > Draft </th>
            <th colspan="5" > Picks </th>
        </tr>
        </thead>
        <tbody>
        <?php
			date_default_timezone_set("America/Chicago");
			ini_set('display_errors', true);
			ini_set('error_reporting', E_ALL);
			
			$cachefile = "./ffpicks.xml";
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
		</tbody>
		<tfoot>
        <tr>
            <td colspan="33" align="center"> Updated <?php echo date("n/j/y H:i:s O") ?> GMT</td>
        </tr>
        </tfoot>
    </table>

<br><br>
<div id='tabs'>
<ul class="tabs">
	<li><a href="#archimedes">Archimedes</a></li>
	<li><a href="#curie">Curie</a></li>
	<li><a href="#galileo">Galileo</a></li>
	<li><a href="#newton">Newton</a></li>
	<li><a href="#einstein">Einstein</a></li>
</ul>
</div>

<!-- tab "panes" -->
<div id="panes">
<div class="main">
	<div id="archimedes"><iframe style="width: 100%;" height="400" src="./divisions/archimedes.php" scrolling="yes" frameborder="0"></iframe></div>
	<div id = "curie"><iframe style="width: 100%;" height="400" src="./divisions/curie.php" scrolling="yes" frameborder="0"></iframe></div>
	<div id = "galileo"><iframe style="width: 100%;" height="400" src="./divisions/galileo.php" scrolling="yes" frameborder="0"></iframe></div>
	<div id = "newton"><iframe style="width: 100%;" height="400" src="./divisions/newton.php" scrolling="yes" frameborder="0"></iframe></div>
	<div id = "einstein"><iframe style="width: 100%;" height="400" src="./divisions/einstein.php" scrolling="yes" frameborder="0"></iframe></div>
</div>
</div>

</body>
</html>