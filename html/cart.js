function addToCart(id, amount) {
    console.log("carts");
    let url = "html/addCart.php";
    xhrCart = new XMLHttpRequest();
    xhrCart.open("POST", url, true);
    //let data = new FormData(document.getElementById("filter"));
    xhrCart.send(data);
}

function filterItems() {
    console.log("filter");
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
        console.log(xhrFilter.responseText)
    }
}