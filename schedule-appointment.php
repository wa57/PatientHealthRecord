<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        init();

        document.getElementById("physicians-list").addEventListener("change", function() {
            document.getElementById("appointments-section").style.display = "block";
            getAppointmentsByPhysicianId();
        });

        document.getElementById("appointments-table").addEventListener("click", function(e){
            if (e.target && e.target.classList.contains("schedule-button")) {
                var user = JSON.parse(localStorage.getItem("user"));
                appointment_id = e.target.getAttribute("data-appointment-id");
                POST("ScheduleAppointment&patient_id=" + user.system_user_id + "&appointment_id=" + appointment_id, refreshAppointmentsTable);
            }

            if (e.target && e.target.classList.contains("cancel-button")) {
                appointment_id = e.target.getAttribute("data-appointment-id");
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
            physician_name = getPhysicianData("data-physician-name");
            response.forEach(function(appointment) {
                rows.push(createAppointmentRow(appointment, physician_name));
            });
            loadTableData();
        }

        function createAppointmentRow(appointment, physician_name) {
            row = "";
            var user = JSON.parse(localStorage.getItem("user"))
            var className = "";
            if(user.system_user_id === appointment.patient_id) {
                className = "highlighted";
            }
            
            var buttonClass = "Schedule";
            if(user.system_user_id === appointment.patient_id && appointment.patient_id !== null) {
                buttonClass = "Cancel";
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
            row +=     "<td>" + appointment.time + "</td>";
            row +=     "<td class='"+ appointmentStatus.toLowerCase() +"'>" + appointmentStatus + "</td>";
            row +=     "<td> <input type='button' class='" + buttonClass.toLowerCase() + "-button' value='" + buttonClass + "' data-appointment-id='" + appointment.appointment_id + "' " + buttonState + "/> </td>";
            row += "</tr>";
            return row;
        }

        function getAppointmentsByPhysicianId() {
            rows = [];
            physician_id = getPhysicianData("data-physician-id");
            GET("GetAppointmentsByPhysicianId&physician_id=" + physician_id, addAppointments);
        }

        function getPhysicianData(attribute) {
            physicians_list = document.getElementById("physicians-list");
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

        function addPatientAppointments(response) {
            var html = "";
            response.forEach(function(appointment) {
                html += "<tr>";
                html +=     "<td>" + appointment.physician_id + "</td>";
                html +=     "<td>" + appointment.date + "</td>";
                html +=     "<td>" + appointment.time + "</td>";
                html +=     "<td>TODO</td>";
                html += "</tr>";
            });
            document.getElementById("patient-appointments-tbody").innerHTML = html;
        }

        var pageSize = 5;
        var pageNum = 0;
        var rows = [];
        function loadTableData() {
            page = rows.slice(pageNum * pageSize, (pageNum + 1) * pageSize);
            nextpage = rows.slice((pageNum + 1)* pageSize, (pageNum + 2) * pageSize);
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
            var system_user_id = JSON.parse(localStorage.getItem("user")).system_user_id;
            GET("GetAppointmentsByPatientId&patient_id="+system_user_id, addPatientAppointments);
            document.getElementById("appointments-section").style.display = "none";
        }

        function refreshAppointmentsTable() {
            getAppointmentsByPhysicianId();
        }
    });
</script>
<div class="container main">
    <div>
        <div>
            <h3>Your Appointments</h3>
            <table id="patient-appointments">
                <thead>
                    <th>Physician Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </thead>
                <tbody id="patient-appointments-tbody"></tbody>
            </table>
        </div>
        <h3>Schedule Appointment</h3>
        <span>Select your physician:</span>
        <select id="physicians-list">
            <option selected disabled>Select a Physician</option>
        </select>
        <div id="appointments-section">
            <p>Available appointments listed below. Please select the date and time you would like.</p>
            <input id="previous-page" type="button" value="Back"/>
            <input id="next-page" type="button" value="Next 5 Appointments"/>
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
</div>



