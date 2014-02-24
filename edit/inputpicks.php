<html>
<head>
<title> Update Picks </title>
<link rel="stylesheet" type="text/css" href="../util/style.css">
<style>
#teams ul
{
	list-style: none;
}
#teams li
{
	display: inline;
	color:#E87600;
	font-family:"Arial";
}
.used
{
	/*background:#888888;*/
	background-color:#ff0000;
}
</style>
<script>
	function allowDrop(ev)
	{
		//var el = $(this);
		//el.addClass("used");
		ev.preventDefault();
	}

	function drag(ev,id)
	{
		var orig = document.getElementById(id);

        orig.className += 'used';

        ev.effectAllowed = 'move';
	
		ev.dataTransfer.setData("text/plain",ev.target.id);
	}
	
	function drop(ev)
	{
		ev.preventDefault();
		var data=ev.dataTransfer.getData("Text");
		ev.target.appendChild(document.getElementById(data));
	}
	
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
</script>
</head>
<body class="BackgroundGradient">
<form action="./updatexml.php" method="post">

<table id=rounded-corner>
<thead>
<tr  >
	<th colspan = "35"> Picks </th>
</tr>
<tr  >
	<th rowspan = "2"> Name </th>
	<th> Text Color </th>
	<th> BG Color </th>
	<th colspan = "8" class='archimedes'> Archimedes </th>
	<th colspan = "8" class='curie'> Curie </th>
	<th colspan = "8" class='galileo'> Galileo </th>
	<th colspan = "8" class='newton'> Newton </th>
</tr>
<tr  >
	<th colspan = "2"><a href='http://www.w3schools.com/tags/ref_colornames.asp' target='_new'> Valid HTML Colors </a></th>
	<th colspan = "3" class='archimedes'> Draft </th>
	<th colspan = "5" class='archimedes'> Picks </th>
	<th colspan = "3" class='curie'> Draft </th>
	<th colspan = "5" class='curie'> Picks </th>
	<th colspan = "3" class='galileo'> Draft </th>
	<th colspan = "5" class='galileo'> Picks </th>
	<th colspan = "3" class='newton'> Draft </th>
	<th colspan = "5" class='newton'> Picks </th>
