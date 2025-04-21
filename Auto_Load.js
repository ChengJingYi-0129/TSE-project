email=ID+"@student.mmu.edu.my. ";
var hidePassword=ID.replace(/(.{4})./, '$1******');
var OTP=Math.floor(Math.random()*1000000);
let temp3=Date();
temp3.setMinutes(temp3.getMinutes()+10);

function sendToOutlook()
{
    window.open('mailto:${email}?subject=${encodeURIComponent("CLiC OTP")}&body=${encodeURIComponent("Your OTP is: " + OTP+". Valid 10 minutes until "+temp3)}');
}
sendToOutlook();

function clearData()
{
    document.getElementById("loginForm").innerHTML = "";
    document.getElementById("authenticateForm").innerHTML = "";
}
clearData();

function Text1Generate(){
    let temp="To complete login process to CLiC, please enter 6 digits OTP code provided to email ";
    let temp1b=hidePassword+"@student.mmu.edu.my. ";
    let temp2="Valid 10 minutes until ";
    document.getElementById("text1").innerHTML=temp+temp1b+temp2+temp3;
}
Text1Generate();

document.getElementsByClassName("ID").innerHTML=ID;

function ValidateOTP(){
    if (Date().getTime() > temp3.getTime()) {
        alert("OTP has expired. Please request a new OTP.");
        return;
    }
    if (document.querySelector('input[name="ValidateOTP"]').value == "") {
        alert("Please enter your OTP");
        return;
    }
    if (document.querySelector('input[name="ValidateOTP"]').value != OTP) {
        alert("Invalid OTP");
        return;
    }
    window.location.href="Enrollment.html";

}