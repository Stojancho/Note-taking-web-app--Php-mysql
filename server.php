<?php

	session_start();

	// Variablen initialisieren
		$title = "";
		$note = "";
		$id =0;
		$edit_state = false;
		
	// Verbindung zur Datenbank herstellen
	$db = mysqli_connect('localhost', 'root', '', 'notes');
	
	// Wenn die Schaltfläche "Speichern" angeklickt wird
	if (isset($_POST['save'])) {
		
		$title = $_POST['title'];
		$note = $_POST['note'];
		
		$query = "INSERT INTO info(title, note) VALUES ('$title', '$note')";
		mysqli_query($db, $query);
	

		$_SESSION['msg'] = "Note saved";
		
	// Umleitung zur Indexseite nach dem Einfügen
		header('location: index.php'); 
	}
	
	// Datensätze bearbeiten
		if (isset($_POST['edit'])) {	
			$title = mysql_real_escape_string($_POST['title']);
			$note = mysql_real_escape_string($_POST['note']);
			$id = mysql_real_escape_string($_POST['id']);		
			mysqli_query($db, "UPDATE info SET title = '$title', note = '$note' WHERE id = $id ");
			$_SESSION['msg'] = "Note edited";
			header('location: index.php');
			}	
			
	// Datensätze löschen
		if (isset($_GET['del'])) {
			$id = $_GET['del'];
			mysqli_query($db, "DELETE FROM info WHERE id = $id");
			$_SESSION['msg'] = "Note deleted";
			header('location: index.php');
			
		}
		
	// Datensätze abrufen
	$results = mysqli_query($db, "SELECT * FROM info");
?>