</tr>
</thead>
<tbody>
<?php
			date_default_timezone_set("America/Chicago");
			//ini_set('display_errors', true);
			//ini_set('error_reporting', E_ALL);
			
			$ateamsf = "../divisions/archimedest.xml";
			$cteamsf = "../divisions/curiet.xml";
			$gteamsf = "../divisions/galileot.xml";
			$nteamsf = "../divisions/newtont.xml";
			
			$cachefile = "../ffpicks.xml";
			if($_GET["fail"] == 'true')
			{
				$cachefile = "../ffpicksfail.xml";
				echo "<div style='color:red'><b><i> BAD PASSWORD </b></i></div>";
			}
			$players = simplexml_load_file($cachefile);
			$p = 0;
			
			foreach ($players as $row) //build table based on match data
			{
				echo "<tr style='background-color:". $players->player[$p]->bgcolor . "; color:" .
						$players->player[$p]->textcolor . ";'>";
				
				echo "<td align = 'center'><input type = 'text' size = '10' name = '" . $p . "name' value = '" . 
						$players->player[$p]->name . "' ></td>";
						
				echo "<td align = 'center'><input type = 'text' size = '8' name = '" . $p . "textc' value = '" . 
						$players->player[$p]->textcolor . "' ></td>";
						
				echo "<td align = 'center'><input type = 'text' size = '8' name = '" . $p . "bgc' value = '" . 
						$players->player[$p]->bgcolor . "' ></td>";
				
				//Archimedes
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a1' value = '" . 
						$players->player[$p]->archimedes->ap1 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a2' value = '" . 
						$players->player[$p]->archimedes->ap2 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a3' value = '" . 
						$players->player[$p]->archimedes->ap3 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a4' value = '" . 
						$players->player[$p]->archimedes->ap4 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a5' value = '" . 
						$players->player[$p]->archimedes->ap5 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a6' value = '" . 
						$players->player[$p]->archimedes->ap6 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a7' value = '" . 
						$players->player[$p]->archimedes->ap7 . "' ></td>";
				echo "<td align = 'center' class='archimedes'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "a8' value = '" . 
						$players->player[$p]->archimedes->ap8 . "' ></td>";
				
				//Curie
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c1' value = '" . 
						$players->player[$p]->curie->cp1 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c2' value = '" . 
						$players->player[$p]->curie->cp2 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c3' value = '" . 
						$players->player[$p]->curie->cp3 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c4' value = '" . 
						$players->player[$p]->curie->cp4 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c5' value = '" . 
						$players->player[$p]->curie->cp5 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c6' value = '" . 
						$players->player[$p]->curie->cp6 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c7' value = '" . 
						$players->player[$p]->curie->cp7 . "' ></td>";
				echo "<td align = 'center' class='curie'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "c8' value = '" . 
						$players->player[$p]->curie->cp8 . "' ></td>";
				
				//Galileo
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g1' value = '" . 
						$players->player[$p]->galileo->gp1 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g2' value = '" . 
						$players->player[$p]->galileo->gp2 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g3' value = '" . 
						$players->player[$p]->galileo->gp3 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g4' value = '" . 
						$players->player[$p]->galileo->gp4 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g5' value = '" . 
						$players->player[$p]->galileo->gp5 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g6' value = '" . 
						$players->player[$p]->galileo->gp6 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g7' value = '" . 
						$players->player[$p]->galileo->gp7 . "' ></td>";
				echo "<td align = 'center' class='galileo'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "g8' value = '" . 
						$players->player[$p]->galileo->gp8 . "' ></td>";
				
				//Newton
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n1' value = '" . 
						$players->player[$p]->newton->np1 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n2' value = '" . 
						$players->player[$p]->newton->np2 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n3' value = '" . 
						$players->player[$p]->newton->np3 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n4' value = '" . 
						$players->player[$p]->newton->np4 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n5' value = '" . 
						$players->player[$p]->newton->np5 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n6' value = '" . 
						$players->player[$p]->newton->np6 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n7' value = '" . 
						$players->player[$p]->newton->np7 . "' ></td>";
				echo "<td align = 'center' class='newton'> <input type = 'number' min='1' max='9999' size = '4' maxlength='4' ondrop='drop(ev)' ondragover='allowDrop(ev)' onkeypress='return isNumberKey(event)' name = '" . $p . "n8' value = '" . 
						$players->player[$p]->newton->np8 . "' ></td>";
				
				
				echo "</tr>";
				
				$p = $p + 1;
			};
			echo "</tbody><tfoot><tr colspan='35'  > Password: <input type='password' name = 'pwd'><input type = 'submit' value='Submit'>
					<a href='/fantasyfirst.php'>Cancel  </a></tr>";
			echo "<tr colspan='35'  > <input type='radio'   name='chplayers' value='add'> Add 1 player";  
			echo "<input type='radio' name='chplayers'   value='same' checked> Keep players";
			echo "<input type='radio' name='chplayers'   value='subtract'> Remove 1 player";

			echo "</form></tfoot></table>";
			
			echo "<table style='width: 95%; height: auto' align='center'><thead><tr class='makeorange' ><th colspan='4'> Available Teams </th></tr>";
			echo "<tr  class='makeorange'  align='center'><th>Archimedes</th><th>Curie</th><th>Galileo</th><th>Newton</th></tr></thead><tbody><tr>";

			$ateams = simplexml_load_file($ateamsf);
			$cteams = simplexml_load_file($cteamsf);
			$gteams = simplexml_load_file($gteamsf);
			$nteams = simplexml_load_file($nteamsf);
			
			echo "<td align='center'id='teams'><ul class='teams'>";
			foreach($ateams as $ateam)
			{
				$printme = true;
				$i = 0;
				foreach($players as $pid)
				{
					//echo intval($players[i]->name);
					if(intval($players->player[$i]->archimedes->ap1) == intval($ateam) or
						intval($players->player[$i]->archimedes->ap2) == intval($ateam) or
						intval($players->player[$i]->archimedes->ap3) == intval($ateam))
					{
						$printme = false;
						break;
					}
					$i++;
				}
				if($printme == true)
					echo "<li id='".intval($ateam)."' draggable='true' ondragstart='drag(event,".$ateam.")'>".$ateam."</li>";
			}
			echo "</ul></td>";
			
			echo "<td align='center'id='teams'><ul class='teams'>";
			foreach($cteams as $cteam)
			{
				$printme = true;
				$i = 0;
				foreach($players as $pid)
				{
					//echo intval($players[i]->name);
					if(intval($players->player[$i]->curie->cp1) == intval($cteam) or
						intval($players->player[$i]->curie->cp2) == intval($cteam) or
						intval($players->player[$i]->curie->cp3) == intval($cteam))
					{
						$printme = false;
						break;
					}
					$i++;
				}
				if($printme == true)
					echo "<li id='".intval($cteam)."' draggable='true' ondragstart='drag(event,".$cteam.")'>".$cteam."</li>";
			}
			echo "</ul></td>";
			
			echo "<td align='center'id='teams'><ul class='teams'>";
			foreach($gteams as $gteam)
			{
				$printme = true;
				$i = 0;
				foreach($players as $pid)
				{
					//echo intval($players[i]->name);
					if(intval($players->player[$i]->galileo->gp1) == intval($gteam) or
						intval($players->player[$i]->galileo->gp2) == intval($gteam) or
						intval($players->player[$i]->galileo->gp3) == intval($gteam))
					{
						$printme = false;
						break;
					}
					$i++;
				}
				if($printme == true)
					echo "<li id='".intval($gteam)."' draggable='true' ondragstart='drag(event,".$gteam.")'>".$gteam."</li>";
			}
			echo "</ul></td>";
			
			echo "<td align='center'id='teams'><ul class='teams'>";
			foreach($nteams as $nteam)
			{
				$printme = true;
				$i = 0;
				foreach($players as $pid)
				{
					//echo intval($players[i]->name);
					if(intval($players->player[$i]->newton->np1) == intval($nteam) or
						intval($players->player[$i]->newton->np2) == intval($nteam) or
						intval($players->player[$i]->newton->np3) == intval($nteam))
					{
						$printme = false;
						break;
					}
					$i++;
				}
				if($printme == true)
					echo "<li id='".intval($nteam)."' draggable='true' ondragstart='drag(event,".$nteam.")'>".$nteam."</li>";
			}
			echo "</ul></td>";
			
			echo "</tbody></table>";
		?>
</body>
</html>