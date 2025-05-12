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
    ID=document.getElementsByName("userID")[0].value;
    sessionStorage.setItem('userID', ID);
    password=document.getElementsByName("password")[0].value;

    // Assuming password verification logic here
    if (password === "yourCorrectPassword") { // Replace "yourCorrectPassword" with the actual correct password
        alert("Correct password");
    }

    form.submit();
}