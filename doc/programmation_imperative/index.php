<?php

function afficherUtilisateur($name, $age)
{
    echo "<p>Utilisateur : $name, age: $age</p>";
}

$_POST['email'];

$username = "john";
$age = 34;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <? afficherUtilisateur($username, $age) ?>
</body>

</html>