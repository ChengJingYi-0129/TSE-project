window.onload = function () {
    let ID = document.querySelector(".ID input").value;
    let email = ID + "@student.mmu.edu.my";
    let hidePassword = ID.replace(/(.{4})./, '$1******');
    let OTP = Math.floor(Math.random() * 1000000);
    let temp3 = new Date();
    temp3.setMinutes(temp3.getMinutes() + 10);

    function sendToOutlook() {
        window.open(`mailto:${email}?subject=${encodeURIComponent("CLiC OTP")}&body=${encodeURIComponent("Your OTP is: " + OTP + ". Valid 10 minutes until " + temp3)}`);
    }
    sendToOutlook();

    function clearData() {
        document.getElementById("loginForm").innerHTML = "";
        document.getElementById("authenticateForm").innerHTML = "";
    }
    // clearData();  // optional

    function Text1Generate() {
        let temp = "To complete login process to CLiC, please enter 6 digits OTP code provided to email ";
        let temp1b = hidePassword + "@student.mmu.edu.my";
        let temp2 = " Valid 10 minutes until ";
        document.getElementById("text1").innerHTML = temp + temp1b + temp2 + temp3;
    }
    Text1Generate();

    function ValidateID(){
        document.getElementsByClassName("ID").innerHTML = ID;
    }
    ValidateID();

    function ValidateOTP() {
        if (new Date().getTime() > temp3.getTime()) {
            alert("OTP has expired. Please request a new OTP.");
            return;
        }
        let userOtp = document.querySelector('input[placeholder="Enter your OTP"]').value;
        if (userOtp === "") {
            alert("Please enter your OTP");
            return;
        }
        if (userOtp != OTP) {
            alert("Invalid OTP");
            return;
        }
        window.location.href = "Enrollment.html";
    }

    window.ValidateOTP = ValidateOTP;  // make it global
};
