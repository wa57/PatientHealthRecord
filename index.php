<?php include "api/db_connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient Health Record</title>
    <style>
        main {
            padding: 1em;
        }

        .header, .menu, .main, .footer{ 
            margin: 0 auto;
            padding: 1.5em;
        }

        .menu { 
            background-color: #fff;
            border-bottom: 1px solid #ebebeb;
        }

        .container {
            display: grid;
            
        }

        h2 a {
            text-decoration: none;
        }

        h2 a:visited {
            color: black;
        }

        nav {
            height: 100vh;
            background: #ebebeb;
        }

        nav h3 a {
            color: #F25652;
        }

        nav h3 {
            padding: 1em;
            margin-bottom: 0;
        }

        nav h3 a:hover {
            color: #F25652;
            text-decoration: none;
        }

        nav li a, #logout-link {
            color: black;
            text-decoration: none;
            width: 100%;
            display: block;
            padding: 1rem 1.5rem;
        }

        nav li a:hover, .active-link, #logout-link:hover {
            background: #575757;
            color: #ebebeb;
            text-decoration: none;
        }

        #logout-link {
            background:none;
            border:none; 
            cursor: pointer;
            outline: none;
            text-align: left;
        }

        nav i {
            margin-right: 15px;
        }

        .booked {
            color: red;
        }

        .available {
            color: green;
        }

        .highlighted {
            background-color: #ffff99;
        }

        .cancel-button {
            background-color: red;
            color: #fff;
        }

        #message {
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        #color-bar {
            height: 50px;
            width: 960px;
            margin: 0 auto;
            background: #F25652;
        }

        .gj-datepicker {
            width: 100px;
        }

        #patient-prescriptions-table {
            width: 100%;
        }

        #nav-buttons {
            margin-top: 15px;
        }

        .header {
            background: #F25652;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .card {
            flex: 0 1 24%;
            padding: 25px;
            flex-grow: 1;
            margin-right: 10px;
        }

        .card p {
            margin-bottom: 5px;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        'use strict';

        function GET(query, callback) {
            fetch("api/process.php?" + query, {
                method: 'get',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                }
            })
            .then(response => response.json())
            .then(function(response) {
                callback(response);
            });
        }

        function POST(params, callback) {
            fetch("api/process.php", {
                method: 'post',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                },
                body: params
            })
            .then(response => response.json())
            .then(function(response) {
                callback(response);
            });
        }

        function getUser() {
            return JSON.parse(localStorage.getItem("user"));
        }

        function setUser(user) {
            localStorage.setItem("user", null);
        }

        function guid() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
            }
            return s4() + s4() + '-' + s4();
        }

        document.addEventListener("DOMContentLoaded", function() {         
            toggleNavState();
            addActiveLink();

            document.getElementById("logout-link").addEventListener("click", function() {
                setUser(null);
                window.location.href = "index.php?path=homepage";
            });

            document.getElementById("exit-button").addEventListener("click", function() {
                setUser(null);
                window.location.href = "https://www.google.com/_/chrome/newtab";
            });

            document.getElementById("home-button").addEventListener("click", function() {
                window.location.href = "index.php";
            });

            document.getElementById("previous-button").addEventListener("click", function() {
                history.back();
            });

            document.getElementById("logout-button").addEventListener("click", function() {
                setUser(null);
                window.location.href = "index.php?path=homepage";
            });

            function toggleNavState() {
                var user = getUser();
                var links = document.getElementsByClassName("login-required"); 
                if(user && user !== null) {
                    document.getElementById("login-link").style.display = "none";
                    document.getElementById("logout-link").style.display = "inline-block";
                    let navButtons = document.querySelectorAll(".nav-button");
                } else {
                    document.getElementById("login-link").style.display = "inline-block";
                    document.getElementById("logout-link").style.display = "none";
                }

                for (var i = 0; i < links.length; i++) {
                    if(user && user !== null) {
                        links[i].style.display = "inline-block";
                    } else {
                        links[i].style.display = "none";
                    }
                }
            }

            function addActiveLink() {
                let navLinks = document.querySelectorAll("ul li a");
                for(let i = 0; i < navLinks.length; i++) {
                    var linkName = navLinks[i].getAttribute("href").split('=').pop();
                    var locationName = document.location.href.split("=").pop();

                    if(linkName === locationName) {
                        navLinks[i].classList.add("active-link");
                    }

                    if(locationName === "https://www.patienthealthrecord.net/index.php" || locationName === "https://www.patienthealthrecord.net/") {
                        document.getElementById("homepage-link").classList.add("active-link");
                    }
                }
            }
        });


    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="sticky-top">
                <h3>
                    <a href="?path=homepage"><i class="fas fa-file-medical-alt"></i>Patient Health Record</a>
                </h3>
                <ul class="nav flex-column">
                    <li>
                        <a id="homepage-link" href="?path=homepage">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li id="login-link">
                        <a href="?path=login">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    </li>
                    <li>
                        <button id="logout-link">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </li>
                    <li class="login-required">
                        <a href="?path=schedule-appointment">
                            <i class="fas fa-calendar-alt"></i>
                            Schedule An Appointment
                        </a>
                    </li>
                    <li class="login-required">
                        <a href="?path=view-lab-reports">
                            <i class="fas fa-clipboard-list"></i>
                            View Lab Reports
                        </a>
                    </li>
                    <li class="login-required">
                        <a href="?path=view-prescriptions">
                            <i class="fas fa-prescription-bottle-alt"></i>
                            View Prescriptions
                        </a>
                    </li>
                    <li>
                        <a href="?path=about">
                            <i class="fas fa-user"></i>
                            About
                        </a>
                    </li>
                    <li>
                        <a href="?path=contact">
                            <i class="fas fa-envelope"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="col">
                <main>
                    <?php
                        if(isset($_GET["path"]))
                        {
                            @include_once $_GET["path"].".php";
                        }
                        else 
                        {
                            include "homepage.php";
                        }
                    ?>
                    <div id="nav-buttons">
                        <button id="previous-button">Previous</button>
                        <button id="logout-button" class="login-required">Logout</button>
                        <button id="exit-button">Exit</button>
                        <button id="home-button">Home</button>
                    </div>
                </main>
            </div>
        </div>
        
    </div>
    

</body>
</html>
