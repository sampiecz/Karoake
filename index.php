<?php include 'header.html'; ?>

<?php
    $pageName = "Index";
     echo "<h1>$pageName</h1></center></td></tr></table></div>";
?>
        <div>
            <form method="POST" action"">
                <table width="100%" border="50px" cellpadding="25%">
                    <tr>
                        <td>
                            <h2>Request a song</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label></label>
                            <input value="requesterName" name="Your name" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label></label>
                            <input value="song" name="Song" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label></label>
                            <input value="paidOrFree" name="Paid or free" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input action="submit" type="submit"> 
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <body> 
<?php include 'footer.html'; ?>
</html>
