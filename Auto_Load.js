var ID = sessionStorage.getItem('userID');
if (!ID) {
    alert("Please enter your ID");
    window.location.href = 'Interface.html';
}
    var email = ID + "@student.mmu.edu.my";
    var hidePassword = ID.replace(/(.{4})./, '$1******');
    var OTP = Math.floor(Math.random() * 1000000);
    var temp3 = new Date();
    temp3.setMinutes(temp3.getMinutes() + 10);

    window.onload = function() {
        // Generate the text for text1
        let temp = "To complete login process to CLiC, please enter 6 digits OTP code provided to email ";
        let temp1b = hidePassword + "@student.mmu.edu.my";
        let temp2 = " Valid 10 minutes until ";
        document.getElementById("text1").innerHTML = temp + temp1b + temp2 + temp3.toLocaleString();

        // Auto-send OTP via AJAX to PHP
        fetch('send_otp.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `email=${encodeURIComponent(email)}&otp=${encodeURIComponent(OTP)}&expiry=${encodeURIComponent(temp3.toLocaleString())}`
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== "sent") {
                alert("Failed to send OTP email.");
            }
        });

        // Display the ID (assuming you have an element with class "ID")
        let idElements = document.getElementsByClassName("ID");
        if (idElements.length > 0) {
            idElements[0].innerHTML = ID; // Assuming you want to update the first element with the class "ID"
        }
    };

    function ValidateOTP() {
        if (new Date().getTime() > temp3.getTime()) {
            alert("OTP has expired. Please request a new OTP.");
            return;
        }
        let userOtp = document.getElementsByName("ValidateOTP")[0].value;// Assuming you have an input field with id 'OTP'
        if (!userOtp || userOtp.value === "") {
            alert("Please enter your OTP");
            return;
        }
        if (userOtp.value != OTP) {
            alert("Invalid OTP");
            return;
        }
        window.location.href = "Enrollment.html";
    }

    window.ValidateOTP = ValidateOTP;  // make it global (though not strictly necessary in this scope)