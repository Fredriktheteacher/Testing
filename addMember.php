<!DOCTYPE html>
<html>
<head>
	<title>Lägg till ny medlem</title>
	<?php
		include_once 'dbincludes.php';

		if(isset($_POST['submit'])){
			$namn = $_POST['namn'];
			$telefon = $_POST['telefon'];
			$adress = $_POST['adress'];
		}
		
	?>	
</head>
<body>
	<?php
		if($conn->connect_error){
			die("Uppkopplingen misslyckades".$conn->connect_error);
		}
	?>
	<h1>Lägg till ny medlem</h1>
	<p><a href="index.php">Tillbaka till startsidan</a></p>
	<form action="addMember.php" method="post">
		Namn: <input type="text" name="namn" id="namn" value="<?php if(!empty($namn)){  echo $namn; } ?>"><br>
		Telefon: <input type="text" name="telefon" id="telefon" value="<?php if(!empty($telefon)){  echo $telefon; } ?>"><br>
		Adress: <input type="text" name="adress" id="adress" value="<?php if(!empty($adress)){  echo $adress; } ?>"><br>
		<input type="submit" name="submit" value="Spara">
	</form>
	<?php
		if(isset($_POST['submit'])){
			if(empty($namn)){
				echo "Du måste ange ett namn.";
				?>
				<script>
					document.getElementById('namn').style.backgroundColor = "pink";
					document.getElementById('telefon').style.backgroundColor = "";
					document.getElementById('adress').style.backgroundColor = "";
				</script>
				<?php
			}
			else if(empty($telefon)){
				echo "Du måste ange ett telefonnummer.";
				?>
				<script>
					document.getElementById('namn').style.backgroundColor = "";
					document.getElementById('telefon').style.backgroundColor = "pink";
					document.getElementById('adress').style.backgroundColor = "";
				</script>
				<?php
			}
			else if(empty($adress)){
				echo "Du måste ange en adress.";
				?>
				<script>
					document.getElementById('namn').style.backgroundColor = "";
					document.getElementById('telefon').style.backgroundColor = "";
					document.getElementById('adress').style.backgroundColor = "pink";
				</script>
				<?php
			}
			else{
				$sql = "INSERT INTO members (namn, telefon, adress) VALUES ('$namn', '$telefon', '$adress')";
				if($conn->query($sql)){
					echo "Det gick bra att spara medlemmen i tabellen members";
				}
				else{
					echo "Det sket sig! Kunde inte spara medlemmen i tabellen members".$conn->error;
				}
			}
		}
		else{
			echo "Du har inte klickat på Spara-knappen.";
		}
		$conn->close();
	?>

</body>
</html>