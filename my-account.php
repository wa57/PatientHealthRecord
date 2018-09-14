<?php include 'layout.php'; ?>
@{
    ViewData["Title"] = "My Account";
    Layout = "~/Views/Shared/_Layout.cshtml";
    User user = (User) ViewData["User"];
}

<h3>My Account</h3>
<form>
    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="fname">First Name</label>
            </div>
            <div>
                <input id="fname" disabled="disabled" type="text" value="@user.FirstName" />
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <label for="lname">Last Name</label>
            </div>
            <div>
                <input id="lname" type="text" value="@user.LastName"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="bdate">Birth Date</label>
            </div>
            <div>
                <select disabled="disabled">
                    <option>@user.Birthdate.Day</option>
                </select>
                <select disabled="disabled">
                    @{
                        var month = System.Globalization.CultureInfo.CurrentCulture.DateTimeFormat.GetMonthName(@user.Birthdate.Month);
                        <option>@month</option>
                     }
                    
                </select>
                <select disabled="disabled">
                    <option>@user.Birthdate.Year</option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div>
                <label for="phone">Best phone number to be reached at</label>
            </div>
            <div>
                <input id="phone" type="text" value="@user.Phone"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="fname">Address 1</label>
            </div>
            <div>
                <input id="fname" type="text" placholder="" title=""value="@user.Address"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <label for="fname">Apartment #</label>
            </div>
            <div>
                <input id="fname" type="text" value="@user.Apartment"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div>
                <label for="fname">City</label>
            </div>
            <div>
                <input id="fname" type="text" value="@user.City"/>
            </div>
        </div>
        <div class="col-sm-2">
            <div>
                <label for="fname">State</label>
            </div>
            <div>
                <select>
                    <option>@user.State</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div>
                <label for="fname">Zipcode</label>
            </div>
            <div>
                <input id="fname" type="text" value="@user.Zipcode"/>
            </div>
        </div>
        <div class="col-sm-3">
            <div>
                <label for="fname">Zipcode Ext.</label>
            </div>
            <div>
                <input id="fname" type="text" value="@user.ZipcodeExt"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="fname">Email</label>
            </div>
            <div>
                <input id="fname" type="text" disabled="disabled" value="@user.Email"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <label for="fname">Username</label>
            </div>
            <div>
                <input id="fname" type="text" disabled="disabled" value="@user.Username"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="fname">Password</label>
            </div>
            <div>
                <input id="fname" type="text" />
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <label for="fname">Confirm Password</label>
            </div>
            <div>
                <input id="fname" type="text" />
            </div>
        </div>
    </div>

    <div>
        <input id="Text1" type="submit" value="Save" />
    </div>
</form>