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
            <form  onsubmit="checkForm()" method="POST" >
                <label for="email">email</label>
                <input type="text" name="email" id="email"/><br />
                <label for="password">password</label>
                <input type="text" name="password" id="password"/><br />
                <input type="submit" value="login" />
                <a href="./signup.php">sign up</a><br />
                <?php

                    if(isset($_POST["email"], $_POST["password"])  && $_POST["email"] != "" && $_POST["password"] != "")
                    {
                        $db = new Database();
                        //$db->checkAdmin();
                        $db->verifyUser($_POST["email"], $_POST["password"]);
                    }
                ?>

            </form>   

        </div>
    </div>
</body>
<script>
    function checkForm()
    {
        let list = ["email", "password"]
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
</html>