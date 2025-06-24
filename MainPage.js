document.getElementById("EnrollmentAppointmentButton").addEventListener("click", EAB);
document.getElementById("ShoppingCartButton").addEventListener("click", ShoppingCart);
document.getElementById("DropClassesButton").addEventListener("click", DropClasses);
document.getElementById("SwapClassesButton").addEventListener("click", SwapClasses);
document.getElementById("PlannerButton").addEventListener("click", Planner);
document.getElementById("ViewMyClassesButton").addEventListener("click", ViewMyClasses);
document.getElementById("EnrollmentSummaryButton").addEventListener("click", EnrollmentSummary);

var allSubjectCodes = [];
var allSubjectNames = [];
var allSubjectCredits = [];
var allSubjectDays=[];
var allSubjectStart=[];
var allSubjectEnd=[];

var ID = sessionStorage.getItem('userID');

function ClearAll(){
    document.getElementById("EnrollmentAppointment").style.display="none";
    document.getElementById("ShoppingCart").style.display="none";
    document.getElementById("DropClasses").style.display="none";
    document.getElementById("SwapClasses").style.display="none";
    document.getElementById("Planner").style.display="none";
    document.getElementById("ViewMyClasses").style.display="none";
    document.getElementById("EnrollmentSummary").style.display="none";
}

function EAB() { //done
    ClearAll();
    // Get the current date
    const currentDate = new Date();
    const Date1Start = new Date("2025-02-04");
    const Date1End = new Date("2025-04-12");
    const Date2Start = new Date("2025-06-24");
    const Date2End = new Date("2025-08-23");
    const Date3Start = new Date("2025-09-28");
    const Date3End = new Date("2025-11-16");

    currentMonth = currentDate.getMonth();
    currentDay = currentDate.getDate();
    Date1StartMonth = Date1Start.getMonth();
    Date1StartDay = Date1Start.getDate();
    Date1EndMonth = Date1End.getMonth();
    Date1EndDay = Date1End.getDate();
    Date2StartMonth = Date2Start.getMonth();
    Date2StartDay = Date2Start.getDate();
    Date2EndMonth = Date2End.getMonth();
    Date2EndDay = Date2End.getDate();
    Date3StartMonth = Date3Start.getMonth();
    Date3StartDay = Date3Start.getDate();
    Date3EndMonth = Date3End.getMonth();
    Date3EndDay = Date3End.getDate();

    document.getElementById("EnrollmentAppointment").style.display="block";
    if((((currentMonth>Date1StartMonth) || (currentMonth==Date1StartMonth && currentDay>Date1StartDay)) && ((currentMonth<Date1EndMonth) || (currentMonth==Date1EndMonth && currentDay<Date1EndDay)))
    || (((currentMonth>Date2StartMonth) || (currentMonth==Date2StartMonth && currentDay>Date2StartDay)) && ((currentMonth<Date2EndMonth) || (currentMonth==Date2EndMonth && currentDay<Date2EndDay)))
    || (((currentMonth>Date3StartMonth) || (currentMonth==Date3StartMonth && currentDay>Date3StartDay)) && ((currentMonth<Date3EndMonth) || (currentMonth==Date3EndMonth && currentDay<Date3EndDay)))) {
        document.getElementById("EnrollmentAppointment").innerHTML="<h1>You have an Enrollment Appointment</h1><p>Please click this button to proceed with it</p><button onclick='ShoppingCart()' style='color:black;'>Proceed</button>";
    }
    else{
        document.getElementById("EnrollmentAppointment").innerHTML="<h1>You don't have an Enrollment Appointment</h1>";
    }
}


