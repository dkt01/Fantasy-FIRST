<head>
    <meta http-equiv="refresh" content="90" >
</head>

<body>
<table style="background: black none repeat scroll 0% 50%; -moz-background-clip: initial; width: 100%;" border="0" cellpadding="0" cellspacing="1">
<th colspan = 9 style='background-color:#FFFFFF;'> Archimedes Ranks (ARC)</th>
<!--<tr>
	<th> Rank </th>
	<th> Team </th>
	<th> QS </th>
	<th> AP </th>
	<th> CP </th>
	<th> TP </th>
	<th> Record </th>
	<th> DQ </th>
	<th> Played </th>
</tr>-->

<?php
	date_default_timezone_set("America/Chicago");
	ini_set('display_errors', true);
	ini_set('error_reporting', E_ALL);
        ini_set('memory_limit','25M');
	include("../../../util/simple_html_dom.php");
	$pcachefile = "../ffpicks.xml";
	$players = simplexml_load_file($pcachefile);
	$hcachefile = "../cachepages/archimedesr.html";
	$xmlcachefile = "../cachepages/archimedesr.xml";
	$cachelife = 60;
	$p = 0;
	
	$rankingsfile = "http://www2.usfirst.org/2013comp/Events/Archimedes/rankings.html";
	
	//Update Cache file so we don't spam source website
	if (!file_exists($hcachefile) or ((time() - filectime($hcachefile) >= $cachelife)))
    //disabled updating for off-season
    {
        $ch = curl_init();	//Server settings require all this cURL stuff
		$timeout = 5; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $rankingsfile);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
        $dfile = fopen($hcachefile, 'w');	//Update cache file
        fwrite($dfile, $data);
        fclose($dfile);
    
		$html = new DOMDocument;
		$html = file_get_html($hcachefile);
		if($html->find('table'))
			$tables = $html->find('table');
		else
		{
			echo"<tr colspan = 9 style='background-color:#FFFFFF;'><td> Not yet avaliable... </td></tr></table>";
			exit;
		}
		$rtable = $tables[2];	//isolate table with info
		$html = str_get_html($rtable);
		
		$rows = $html->find('tr');
	
		$i = 0;
	
		$newxml = new DOMDocument('1.0');
		$newxml->formatOutput = true;
		
		$root = $newxml->createElement("ranks");
		$root = $newxml->appendChild($root);
		
		foreach($rows as $row)
		{
			if($i != 0)
			{
				$ranktag = $newxml->createElement("rank");
				$ranktag = $root->appendChild($ranktag);
				
				$html = str_get_html($row);
				$cells = $html->find('td');
				$j = 0;
				foreach($cells as $cell)
				{
					$attribute = $newxml->createElement('r' . ($j+1));
					$attribute = $ranktag->appendChild($attribute);
					//populate attribute
					$text = $newxml->createTextNode(str_get_html($cell)->plaintext);
					$text = $attribute->appendChild($text);
					$j++;
				}
			}
			$i++;
		}
		//echo $newxml->savexml();
		$newxml->save($xmlcachefile);
	}
	
	if (!file_exists($xmlcachefile) or ((time() - filectime($xmlcachefile) >= 2*$cachelife)))
	{
		echo"<tr colspan = 9 style='background-color:#FFFFFF;'><td> Not yet avaliable... </td></tr></table>";
	}
	else
	{
	$allrankings = simplexml_load_file($xmlcachefile);
	
	function colorrow($tnum, $inplayers)
	{
		if($tnum != "Team")
			$tnum = intval($tnum);
		//echo " ~~~" . $tnum . "~~~ ";
		
		foreach($inplayers as $pind)
		{
			$p1 = $pind->archimedes->ap1;
			$p2 = $pind->archimedes->ap2;
			$p3 = $pind->archimedes->ap3;
			
			$p1 = intval($p1);
			$p2 = intval($p2);
			$p3 = intval($p3);
			
			//echo $pind->name . "\t" . $pind->archimedes->ap1 . ' ' . $pind->archimedes->ap2 . ' ' . $pind->archimedes->ap3 . "\n";
			
			if(($tnum == $p1) OR ($tnum == $p2) OR ($tnum == $p3))
			{
				//echo(" ~SUCCESS~ ");
				return("<tr style='background-color:". $pind->bgcolor . "; color:" .$pind->textcolor . ";'>");
			}
		}
		return("<tr style='background-color:#FFFFFF;'>");
	}
	
	foreach($allrankings as $rind)
	{
		echo colorrow(($rind->r2), $players);
		
		foreach($rind as $cind)
		{
			echo "<td align='center'> " . $cind . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	}
?>
</body>