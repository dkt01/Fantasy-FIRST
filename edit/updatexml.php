<?php
	//header("Content-Type: text/plain");
	ini_set('display_errors', true);
	ini_set('error_reporting', E_ALL);
	$epassword = "omgrobots";
	$oldstuffs = "../ffpicks.xml";
	
	$oldplayers = simplexml_load_file($oldstuffs);
	
	$numplayers = 0;
	foreach($oldplayers as $pind)
		$numplayers++;
	
	//Really simple password control
	if($_POST["pwd"] != $epassword)
	{
		//EVIL PERSON!!!
		header("location: ../edit/inputpicks.php?fail=true");
		echo "BAD PASSWORD!";
		$oldstuffs = "../ffpicksfail.xml";
	}
	else
	{
		header("location: /fantasyfirst.php");
		echo "Updating... <br> You will be redirected...";
		$oldstuffs = "../ffpicks.xml";
	}
	
	$oldplayers = simplexml_load_file($oldstuffs);

	//remove player if prompted
	if(($numplayers > 1) and($_POST["chplayers"] == 'subtract'))
		$numplayers--;
	//Player class to hold all soon-to-be xml info
	class Player
	{
		public $name;
		public $textcolor;
		public $bgcolor;
		public $archimedes;
		public $curie;
		public $galileo;
		public $newton;
		
		//parameterized constructor
		function __construct(
			$name, $textcolor, $bgcolor, $archimedes, $curie, $galileo, $newton)
		{
			if(func_num_args() == 0)
			{
				$this->name = "JohnDoe";
				$this->textcolor = "black";
				$this->bgcolor = "white";
				$this->archimedes = array("4096","4096","4096","4096","4096","4096","4096","4096");
				$this->curie = array("4096","4096","4096","4096","4096","4096","4096","4096");
				$this->galileo = array("4096","4096","4096","4096","4096","4096","4096","4096");
				$this->newton = array("4096","4096","4096","4096","4096","4096","4096","4096");
			}
			else
			{
				$this->name = $name;
				$this->textcolor = $textcolor;
				$this->bgcolor = $bgcolor;
				$this->archimedes = $archimedes;
				$this->curie = $curie;
				$this->galileo = $galileo;
				$this->newton = $newton;
			}
		}
		
		//default constructor
		/*function __construct()
		{
			$this->name = "JohnDoe";
			$this->textcolor = "black";
			$this->bgcolor = "white";
			$this->archimedes = array("4096","4096","4096","4096","4096","4096","4096","4096");
			$this->curie = array("4096","4096","4096","4096","4096","4096","4096","4096");
			$this->galileo = array("4096","4096","4096","4096","4096","4096","4096","4096");
			$this->newton = array("4096","4096","4096","4096","4096","4096","4096","4096");
		}*/
	}
	
	//array of players to be made
	$Players = array();
	
	//make players
	for($i = 0; $i < $numplayers; $i++)
	{
		$newplayer = new Player($_POST[$i . "name"],
								$_POST[$i."textc"],
								$_POST[$i."bgc"],
								array($_POST[$i."a1"],
									  $_POST[$i."a2"],
									  $_POST[$i."a3"],
									  $_POST[$i."a4"],
									  $_POST[$i."a5"],
									  $_POST[$i."a6"],
									  $_POST[$i."a7"],
									  $_POST[$i."a8"]),
								array($_POST[$i."c1"],
									  $_POST[$i."c2"],
									  $_POST[$i."c3"],
									  $_POST[$i."c4"],
									  $_POST[$i."c5"],
									  $_POST[$i."c6"],
									  $_POST[$i."c7"],
									  $_POST[$i."c8"]),
								array($_POST[$i."g1"],
									  $_POST[$i."g2"],
									  $_POST[$i."g3"],
									  $_POST[$i."g4"],
									  $_POST[$i."g5"],
									  $_POST[$i."g6"],
									  $_POST[$i."g7"],
									  $_POST[$i."g8"]),
								array($_POST[$i."n1"],
									  $_POST[$i."n2"],
									  $_POST[$i."n3"],
									  $_POST[$i."n4"],
									  $_POST[$i."n5"],
									  $_POST[$i."n6"],
									  $_POST[$i."n7"],
									  $_POST[$i."n8"]));
		//insert into players array
		array_push($Players, $newplayer);
	}
	
	//add player if prompted
	if($_POST["chplayers"] == "add")
	{
		$numplayers++;
		$newplayer = new Player();
		array_push($Players, $newplayer);
	}
	//XML is stored as DOMDocument
	$newxml = new DOMDocument('1.0');
	$newxml->formatOutput = true;
	
	//Create root structure "players" where each player goes
	$root = $newxml->createElement("players");
	$root = $newxml->appendChild($root);
				
	//make XML parts for each player
	for($i = 0; $i < $numplayers; $i++)
	{
		//make player
		$playtag = $newxml->createElement("player");
		$playtag = $root->appendChild($playtag);
		
		//make name
		$name = $newxml->createElement("name");
		$name = $playtag->appendChild($name);
		//populate name
		$text = $newxml->createTextNode($Players[$i]->name);
		$text = $name->appendChild($text);
		
		//make textcolor
		$textcolor = $newxml->createElement("textcolor");
		$textcolor = $playtag->appendChild($textcolor);
		//poplulate textcolor
		$text = $newxml->createTextNode($Players[$i]->textcolor);
		$text = $textcolor->appendChild($text);
		
		//make bgcolor
		$bgcolor = $newxml->createElement("bgcolor");	
		$bgcolor = $playtag->appendChild($bgcolor);
		//populate bgcolor			
		$text = $newxml->createTextNode($Players[$i]->bgcolor);
		$text = $bgcolor->appendChild($text);
		
		//make archimedes
		$archimedes = $newxml->createElement("archimedes");
		$archimedes = $playtag->appendChild($archimedes);
		//populate archimedes			
		for($a = 0; $a < 8; $a++)
		{
			$pick = $newxml->createElement("ap".($a+1));
			$pick = $archimedes->appendChild($pick);
			
			$text = $newxml->createTextNode($Players[$i]->archimedes[$a]);
			$text = $pick->appendChild($text);
		}
		
		//make curie
		$curie = $newxml->createElement("curie");
		$curie = $playtag->appendChild($curie);
		//populate curie
		for($a = 0; $a < 8; $a++)
		{
			$pick = $newxml->createElement("cp".($a+1));
			$pick = $curie->appendChild($pick);
			
			$text = $newxml->createTextNode($Players[$i]->curie[$a]);
			$text = $pick->appendChild($text);
		}
		
		//make galileo
		$galileo = $newxml->createElement("galileo");
		$galileo = $playtag->appendChild($galileo);
		//populate galileo
		for($a = 0; $a < 8; $a++)
		{
			$pick = $newxml->createElement("gp".($a+1));
			$pick = $galileo->appendChild($pick);
			
			$text = $newxml->createTextNode($Players[$i]->galileo[$a]);
			$text = $pick->appendChild($text);
		}
			
		//make newton
		$newton = $newxml->createElement("newton");
		$newton = $playtag->appendChild($newton);
		//populate newton
		for($a = 0; $a < 8; $a++)
		{
			$pick = $newxml->createElement("np".($a+1));
			$pick = $newton->appendChild($pick);
			
			$text = $newxml->createTextNode($Players[$i]->newton[$a]);
			$text = $pick->appendChild($text);
		}
	};
	
	//save xml file
	$newxml->save($oldstuffs);
?>