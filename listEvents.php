<?php
	include_once 'dbincludes.php';

	if($conn->connect_error){
		die("Uppkopplingen misslyckades".$conn->connect_error);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista alla evenemang</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	
</head>
<body>
	<h1>Lista alla evenemang</h1>
	<p><a href="index.php">Tillbaka till startsidan</a></p>
	<table>
		<tr>
			<th>ID</th>
			<th>TITEL</th>
			<th>DATUM</th>
			<th>BESKRIVNING</th>
			<th>ANSVAR</th>
		</tr>
		<?php
			$sql = "SELECT events.id, events.titel, events.datum, events.beskrivning, members.namn FROM members INNER JOIN events ON events.ansvar=members.id;";

			$result = $conn->query($sql);

			if($result->num_rows > 0){
				$counter = 0;
				while($row = $result->fetch_assoc()){
					if($counter%2){
						echo "<tr class='stripe'>
								<td>".$row['id']."</td>
								<td>".$row['titel']."</td>
								<td>".$row['datum']."</td>
								<td>".$row['beskrivning']."</td>
								<td>".$row['namn']."</td>

						</tr>";
					}
					else{
						echo "<tr class='nostripe'>
								<td>".$row['id']."</td>
								<td>".$row['titel']."</td>
								<td>".$row['datum']."</td>
								<td>".$row['beskrivning']."</td>
								<td>".$row['namn']."</td>

						</tr>";
					}
					$counter++;
				}
			}
			else{
				echo "<tr>
				<td colspan='5'>Tabellen är tom</td>
				</tr>";
			}
			$conn->close();
		?>
	</table>

</body>
</html>