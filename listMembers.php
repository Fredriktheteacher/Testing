<!DOCTYPE html>
<html>
<head>
	<title>Lista alla medlemmar</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<?php
		include_once 'dbincludes.php';

		if($conn->connect_error){
			die("Uppkopplingen misslyckades: ".$conn->connect_error);
		}
	?>
</head>
<body>
	<h1>Lista alla medlemmar</h1>
	<p><a href="index.php">Tillbaka till startsidan</a></p>
	<table>
		<tr>
			<th>ID</th>
			<th>NAMN</th>
			<th>TELEFON</th>
			<th>ADRESS</th>
		</tr>
		<?php
		$sql = "SELECT id, namn, telefon, adress FROM members;";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			$counter = 0;
			while($row = $result->fetch_assoc()){
				if($counter%2){
					echo "<tr class='stripe'>
							<td>".$row['id']."</td>
							<td>".$row['namn']."</td>
							<td>".$row['telefon']."</td>
							<td>".$row['adress']."</td>
						</tr>";
				}
				else{
					echo "<tr class='nostripe'>
							<td>".$row['id']."</td>
							<td>".$row['namn']."</td>
							<td>".$row['telefon']."</td>
							<td>".$row['adress']."</td>
						</tr>";
				}
				$counter++;
			}
		}
		?>
	</table>

</body>
</html>