function DropClasses() {
    ClearAll();
    document.getElementById("DropClasses").style.display="block";
    document.getElementById("DropClasses").innerHTML="";
    document.getElementById("DropClasses").innerHTML="<h1>Drop Classes</h1>";
    for (let i = 0; i < allSubjectCodes.length; i++) {
        const subjectCode = allSubjectCodes[i];
        const subjectName = allSubjectNames[i];
        const subjectCreditHours = allSubjectCredits[i];
        const subjectDay=allSubjectDays[i];
        const subjectStart=allSubjectStart[i];
        const subjectEnd=allSubjectEnd[i];
        document.getElementById("DropClasses").innerHTML += `<div class='subject-item' style='border: 2px solid #ccc;'>
            <span class='subject-code'>Subject Code: ${subjectCode}</span><br>
            <span class='subject-name'>Subject Name: ${subjectName}</span><br>
            <span class='credit-hours'>Credit Hours: ${subjectCreditHours}</span><br>
            <span class='credit-hours'>Day: ${subjectDay}</span><br>
            <span class='credit-hours'>From: ${subjectStart}</span><br>
            <span class='credit-hours'> To : ${subjectEnd}</span><br>
            <button onclick='removeClass("${subjectCode}")' style='color:black;'>Drop Class</button>
            </div>`;
    }
}

function removeClass(subjectCode) {
    const index = allSubjectCodes.indexOf(subjectCode);
    allSubjectCodes.splice(index, 1);
    allSubjectNames.splice(index, 1);
    allSubjectCredits.splice(index, 1);
    allSubjectDays.splice(index, 1);
    allSubjectStart.splice(index, 1);
    allSubjectEnd.splice(index, 1);
    updateSessionCart();
    saveAllSubjectsToSession();
    DropClasses(); // Refresh the Shopping Cart display
}

function SwapClasses() {
    ClearAll();
    document.getElementById("SwapClasses").style.display="block";
    document.getElementById("SwapClasses").innerHTML="";
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "GetSubject.php", true);
    xhr.onload = function() {
        const subjects = JSON.parse(xhr.responseText);

        const subjectList = document.getElementById('SwapClasses');
        subjectList.innerHTML = ''; // Clear previous content
        
        const plannerTitle = document.createElement('h1');
        plannerTitle.textContent = 'Swap Classes';
        subjectList.appendChild(plannerTitle);
        
        subjects.forEach(subject => {
            if (!allSubjectCodes.includes(subject.Subject_Code))
            {
                return;
            }

            const idx = allSubjectCodes.indexOf(subject.Subject_Code);
            const currentDay = allSubjectDays[idx];
            const currentStart = allSubjectStart[idx];
            const currentEnd = allSubjectEnd[idx];

            const subjectDiv = document.createElement('div');
            subjectDiv.style.border = '2px solid #ccc';
            subjectDiv.style.padding = '10px';
            subjectDiv.style.marginBottom = '10px';
            subjectDiv.classList.add('subject-item1');

            // Subject basic info
            const subjectInfo = document.createElement('div');
            subjectInfo.innerHTML = `
                <span class="subject-code"><strong>Subject Code:</strong> ${subject.Subject_Code}</span><br>
                <span class="subject-name"><strong>Subject Name:</strong> ${subject.Subject_Name}</span><br>
                <span class="credit-hours"><strong>Credit Hours:</strong> ${subject.Subject_Credit_Hours}</span><br>
                <span class="credit-hours"><strong>Current Date:</strong> ${currentDay}</span><br>
                <span class="credit-hours"><strong>    From    :</strong> ${currentStart}</span><br>
                <span class="credit-hours"><strong>     To     :</strong> ${currentEnd}</span><br>
            `;

            // Schedule selection dropdown
            const scheduleLabel = document.createElement('label');
            scheduleLabel.innerHTML = '<strong>Select Schedule:</strong> ';
            scheduleLabel.style.display = 'block';
            scheduleLabel.style.margin = '10px 0 5px 0';
            scheduleLabel.style.color='!important';
            
            const scheduleSelect = document.createElement('select');
            scheduleSelect.className = 'class-and-time';
            scheduleSelect.style.padding = '5px';
            scheduleSelect.style.marginBottom = '10px';
            scheduleSelect.style.color='black';
            
            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = '-- Select a schedule --';
            defaultOption.style.color='black';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            scheduleSelect.appendChild(defaultOption);
            
            // Add schedule options
            for (let i = 0; i < subject.Days_Of_Week.length; i++) {
                const day = subject.Days_Of_Week[i];
                const start = formatTime(subject.Start_Times[i]);
                const end = formatTime(subject.End_Times[i]);
                // Skip the current schedule
                if (day === currentDay && start === currentStart && end === currentEnd) {
                    continue;
                }
                const option = document.createElement('option');
                option.value = `${day} ${start}-${end}`;
                option.textContent = `${day} ${start} - ${end}`;
                option.style.color = 'black';
                scheduleSelect.appendChild(option);
            }

            // Add class button
            const addButton = document.createElement('button');
            addButton.innerHTML = 'Switch Class';
            addButton.style.padding = '5px 10px';
            addButton.style.backgroundColor = '#4CAF50';
            addButton.style.color = 'white';
            addButton.style.border = 'none';
            addButton.style.borderRadius = '4px';
            addButton.style.cursor = 'pointer';
            addButton.addEventListener('click', () => {
                if (scheduleSelect.value) {
                    if (scheduleSelect.value===defaultOption.textContent)
                    {
                        alert("Please select a class session first!");
                    }
                    else
                    {
                        switchClass(
                        subject.Subject_Code,
                        scheduleSelect.value
                    );
                     
                    }
                } else {
                    alert('Please select a schedule first');
                }
            });

            // Append elements to subject div
            subjectDiv.appendChild(subjectInfo);
            subjectDiv.appendChild(scheduleLabel);
            subjectDiv.appendChild(scheduleSelect);
            subjectDiv.appendChild(addButton);

            // Append subject div to the main list
            subjectList.appendChild(subjectDiv);
        });
    };
    xhr.send();
}

