<?php 
    //session_start();
    //if($_POST)
?>
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
            <form  onsubmit="" >
                <label for="username">username</label>
                <input type="text" name="username"/><br />
                <label for="password">password</label>
                <input type="text" name="password" /><br />
                <input type="submit" value="login" />
                <a href="./signup.php">sign up</a>
            </form>   

        </div>
    </div>
</body>
</html>
<script>
    function checkForm()
    {
        let list = ["username", "password"]
        for(let i of list){
            if(document.getElementById(i).value == "")
            {
                return false;
            }
        }
        return true;
    }
</script>