<?php include 'layout.php' ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Get("GetPhysicians", addPhysicians);
        rows = [];
        document.getElementById("show-availability").addEventListener('click', function() { 
            physicians_list = document.getElementById("physicians-list")
            physician_id = physicians_list.options[physicians_list.selectedIndex].getAttribute("data-physician-id");
     
            fetch("api/process.php?GetUnscheduledAppointmentsByPhysicianId&physician_id=" + physician_id, {
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
                //console.log('Success:', JSON.stringify(response));
                console.log(response);
            });
        }, false);

        function addAppointments(response) {
            response.forEach(function(appointment) {
                row = "";
                row += "<tr>";
                row +=     "<td>" + appointment.physician_id + "</td>";
                row +=     "<td>" + appointment.date + "</td>";
                row +=     "<td>" + appointment.time + "</td>";
                row +=     "<td> <input type='radio' name='appointment-selection' data-appointment-id='" + appointment.appointment_id + "'/> </td>";
                row += "</tr>";
                rows.push(row);
            });
            loadData();
        }

        function addPhysicians(response) {
            var html = "<option selected disabled>Select a Physician</option>";
            response.forEach(function(physician) {
                html += "<option data-physician-id='" + physician.system_user_id + "'>";
                html +=     physician.first_name + " " + physician.last_name;
                html += "</option>";
            });
            document.getElementById("physicians-list").innerHTML = html;
        }

        var pageSize = 5;
        var pageNum = 0;
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
        <div>
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
        <input id="previous-page" type="button" value="Back"/>
        <input id="next-page" type="button" value="Next"/>
        <input id="schedule-appointment" type="submit" value="Schedule Appointment" />
    </div>
</div>