function switchClass(subjectCode,subjectDay){
    subjectCode = subjectCode.trim();
    const [SubjectDay, TimeRange] = subjectDay.split(' ');
    const [start, end] = TimeRange.split('-');

    for (let i = 0; i < allSubjectDays.length; i++) {
        if (allSubjectCodes[i] === subjectCode) continue; // skip self
        if (allSubjectDays[i] === SubjectDay) {
            const existingStart = timeToMinutes(allSubjectStart[i]);
            const existingEnd = timeToMinutes(allSubjectEnd[i]);
            if (!(newEnd <= existingStart || newStart >= existingEnd)) {
                alert(`Time conflict detected with ${allSubjectCodes[i]} (${allSubjectNames[i]}) on ${SubjectDay}!`);
                return;
            }
        }
    }

    const index=allSubjectCodes.indexOf(subjectCode);
    allSubjectDays[index]=SubjectDay;
    allSubjectStart[index]=start;
    allSubjectEnd[index]=end;
    saveAllSubjectsToSession();
    SwapClasses();
}

function Planner() {
    ClearAll();
    document.getElementById("Planner").style.display = "block";
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "GetSubject.php", true);
    xhr.onload = function() {
        const subjects = JSON.parse(xhr.responseText);

        const subjectList = document.getElementById('Planner');
        subjectList.innerHTML = ''; // Clear previous content
        
        const plannerTitle = document.createElement('h1');
        plannerTitle.textContent = 'Planner';
        subjectList.appendChild(plannerTitle);
        
        subjects.forEach(subject => {
            const subjectDiv = document.createElement('div');
            subjectDiv.style.border = '2px solid #ccc';
            subjectDiv.style.padding = '10px';
            subjectDiv.style.marginBottom = '10px';
            subjectDiv.classList.add('subject-item');

            // Subject basic info
            const subjectInfo = document.createElement('div');
            subjectInfo.innerHTML = `
                <span class="subject-code"><strong>Subject Code:</strong> ${subject.Subject_Code}</span><br>
                <span class="subject-name"><strong>Subject Name:</strong> ${subject.Subject_Name}</span><br>
                <span class="credit-hours"><strong>Credit Hours:</strong> ${subject.Subject_Credit_Hours}</span><br>
            `;

            // Schedule selection dropdown
            const scheduleLabel = document.createElement('label');
            scheduleLabel.innerHTML = '<strong>Select Schedule:</strong> ';
            scheduleLabel.style.display = 'block';
            scheduleLabel.style.margin = '10px 0 5px 0';
            scheduleLabel.style.color='!important';
            
            const scheduleSelect = document.createElement('select');
            scheduleSelect.className = 'class-and-time';
            scheduleSelect.style.padding = '5px';
            scheduleSelect.style.marginBottom = '10px';
            scheduleSelect.style.color='black';
            
            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = '-- Select a schedule --';
            defaultOption.style.color='black';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            scheduleSelect.appendChild(defaultOption);
            
            // Add schedule options
            for (let i = 0; i < subject.Days_Of_Week.length; i++) {
                const day = subject.Days_Of_Week[i];
                const start = formatTime(subject.Start_Times[i]);
                const end = formatTime(subject.End_Times[i]);
                const option = document.createElement('option');
                option.value = `${day} ${start}-${end}`;
                option.textContent = `${day} ${start} - ${end}`;
                option.style.color='black';
                scheduleSelect.appendChild(option);
            }

            // Add class button
            const addButton = document.createElement('button');
            addButton.innerHTML = 'Add Class';
            addButton.style.padding = '5px 10px';
            addButton.style.backgroundColor = '#4CAF50';
            addButton.style.color = 'white';
            addButton.style.border = 'none';
            addButton.style.borderRadius = '4px';
            addButton.style.cursor = 'pointer';
            addButton.addEventListener('click', () => {
                if (scheduleSelect.value) {
                    if (scheduleSelect.value===defaultOption.textContent)
                    {
                        alert("Please select a class session first!");
                    }
                    else
                    {
                        addClass(
                        subject.Subject_Code,
                        subject.Subject_Name,
                        subject.Subject_Credit_Hours,
                        scheduleSelect.value
                    );
                     
                    }
                } else {
                    alert('Please select a schedule first');
                }
            });

            // Append elements to subject div
            subjectDiv.appendChild(subjectInfo);
            subjectDiv.appendChild(scheduleLabel);
            subjectDiv.appendChild(scheduleSelect);
            subjectDiv.appendChild(addButton);

            // Append subject div to the main list
            subjectList.appendChild(subjectDiv);
        });
    };
    xhr.send();
}

