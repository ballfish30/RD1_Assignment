<?php
echo(132);
$link = require_once("config.php");
$news = <<<multi
select * from weather;
multi;
$result = mysqli_query($link, $news);
$row = mysqli_fetch_assoc($result);
return(123456789);
?>