<?php include 'layout.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetPatientPrescriptionsByPatientId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            var html = "";
            response.forEach(function(prescription) {
                html += "<tr>";
                html +=     "<td>" + prescription.physician_id + "</td>";
                html +=     "<td>" + prescription.patient_id + "</td>";
                html +=     "<td>" + prescription.rx_id + "</td>";
                html +=     "<td>" + prescription.expires + "</td>";
                html +=     "<td>" + prescription.prescription_date + "</td>";
                html +=     "<td>" + prescription.dosage + "</td>";
                html +=     "<td>" + prescription.quantity + "</td>";
                html +=     "<td>" + prescription.description + "</td>";
                html +=     "<td>" + prescription.refills + "</td>";
                html +=     "<td>" + prescription.instructions + "</td>";
                html +=     "<td>" + prescription.pharmacy_addr + "</td>";
                html += "</tr>";
                
            });
            document.getElementById("patient-prescriptions-tbody").innerHTML = html;
        }
    });
</script>
<div class="container main">
    <div>
    GetPatientPrescriptionsByPatientId
        <h2>View Lab Reports</h2>

        <table id="patient-prescriptions-table">
            <thead>
                <th>Test</th>
                <th>Date</th>
                <th>Results</th>
                <th>Test Lab Address</th>
            </thead>
            <tbody id="patient-prescriptions-tbody"></tbody>
        </table>
    </div>
</div>

