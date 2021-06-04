<?php 
include('server.php'); 

// Holen Sie den zu bearbeitenden Datensatz
	if (isset($_GET['edit'])){
		$id = $_GET['edit'];
		$edit_state = true;
		$rec = mysqli_query($db, "SELECT * FROM info WHERE id = $id");
		$record = mysqli_fetch_array($rec);
		$title = $record['title'];
		$note = $record['note'];
		$id = $record['id'];
	}
?>
<!DOCTYPE html>
<html>

<head>
<h1>Notes Takin App</h1>
	<title>Notes taking Web App</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css?<?php echo time(); ?>" />
</head>
<body>
	<div class = "glass">
		<form method = "post" action ="server.php">
			<input type = "hidden" name = "id" value ="<?php echo $id; ?>">  
			<div class = "input-group">
				<label>Title</label>
				<input type = "text" name = "title" value = "<?php echo $title; ?>" placeholder = "Enter Titel">
			</div>
			<div class = "input-group">
				<label>Note</label>
				<input type = "text" name = "note" value = "<?php echo $note; ?>" placeholder = "Enter Note">
			<div class = "input-group">
				
			<?php if ($edit_state == false): ?>
				<button type = "submit" name ="save" class = "btn" >Save</button>
			<?php else :?>
				<button type = "submit" name ="edit" class = "btn" >Edit</button>
			<?php endif ?>	
			</div>	
			</div>
		</form>
		<?php if (isset($_SESSION['msg'])): ?>
			<div class = 'msg'>
				<?php
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			</div>
		<?php endif ?>	
		<table>
			<thead>
				<tr>
					<th>Title</th>
					<th>Note</th>
					<th colspan="2">Action</th>	
				</tr>		
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_array($results)){ ?>
					<tr>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['note']; ?></td>
						<td>
							<a class= "edit_btn" href = "index.php?edit=<?php echo $row['id']; ?>">Edit</a>
						</td>
						<td>
							<a class = "del_btn" href = "server.php?del=<?php echo $row['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>	
			</tbody>		
		</table>	
	</div>	

</body>



</html>
