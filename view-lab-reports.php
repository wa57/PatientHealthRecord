<?php 
include 'layout.php';


?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetLabTestsPerformedByUserId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            console.log(response);
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
                <th>Description</th>
            </thead>
            <tbody id="lab-tests-tbody"></tbody>
        </table>
    </div>
</div>

