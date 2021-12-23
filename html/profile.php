<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" /> 
    <title>profile SOP</title>
</head>
<body>
    <header>
        <?php include "nav.php"?>
</header>
<div class="homeBox">
    <?php
        echo("<h2>username: ". $_SESSION["username"] . "</h2>");
        echo("<h2>email: ". $_SESSION["email"] . "</h2>");
        echo("<h2>address: ". $_SESSION["address"] . "</h2>");
        echo("<a href=\"" . $_SERVER["PHP_SELF"]
        . "?logout=yes\"> logout</a>");

        //include "session.php";
        if( isset($_GET["logout"]) && $_GET["logout"] == "yes")
        {
            Session::logout();
            header("location: /php-mysxl/storeProject/html/index.php");
        }
        //TODO add change buttons to change your information;
    ?>
</div>
</body>
</html>