function addClass(subjectCode, subjectName, subjectCreditHours, subjectDay) {
    subjectCode = subjectCode.trim();
    const [SubjectDay, TimeRange] = subjectDay.split(' ');
    const [start, end] = TimeRange.split('-');

    const timeToMinutes = (t) => {
        const [hours, minutes] = t.split(':').map(Number);
        return hours * 60 + minutes;
    };

    const newStart = timeToMinutes(start);
    const newEnd = timeToMinutes(end);

    for (let i = 0; i < allSubjectDays.length; i++) {
        if (allSubjectDays[i] === SubjectDay) {
            const existingStart = timeToMinutes(allSubjectStart[i]);
            const existingEnd = timeToMinutes(allSubjectEnd[i]);

            if (!(newEnd <= existingStart || newStart >= existingEnd)) {
                alert(`Time conflict detected with ${allSubjectCodes[i]} (${allSubjectNames[i]}) on ${SubjectDay}!`);
                return; 
            }
        }
    }


    alert("Class added successfully!");
    allSubjectCodes.push(subjectCode);
    allSubjectNames.push(subjectName);
    allSubjectCredits.push(parseInt(subjectCreditHours));
    allSubjectDays.push(SubjectDay);
    allSubjectStart.push(start);
    allSubjectEnd.push(end);
    updateSessionCart();
    saveAllSubjectsToSession();
}

function updateSessionCart() {
    var total = allSubjectCredits.reduce((a, b) => parseInt(a) + parseInt(b), 0);
    sessionStorage.setItem('Total', total);
    sessionStorage.setItem('allSubjectCodes', allSubjectCodes);
}

