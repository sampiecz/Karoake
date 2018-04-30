<?php include 'header.html'; ?>

<?php
    $pageName = "Page 3";
     echo "<h1>$pageName</h1></center></td></tr></table></div>";
?>
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


<?php
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
      if (isset($_GET["order"]))
      {
      $delete = $_GET["order"];
      $del_sql= "delete from Request where requesterID =" . $delete . ";";

      $n = $pdo->exec($del_sql);
      }

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

     if (isset($_GET["order1"]))
     {
     $delete1 = $_GET["order1"];
     $del_sql1= "delete from Request where requesterID =" . $delete1 . ";";

     $n = $pdo->exec($del_sql1);
     }

      echo '<tr style="outline: thin solid">';
      echo "<td>";
      echo '<input type="checkbox" name="order1" ';
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

<?php include 'footer.html'; ?>
</html>


