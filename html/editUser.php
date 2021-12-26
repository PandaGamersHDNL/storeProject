<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" /> 
    <title>SOP</title>
</head>
<body>
    <header>
        <?php include "nav.php"?>
    </header>
    <div class="container-fluid">
        <div class="homeBox">
            <?php
                function form(int $id = 0, string $email = "", string $username = "", string $address ="", bool $admin = false )
                {
                    //TODO add cancel button + check fields?
                    //TODO change id to select so that we can have 1 value only -> not changable
                    echo('<form method="POST">
                    <h2>don\'t change the id if you want this one changed</h2>
                    <label for="id">ID: </label><input id="id" name="id" value="'. ($id ==0 ? "unknown" : $id) .'"/><br/>
                    <label for="email">email</label>
                    <input id="email" type="text" name="email" value="'.$email.'"/><br/>
                    <label for="username">username</label>
                    <input id="username" type="text" name="username" value="'.$username.'"/><br/>
                    <label for="admin">admin?</</label><select id="admin" name="admin">
                    <option value="0" '. ($admin ? "": "selected") .'>no</option>
                    <option value="1"  '. ($admin ? "selected": "") .'>yes</option></select><br/>
                    <label for="address">address</label>
                    <input id="address" type="text" name="address" value="'.$address.'"/><br/>
                    <input type="submit" value="confirm"></form>
                    ');
                }

                if(isset($_POST["id"], $_POST["email"], $_POST["username"], $_POST["address"], $_POST["admin"]))
                    {
                        // TODO add password
                        header("location: /php-mysxl/storeProject/html/admin.php?Uid=". $_POST["id"]. "&Uemail=".$_POST["email"]."&Uusername=".$_POST["username"]."&Uaddress=".$_POST["address"]."&Uadmin=".$_POST["admin"]);
                    }
                if(!isset($_GET["editUser"]))
                {
                    header("location: /php-mysxl/storeProject/html/admin.php");
                }

                if($_GET["editUser"] == 0)
                {
                    form();
                } else if ($_GET["editUser"] > 0)
                {
                    $db = new Database();
                    $user = $db->getUser($_GET["editUser"]);
                    if($user != false)
                        form($user["userID"], $user["username"], $user["email"], $user["address"], $user["bAdmin"]);
                    else
                        echo("<h3>failed to get user</h3>");
                }
            ?>
        </div>
    </div>
</body>
</html>