<?php
class User {
    static public function printTable($users)
    {
            
        echo("<table class='users'>");
        echo("<tr><th>ID</th><th> admin? </th><th> username</th><th> email </th><th> address </th><th>edit</th><th>del</th></tr> ");
        // TODO give alternate rows a different background https://stackoverflow.com/questions/3084261/alternate-table-row-color-using-css
        while($user = mysqli_fetch_array($users)){
            echo("<tr><th>" . $user["userID"] . "</th><td>" 
                . ($user["bAdmin"] ? "yes." : "no.") .  "</td><td>". $user["username"] ."</td><td>" . $user["email"] 
                . "</td><td>". $user["address"] ."</td><td><a href='" . $_SERVER["PHP_SELF"] . "' >edit</a></td> 
                <td><a href='" . $_SERVER["PHP_SELF"] . "' >del</a></td></tr> "
            );  
        }
        echo("</table>");
    }

}

?>