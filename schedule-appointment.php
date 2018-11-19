<script>
    'use strict';
    document.addEventListener("DOMContentLoaded", function() {
        init();

        document.getElementById("physicians-list").addEventListener("change", function() {
            document.getElementById("appointments-section").style.display = "block";
            getAppointmentsByPhysicianId();
        });
        document.getElementById("patient-appointments-tbody").addEventListener("click", function(e) {
            if(e.target && e.target.classList.contains("cancel-button")) {
                var appointment_id = e.target.getAttribute("data-appointment-id");
                POST("CancelAppointment&appointment_id=" + appointment_id, refreshAppointmentsTable);
            }
        });

        document.getElementById("appointments-table").addEventListener("click", function(e) {
            var appointment_id = e.target.getAttribute("data-appointment-id");
            if(e.target && e.target.classList.contains("schedule-button")) {
                POST("ScheduleAppointment&patient_id=" + getUser().system_user_id + "&appointment_id=" + appointment_id, refreshAppointmentsTable);
            }

            if(e.target && e.target.classList.contains("cancel-button")) {
                POST("CancelAppointment&appointment_id=" + appointment_id, refreshAppointmentsTable);
            }
        });

        document.getElementById("previous-page").addEventListener("click", function() {
            previousPage();
        });

        document.getElementById("next-page").addEventListener("click", function() {
            nextPage();
        });

        function addAppointments(response) {
            var physician_name = getPhysicianData("data-physician-name");
            response.forEach(function(appointment) {
                rows.push(createAppointmentRow(appointment, physician_name));
            });
            loadTableData();
        }

        function createAppointmentRow(appointment, physician_name) {
            var row = "";
            var user = getUser()
            var className = "";
            if(user.system_user_id === appointment.patient_id) {
                className = "highlighted";
            }
            
            var buttonClass = "Schedule";
            var buttonStyles = "btn-primary";
            if(user.system_user_id === appointment.patient_id && appointment.patient_id !== null) {
                buttonClass = "Cancel";
                buttonStyles = "btn-danger";
            }
            
            var buttonState = "";
            if(user.system_user_id !== appointment.patient_id && appointment.patient_id !== null ) {
                buttonState = "disabled";
            }

            var appointmentStatus = "AVAILABLE";
            if(appointment.patient_id !== null) {
                appointmentStatus = "BOOKED";
            }

            row += "<tr class='" + className + "'>";
            row +=     "<td>" + physician_name + "</td>";
            row +=     "<td>" + appointment.date + "</td>";
            row +=     "<td>" + formatTime(appointment.time) + "</td>";
            row +=     "<td class='"+ appointmentStatus.toLowerCase() +"'>" + appointmentStatus + "</td>";
            row +=     "<td> <input type='button' class='btn " + buttonClass.toLowerCase() + "-button " + buttonStyles + "' value='" + buttonClass + "' data-appointment-id='" + appointment.appointment_id + "' " + buttonState + "/> </td>";
            row += "</tr>";
            return row;
        }

        function getAppointmentsByPhysicianId() {
            rows = [];
            var physician_id = getPhysicianData("data-physician-id");
            GET("GetAppointmentsByPhysicianId&physician_id=" + physician_id, addAppointments);
        }

        function getPhysicianData(attribute) {
            var physicians_list = document.getElementById("physicians-list");
            return physicians_list.options[physicians_list.selectedIndex].getAttribute(attribute);
        }

        function addPhysicians(response) {
            var html = "<option selected disabled>Select a Physician</option>";
            response.forEach(function(physician) {
                html += "<option data-physician-id='" + physician.system_user_id + "' data-physician-name='" + physician.first_name + " " + physician.last_name + "'>";
                html +=     physician.first_name + " " + physician.last_name;
                html += "</option>";
            });
            document.getElementById("physicians-list").innerHTML = html;
        }

        function formatTime(time) {
            let splitTime = time.split(":");
            let test = [];
            test.push(splitTime[0]);
            test.push(splitTime[1]);
            test = test.join(":");
            test = test.replace(",", ":");
            return test;
        }

        function addPatientAppointments(response) {
            var html = "";
            console.log(response);
            if(response.length > 0) {
                response.forEach(function(appointment) {
                    var appointment_status = "UPCOMING";
                    if(JSON.parse(appointment.appointment_status) === 1) {
                        appointment_status = "COMPLETE";
                    }
                    html += "<tr>";
                    html +=     "<td>" + appointment.physician_name + "</td>";
                    html +=     "<td>" + appointment.date + "</td>";
                    html +=     "<td>" + formatTime(appointment.time) + "</td>";
                    html +=     "<td>" + appointment_status + "</td>";
                    html +=     "<td>";
                    if(appointment_status === "UPCOMING") {
                        html += "<input type='button' class='cancel-button btn btn-danger' data-appointment-id='" + appointment.appointment_id + "' value='Cancel'/>";
                    } 
                    html +=     "</td>"
                    html += "</tr>";
                });
                document.getElementById("patient-appointments-tbody").innerHTML = html;
            } else {
                document.getElementById("patient-appointments-tbody").innerHTML = "<p>You are not scheduled for any appointments</p>";
            }
            
        }

        var pageSize = 5;
        var pageNum = 0;
        var rows = [];
        function loadTableData() {
            var page = rows.slice(pageNum * pageSize, (pageNum + 1) * pageSize);
            var nextpage = rows.slice((pageNum + 1)* pageSize, (pageNum + 2) * pageSize);
            if(pageNum === 0) {
                document.getElementById("previous-page").disabled = true;
            } else {
                document.getElementById("previous-page").disabled = false;
            }
            if(page.length < pageSize || nextpage.length === 0 ) {
                document.getElementById("next-page").disabled = true;
            } else {
                document.getElementById("next-page").disabled = false;
            }
            document.getElementById('available-appointments-table').innerHTML = page.join("");
        }

        function nextPage() {
            pageNum++;
            loadTableData();
        }

        function previousPage() {
            pageNum--;
            loadTableData();
        }

        function init() {
            GET("GetPhysicians", addPhysicians);
            getAppointmentsByPatientId();
            document.getElementById("appointments-section").style.display = "none";
        }

        function getAppointmentsByPatientId() {
            var system_user_id = getUser().system_user_id;
            GET("GetAppointmentsByPatientId&patient_id="+system_user_id, addPatientAppointments);
        }

        function refreshAppointmentsTable(response) {
            displayMessage(response);
            getAppointmentsByPhysicianId();
            getAppointmentsByPatientId();
        }

        function displayMessage(response) {
            if(response === true) {
                document.getElementById("message").innerHTML = "Appointment Scheduled!";
                document.getElementById("message").classList.add("success");
                document.getElementById("message").classList.remove("error");
            } else if(response === "cancelled") {
                document.getElementById("message").innerHTML = "Appointment Cancelled!";
                document.getElementById("message").classList.add("success");
                document.getElementById("message").classList.remove("error");
            }  else {
                document.getElementById("message").innerHTML = "You can only sign up for one appointment at a time.";
                document.getElementById("message").classList.add("error");
                document.getElementById("message").classList.remove("success");
            }
        }
    });
</script>
<div>
    <h3>Schedule An Appointment</h3>
    <span>Select your physician:</span>
    <select id="physicians-list">
        <option selected disabled>Select a Physician</option>
    </select>
    <div id="appointments-section">
        <div class="alert alert-info" style="margin-top: 15px; width: 500px;">
            <h5 class="alert-heading"><i class="fas fa-info-circle"></i> Important Information</h5>
            <ul>
                <li>Call (555)-555-5555 for same day appointments</li>
                <li>Office is open from 9 AM through 5 PM 7 days a week</li>
            </ul>
        </div>
        <p>Available appointments listed below. Please select the date and time you would like.</p>
        <input id="previous-page" type="button" class="btn btn-secondary" value="Back"/>
        <input id="next-page" type="button" class="btn btn-secondary" value="Next 5 Appointments"/>
        <span id="message"></span>
        <table id="appointments-table">
            <thead>
                <th>Physican Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Selection</th>
            </thead>
            <tbody id="available-appointments-table"></tbody>
        </table>
    </div>
</div>
<div>
    <h3>Your Appointments</h3>
    <table id="patient-appointments">
        <thead>
            <th>Physician Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody id="patient-appointments-tbody"></tbody>
    </table>
</div>

