<?php

#$url = '10.10.10.47/';
$pid = $_GET['pid'];
$seite = '404.php';
include('header.php');
include('menu.php');


if($pid == 1)
{
	$seite = 'seite1.php';
}
else
{
	$seite = '404.php';
}

?>

<?php

include($seite);

?>â
<?php
include('footer.php');
?>
