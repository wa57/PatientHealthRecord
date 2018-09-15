<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Get("GetPhysicians", addPhysicians);

        document.getElementById("show-availability").addEventListener('click', function() { 
            Get("GetAppointments", addAppointments);
        }, false);
        
        function addAppointments(response) {
            var tableBody = document.getElementById("available-appointments-table");
            var html = "";
            response.forEach(function(appointment) {
                html += "<tr>";
                html +=     "<td>" + appointment.physician_id + "</td>";
                html +=     "<td>" + appointment.date + "</td>";
                html +=     "<td>" + appointment.date + "</td>";
                html +=     "<td> <input type='radio' name='appointment-selection'/> </td>";
                html += "</tr>";
            });
            tableBody.innerHTML = html;
        }

        function addPhysicians(response) {
            var select = document.getElementById("physicians-list");
            var html = "";
            response.forEach(function(physician) {
                html += "<option>";
                html +=     physician.first_name + " " + physician.last_name;
                html += "</option>";
            });
            select.innerHTML = html;
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
        <input type="submit" value="Schedule Appointment" />
    </div>
</div>



