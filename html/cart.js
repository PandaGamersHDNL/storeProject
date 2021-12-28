function addToCart(id, amount) {
    console.log("carts");
    let url = "html/addCart.php";
    xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    let data = new FormData(document.getElementById("filter"));
    xhr.send(data);
}

function filterItems() {
    console.log("filter");
    let url = "/php-mysxl/storeProject/html/filter.php";
    xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    console.log(document.getElementById("filter"));
    let data = new FormData(document.getElementById("filter"));
    console.log(data);
    xhr.send(data);
}