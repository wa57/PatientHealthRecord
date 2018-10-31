<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetPatientPrescriptionsByPatientId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            var html = "";
            response.forEach(function(prescription) {
                html += "<article class='card'>";
                html +=     "<p>Prescribing Physician: <strong>" + prescription.first_name + " " + prescription.last_name + "</strong></p>";
                html +=     "<p>Prescription Name: <strong>" + prescription.rx_name + "</strong></p>";
                html +=     "<p>Rx Number: <strong>" + prescription.rx_num + "</strong></p>";
                html +=     "<p>Expires: <strong>" + prescription.expires + "</strong></p>";
                html +=     "<p>Prescription Date: <strong>" + prescription.prescription_date + "</strong></p>";
                html +=     "<p>Dosage: <strong>" + prescription.dosage + "</strong></p>";
                html +=     "<p>Quantity: <strong>" + prescription.quantity + "</strong></p>";
                html +=     "<p>Description: <strong>" + prescription.description + "</strong></p>";
                html +=     "<p>Refills: <strong>" + prescription.refills + "</strong></p>";
                html +=     "<p>Instructions: <strong>" + prescription.instructions + "</strong></p>";
                html +=     "<p>Pharmacy Address: <strong>" + prescription.pharmacy_addr + "</strong></p>";
                html += "</article>";
                
            });
            document.getElementById("patient-prescriptions-cards").innerHTML = html;
        }
    });
</script>

<h3>View Prescriptions</h3>
<div class="centered">
    <section id="patient-prescriptions-cards" class="cards"></section>
</div>
  

