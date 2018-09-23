<?php include 'layout.php'; ?>
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

        function loginUser(response) {
            console.log(response);
        }
    });
</script>
<div class="container main">
    <div>
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
                <a>Forgot My Password</a>
            </div>
            <div>
                <a>Forgot My Username</a>
            </div>
            <div>
                <input id="submit-login-credentials" type="submit" value="Login" />
            </div>
        </div>
    </div>
    <div>
        <h3>New User? Register Here</h3>
        <span className="required-ast">&ast;</span> Required Field
        <form>
            <div className="row">
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="fname">First Name<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="fname" type="text" tile="First Name" placeholder="First Name" />
                    </div>
                </div>
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="lname">Last Name<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="lname" type="text" tile="Last Name" placeholder="Last Name" />
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="bdate">Birth Date<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <select>
                            <option selected disabled>Day</option>
                            <option>01</option>
                        </select>
                        <select>
                            <option selected disabled>Month</option>
                        </select>
                        <select>
                            <option selected disabled>Year</option>
                            <option>@DateTime.Now.Year</option>
                        </select>
                    </div>
                </div>

                <div className="col-sm-6">
                    <div>
                        <label htmlFor="phone">Best phone number to be reached at<span className="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="phone" type="text" tile="Phone Number" placeholder="Phone Number" />
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="address">Address<span className="required-ast">*</span></label>
                    </div>
                    <div>
                        <input id="address" type="text" placeholder="Address"/>
                    </div>
                </div>
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="apartment-num">Apartment #</label>
                    </div>
                    <div>
                        <input id="apartment-num" type="text" placeholder="Apartment"/>
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-sm-4">
                    <div>
                        <label htmlFor="city">City<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="city" type="text" placeholder="City"/>
                    </div>
                </div>
                <div className="col-sm-2">
                    <div>
                        <label htmlFor="state">State<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <select>
                            <option disabled defaultValue>Select State</option>
                            <option>CT</option>
                        </select>
                    </div>
                </div>
                <div className="col-sm-3">
                    <div>
                        <label htmlFor="zipcode">Zipcode<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="zipcode" type="text" placeholder="Zipcode"/>
                    </div>
                </div>
                <div className="col-sm-3">
                    <div>
                        <label htmlFor="zipcode-ext">Zipcode Ext.</label>
                    </div>
                    <div>
                        <input id="zipcode-ext" type="text" placeholder="Zipcode Ext."/>
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="email">Email<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="email" type="text" placeholder="Email"/>
                    </div>
                </div>
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="username">Username<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="username" type="text" placeholder="Username"/>
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="password">Password<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="password" type="text" placeholder="Password"/>
                    </div>
                </div>
                <div className="col-sm-6">
                    <div>
                        <label htmlFor="confirm-password">Confirm Password<span className="required-ast">&ast;</span></label>
                    </div>
                    <div>
                        <input id="confirm-password" type="text" placeholder="Confirm Password"/>
                    </div>
                </div>
            </div>

            <div>
                <input id="submit-registration" type="submit" value="Register" />
                <input type="submit" value="Clear" />
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>