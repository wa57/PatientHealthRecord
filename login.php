<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
    document.addEventListener("DOMContentLoaded", function() {
    
        document.getElementById("submit-login-credentials").addEventListener('click', function() { 
            loginUser(document.getElementById("username").value, document.getElementById("password").value);
        });

        document.getElementById("submit-registration").addEventListener("click", function() {
            let el = document.getElementById("state");
            let state = el.options[el.selectedIndex].text;
            
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
            localStorage.setItem("user", JSON.stringify(response));
            window.location = "index.php";
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
            document.getElementById("datepicker").value = "06/05/1984";
            document.getElementById("phone").value = "5555555555";
            document.getElementById("address").value = "666 Test Avenue";
            document.getElementById("apartment-num").value = "2";
            document.getElementById("city").value = "Fairfield";
            document.getElementById("zipcode").value = "06880";
            document.getElementById("zipcode-ext").value = "66";
            document.getElementById("reg-username").value = "USERNAME" + guid();
            document.getElementById("reg-password").value = "PASSWORD";
            document.getElementById("email").value = "test@test.com";
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
            document.getElementById("email").value = "";
        });
        
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
                <div class="col">
                    <div>
                        <label for="fname">First Name<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="fname" type="text" title="First Name" placeholder="First Name" />
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="lname">Last Name<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="lname" type="text" title="Last Name" placeholder="Last Name" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <label for="bdate">Birth Date<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="datepicker" disabled width="300"/>
                    </div>
                </div>

                <div class="col">
                    <div>
                        <label for="phone">Best phone number to be reached at<span class="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="phone" type="text" tile="Phone Number" placeholder="Phone Number" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <label for="address">Address<span class="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="address" type="text" placeholder="Address"/>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="apartment-num">Apartment #</label>
                    </div>
                    <div>
                        <input id="apartment-num" type="text" placeholder="Apartment"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <label htmlFor="city">City<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="city" type="text" placeholder="City"/>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label htmlFor="state">State<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <select id="state">
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
                </div>
                <div class="col">
                    <div>
                        <label htmlFor="zipcode">Zipcode<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="zipcode" type="text" placeholder="Zipcode"/>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label htmlFor="zipcode-ext">Zipcode Ext.</label>
                    </div>
                    <div>
                        <input id="zipcode-ext" type="text" placeholder="Zipcode Ext."/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <label htmlFor="email">Email<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="email" type="text" placeholder="Email"/>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label htmlFor="username">Username<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="reg-username" type="text" placeholder="Username"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div>
                        <label htmlFor="password">Password<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="reg-password" type="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label htmlFor="confirm-password">Confirm Password<span class="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="confirm-password" type="password" placeholder="Confirm Password"/>
                    </div>
                </div>
            </div>

            <div>
                <button id="submit-registration" value="Register">Register</button>
                <button id="clear-button">Clear</button>
                <button id="test-button">TEST</button>
                <span id="message"></span>
            </div>
        </div>
    </div>
</div>