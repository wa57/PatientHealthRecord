<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        init();

        document.getElementById("physicians-list").addEventListener('change', function() {
            document.getElementById("show-availability").disabled = false;
        });

        document.getElementById("show-availability").addEventListener('click', function() { 
            rows = [];
            document.getElementById("appointments-section").style.display = 'block';
            physician_id = getPhysicianData("data-physician-id");

            GET("GetAppointmentsByPhysicianId&physician_id=" + physician_id, addAppointments);
        }, false);
        
        document.getElementById("schedule-appointment").addEventListener("click", function() {
            var user = JSON.parse(localStorage.getItem("user"));
            
            var radios = document.getElementsByName('appointment-selection');
            console.log(this.getAttribute("data-appointment-id"));
            var appointment_id = null;
            for(var i = 0, length = radios.length; i < length; i++)
            {
                if(radios[i].checked)
                {
                    appointment_id = radios[i].getAttribute('data-appointment-id');
                    break;
                }
            }

            POST("ScheduleAppointment&patient_id=" + user.system_user_id + "&appointment_id=" + appointment_id, refreshAppointmentsTable);
        }, false);

        document.getElementById("appointments-table").addEventListener('click',function(e){
            if (e.target && e.target.classList.contains('schedule-button')) {
                console.log('hello');
            }
        })

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
            row += "<tr>";
            row +=     "<td>" + physician_name + "</td>";
            row +=     "<td>" + appointment.date + "</td>";
            row +=     "<td>" + appointment.time + "</td>";
            var appointmentStatus = "AVAILABLE";
            var buttonStatus = "";
            if(appointment.patient_id !== null) {
                appointmentStatus = "BOOKED";
                buttonStatus = "disabled";
            }
            row +=     "<td class='"+ appointmentStatus.toLowerCase() +"'>" + appointmentStatus + "</td>";
            row +=     "<td> <input type='button' class='schedule-button' name='appointment-selection' value='Schedule' data-appointment-id='" + appointment.appointment_id + "' " + buttonStatus + "/> </td>";
            row += "</tr>";
            return row;
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
            document.getElementById("appointments-section").style.display = 'none';
            document.getElementById("show-availability").disabled = true;
        }

        function refreshAppointmentsTable() {
            document.getElementById("show-availability").click();
        }
    });
</script>
<div class="container main">
    <div>
        <h3>Schedule Appointment</h3>
        <span>Select your physician:</span>
        <select id="physicians-list">
            <option selected disabled>Select a Physician</option>
        </select>
        <input id="show-availability" type="submit" value="Show Availability" />
        <div id="appointments-section">
            <p>Available appointments listed below. Please select the date and time you would like.</p>
            <input id="previous-page" type="button" value="Back"/>
            <input id="next-page" type="button" value="Next"/>
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
            <input id="schedule-appointment" type="submit" value="Schedule Appointment" />
        </div>
    </div>
</div>



