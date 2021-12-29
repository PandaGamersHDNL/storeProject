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
        <?php include_once "nav.php"?>
    </header>
    <div class="container-fluid">
        <div class="homeBox">
            <?php
                function form(int $id = 0, string $email = "", string $username = "", string $address ="", bool $admin = false )
                {
                    //TODO add cancel button + check fields?
                    //TODO change id to select so that we can have 1 value only -> not changable
                    echo('<form method="POST">
                    <h2> edit user</h2>
                    <label for="id">ID: </label><select id="id" name="id"><option value="'. ($id ==0 ? "unknown" : htmlspecialchars($id)) .'"/>'.($id ==0 ? "unknown" : htmlspecialchars($id)).' </option></select><br/>
                    <label for="email">email</label>
                    <input id="email" type="text" name="email" value="'.htmlspecialchars($email).'"/><br/>
                    <label for="username">username</label>
                    <input id="username" type="text" name="username" value="'.htmlspecialchars($username).'"/><br/>
                    <label for="admin">admin?</</label><select id="admin" name="admin">
                    <option value="0" '. ($admin ? "": "selected") .'>no</option>
                    <option value="1"  '. ($admin ? "selected": "") .'>yes</option></select><br/>
                    <label for="address">address</label>
                    <input id="address" type="text" name="address" value="'.htmlspecialchars($address).'"/><br/>
                    <input type="submit" value="confirm"></form>
                    ');
                }

                if(isset($_POST["id"], $_POST["email"], $_POST["username"], $_POST["address"], $_POST["admin"]))
                    {
                        // TODO add password
                        header("location: /php-mysxl/storeProject/html/admin.php?Uid=". htmlspecialchars($_POST["id"]). "&Uemail=".htmlspecialchars($_POST["email"])."&Uusername=".htmlspecialchars($_POST["username"])."&Uaddress=".htmlspecialchars($_POST["address"])."&Uadmin=".htmlspecialchars($_POST["admin"]));
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
                        form($user["userID"], $user["email"],$user["username"], $user["address"], $user["bAdmin"]);
                    else
                        echo("<h3>failed to get user</h3>");
                }
            ?>
        </div>
    </div>
</body>
</html>