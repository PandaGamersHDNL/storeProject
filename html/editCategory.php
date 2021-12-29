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
                function form(int $id = 0, string $name = "", string $desc = "")
                {
                    //TODO add cancel button + check fields?

                    echo('<form method="POST">
                    <h2> '.($id ==0 ? "add" : "edit") . ' category</h2>
                    <label for="id">ID: </label><select id="id" name="id"><option value="'. ($id ==0 ? "unknown" : htmlspecialchars($id)) .'"/>'.($id ==0 ? "unknown" : htmlspecialchars($id)).' </option></select><br/>
                    <label for="name">name</label>
                    <input id="name" type="text" name="name" value="'.htmlspecialchars($name).'"/><br/>
                    <label for="desc">desc</label>
                    <input id="desc" type="text" name="desc" value="'.htmlspecialchars($desc).'"/><br/>
                    <input type="submit" value="confirm"><br/>
                    </form>');
                }

                if(isset($_POST["id"], $_POST["name"], $_POST["desc"]))
                    {
                        header("location: /php-mysxl/storeProject/html/admin.php?Cid=". htmlspecialchars($_POST["id"]). "&Cname=".htmlspecialchars($_POST["name"])."&Cdesc=".htmlspecialchars($_POST["desc"]));
                    }
                if(!isset($_GET["category"]))
                {
                    header("location: /php-mysxl/storeProject/html/admin.php");
                }

                if($_GET["category"] == 0)
                {
                    //add
                    form();
                } else if ($_GET["category"] > 0)
                {
                    $db = new Database();
                    $category = $db->getCategory($_GET["category"]);
                    if($category != false){
                        form($category["categoryID"], $category["name"], $category["description"]);
                    }else
                        echo("<h3>failed to get user</h3>");
                }
            ?>
        </div>
    </div>
</body>
</html>