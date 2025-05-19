var ID = sessionStorage.getItem('userID');
if (!ID) {
    alert("Please enter your ID");
    window.location.href = 'Interface.html';
}
    var email = ID + "@student.mmu.edu.my";
    var hidePassword = ID.replace(/(.{4}).*/, '$1******');
    var temp3 = new Date();
    temp3.setMinutes(temp3.getMinutes() + 10);

    window.onload = function() {
        // Generate the text for text1
        let temp = "To complete login process to CLiC, please enter 6 digits OTP code provided to email ";
        let temp1b = hidePassword + "@student.mmu.edu.my";
        let temp2 = " Valid 10 minutes until ";
        document.getElementById("text1").innerHTML = temp + temp1b + temp2 + temp3.toLocaleString();
        document.getElementById("ID").value = ID;
        form.submit();
    };