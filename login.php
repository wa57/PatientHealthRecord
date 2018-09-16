<?php include 'layout.php'; ?>
<div class="container main">
    <div>
        <h3>Login</h3>
        <form>
            <div>
                <label htmlFor="username">Username</label>
            </div>
            <div>
                <input id="username" type="text" placeholder="Username" title="Username" />
            </div>
            <div>
                <label htmlFor="password">Password</label>
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
                <input id="Text1" type="submit" value="Login" />
            </div>
        </form>
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
                <input id="Text1" type="submit" value="Register" />
                <input type="submit" value="Clear" />
            </div>
        </form>
    </div>
</div>