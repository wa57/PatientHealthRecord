<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
    document.addEventListener("DOMContentLoaded", function() {
    
        document.getElementById("submit-login-credentials").addEventListener('click', function() { 
            loginUser(document.getElementById("username").value, document.getElementById("password").value);
        });

        document.getElementById("submit-registration").addEventListener("click", function() {           
             document.getElementById("message").style.display = "none";
            let el = document.getElementById("state");
            let state = el.options[el.selectedIndex].text;
            
            if(document.getElementById('reg-password').value !== document.getElementById('confirm-password').value) {
                document.getElementById("message").textContent = "Passwords do not match";
                document.getElementById("message").style.color = "red";
                document.getElementById("message").style.display = "inline";
                return;
            }
            
            let fields = {
                "fname": document.getElementById("fname").value,
                "lname": document.getElementById("lname").value,
                "birthdate": document.getElementById("datepicker").value,
                "phone": document.getElementById("phone").value,
                "address": document.getElementById("address").value,
                "apartment": document.getElementById("apartment-num").value,
                "city": document.getElementById("city").value,
                "state": state,
                "email": document.getElementById("email").value,
                "zipcode": document.getElementById("zipcode").value,
                "zipcode-ext": document.getElementById("zipcode-ext").value,
                "username": document.getElementById("reg-username").value,
                "password": document.getElementById("reg-password").value
            };

            POST("RegisterUser&userInfo=" + JSON.stringify(fields), handleResponse);
        });

        function loginUser(username, password) {
            var params = 'AuthenticateUser&username=' + username + "&password=" + password;
            POST(params, handleLogin);
        }

        function handleLogin(response) {
            response = JSON.parse(JSON.stringify(response));
            if(response.invalid) {
                document.getElementById("login-message-wrapper").style.display = "block";
                document.getElementById("login-message").textContent = response.message;
            } else {
                localStorage.setItem("user", JSON.stringify(response));
                window.location = "index.php";
            }
            
        }

        function handleResponse(response) {
            if(response.invalid) {
                document.getElementById("message").textContent = response.message;
                document.getElementById("message").style.color = "red";
                document.getElementById("message").style.display = "inline";
            } else {
                loginUser(response.user[0].username, response.user[0].password);
            }
        }

        document.getElementById("test-button").addEventListener("click", function() {
            document.getElementById("fname").value = "Hepseeba";
            document.getElementById("lname").value = "Kode";
            document.getElementById("datepicker").value = "1984-06-15";
            document.getElementById("phone").value = "5555555555";
            document.getElementById("address").value = "555 Test Avenue";
            document.getElementById("apartment-num").value = "2";
            document.getElementById("city").value = "Fairfield";
            document.getElementById("zipcode").value = "06880";
            document.getElementById("zipcode-ext").value = "1234";
            document.getElementById("reg-username").value = "USERNAME" + guid();
            document.getElementById("reg-password").value = "PASSWORD";
            document.getElementById("confirm-password").value = "PASSWORD";
            document.getElementById("email").value = "test@test.com";
            document.getElementById("message").style.display = "none";
        });

        document.getElementById("clear-button").addEventListener("click", function() {
            document.getElementById("fname").value = ""
            document.getElementById("lname").value = ""
            document.getElementById("datepicker").value = "";
            document.getElementById("phone").value = "";
            document.getElementById("address").value = "";
            document.getElementById("apartment-num").value = "";
            document.getElementById("city").value = "";
            document.getElementById("zipcode").value = "";
            document.getElementById("zipcode-ext").value = "";
            document.getElementById("reg-username").value = "";
            document.getElementById("reg-password").value = "";
            document.getElementById("confirm-password").value = "";
            document.getElementById("email").value = "";
            document.getElementById("message").style.display = "none";
        });
        
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    });
</script>
<div class="row">
    <div class="col-sm-4">
        <h3>Login</h3>
        <span class="required-ast">&ast;</span> Required Field
        <div id="login-message-wrapper" class="alert alert-danger" style="display: none;"><i class="fas fa-exclamation-circle"></i> <span id="login-message"></span></div>
        <div class="form-group">
            <label for="username">Username<span class="required-ast">*</span></label>
            <input type="text" class="form-control" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password<span class="required-ast">*</span></label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div>
            <a href="?path=forgot-credentials">Forgot My Password</a>
        </div>
        <div>
            <input id="submit-login-credentials" class="btn btn-primary" style="width: 100%" type="submit" value="Login" />
        </div>
    </div>
    
    <div class="col" >
        <h3>New User? Register Here</h3>
        <span class="required-ast">&ast;</span> Required Field
        <div>
            <div class="row">
                <div class="form-group col">
                    <label for="fname">First Name<span class="required-ast">&ast;</span></label>
                    <input id="fname" type="text" title="First Name" placeholder="First Name" class="form-control"/>
                </div>
                <div class="form-group col">
                    <label for="lname">Last Name<span class="required-ast">&ast;</span></label>
                    <input id="lname" type="text" class="form-control" placeholder="Last Name" title="Last Name"/>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="bdate">Birth Date<span class="required-ast">&ast;</span></label>
                    <input id="datepicker" class="form-control" placeholder="YYYY-MM-DD" disabled/>
                </div>

                <div class="form-group col">
                    <label for="phone">Best phone number to be reached at<span class="required-ast">*</span></label>
                    <input id="phone" type="text" class="form-control" tile="Phone Number" placeholder="Ex. 5555555555 (No Dashes or Spaces)" maxlength="10"/>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="address">Address<span class="required-ast">*</span></label>
                    <input id="address" type="text" class="form-control" placeholder="Full Street Address"/>
                </div>
                <div class="form-group col">
                    <label for="apartment-num">Apartment #</label>
                    <input id="apartment-num" type="text" class="form-control" placeholder="Apartment # (If Applicable)"/>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label htmlFor="city">City<span class="required-ast">&ast;</span></label>
                    <input id="city" type="text" class="form-control" placeholder="City"/>
                </div>
                <div class="form-group col">
                    <label htmlFor="state">State<span class="required-ast">&ast;</span></label>
                    <select id="state" class="form-control">
                        <option disabled defaultValue>Select State</option>
                        <option>AL</option>
                        <option>AK</option>
                        <option>AZ</option>
                        <option>AR</option>
                        <option>CA</option>
                        <option>CO</option>
                        <option>CT</option>
                        <option>DE</option>
                        <option>FL</option>
                        <option>GA</option>
                        <option>HI</option>
                        <option>ID</option>
                        <option>IL</option>
                        <option>IN</option>
                        <option>IA</option>
                        <option>KS</option>
                        <option>KY</option>
                        <option>LA</option>
                        <option>ME</option>
                        <option>MD</option>
                        <option>MA</option>
                        <option>MI</option>
                        <option>MN</option>
                        <option>MS</option>
                        <option>MO</option>
                        <option>MT</option>
                        <option>NE</option>
                        <option>NV</option>
                        <option>NH</option>
                        <option>NJ</option>
                        <option>NM</option>
                        <option>NY</option>
                        <option>NC</option>
                        <option>ND</option>
                        <option>OH</option>
                        <option>OK</option>
                        <option>OR</option>
                        <option>PA</option>
                        <option>RI</option>
                        <option>SC</option>
                        <option>SD</option>
                        <option>TN</option>
                        <option>TX</option>
                        <option>UT</option>
                        <option>VT</option>
                        <option>VA</option>
                        <option>WA</option>
                        <option>WV</option>
                        <option>WI</option>
                        <option>WY</option>
                    </select>
                </div>
                <div class="col form-group">
                    <div>
                        <label htmlFor="zipcode">Zipcode<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="zipcode" type="text" class="form-control" placeholder="Zipcode" maxlength='5'/>
                    </div>
                </div>
                <div class="col form-group">
                    <label htmlFor="zipcode-ext">Zipcode Ext.</label>
                    <input id="zipcode-ext" type="text" class="form-control" placeholder="Zipcode Ext." maxlength='4'/>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label htmlFor="email">Email<span class="required-ast">&ast;</span></label>
                    <input id="email" type="text" class="form-control" placeholder="Email"/>
                </div>
                <div class="col form-group">
                    <label htmlFor="username">Username<span class="required-ast">&ast;</span></label>
                    <input id="reg-username" type="text" class="form-control" placeholder="Username"/>
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col form-group">
                    <label htmlFor="password">Password<span class="required-ast">&ast;</span></label>
                    <input id="reg-password" type="password" class="form-control" placeholder="Password"/>
                </div>
                <div class="col form-group">
                    <label htmlFor="confirm-password">Confirm Password<span class="required-ast">&ast;</span></label>
                    <input id="confirm-password" type="password" class="form-control" placeholder="Confirm Password"/>
                </div>
            </div>

            <div>
                <button id="submit-registration" class="btn btn-primary" value="Register">Register</button>
                <button id="clear-button" class="btn btn-secondary">Clear</button>
                <button id="test-button" class="btn btn-link">TEST</button>
                <span id="message"></span>
            </div>
        </div>
    </div>
</div>