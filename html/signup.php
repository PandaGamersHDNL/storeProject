<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="../css/gen.css" /> 
    <title>sop</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><h1>SOP </h1></li>
                <li><div id="searchItems"> search:<input type="text" /> </div></li>
                <li>login/ signup</li>
                <li>cart</li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>category1</li>
                <li>category2</li>
                <li>category3</li>
                <li>category4</li>
                <li>category5</li>
        </nav>
    </header>
    <div class="container-fluid">
        
        <div class="homeBox">
            <form method="post" onsubmit=checkForm>
                <label for="username">username</label>
                <input id="username" type="text" name="username"/><br/>
                <label for="email">email</label>
                <input id="email" type="text" name="email"/><br/>
                <label for="password">password</label>
                <input id="password" type="password" name="password"/><br/>
                <label for="address">address</label>
                <input id="address" type="text" name="address"/><br/>
                <input type="submit" value="sign up">
                <a href="./login.php">Already have an account?</a>
<?php 
include "db.php";
if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])&& isset($_POST["address"]) )
{
    $db = new Database();
    $db->addUser($_POST["username"], $_POST["email"], $_POST["password"], $_POST["address"]);
    //prepare sql query etc to add a new user
    //make password hash
    //send query
}
?>
                
            </form>
        </div>
    </div>
</body>
</html>
<script>
    function checkForm()
    {
        let list = ["username", "email", "password", "address"];
        //console.log(document.getElementById("password").value);
        for(let i of list){
            let item = document.getElementById(i);
            let errorText = "fill this bitch in"
            if(item.value == "" || item.value == errorText)
            {
                
                return false;
            }
            console.log(i)
        }
        return true;
    }
</script>