function validateEmail(){
    let valid =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let mail = document.getElementById("email").value;
    if(mail.match(valid)){
        document.getElementById("email").style.background="";
    }
    else{
        document.getElementById("email").style.background = "#F2275D";
        alert("Email input incorrect");
    }
}
function validatePassword(){
    let pwd = document.getElementById("pwd").value;
    let pwdR = document.getElementById("pwdR").value;
    if(pwd!==pwdR){
        document.getElementById("pwdR").style.background="#F2275D";
        alert("Password mismatch")
    }
    else{
        document.getElementById("pwdR").style.background="";
    }
}
function validateName(){
    let name = document.getElementById("name");
    if(name.value===""){
        name.style.background="#F2275D";
        alert("Missing Field: Name");
    }
    else{
        name.style.background="";
    }
}
function validateSurname(){
    let surname = document.getElementById("surname");
    if(surname.value===""){
        surname.style.background="#F2275D";
        alert("Missing Field: Surname");
    }
    else{
        surname.style.background="";
    }
}

function password(){
    let pwd = document.getElementById("pwd");
    let pwdVal = pwd.value;
    if(pwdVal.length>=8 && pwdVal.length<=32){
        pwd.style.background="";
    }
    else{
        pwd.style.background="#F2275D";
        alert("Password Length: 8-32 [Size matters ;) ]")
    }
}