function ShoppingCart() {
    ClearAll();
    loadAllSubjectsFromSession();
    document.getElementById("ShoppingCart").style.display = "block";
    document.getElementById("ShoppingCart").innerHTML = "";
    document.getElementById("ShoppingCart").innerHTML = "<h1>Shopping Cart</h1>";
    for (let i = 0; i < allSubjectCodes.length; i++) {
        const subjectCode = allSubjectCodes[i];
        const subjectName = allSubjectNames[i];
        const subjectCreditHours = allSubjectCredits[i];
        const subjectDay=allSubjectDays[i];
        const subjectStart=allSubjectStart[i];
        const subjectEnd=allSubjectEnd[i];
        document.getElementById("ShoppingCart").innerHTML += `<div class='subject-item' style='border: 2px solid #ccc;'>
            <span class='subject-code'>Subject Code: ${subjectCode}</span><br>
            <span class='subject-name'>Subject Name: ${subjectName}</span><br>
            <span class='credit-hours'>Credit Hours: ${subjectCreditHours}</span><br>
            <span class='credit-hours'>Day: ${subjectDay}</span><br>
            <span class='credit-hours'>From: ${subjectStart}</span><br>
            <span class='credit-hours'> To : ${subjectEnd}</span><br>
            </div>`;
    }
    if (allSubjectCodes.length === 0) {
        document.getElementById("ShoppingCart").innerHTML += "<p>No classes are in the Shopping Cart. Please proceed to planner to add class</p>";
        document.getElementById("ShoppingCart").innerHTML +=`<button onclick='Planner()' style='color:black;'>Add Class</button>`;
    } else {
    document.getElementById("ShoppingCart").innerHTML +=`<button onclick='Planner()' style='color:black;'>Add Class</button>`;
    document.getElementById("ShoppingCart").innerHTML +=`<button onclick='DropClasses()' style='color:black;'>Drop Class</button>`;
    }

}

// Helper function to format time (remove seconds if present)
function formatTime(timeString) {
    return timeString.split(':').slice(0, 2).join(':'); // Takes only hours and minutes
}


function EnrollmentSummary() {
    ClearAll();
    document.getElementById("EnrollmentSummary").style.display="block";
     document.getElementById("EnrollmentSummary").innerHTML ="<h1>Enrollment Summary</h1>";
    for (let i = 0; i < allSubjectCodes.length; i++) {
        const subjectCode = allSubjectCodes[i];
        const subjectName = allSubjectNames[i];
        const subjectCreditHours = allSubjectCredits[i];
        const subjectDay=allSubjectDays[i];
        const subjectStart=allSubjectStart[i];
        const subjectEnd=allSubjectEnd[i];
        document.getElementById("EnrollmentSummary").innerHTML += `<div class='subject-item' style='border: 2px solid #ccc;'>
            <span class='subject-code'>Subject Code: ${subjectCode}</span><br>
            <span class='subject-name'>Subject Name: ${subjectName}</span><br>
            <span class='credit-hours'>Credit Hours: ${subjectCreditHours}</span><br>
            <span class='credit-hours'>Day: ${subjectDay}</span><br>
            <span class='credit-hours'>From: ${subjectStart}</span><br>
            <span class='credit-hours'> To : ${subjectEnd}</span><br>
            </div>`;
    }
    if (allSubjectCodes.length === 0) {
        document.getElementById("EnrollmentSummary").innerHTML = "<p>No classes are in the Shopping Cart. Please proceed to planner to add class</p>";
        document.getElementById("EnrollmentSummary").innerHTML +=`<button onclick='Planner()' style='color:black;'>Add Class</button>`;
    } else {
        document.getElementById("EnrollmentSummary").innerHTML +=`<button onclick='Enroll()' style='color:black;'>Enroll</button>`;
    }
}

function Enroll() {
var total = allSubjectCredits.reduce((a, b) => parseInt(a) + parseInt(b), 0);
sessionStorage.setItem('Total', total);
sessionStorage.setItem('allSubjectCodes',allSubjectCodes);
    if (total < 12) {
        alert(`You must enroll in at least 12 credit hours. You are currently enrolling ${total} hours`);
        return;
    }
    else if (total > 20) {
        alert(`You cannot enroll in more than 20 credit hours. You are currently enrolling ${total} hours`);
        return;
    }
    alert(`You have successfully enrolled in the following classes:\n\n${allSubjectCodes.join('\n')}\n\nTotal Credit Hours: ${total} Going to payment page...   `);
    window.location.href = "payment.html";
}

