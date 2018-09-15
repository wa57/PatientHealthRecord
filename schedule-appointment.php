<?php 

include 'layout.php' 


?>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("show-availability").addEventListener('click', function() { 
            var http  = new XMLHttpRequest();
            var url = "api/process.php";
            http.open('GET', url + "?GetAppointments=true", true);
            http.setRequestHeader("Content-type", "application/json; charset=utf-8");
            http.onload = function() {
                if (http.status >= 200 && http.status < 400) {
                    addAppointments(JSON.parse(http.responseText));
                } else {
                    // We reached our target server, but it returned an error
                }
            };
            http.onerror = function() {
            // There was a connection error of some sort
            };
            http.send();
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
    });
    
</script>
<div class="container">
  <div class="item1">Header</div>
  <div class="item2">Menu</div>
  <div class="item3">Main</div>  
  <div class="item4">Footer</div>
</div>

<h3>Schedule Appointment</h3>

<div>
    <span>Select your physician:</span>
    <select>
        <option>Theresa Cohen</option>
    </select>
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

