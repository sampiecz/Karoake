<html>
<head> <title> Karaoke pg 2 </title><head>
<body>
<h1 align='center'> Karaoke Pg 2 </h1>
<p align='center'> Please choose song version and add it to desired queue, you may choose to pay and get your song played early </p>
<?php

try
{
	$dsn="mysql:host=courses; dbname=z1732715";
	$pdo = new PDO($dsn, 'z1732715', '1996Apr23');
}

catch(PDOexception $e)
{
	echo 'Connection to databse failed' .$e->getmessage();
}	

?>
<table border="1" width ="50">


<?php
$title = $_POST['title'];
$artist = $_POST['artist'];
$contr = $_POST['contr'];

if(strlen($title)>1)
	{
		$prepared =$pdo->prepare('select s.name as Title,b.name as Artist,m.name as Contributor from Song as s, Band as b, BandMember as m where s.bandId=b.bandId and b.bandId=m.bandId and s.name like ? group by Title');
		
		$prepared->execute(array("$title%"));
	}
else if (strlen($artist) >1)
{
		$prepared =$pdo->prepare('select s.name as Title,b.name as Artist,m.name as Contributor from Song as s, Band as b, BandMember as m where s.bandId=b.bandId and b.bandId=m.bandId and b.name like ? group by Artist');

		$prepared->execute(array("$artist%"));
}
else if (strlen($contr)>1)
{
		$prepared =$pdo->prepare('select s.name as Title,b.name as Artist,m.name as Contributor from Song as s, Band as b, BandMember as m where s.bandId=b.bandId and b.bandId=m.bandId and m.name like ? group by Contributor');
		$prepared->execute(array("$contr%"));
}


$rows = $prepared->fetchAll();


echo '<tr>
	<th> Song Title</th>
	<th> Artist Name </th>
	<th> Contributor Name </th>
      </tr>';

foreach($rows as $res)
	echo "<tr> <td> $res[Title]</td> <td> $res[Artist]</td> <td> $res[Contributor] </td> </tr>";
?>

</table>

<?php

// ATTACH ADAM"S CODE HERE 

?>

</body>
</html>

