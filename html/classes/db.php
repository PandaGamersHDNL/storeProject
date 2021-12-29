<?php
class Database{
    public $host = "localhost";
    public $user = "Webuser";
    //bad practice (this is for a project => no sensitive data) => env file
    public $password = "Lab2020";
    public $database = "storedb";
    public mysqli $link;

    public function __construct()
    {
        $this->connectDB();
    }

    public function __destruct()
    {
        mysqli_close($this->link);
    }

    public function connectDB(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password) or die("error: no connection can be made to the host of the db");
        $this->openDB();
    }
    
    public function openDB()
    {
        mysqli_select_db($this->link, $this->database) or die("couldn't open database");
    }

    public function addUser(string $username, string $email, string $password, string $address, bool $admin = false )
    {
        $username = mysqli_real_escape_string($this->link, $username);
        $email = mysqli_real_escape_string($this->link, $email);
        $address = mysqli_real_escape_string($this->link, $address);

        $query = "SELECT email FROM users WHERE email = '". $email . "';";
        $user = mysqli_query($this->link, $query) or die("add user failed");
        if ($user->num_rows == 0)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT, [PASSWORD_DEFAULT]);
            $query = "INSERT INTO users (username, email, password, address, bAdmin) 
                VALUE ('". $username . "', '". $email . "', '" . $hash . "', '" . $address  . "', ". ($admin ==true ? 1 : 0) . ")";
            mysqli_query($this->link, $query) or die("add user failed");
            echo "<br/>sign up successfull";
            $this->verifyUser($email, $password);
            //Session::setLogin($username, $email, $address);
            header("location: /php-mysxl/storeProject/html/index.php");
        } else {
            echo "<br/>user already exists";
        }
        //mysqli_real_escape_string(link, string)
        //filter_var();
    }

    public function verifyUser(string $email, string $password)
    {
        $email = mysqli_real_escape_string($this->link, $email);
        $query = "select userID ,username, email, address, password from users where email = '$email'; ";
        $users = mysqli_query($this->link, $query) or die("get password failed");
        if($users->num_rows > 0){
            $user = mysqli_fetch_array($users);
            $hash = $user["password"];
            if(password_verify($password, $hash)){
                //include_once "session.php";
                echo("login successful");
                Session::setLogin($user["userID"], $user["username"], $user["email"], $user["address"]);
                header("location: /php-mysxl/storeProject/html/index.php");
                return true;
            } 
        }
        echo("Password or username is incorrect");
        return false;
    }

    public function checkAdmin(string $email = null)
    {
        $email = mysqli_real_escape_string($this->link, $email);
        $query = "SELECT bAdmin FROM users WHERE email = '$email'; ";
        $users = mysqli_query($this->link, $query) or die("get password failed");
        if($users->num_rows > 0){
            $user = mysqli_fetch_array($users);
            return $user["bAdmin"] ? true : false;
        }
        //TODO error if you can't find user?
        return false;
    }

    public function getUsers(int $page, int $perPage = 100)
    {
        $page -=1;
        $page = filter_var($page, FILTER_VALIDATE_INT);
        $perPage = filter_var($perPage, FILTER_VALIDATE_INT);

        $query = "SELECT * FROM users LIMIT $perPage OFFSET " . ($page * $perPage);
        $users = mysqli_query($this->link, $query) or die("get users failed");
        if ($users->num_rows > 0) {
            return $users;
        }
        return false;
    }

    public function getProducts(int $page, int $perPage = 100)
    {
        $page -=1;
        $page = filter_var($page, FILTER_VALIDATE_INT);
        $perPage = filter_var($perPage, FILTER_VALIDATE_INT);

        //$query = "SELECT * FROM ( SELECT (ROW_NUMBER() over ()) as row, users.* FROM users) as t WHERE row BETWEEN ". (($page -1) * $perPage) + 1 . " and ". $page * $perPage  .";";
        $query = "SELECT * FROM products LIMIT $perPage OFFSET " . ($page * $perPage);
        $products = mysqli_query($this->link, $query) or die("get products failed");
        //echo("<div class='homeBox'>" . var_dump($products) . "</div>");
        if ($products->num_rows > 0) {
            return $products;
        }
        return false;
    }

    public function getProduct(int $id = null)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "SELECT * FROM products WHERE productID = $id";
        $prods = mysqli_query($this->link, $query) or die("get product failed");
        if ($prods->num_rows > 0) {
            return mysqli_fetch_array($prods);
        }
        return false;
    }

    public function getUser(int $id = null)
    {
        $query = "SELECT * FROM users WHERE userID = $id";
        $userSql = mysqli_query($this->link, $query) or die("get user failed");
        if ($userSql->num_rows > 0)
        {
            return mysqli_fetch_array($userSql);
        }
        return false;
    }

    public function updateUser(int $id,string $email, string $username, string $address, bool $admin )
    {
        $email = mysqli_real_escape_string($this->link, $email);
        $username = mysqli_real_escape_string($this->link, $username);
        $address = mysqli_real_escape_string($this->link, $address);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query =  "UPDATE users SET username = '$username', email = '$email', address = '$address', bAdmin = ".($admin ==true? 1: 0)." WHERE userID = $id;";
        mysqli_query($this->link, $query) or die("updating user failed");
    }

    public function delUser(int $id = null)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "DELETE FROM users WHERE userID = $id;";
        mysqli_query($this->link, $query) or die("deleting user failed");
    }

    public function updateProduct(int $id,string $name, string $desc,int $category, float $price,int $stock)
    {
        $name = mysqli_real_escape_string($this->link, $name);
        $desc = mysqli_real_escape_string($this->link, $desc);
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $stock = filter_var($stock, FILTER_VALIDATE_INT);
        $category = filter_var($category, FILTER_VALIDATE_INT);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT);
        

        $query =  "UPDATE products SET name = '$name', description = '$desc', categoryID = $category, price = $price, stock = $stock WHERE productID = $id;";
        mysqli_query($this->link, $query) or die("updating product failed");
    }

    public function addProduct(string $name, string $desc, int $category, float $price, int $stock)
    {
        
        $name = mysqli_real_escape_string($this->link, $name);
        $desc = mysqli_real_escape_string($this->link, $desc);
        $category = filter_var($category, FILTER_VALIDATE_INT);
        $stock = filter_var($stock, FILTER_VALIDATE_INT);
        $price = filter_var($price, FILTER_VALIDATE_FLOAT);

        $query = "INSERT INTO products (name, description, categoryID, stock, price)
        VALUE ('". $name . "', '". $desc . "', " . $category . ", " . $price  . ", ". $stock .")";
        mysqli_query($this->link, $query) or die("add product failed");
    }

    public function delProduct(int $id = null)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "DELETE FROM products WHERE productID = $id;";
        mysqli_query($this->link, $query) or die("deleting product failed");
    }

    public function filterProducts( array $categories, int $page,float $min = 0, float $max = 0, string $name = "", int $perPage = 100)
    {
        $name = mysqli_real_escape_string($this->link, $name);
        
        $max = filter_var($max, FILTER_VALIDATE_FLOAT);
        $min = filter_var($min, FILTER_VALIDATE_FLOAT);

        $query = "SELECT * FROM products WHERE name LIKE '%" . $name."%' AND price > $min ";
        if($max > .01)
        {
            $query = $query . "AND price < $max ";
        }
        if( count($categories) > 0) {
            $query = $query . "AND ( ";
            $categories[0] = filter_var($categories[0], FILTER_VALIDATE_INT);
            $query = $query . "categoryID = ". $categories[0]." ";
            for($i = 1 ; $i < count($categories); $i++){
                $categories[$i] = filter_var($categories[$i], FILTER_VALIDATE_INT);
                $query = $query . "OR categoryID = " . $categories[$i];
            }
            $query = $query . ") ";
        }
        //SELECT * FROM products where price >= 55 AND price <= 100 AND (categoryID = 2 OR categoryID = 3);
        $page -= 1;
        $query = $query . " LIMIT $perPage OFFSET ". ($perPage * $page) . ";";
        
        $prods = mysqli_query($this->link, $query) or die("filtering products failed");
        if($prods->num_rows > 0)
        {
            return $prods;
        }
        return false;
    }

    public function getCategories()
    {
        $query = "SELECT * FROM categories";
        $categories = mysqli_query($this->link, $query) or die("get users failed");
        if ($categories->num_rows > 0)
        {
            return $categories;
        }
        return false;

    }
    public function getCategory(int $id = null)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "SELECT * FROM categories WHERE categoryID = $id";
        $prods = mysqli_query($this->link, $query) or die("get category failed");
        if ($prods->num_rows > 0) {
            return mysqli_fetch_array($prods);
        }
        return false;
    }

    public function updateCategory(int $id,string $name, string $desc)
    {
        $name = mysqli_real_escape_string($this->link, $name);
        $desc = mysqli_real_escape_string($this->link, $desc);
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $query =  "UPDATE categories SET name = '$name', description = '$desc' WHERE categoryID = $id;";
        mysqli_query($this->link, $query) or die("updating category failed");
    }
    
    public function addCategory(string $name, string $desc)
    {
        
        $name = mysqli_real_escape_string($this->link, $name);
        $desc = mysqli_real_escape_string($this->link, $desc);
        
        $query = "INSERT INTO categories (name, description)
        VALUE ('". $name . "', '". $desc . "')";
        mysqli_query($this->link, $query) or die("add category failed");
    }

    public function delCategory(int $id = null)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "DELETE FROM categories WHERE categoryID = $id;";
        mysqli_query($this->link, $query) or die("deleting category failed");
    }

    public function addOrder(int $userID, int $productID, int $amount)
    {
        //$name = mysqli_real_escape_string($this->link, $name);
        //$desc = mysqli_real_escape_string($this->link, $desc);
        $userID = filter_var($userID, FILTER_VALIDATE_INT);
        $productID = filter_var($productID, FILTER_VALIDATE_INT);
        $amount = filter_var($amount, FILTER_VALIDATE_INT);
        
        $query = "INSERT INTO orders (userID, productID, amount)
        VALUE (". $userID . ", ". $productID . ", $amount)";
        mysqli_query($this->link, $query) or die("add order failed");
    }

    public function getOrders(int $userID, bool $bPayed = false)
    {
        $userID = filter_var($userID, FILTER_VALIDATE_INT);

        $query = "SELECT * FROM orders INNER JOIN products on orders.ProductID = products.productID WHERE payDate is ".($bPayed ? "NOT " : "")." NULL AND userID = $userID;";
        $orders = mysqli_query($this->link, $query) or die("get orders for user failed");
        if($orders->num_rows > 0)
            return $orders;
        return false;
    }

    public function delOrder(int $id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $query = "DELETE FROM orders WHERE orderID = $id AND payDate IS NULL;";
        mysqli_query($this->link, $query) or die("deleting order failed");
    }

    public function getCartAmount(int $userID)
    {
        $userID = filter_var($userID, FILTER_VALIDATE_INT);
        $query = "SELECT count(orderID) as amount FROM orders WHERE payDate IS NULL AND userID = $userID;";
        $result = mysqli_query($this->link, $query) or die("add order failed");
        $row = mysqli_fetch_array($result);
        return $row["amount"];
    }

    public function payCart(int $userID)
    {
        $userID = filter_var($userID, FILTER_VALIDATE_INT);

        $query = "select * from orders where userID = $userID AND payDate IS NULL";
        $orders = mysqli_query($this->link, $query) or die("get order to pay failed");

        while($order = mysqli_fetch_array($orders)){
            //gets a product every time to make sure we got the right stock
            $product = $this->getProduct($order["productID"]);
            if($product["stock"] >= $order["amount"])
            {
                $query = "update orders set payDate = CURRENT_TIMESTAMP() where orderID = " . $order["orderID"];
                mysqli_query($this->link, $query) or die("update orders to pay failed");

                $newStock = $product["stock"] - $order["amount"];
                $query = "update products set stock = $newStock where productID = ". $product["productID"];
                mysqli_query($this->link, $query) or die("update product stock failed");
            }
        }
        //check if the stock is > than the amount -> set curr date + update amount
    }

}
    
    ?>