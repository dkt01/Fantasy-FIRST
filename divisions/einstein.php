<head>
    <meta http-equiv="refresh" content="90" >
</head>

<body>
<table style="background: black none repeat scroll 0% 50%; -moz-background-clip: initial; width: 100%;" border="0" cellpadding="0" cellspacing="1">
<th colspan = 9 style='background-color:#FFFFFF;'> Einstein Ranks (EIN)</th>
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
        ini_set('memory_limit','40M');
	include("../../../util/simple_html_dom.php");
	$pcachefile = "../ffpicks.xml";
	$players = simplexml_load_file($pcachefile);
	$hcachefile = "../cachepages/einsteinr.html";
	$xmlcachefile = "../cachepages/einsteinr.xml";
	$cachelife = 60;
	$p = 0;
	
	$rankingsfile = "http://www2.usfirst.org/2013comp/Events/Einstein/rankings.html";
	
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
			echo"<tr colspan = 9 style='background-color:#FFFFFF;'><td> Not yet avaliable... </td></tr>";
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
			
			$p4 = $pind->curie->cp1;
			$p5 = $pind->curie->cp2;
			$p6 = $pind->curie->cp3;
			
			$p7 = $pind->galileo->gp1;
			$p8 = $pind->galileo->gp2;
			$p9 = $pind->galileo->gp3;
			
			$p10 = $pind->newton->np1;
			$p11 = $pind->newton->np2;
			$p12 = $pind->newton->np3;
			
			$p1 = intval($p1);
			$p2 = intval($p2);
			$p3 = intval($p3);
			$p4 = intval($p4);
			$p5 = intval($p5);
			$p6 = intval($p6);
			$p7 = intval($p7);
			$p8 = intval($p8);
			$p9 = intval($p9);
			$p10 = intval($p10);
			$p11 = intval($p11);
			$p12 = intval($p12);
			
			
			if(($tnum == $p1) OR ($tnum == $p2) OR ($tnum == $p3) OR ($tnum == $p4) OR ($tnum == $p5) OR ($tnum == $p6) OR
			   ($tnum == $p7) OR ($tnum == $p8) OR ($tnum == $p9) OR ($tnum == $p10) OR ($tnum == $p11) OR ($tnum == $p12))
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