function ViewMyClasses() {
    ClearAll();
    document.getElementById("ViewMyClasses").style.display="block";
    document.getElementById("ViewMyClasses").innerHTML="";
    document.getElementById("ViewMyClasses").innerHTML="<h1>View My Classes</h1>";

    const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    const startHour = 8; 
    const endHour = 18; 

    function timeToMinutes(t) {
        const [h, m] = t.split(":").map(Number);
        return h * 60 + m;
    }

    // Build a 2D array for the calendar
    const calendar = [];
    for (let hour = startHour; hour < endHour; hour++) {
        const row = {};
        for (const day of days) {
            row[day] = null;
        }
        calendar.push(row);
    }

    // Place classes in the calendar
    for (let i = 0; i < allSubjectCodes.length; i++) {
        const day = allSubjectDays[i];
        const start = allSubjectStart[i];
        const end = allSubjectEnd[i];
        const code = allSubjectCodes[i];
        const name = allSubjectNames[i];

        // Only process if day is in our calendar
        if (!days.includes(day)) continue;

        const startMins = timeToMinutes(start);
        const endMins = timeToMinutes(end);
        const startRow = Math.floor((startMins - startHour * 60) / 60);
        const endRow = Math.ceil((endMins - startHour * 60) / 60);

        // Place class info in the starting cell, mark others as "occupied"
        if (startRow >= 0 && endRow > startRow && endRow <= calendar.length) {
            calendar[startRow][day] = {
                rowspan: endRow - startRow,
                code,
                name,
                start,
                end
            };
            // Mark the rest as occupied
            for (let r = startRow + 1; r < endRow; r++) {
                calendar[r][day] = "occupied";
            }
        }
    }

    // Build the table HTML
    let table = `<table border="1" style="border-collapse:collapse;width:100%;text-align:center;">
        <tr>
            <th>Time</th>
            ${days.map(d => `<th>${d}</th>`).join("")}
        </tr>`;

    for (let h = 0; h < calendar.length; h++) {
        const hourLabel = `${String(startHour + h).padStart(2, "0")}:00 - ${String(startHour + h + 1).padStart(2, "0")}:00`;
        table += `<tr><td style="width:90px;">${hourLabel}</td>`;
        for (const day of days) {
            const cell = calendar[h][day];
            if (cell === null) {
                table += `<td></td>`;
            } else if (cell === "occupied") {
                continue;
            } else {
                table += `<td rowspan="${cell.rowspan}" style="background:#0000ff;font-weight:bold;">
                    ${cell.code}<br>${cell.name}<br>${cell.start} - ${cell.end}
                </td>`;
            }
        }
        table += `</tr>`;
    }
    table += `</table>`;

    document.getElementById("ViewMyClasses").innerHTML += table;
    
}

function showContent(content) {
  dailyContent.style.display = "none";
  weeklyContent.style.display = "none";
  content.style.display = "block";
}

window.onload = function() {
    ShoppingCart();
}

function saveAllSubjectsToSession() {
    sessionStorage.setItem('allSubjectCodes', JSON.stringify(allSubjectCodes));
    sessionStorage.setItem('allSubjectNames', JSON.stringify(allSubjectNames));
    sessionStorage.setItem('allSubjectCredits', JSON.stringify(allSubjectCredits));
    sessionStorage.setItem('allSubjectDays', JSON.stringify(allSubjectDays));
    sessionStorage.setItem('allSubjectStart', JSON.stringify(allSubjectStart));
    sessionStorage.setItem('allSubjectEnd', JSON.stringify(allSubjectEnd));
}

function loadAllSubjectsFromSession() {
    allSubjectCodes = JSON.parse(sessionStorage.getItem('allSubjectCodes') || '[]');
    allSubjectNames = JSON.parse(sessionStorage.getItem('allSubjectNames') || '[]');
    allSubjectCredits = JSON.parse(sessionStorage.getItem('allSubjectCredits') || '[]');
    allSubjectDays = JSON.parse(sessionStorage.getItem('allSubjectDays') || '[]');
    allSubjectStart = JSON.parse(sessionStorage.getItem('allSubjectStart') || '[]');
    allSubjectEnd = JSON.parse(sessionStorage.getItem('allSubjectEnd') || '[]');
}