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
                function form(int $id = 0, string $name = "", string $desc = "", float $price = -1, int $category = 0, int $stock = 0, string $img="" )
                {
                    //TODO add cancel button + check fields?
                    $db = new Database();
                    $categories = $db->getCategories();
                    $options = "";
                    while($c = mysqli_fetch_array($categories))
                        $options =  $options .'<option value="'.$c["categoryID"].'" ' . ($c["categoryID"] == $category ? 'selected' : "" ). '>'.$c["name"].'</option>';



                    echo('<form method="POST">
                    <h2> '.($id ==0 ? "add" : "edit") . ' product</h2>
                    <label for="id">ID: </label><select id="id" name="id"><option value="'. ($id ==0 ? "unknown" : $id) .'"/>'.($id ==0 ? "unknown" : $id).' </option></select><br/>
                    <label for="name">name</label>
                    <input id="name" type="text" name="name" value="'.$name.'"/><br/>
                    <label for="desc">desc</label>
                    <input id="desc" type="text" name="desc" value="'.$desc.'"/><br/>
                    <label for="category">category?</label><select id="category" name="category">'. $options . '</select><br/>
                    <label for="price">price</label>
                    <input id="price" type="number" step="0.01" name="price" value="'.$price.'"/><br/>
                    <label for="stock">stock: </label><input id="stock" name="stock" type="number" value="' . $stock . '"/><br/>
                    <label for="img">img path</label><input id="img" name="img" value="'. $img. '"><br/>
                    <input type="submit" value="confirm"><br/>
                    </form>');
                }

                if(isset($_POST["id"], $_POST["name"], $_POST["desc"], $_POST["category"], $_POST["price"], $_POST["stock"],$_POST["img"], $_POST["stock"], $_POST["img"]))
                    {
                        header("location: /php-mysxl/storeProject/html/admin.php?Pid=". $_POST["id"]. "&Pname=".$_POST["name"]."&Pdesc=".$_POST["desc"]."&Pcategory=".$_POST["category"]."&Pprice=".$_POST["price"]. "&Pstock=".$_POST["stock"]."&Pimg=".$_POST["img"]);
                    }
                if(!isset($_GET["product"]))
                {
                    header("location: /php-mysxl/storeProject/html/admin.php");
                }

                if($_GET["product"] == 0)
                {
                    //add
                    form();
                } else if ($_GET["product"] > 0)
                {
                    $db = new Database();
                    $product = $db->getProduct($_GET["product"]);
                    if($product != false){
                        $img = $product["imagePath"];
                        if ($img == null){
                            $img = "";
                        }
                        form($product["productID"], $product["name"], $product["description"], $product["price"], $product["categoryID"], $product["stock"], $img);
                    }else
                        echo("<h3>failed to get user</h3>");
                }
            ?>
        </div>
    </div>
</body>
</html>