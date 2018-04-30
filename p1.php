<?php include 'header.html'; ?>

<?php
    $pageName = "Page 1";
     echo "<h1>$pageName</h1></center></td></tr></table></div>";
?>

<h1> Song Search Page</h1>
<h3> Please search for desired song using any of the search options below</h3>

<form method="POST" action="/~z1732715/group_project/p2.php">
<p> Enter Song title: <input type = 'text' name ='title' /> </p>
<p> Enter Artist Name: <input type='text' name='artist' value=''/> </p>
<p> Contributor Name: <input type='text' name='contr' value=''/></p>
<p> <input type='Submit'/>

</form>
</body>

<?php include 'footer.html'; ?>
</html>
