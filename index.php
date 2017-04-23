<?php
	require("./digest.php");
	$auth = new digest;

	//Benutzer hinzufuegen, Variante 1
	$auth->add("benutzername1", "benutzerpasswort1");
	$auth->add("benutzername2", "benutzerpasswort2");
	$auth->add("benutzername3", "benutzerpasswort3");
	$auth->add("benutzername4", "benutzerpasswort4");

	//Benutzer hinzufuegen, Variante 2
	$auth->add(array("benutzername1", "benutzername2", "benutzername3", "benutzername4"), array("benutzerpasswort1", "benutzerpasswort2", "benutzerpasswort3", "benutzerpasswort4"));

	//_OPTIONAL_ Grund fuer die Legetimierung
	$auth->realm("Privater Bereich");

	//_OPTIONAL_ Fehlermeldung bei falschen Daten
	$auth->error("Falsche Daten angegeben!");

	// Mechanismus starten
	$auth->start();
	
	echo "Dies ist der private Bereich!<br>Wenn du diesen Text siehst hast du die richtigen Daten angegeben!";
?>
