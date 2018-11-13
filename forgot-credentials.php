<script>

document.addEventListener("DOMContentLoaded", function() {
    
    function sendPasswordReset(username) {
        var params = 'SendPasswordResetEmail&username=' + username;
        POST(params, handlePasswordReset);
    }

    function handlePasswordReset(response) {
        document.getElementById("message").style.display = "block";
    }

    document.getElementById("reset-password").addEventListener("click", function(e) {
        document.getElementById("message").style.display = "none";
        sendPasswordReset(document.getElementById("username").value);
    });
});;



</script>

<h3>Forgot Password</h3>

<div>
    <label for="username">Username you used to register: </label>
</div>
<div class="row form-group">
    <div class="col-sm-4">
        <input id="username" type="text" placeholder="username" />
    </div>
    <div>
        <button id="reset-password">Send Password Reset</button>
    </div>
</div>
<div id="message" class="alert alert-success" style="width: 450px; display: none;">
    An email has been sent to the email address provided.
</div>
