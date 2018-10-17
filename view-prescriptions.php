<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetPatientPrescriptionsByPatientId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            console.log(response);
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

<h3>View Prescriptions</h3>
<table id="patient-prescriptions-table">
    <thead>
        <th>Prescribing Physician</th>
        <th>Prescribed To</th>
        <th>Prescription Name</th>
        <th>Expires</th>
        <th>Prescription Date</th>
        <th>Dosage</th>
        <th>Quantity</th>
        <th>Description</th>
        <th>Refills</th>
        <th>Instructions</th>
        <th>Pharmacy Address</th>
    </thead>
    <tbody id="patient-prescriptions-tbody"></tbody>
</table>
  

