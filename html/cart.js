function addToCart(prodID) {
    console.log("carts");
    let url = "/php-mysxl/storeProject/html/addCart.php";
    xhrCart = new XMLHttpRequest();
    xhrCart.open("POST", url, true);
    //let data = new FormData(document.getElementById("filter"));
    let amount = document.getElementById("amount" + prodID).value;
    xhrCart.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrCart.onreadystatechange=cartReturn;
    let data = {"amount": amount, "productID": prodID};
    xhrCart.send("amount=" + amount + "&productID=" + prodID);
}

function cartReturn() {
    //add cart amount => "cart: 5" => non payed entries
    if(xhrCart.readyState == 4 && xhrCart.status == 200){
        console.log("response");
        document.getElementById("cart").innerHTML = xhrCart.responseText; 
    }
}

function filterItems() {
    let url = "/php-mysxl/storeProject/html/filter.php";
    xhrFilter = new XMLHttpRequest();
    xhrFilter.open("POST", url, true);
    let data = new FormData(document.getElementById("filter"));
    xhrFilter.onreadystatechange=filterReturn;
    console.log(document.getElementById("filter"));
    console.log(data);
    xhrFilter.send(data);
}

function filterReturn() {
    if(xhrFilter.readyState == 4 && xhrFilter.status == 200){
        document.getElementById("products").innerHTML = xhrFilter.responseText; 
    }
}