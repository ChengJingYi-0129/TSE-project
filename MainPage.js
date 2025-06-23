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

//stock a list of available data for corresponding subject
var listForlistForDays_Of_Week=[];
var listForlistForStartTimes=[];
var listForlistForEndTimes=[];

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
        document.getElementById("EnrollmentAppointment").innerHTML="You have an Enrollment Appointment";
    }
    else{
        document.getElementById("EnrollmentAppointment").innerHTML="You don't have an Enrollment Appointment";
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
    DropClasses(); // Refresh the Shopping Cart display
}




function SwapClasses() {
    ClearAll();
    document.getElementById("SwapClasses").style.display="block";
    document.getElementById("SwapClasses").innerHTML="Swap Classes";
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
            //listForlistForDays_Of_Week.push(subject.Days_Of_Week);
            //listForlistForStartTimes.push(subject.Start_Times);
            //listForlistForEndTimes.push(subject.End_Times);

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
    const [SubjectDay, TimeRange]=subjectDay.split(' ');
    const [start, end]=TimeRange.split('-');
    if (allSubjectCodes.includes(subjectCode)) {
        return; // Class already added, do nothing
    }
    allSubjectCodes.push(subjectCode);
    allSubjectNames.push(subjectName);
    allSubjectCredits.push(subjectCreditHours);
    allSubjectDays.push(SubjectDay);
    allSubjectStart.push(start);
    allSubjectEnd.push(end);
}


function ShoppingCart() {
    ClearAll();
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



document.getElementById("dailyTabButton").addEventListener("click", function() {
    showContent(dailyContent);
    document.getElementById("dailyTabButton").style.backgroundColor = "white";
    document.getElementById("dailyTabButton").style.color = "black";
});
document.getElementById("weeklyTabButton").addEventListener("click", function() {
    showContent(weeklyContent);
    document.getElementById("weeklyTabButton").style.backgroundColor = "white";
    document.getElementById("weeklyTabButton").style.color = "black";
    const currentDate = new Date();
    const operateDate= SetStartandEndDate(currentDate);
    const strDate = operateDate.StartDate;
    const strDate2 = operateDate.EndDate;
    const month=strDate.split('-')[1]-1;
    const year=strDate.split('-')[0];
    generateCalendar(month, year);

});

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
    var total = allSubjectCredits.reduce((a, b) => a + b, 0);

    if (total < 12) {
        alert(`You must enroll in at least 12 credit hours. You are currently enrolling ${total} hours`);
        return;
    }
    else if (total > 20) {
        alert(`You cannot enroll in more than 20 credit hours. You are currently enrolling ${total} hours`);
        return;
    }
}

// Function to display the "View My Classes" section
function ViewMyClasses() {
    const currentDate = new Date();
    const operateDate= SetStartandEndDate(currentDate);
    const strDate = operateDate.StartDate;
    const strDate2 = operateDate.EndDate;
    document.getElementById("Sdate").value = strDate;
    document.getElementById("Edate").value = strDate2;
    ClearAll();
    document.getElementById("ViewMyClasses").style.display="block";
    document.getElementById("ViewMyClasses").innerHTML="<h1>View My Classes</h1>\
    <form><div class='form-floating mb-3 mt-3'>\
    Start: <input type='date' class='form-control' id='Sdate' placeholder='Enter date'>\
     End : <input type='date' class='form-control' id='Edate' placeholder='Enter date'>\
    <button type='button' class='btn btn-primary' onclick='SetStartandEndDate(currentDate)'>Select</button>\
    </div></form>\
    <nav class='navbar navbar-default'>\
    <div class='container-fluid'>\
    <ul class='nav navbar-nav'>\
    <li class='col-sm-6' style='background-color:white;'><a href='#' id='dailyTabButton'>Daily</a></li>\
    <li class='col-sm-6' style='background-color:white;'><a href='#' id='weeklyTabButton'>Weekly</a></li>\
    </ul>\
    </div>\
    </nav>\
    <div id='dailyContent' class='content' style='background-color:white; display:none;'></div>\
    <div id='weeklyContent' class='content' style='background-color:white; display:none;'>\
    <div id='calendar-container'></div>\
    </div>";
}

function showContent(content) {
  // Hide all content divs
  dailyContent.style.display = "none";
  weeklyContent.style.display = "none";

  // Show the specific content
  content.style.display = "block";
}

function SetStartandEndDate(currentDate) {
    const dayofWeek= currentDate.getDay();
    const daysToMonday = (dayofWeek + 6) % 7; // Calculate days to Monday
    currentDate.setDate(currentDate.getDate() - daysToMonday); // Set to last Monday
    var strDate = currentDate.toString().split('T')[0];
        
    const daysToSunday=daysToMonday+6;
    currentDate.setDate(currentDate.getDate() + daysToSunday); // Set to next Sunday
    var strDate2 = currentDate.toString().split('T')[0];
    return{
        StartDate: strDate,
        EndDate: strDate2
    };
}

function generateCalendar(month, year) {
            const container = document.getElementById('calendar-container');
            container.innerHTML = ''; // Clear previous content

            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

            // Create the calendar header with month and year
            const header = document.createElement('div');
            header.className = 'calendar-header';
            header.innerHTML = `<h2>${monthNames[month]} ${year}</h2>`;
            container.appendChild(header);

            // Create the days of the week row
            const daysOfWeekRow = document.createElement('div');
            daysOfWeekRow.className = 'calendar';
            daysOfWeek.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.className = 'header';
                dayElement.textContent = day;
                daysOfWeekRow.appendChild(dayElement);
            });
            container.appendChild(daysOfWeekRow);

            // Calculate the first day of the month and the number of days in the month
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            // Create the grid for the calendar
            const calendarGrid = document.createElement('div');
            calendarGrid.className = 'calendar';

            // Add empty divs for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyDiv = document.createElement('div');
                calendarGrid.appendChild(emptyDiv);
            }

            // Add divs for each day of the month
            for (let day = 1; day <= lastDate; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.textContent = day;

                // Highlight today's date
                const today = new Date();
                if (today.getFullYear() === year && today.getMonth() === month && today.getDate() === day) {
                    dayDiv.classList.add('today');
                }

                calendarGrid.appendChild(dayDiv);
            }

            container.appendChild(calendarGrid);
        }


window.onload = function() {
    ShoppingCart();
}