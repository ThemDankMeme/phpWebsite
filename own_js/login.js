function postData(){
    let url = "https://wheatley.cs.up.ac.za/u18059288/web/api.php";
    let mail = document.getElementById("email").value;
    let pwd = document.getElementById("pwd").value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    console.log(mail, pwd);
    xhr.setRequestHeader("Authorization", "Basic dTE4MDU5Mjg4OlRJcjJTQHRVUA==");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status===200) {
            let json = JSON.parse(xhr.responseText);
            if(json.status==="success"){
                window.location.replace("https://wheatley.cs.up.ac.za/u18059288/web/index.php");
            }
            else if(json.status==="failed"){
                if(json.message==="user"){
                    alert("No Account Matching: "+mail);
                }else if(json.message==="invalid")
                    alert("Invalid Password");
                else
                    alert("Unexpected");
            }
        }

    };
    let data = {"type": "login", "email": mail, "pwd": pwd};
    xhr.send(JSON.stringify(data));

}