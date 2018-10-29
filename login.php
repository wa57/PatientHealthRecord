<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
    document.addEventListener("DOMContentLoaded", function() {
    
        document.getElementById("submit-login-credentials").addEventListener('click', function() { 
            var params = 'AuthenticateUser&username=' + document.getElementById("username").value + "&password=" + document.getElementById("password").value
            fetch("api/process.php", {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: params
            })
            .then(response => response.json())
            .then(function(response) {
                localStorage.setItem("user", JSON.stringify(response));
                window.location = "index.php";
            });
        }, false);

        document.getElementById("submit-registration").addEventListener("click", function() {
            let fields = {
                "fname": document.getElementById("fname").value,
                "lname": document.getElementById("lname").value,
                "birthdate": document.getElementById("datepicker").value,

            }

            console.log(fields);
        });

        function loginUser(response) {
            console.log(response);
        }

        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    });
</script>
<div class="row">
    <div class="col-sm-3">
        <h3>Login</h3>
        <div>
            <div>
                <label for="username">Username</label>
            </div>
            <div>
                <input id="username" type="text" placeholder="Username" title="Username" />
            </div>
            <div>
                <label for="password">Password</label>
            </div>
            <div>
                <input id="password" type="password" placeholder="Password" title="Password" />
            </div>
            <div>
                <a href="?path=forgot-credentials">Forgot My Password</a>
            </div>
            <div>
                <a href="?path=forgot-credentials">Forgot My Username</a>
            </div>
            <div>
                <input id="submit-login-credentials" type="submit" value="Login" />
            </div>
        </div>
    </div>
    <div class="col">
        <h3>New User? Register Here</h3>
        <span class="required-ast">&ast;</span> Required Field
        <div>
            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <label for="fname">First Name<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="fname" type="text" title="First Name" placeholder="First Name" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <label for="lname">Last Name<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="lname" type="text" title="Last Name" placeholder="Last Name" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <label for="bdate">Birth Date<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="datepicker"/>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div>
                        <label for="phone">Best phone number to be reached at<span class="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="phone" type="text" tile="Phone Number" placeholder="Phone Number" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <label for="address">Address<span class="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="address" type="text" placeholder="Address"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <label for="apartment-num">Apartment #</label>
                    </div>
                    <div>
                        <input id="apartment-num" type="text" placeholder="Apartment"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div>
                        <label htmlFor="city">City<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="city" type="text" placeholder="City"/>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div>
                        <label htmlFor="state">State<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <select>
                            <option disabled defaultValue>Select State</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div>
                        <label htmlFor="zipcode">Zipcode<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="zipcode" type="text" placeholder="Zipcode"/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div>
                        <label htmlFor="zipcode-ext">Zipcode Ext.</label>
                    </div>
                    <div>
                        <input id="zipcode-ext" type="text" placeholder="Zipcode Ext."/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <label htmlFor="email">Email<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="email" type="text" placeholder="Email"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <label htmlFor="username">Username<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="username" type="text" placeholder="Username"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <label htmlFor="password">Password<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="password" type="text" placeholder="Password"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>
                        <label htmlFor="confirm-password">Confirm Password<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="confirm-password" type="text" placeholder="Confirm Password"/>
                    </div>
                </div>
            </div>

            <div>
                <button id="submit-registration" value="Register">Register</button>
                <input type="submit" value="Clear" />
            </div>
        </div>
    </div>
</div>