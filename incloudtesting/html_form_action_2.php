<html>
<head>

<title>Request Successful!</title>
</head>
<body bgcolor="#e5eecc">
<h3>Request Successful!</h3><br>

Customer: <?php echo $_GET['firstname']; ?><br><br>

Mailed to: <?php echo $_GET['address']." ".$_GET['city']; ?><br><br>

Arrival Date: <?php echo $_GET['date']; ?><br><br>

<p>
Confirmation Number: 640425839
</p>


</body>
</html>