<?php
    class Orders{
        static public function printTable($orders = null, bool $bPayDate)
        {
            //TODO make amount changable? update db then (make button next to amount for changing?)
            echo("<table><tr>");
            //TODO add stock?
            $price = 0;
            echo("<th>product name</th><th>product description</th><th>amount</th><th>unit price</th>");
            if($bPayDate)
                echo("<th>pay date</th>");
            else
                echo("<th>delete</th></tr>");
            $db = new Database();
            while($order = mysqli_fetch_array($orders))
            {
            echo("<tr>");
            echo("<td>".htmlspecialchars($order["name"])."</td>");
            echo("<td>".htmlspecialchars($order["description"])."</td>");
            echo("<td>".htmlspecialchars($order["amount"])."</td>");
            echo("<td>".htmlspecialchars($order["price"])."</td>");
            if($bPayDate)
                echo("<td>" . (isset($order["payDate"]) == true ? htmlspecialchars($order["payDate"]) : "not set")  ."</td>");
            else
                echo("<td><a href='".$_SERVER["PHP_SELF"]. "?Odel=".$order["orderID"]."'>delete</a></td>");
            echo("</tr>");
            $price += ($order["price"] * $order["amount"]);
            }
            echo("</table>");
            return $price;
        }

    }
?>