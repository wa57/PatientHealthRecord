<?php include 'layout.php'; ?>

<div class="row">
    <div class="col-sm-4">
        <h3>Login</h3>
    </div>
    <div class="col-sm-8">
        <h3>New User? Register Here</h3>
        <p><span class="required-ast">&ast;</span> Required Field</p>
    </div>
</div>


<div class="row">
    <form class="col-sm-4">
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
            <a asp-area="" asp-controller="Home" asp-action="ForgotCredentials">Forgot My Password</a>
        </div>
        <div>
            <a asp-area="" asp-controller="Home" asp-action="ForgotCredentials">Forgot My Username</a>
        </div>
        <div>
            <input id="Text1" type="submit" value="Login" />
        </div>
    </form>
    <form class="col-sm-8">
        <div class="row">
            <div class="col-sm-6">
                <div>
                    <label for="fname">First Name<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" tile="First Name" placeholder="First Name" />
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <label for="fname">Last Name<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" tile="Last Name" placeholder="Last Name" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div>
                    <label for="bdate">Birth Date<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <select>
                        <option selected disabled>Day</option>
                        <option>01</option>
                    </select>
                    <select>
                        <option selected disabled>Month</option>
                        @{
                            var monthNames = System.Globalization.CultureInfo.CurrentCulture.DateTimeFormat.MonthNames;
                            for (var i = 0; i < 12; i++)
                            {
                                <option>@monthNames[i]</option>

                            }

                        }
                    </select>
                    <select>
                        <option selected disabled>Year</option>
                        @for (var i = 1900; i < DateTime.Now.Year; i++)
                        {
                            <option>@i</option>
                        }
                        <option>@DateTime.Now.Year</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div>
                    <label for="phone">Best phone number to be reached at<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="phone" type="text" tile="Phone Number" placeholder="Phone Number" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div>
                    <label for="fname">Address<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Address"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <label for="fname">Apartment #</label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Apartment"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div>
                    <label for="fname">City<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="City"/>
                </div>
            </div>
            <div class="col-sm-2">
                <div>
                    <label for="fname">State<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <select>
                        <option disabled selected>Select State</option>
                        <option>CT</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div>
                    <label for="fname">Zipcode<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Zipcode"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div>
                    <label for="fname">Zipcode Ext.</label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Zipcode Ext."/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div>
                    <label for="fname">Email<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Email"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <label for="fname">Username<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Username"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div>
                    <label for="fname">Password<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Password"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <label for="fname">Confirm Password<span class="required-ast">&ast;</span></label>
                </div>
                <div>
                    <input id="fname" type="text" placeholder="Confirm Password"/>
                </div>
            </div>
        </div>

        <div>
            <input id="Text1" type="submit" value="Register" />
            <input type="submit" value="Clear" />
        </div>
    </form>
</div>