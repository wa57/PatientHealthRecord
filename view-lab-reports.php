<script>
    document.addEventListener("DOMContentLoaded", function() {
        GET("GetLabTestsPerformedByUserId&patient_id=" + getUser().system_user_id, addLabReports);

        function addLabReports(response) {
            var html = "";
            response.forEach(function(labTest) {
                html += "<article class='card'>";
                html +=     "<p>Test: <strong>" + labTest.test_name + "</strong></p>";
                html +=     "<p>Results: <strong>" + labTest.results + "</strong></p>";
                html +=     "<p>Test Lab Address: <strong>" + labTest.test_lab_addr + "</strong></p>";
                html +=     "<p>Date Performed: <strong>" + labTest.date_performed + "</strong></p>"
                html += "</article>";
            });
            document.getElementById("patient-lab-cards").innerHTML = html;
        }
    });
</script>

<h3>View Lab Reports</h3>
<div class="centered">
    <section id="patient-lab-cards" class="cards"></section>
</div>
   

