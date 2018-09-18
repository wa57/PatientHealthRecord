<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Get("GetPhysicians", addPhysicians);

        document.getElementById("show-availability").addEventListener('click', function() { 
            physicians_list = document.getElementById("physicians-list")
            physician_id = physicians_list.options[physicians_list.selectedIndex].getAttribute("data-physician-id");
            var params = 'GetUnscheduledAppointmentsByPhysicianId&patient_id=' + user.system_user_id + "&physician_id=" + physician_id
            fetch("api/process.php", {
                method: 'get',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: params
            })
            .then(response => response.json())
            .then(function(response) {
                addAppointments(response);
            });
        }, false);
        
        document.getElementById("schedule-appointment").addEventListener("click", function() {
            var user = JSON.parse(localStorage.getItem("user"));
            
            var radios = document.getElementsByName('appointment-selection');

            var appointment_id = null;
            for(var i = 0, length = radios.length; i < length; i++)
            {
                if(radios[i].checked)
                {
                    appointment_id = radios[i].getAttribute('data-appointment-id');
                    break;
                }
            }

            var params = 'ScheduleAppointment&patient_id=' + user.system_user_id + "&appointment_id=" + appointment_id
            fetch("api/process.php", {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: params
            })
            .then(response => response.json())
            .then(function(response) {
                //console.log('Success:', JSON.stringify(response));
                console.log(response);
            });
        }, false);

        function addAppointments(response) {
            var html = "";
            response.forEach(function(appointment) {
                html += "<tr>";
                html +=     "<td>" + appointment.physician_id + "</td>";
                html +=     "<td>" + appointment.date + "</td>";
                html +=     "<td>" + appointment.date + "</td>";
                html +=     "<td> <input type='radio' name='appointment-selection' data-appointment-id='" + appointment.appointment_id + "'/> </td>";
                html += "</tr>";
            });
            document.getElementById("available-appointments-table").innerHTML = html;
        }

        function addPhysicians(response) {
            var html = "";
            response.forEach(function(physician) {
                html += "<option data-physician-id='" + physician.system_user_id + "'>";
                html +=     physician.first_name + " " + physician.last_name;
                html += "</option>";
            });
            document.getElementById("physicians-list").innerHTML = html;
        }
    });
</script>
<div class="container main">
    <div>
        <h3>Schedule Appointment</h3>
        <span>Select your physician:</span>
        <select id="physicians-list"></select>
        <div>
            <input id="show-availability" type="submit" value="Show Availability" />
        </div>

        <p>Available appointments listed below. Please select the date and time you would like.</p>

        <table>
            <thead>
                <th>Physican Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Selection</th>
            </thead>
            <tbody id="available-appointments-table"></tbody>
        </table>
        <input id="schedule-appointment" type="submit" value="Schedule Appointment" />
    </div>
</div>



