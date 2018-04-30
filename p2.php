<html>
<head> <title> Karaoke pg 2 </title><head>
<body>
<h1 align='center'> Karaoke Pg 2 </h1>
<p align='center'> Please choose song version and add it to desired queue, you may choose to pay and get your song played early </p>

<!-- Connect to the database -->
<?php
    try {
        $dsn = "mysql:host=courses;dbname=z1732715";
        $username = "z1732715";
        $password = "1996Apr23";
        $pdo = new PDO($dsn, $username, $password);
    }
    catch(PDOexception $e) {
        echo "Connection to database failed: " . $e->getMessage();
    }
?>
<!-- End Connect to the database -->


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
<!-- Start test -->

<?php

  //Placeholder
  //requester should equal requesterId from search
  $requester = '1';


  //Choose Song Form
  echo"<form method='post'>";

  //Placeholder for songs gotten from search
  //Loop through songs displayed in radio buttons
  //name=song value=songId
  echo"<table>
      <tr>
        <td>
      <label>Song Name</label><input type='radio' name='song' value='1'></td></tr>";

  //Choose paid or unpaid
  echo"
    <tr><td>Queue</td></tr>
    <tr><td><input type='radio' name='queue' value='0'> Free Queue<td><tr>
    <tr><td><input type='radio' name='queue' value='1'> Priority Queue<td>
    <td><input type='text' name='amountPaid'/></td></tr>
    <tr><td><input type='Submit' name='Submit' value='Submit'/></td></tr>
    <tr><td><input type='reset' value='Reset'/></td></tr>
</form>";

//When submit button is hit
if(isset($_POST['Submit']))
{

  //Check for choice of song
  if(isset($_POST['song']) )
  {

  //Check for choie of queue
  if(isset($_POST['queue']) )
  {

  //get queue selection
  $queueChoice = $_POST['queue'];

  $paidChoice = '0';

  //set amount paid to written amount if input
  if($_POST['amountPaid'] > '0'){
$paidChoice = $_POST['amountPaid'];
}

  //if no amount input, default to free queue
  else{
$queueChoice = '0';
  }

  //set song choice to chosen song
  $songChoice = $_POST['song'];

  //Zero for hasplayed input
  $zero = '0';

//sql statement to insert into queue
$sql = "INSERT INTO Request (paid, amountpaid, songId, requesterId, hasplayed) VALUES (:paid, :amountpaid, :songId, :requesterId, :hasplayed)";

//Prepare the variables to be inserted into the sql statement
$prepared = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));


//Execute the sql statement with the variables
$result = $prepared->execute(array(':paid' => $queueChoice, ':amountpaid' => $paidChoice, ':songId' => $songChoice, ':requesterId' => $requester, ':hasplayed' => $zero));

}//Queue Choice if
else{ echo"<p align='center' style='color:red;'>*No Queue selected</p>";}

}//Song Choice if
else{ echo"<p align='center' style='color:red;'>*No song selected</p>";}

}//submit button if

?>
<!-- End test -->

</body>
</html>

