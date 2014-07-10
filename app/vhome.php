<html>
<head>
<!-- To be included in view.class.php -->
<title>Home Page</title>
</head>

<body>

<h1>Home Page</h1>

<p>A Great Website</p>

<p style="color:red"><?= @$error_message ?></p>



<p><a href="<?= $_base_url . 'index.php/fetch/list/TestData' ?>">View Data</a></p>
<p><a href="<?= $_base_url . 'index.php/restart' ?>">Clear session and start again.</a></p>

</body>
</html>
