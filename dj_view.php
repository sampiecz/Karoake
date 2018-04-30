<!DOCTYPE html>
<!--|Name: Samuel Piecz, Chris, Christopher, Abdul, Philip       -->
<!--|Section: 3               -->
<!--|Instructor Name: Lehuta  -->
<!--|TA Name:  Raj            -->
<!--|Semester: Spring         -->
<!--|Due Date: 4/30/18         -->
<?php include 'header.html'; ?>

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
       SELECT s.name 'Song Name', r.name 'Requester Name', request.requestId 'Request Id', request.amountpaid 'Amount Paid', request.hasplayed 'Has Played'  FROM Song s JOIN Request request JOIN Requester r ON request.songId = s.songId AND r.requesterId = request.requesterId WHERE request.paid = True;
    ";
    $paidResult = $pdo->query($paidSql);
    $paidRows = $paidResult->fetchAll();

    # Get free requests
    $freeSql = "
       SELECT s.name 'Song Name', r.name 'Requester Name', request.requestId 'Request Id', request.hasplayed 'Has Played' FROM Song s JOIN Request request JOIN Requester r ON request.songId = s.songId AND r.requesterId = request.requesterId WHERE request.paid = False; 
    ";
    $freeResult = $pdo->query($freeSql);
    $freeRows = $freeResult->fetchAll();


    # Output paid table first
    echo '
    <div width="50%">
        <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <td>
                    <center>
                        <h2>Paid Requests</h2>
                    </center>
                </td>
            </tr>
        </table>
        <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <th>Requester Name</th>
                <th>Song Name</th>
                <th>Amount Paid</th>
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
                    <center>' . $row['Amount Paid'] . '</center>
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
    <div width="50%">
        <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <td>
                    <center>
                        <h2>Free Requests</h2>
                    </center>
                </td>
            </tr>
        </table>
        <table width="100%" border="50px" cellpadding="25%">
            <tr>
                <th>Requester Name</th>
                <th>Song Name</th>
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

<?php include 'footer.html'; ?>