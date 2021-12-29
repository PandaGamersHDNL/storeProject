<?php
class User {
    static public function printTable($users)
    {
            
        echo("<table class='users'>");
        echo("<tr><th>ID</th><th> admin? </th><th> username</th><th> email </th><th> address </th><th>edit</th><th>del</th></tr> ");
        // TODO give alternate rows a different background https://stackoverflow.com/questions/3084261/alternate-table-row-color-using-css
        while($user = mysqli_fetch_array($users)){
            echo("<tr><th>" . htmlspecialchars($user["userID"]) . "</th><td>" 
                . ($user["bAdmin"] ? "yes." : "no.") .  "</td><td>". htmlspecialchars($user["username"]) ."</td><td>" . htmlspecialchars($user["email"])
                . "</td><td>". htmlspecialchars($user["address"]) ."</td><td><a href='" . $_SERVER["PHP_SELF"] . "?editUser=". htmlspecialchars($user["userID"]) ."' >edit</a></td> 
                <td><a href='" . $_SERVER["PHP_SELF"] . "?Udel=".htmlspecialchars($user["userID"])."' >del</a></td></tr> "
            );  
        }
        echo("</table>");
    }

}


if(isset($_GET["editUser"]) && $_GET["editUser"] > 0)
{
    header("location: /php-mysxl/storeProject/html/editUser.php?editUser=". htmlspecialchars($_GET["editUser"]));    
}
?>