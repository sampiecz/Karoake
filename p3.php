<html>
<head>
</head>
<body>

<?php
   try
   {
      $dsn = "mysql:host=courses;dbname=z1823592";
      $username = "z1823592";
      $password = "1990Jan07";
      $pdo = new PDO($dsn, $username, $password);
   }

   catch (PDOexception $e)
   {
      echo "Connection to database failed: " . $e->getMessage();
   }

 $paid_sql = "SELECT Request.requesterID, Requester.name as Singer, Song.name as Song, paid from Requester, Song, Request where Request.requesterID =  Requester.requesterID and Request.songID = Song.songID and paid = true;";

$result = $pdo->query($paid_sql);

   $paid = $result->fetchall();

   $notPaid_sql = "SELECT Request.requesterID, Requester.name as Singer, Song.name as Song, paid from Requester, Song, Request where Request.requesterID =  Requester.requesterID and Request.songID = Song.songID and paid = false;";
 $result2 = $pdo->query($notPaid_sql);

   $notPaid = $result2->fetchall();

?>

<h1 align="center"> Paid Queue </h1>
<table align="center">


  <tr>
    <th> Order </th>
    <th> Singer </th>
    <th> Song </th>
  </tr>
<form>

<?php

   for ($i = 0; $i < count($paid) ; $i++)
   {
      echo '<tr style="outline: thin solid">';
      echo "<td>";
      echo '<input type="checkbox" name="order" ';
      echo 'value="';
      echo $paid[$i][0];
      echo '">';
      echo $i;
      echo "</td>";

      echo "<td>";
      echo $paid[$i][1];
      echo "</td>";

      echo "<td>";
      echo $paid[$i][2];
      echo "</td>";

      echo "</tr>";

   }


?>
   <tr>
   <td>
   <input type="submit" value="Played">
   </td>
   </tr>
   </form>
   </table>

<h1 align="center"> Free Queue </h1>
<table align="center">


  <tr>
    <th> Order </th>
    <th> Singer </th>
    <th> Song </th>
  </tr>
<form>

<?php

   for ($i = 0; $i < count($notPaid); $i++)
   {
      echo '<tr style="outline: thin solid">';
      echo "<td>";
      echo '<input type="checkbox" name="order" ';
      echo 'value="';
      echo $notPaid[$i][0];
      echo '">';
      echo $i;
      echo "</td>";

      echo "<td>";
      echo $notPaid[$i][1];
      echo "</td>";

      echo "<td>";
      echo $notPaid[$i][2];
      echo "</td>";

      echo "</tr>";

   }
?>
<tr>
<td>
<input type="submit" value="Played">
</td>
</tr>
</form>
</table>
</body>
</html>

