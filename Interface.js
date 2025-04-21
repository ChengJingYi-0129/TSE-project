var ID; 
var password;
function getIDandPassword(){
    if(document.querySelector('input[name="userID"]').value == "") {
        alert("Please enter your ID");
        return;
    }
    if(document.querySelector('input[name="password"]').value == "") {
        alert("Please enter your password");
        return;
    }
    const form=document.getElementById("loginForm");
    ID=document.querySelector('input[name="userID"]').value;
    password=document.querySelector('input[name="password"]').value;
    form.submit();
}