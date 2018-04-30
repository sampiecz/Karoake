<!DOCTYPE html>
<!--|Name: Samuel Piecz, Chris, Christopher, Abdul, Philip       -->
<!--|Section: 3               -->
<!--|Instructor Name: Lehuta  -->
<!--|TA Name:  Raj            -->
<!--|Semester: Spring         -->
<!--|Due Date: 4/30/18         -->
<?php include 'header.html'; ?>

<?php
    $pageName = "Dj View";
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
<!-- End Connect to the database -->

<!-- Get all paid requests AKA KaroakeFiles --> <?php
    
    # Get paid requests 
    $paidSql = "
       SELECT s.name 'Song Name', b.name 'Band Name', r.name 'Requester Name', request.requestId 'Request Id', request.amountpaid 'Amount Paid', request.hasplayed 'Has Played'  FROM Song s JOIN Request request JOIN Requester r JOIN Band b ON request.songId = s.songId AND r.requesterId = request.requesterId AND b.bandId = s.bandId WHERE request.paid = True;
    ";
    $paidResult = $pdo->query($paidSql);
    $paidRows = $paidResult->fetchAll();

    # Get free requests
    $freeSql = "
       SELECT s.name 'Song Name', b.name 'Band Name', r.name 'Requester Name', request.requestId 'Request Id', request.hasplayed 'Has Played' FROM Song s JOIN Request request JOIN Requester r JOIN Band b ON request.songId = s.songId AND r.requesterId = request.requesterId AND b.bandId = s.bandId WHERE request.paid = False; 
    ";
    $freeResult = $pdo->query($freeSql);
    $freeRows = $freeResult->fetchAll();


    # Output paid table first
    echo '
    <div width="50%" style="float:left;">
        <table width="100%"  border="35px" cellpadding="25%">
            <tr>
                <td>
                    <center>
                        <h2>Paid Requests</h2>
                    </center>
                </td>
            </tr>
        </table>
        <table width="100%"  border="35px" cellpadding="25%">
            <tr>
                <th>Requester Name</th>
                <th>Song Name</th>
                <th>Band Name</th>
                <th>Amount Paid</th>
                <th>Request Id</th>
                <th>Has Played</th>
            </tr>
    ';

    foreach( $paidRows as $row ):

        echo ' 
            <tr>
                <td>
                    <center>' . $row['Requester Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Song Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Band Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Amount Paid'] . '</center>
                </td>
                <td>
                    <center>' . $row['Request Id'] . '</center>
                </td>
                <td>';

        if ($row['Has Played'] == False)
        {
            echo '<center><p>No.</p></center>'; 
        }
        else
        {
            echo '<center><p>Yes.</p></center>'; 
        }

        echo '
                </td>
            </tr>


        ';
    endforeach;

    echo '
                </td>
            </tr>
        </table>
      </div>

    ';

    # Output free table next 
    echo '
    <div width="50%" style="float:right;">
        <table width="100%" border="35px" cellpadding="25%">
            <tr>
                <td>
                    <center>
                        <h2>Free Requests</h2>
                    </center>
                </td>
            </tr>
        </table>
        <table width="100%" border="35px" cellpadding="25%">
            <tr>
                <th>Requester Name</th>
                <th>Song Name</th>
                <th>Band Name</th>
                <th>Request Id</th>
                <th>Has Played</th>
            </tr>
    ';

    foreach( $freeRows as $row ):
        echo ' 
            <tr>
                <td>
                    <center>' . $row['Requester Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Song Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Band Name'] . '</center>
                </td>
                <td>
                    <center>' . $row['Request Id'] . '</center>
                </td>
                <td>';

        if ($row['Has Played'] == False)
        {
            echo '<center><p>No.</p></center>'; 
        }
        else
        {
            echo '<center><p>Yes.</p></center>'; 
        }

        echo '
                </td>
            </tr>
        ';
    endforeach;

    echo '
                </td>
            </tr>
        </table>
      </div>

    ';


?>

<?php

    # My query or sql statement 
    $sql = "
       SELECT * FROM Request LIMIT 10; 
    ";

    # The resutlt of passing that query to the db
    $result = $pdo->query($sql);

    # $row = $result->fetch(PDO::FETCH_BOTH);

    # The result of all the rows of that query
    $allrows = $result->fetchAll();

    # Output table first
    echo '
    <div width="100%">
        <form action="/~z1732715/group_project/dj_view.php" method="POST">
            <table width="100%" border="50px" cellpadding="25%">
                <tr>
                    <td>
                        <h3>Song Request to update</h3>
                        <select name="requestId">
    ';
 
    foreach( $allrows as $row ):
        echo '<option value="' . $row['requestId'] . '" >' . $row['requestId'] . '</option>';
    endforeach;

    echo '
                        </select>
                    </td>
                </tr>
                    <td>
                        <h3>Has been played?</h3>
                        <label>Yes</label>
                        <br>
                        <input name="hasplayed" value="true" type="radio">
                        <br>
                        <label>No</label>
                        <br>
                        <input name="hasplayed" value="false" type="radio">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="submit">
                    </td>
                </tr>
            </table>
        </form>
      </div>

    ';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $requestId = trim($_POST['requestId'] ?? '');

        $update = trim($_POST['hasplayed'] ?? '');

        $newSql = "UPDATE Request SET hasplayed=:update WHERE requestId=:requestId;";

        $prepared = $pdo->prepare($newSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
     
        $specificServiceRequest= $prepared->execute(array(':update' => $update, ':requestId' => $requestId));

        echo '
        <div width="100%">
            <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <td>
                    <h3>RequestID ' . $requestId . ' Updated</h3>
                    <p>Has Played is now: ' . $update . '</p>
                </td>
            </tr>
        ';

        echo '
            </table>
        </div>
        ';  

    } 

?>


<?php include 'footer.html'; ?>
