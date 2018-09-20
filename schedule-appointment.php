<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Get("GetPhysicians", addPhysicians);
        document.getElementById("appointments-section").style.display = 'none';
        document.getElementById("show-availability").addEventListener('click', function() { 
            rows = [];
            document.getElementById("appointments-section").style.display = 'block';
            physicians_list = document.getElementById("physicians-list");
            physician_id = physicians_list.options[physicians_list.selectedIndex].getAttribute("data-physician-id");
     
            fetch("api/process.php?GetAppointmentsByPhysicianId&physician_id=" + physician_id, {
                method: 'get',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                }
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
                document.getElementById("show-availability").click();
            });
        }, false);

        document.getElementById("previous-page").addEventListener("click", function() {
            previousPage();
        });

        document.getElementById("next-page").addEventListener("click", function() {
            nextPage();
        });

        function addAppointments(response) {
            physicians_list = document.getElementById("physicians-list");
            physician_name = physicians_list.options[physicians_list.selectedIndex].getAttribute("data-physician-name");
            response.forEach(function(appointment) {
                row = "";
                row += "<tr>";
                row +=     "<td>" + physician_name + "</td>";
                row +=     "<td>" + appointment.date + "</td>";
                row +=     "<td>" + appointment.time + "</td>";
                var appointmentStatus = "AVAILABLE";
                var radioStatus = "";
                if(appointment.patient_id !== null) {
                    appointmentStatus = "BOOKED";
                    radioStatus = "disabled";
                }
                row +=     "<td class='"+ appointmentStatus.toLowerCase() +"'>" + appointmentStatus + "</td>";
                row +=     "<td> <input type='radio' name='appointment-selection' data-appointment-id='" + appointment.appointment_id + "' " + radioStatus + "/> </td>";
                row += "</tr>";
                rows.push(row);
            });
            loadData();
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
        function loadData() {
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
            loadData();
        }

        function previousPage() {
            pageNum--;
            loadData();
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
            <table>
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



