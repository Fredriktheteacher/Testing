<?php
	include_once 'dbincludes.php';

	if($conn->connect_error){
		die("Uppkopplingen misslyckades".$conn->connect_error);
	}
	if(isset($_POST['submit'])){
		$titel = $_POST['titel'];
		$datum = $_POST['datum'];
		$beskrivning = $_POST['beskrivning'];
		$ansvar = $_POST['ansvar'];

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lägg till evenemang</title>
</head>
<body>
	<h1>Lägg till evenemang</h1>
	<p><a href="index.php">Tillbaka till startsidan</a></p>
	<form action="addEvent.php" method="post">
		Titel: <input type="text" name="titel" id="titel" value="<?php if(!empty($titel)){echo $titel;} ?>"><br>
		Datum: <input type="text" name="datum" id="datum" value="<?php if(!empty($datum)){echo $datum;} ?>"><br>
		Beskrivning:<br>
		<textarea cols="25" rows="6" name="beskrivning" id="beskrivning"><?php if(!empty($beskrivning)){echo $beskrivning;} ?></textarea><br>
		Ansvar:
		<select name="ansvar" id="ansvar">
		<?php
			$sql = "SELECT id, namn FROM members;";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					$selected = "";
					if ($ansvar == $row['id']) {
						$selected = "selected";
					}
					else{
						$selected = "";
					}
					echo "<option value='".$row['id']."' ".$selected.">".$row['namn']."</option>";
				}
			}
			else{
				echo "<option>Tabellen members är tom</option>";
			}
		?>
			
		</select><br>
		<input type="submit" name="submit" value="Spara">
		
	</form>
	<?php
	if(isset($_POST['submit'])){
		if(empty($titel)){
			echo "<p>Du måste ange en titel.</p>";
			?>
			<script>
				document.getElementById('titel').style.backgroundColor = "pink";
				document.getElementById('datum').style.backgroundColor = "";
				document.getElementById('beskrivning').style.backgroundColor = "";
			</script>
			<?php
		}
		else if (empty($datum)) {
			echo "<p>Du måste ange ett datum.</p>";
			?>
			<script>
				document.getElementById('titel').style.backgroundColor = "";
				document.getElementById('datum').style.backgroundColor = "pink";
				document.getElementById('beskrivning').style.backgroundColor = "";
			</script>
			<?php
		}
		else if (empty($beskrivning)) {
			echo "<p>Du måste ange en beskrivning.</p>";
			?>
			<script>
				document.getElementById('titel').style.backgroundColor = "";
				document.getElementById('datum').style.backgroundColor = "";
				document.getElementById('beskrivning').style.backgroundColor = "pink";
			</script>
			<?php
		}
		else if (empty($ansvar)) {
			echo "<p>Du måste ange en ansvarig för evenemanget.</p>";
		}
		else{
			$sql = "INSERT INTO events (titel, datum, beskrivning, ansvar) VALUES ('$titel', '$datum', '$beskrivning', '$ansvar');";
			if($conn->query($sql)){
				echo "Det gick bra att spara värdena i tabellen events.";
			}
			else{
				echo "Det sket sig! Kunde inte spara värdena i tabellen events".$conn->error;
			}
		}
	}


	$conn->close();
	?>

</body>
</html>