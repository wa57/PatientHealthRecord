<?php 
include 'layout.php';

?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetLabTestsPerformedByUserId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            console.log(response);
            var html = "";
            response.forEach(function(labTest) {
                html += "<tr>";
                html +=     "<td>" + labTest.physician_id + "</td>";
                html +=     "<td>" + labTest.test_id + "</td>";
                html +=     "<td>" + labTest.results + "</td>";
                html +=     "<td>" + labTest.test_lab_addr + "</td>";
                html += "</tr>";
            });
            document.getElementById("lab-tests-tbody").innerHTML = html;
        }
    });
</script>


<div class="container main">
    <div>
        <h2>View Lab Reports</h2>

        <table id="lab-tests-table">
            <thead>
                <th>Test</th>
                <th>Date</th>
                <th>Results</th>
                <th>Test Lab Address</th>
            </thead>
            <tbody id="lab-tests-tbody"></tbody>
        </table>
    </div>
</div>

