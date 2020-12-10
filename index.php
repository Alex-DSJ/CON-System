<!DOCTYPE html>
<html>
<title>CON system</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

<style>
.header{
        width: 100%;
        background-color: rgba(0,0,0,.2);
    }
    .header ul{
        text-align: center;
    }
    .header ul li{
        list-style: none;
    }
    .header ul li a{
        display: block;
        text-decoration: none;
        text-transform: uppercase;
        color: #fff;
        font-size: 20px;
        font-family: 'Raleway', sans-serif;
        letter-spacing: 2px;
        font-weight: 600;
        padding: 25px;
        transition: all ease 0.5s;
    }
    .header ul li a:hover{
        background-color: #211b4385;
    }
    body,h1,h2{font-family: "Raleway", sans-serif}
    body, html {height: 100%}
    p {line-height: 2}
    .bgimg, .bgimg2 {
        min-height: 100%;
        background-position: center;
        background-size: cover;
    }
    .bgimg {background-image: url("static/upload/building.jpg")}
    .bgimg2 {background-image: url('static/upload/condo1.jpg')}
</style>
<body>

<!-- Header / Home-->
<header class="w3-display-container w3-wide bgimg w3-grayscale-min" id="home">
    <div class="header">
    <ul>
        <il><button class="w3-button w3-black w3-round w3-padding-large w3-large" onclick="window.location.href='./admin/index.php'">CON system</button></li>
        <il><button class="w3-button w3-black w3-round w3-padding-large w3-large" onclick="window.location.href='./owner/index.php'">Admin</button></li>
        <il><button class="w3-button w3-black w3-round w3-padding-large w3-large" onclick="window.location.href='./member/index.php'">Member</button></li>
        <il><button class="w3-button w3-black w3-round w3-padding-large w3-large" onclick="window.open('guest.php')">guest</button></li>
    </ul>
    <div class="w3-display-middle w3-text-white w3-center">
        <h1 class="w3-jumbo">CON</h1>
        <h2>In the Center Of Montreal</h2>
        <h2><b>built in 2020</b></h2>
    </div>
</header>

<!-- About -->
<div class="w3-container w3-padding-64 w3-pale-red w3-grayscale-min" >
    <div class="w3-content">
        <h1 class="w3-center w3-text-grey"><b>About Us</b></h1>
        <img class="w3-round w3-grayscale-min" src="static/upload/condo2.jpg" style="width:100%;margin:32px 0">
        <p><i>
            A Condo-association Online Network System (CON) is the application which allows users to register for services and promote various activities of the condo system. This web-based condo interactive application provides not only applying the core functionalities of the CON management system but also a privately running server to share users’ information and ideas.
            </i>
        </p><br>
        <!-- <p class="w3-center"> <button class="w3-button w3-black w3-round w3-padding-large w3-large" onclick="window.open('main.php')">Choose Your Identity</button></p> -->
    </div>
</div>

<!-- Background photo -->
<div class="w3-display-container bgimg2">
    <div class="w3-display-middle w3-text-white w3-center">
        <h1 class="w3-jumbo">Welcome To Join Us</h1><br>
        <h2>See You Soon..</h2>
    </div>
</div>

<!-- Contact information -->
<div class="w3-container w3-padding-64 w3-pale-red w3-grayscale-min w3-center" >
    <h2>Contact Us</h2>
    <p>Email: CON-SYSTEM@con.com</p>
    <p>Phone/Fax:514-XXX-XXX</p>
    <p>MON-FRI 11A.M.-6P.M.,  SAT-SUN 11A.M.-5P.M.</p>
</div>





</body>
</html>
