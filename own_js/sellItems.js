function listItem(){
    let url = "https://wheatley.cs.up.ac.za/u18059288/web/api.php";
    let product_name = document.getElementById("product_name").value;
    let category = document.getElementById("category").value;
    let amount = document.getElementById("quantity").value;
    let email = document.getElementById("email").value;
    let price = document.getElementById("price").value;
    let image = document.getElementById("formFile");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.setRequestHeader("Authorization", "Basic dTE4MDU5Mjg4OlRJcjJTQHRVUA==");
    xhr.setRequestHeader("Content-Type", "application/json");
}