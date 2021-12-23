<nav>
    <ul>
        <li>
            <h1>SOP </h1>
        </li>
        <li>
            <div id="searchItems"> search:<input type="text" /> </div>
        </li>
        <li>
            <?php 
            include "session.php";
            $bLogin = Session::checkLogin();
            if($bLogin == true)
            {
                //make link to edit profile page
                echo('<a href="/php-mysxl/storeProject/html/profile.php">'. $_SESSION["username"] .'</a>');
            } else{
                echo('<a href="/php-mysxl/storeProject/html/login.php">login/ signup</a>');
            }
        ?>
        </li>
        <li>cart</li>
    </ul>
</nav>
<!-- make check box list from this (join query) -->
<nav>
    <ul>
        <li>category1</li>
        <li>category2</li>
        <li>category3</li>
        <li>category4</li>
        <li>category5</li>
</nav>