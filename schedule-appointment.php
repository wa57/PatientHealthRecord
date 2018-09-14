<?php include 'layout.php' ?>
@{
    ViewData["Title"] = "ScheduleAppointment";
    Layout = "~/Views/Shared/_Layout.cshtml";
}

<h3>Schedule Appointment</h3>

<div>
    <span>Select your physician:</span>
    <select>
        <option>Theresa Cohen</option>
    </select>
    <div>
        <input type="submit" value="Show Availability" />
    </div>

    <p>Available appointments listed below. Please select the date and time you would like.</p>

    <table>
        <tr>
            <th>Physican Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Selection</th>
        </tr>
        <tr>
            <td>Theresa Cohen</td>
            <td>05/10/2018</td>
            <td>2:30pm</td>
            <td><input type="radio" name="selection"/></td>
        </tr>
        <tr>
            <td>Theresa Cohen</td>
            <td>05/10/2018</td>
            <td>3:30pm</td>
            <td><input type="radio" name="selection"/></td>
        </tr>
    </table>
    <input type="submit" value="Schedule Appointment" />
</div>

