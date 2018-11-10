<html>
<head>
    <title>View</title>
</head>
<h1>MY FIRST VIEW EVER</h1>
</html>
<?php
print_r($arg);
for($i = 0 ; $i < sizeof($arg);$i++) {
    echo $arg[$i]['post'] . "<br>";
}