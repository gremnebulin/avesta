<html>
<head>
<!-- To be included in view.class.php -->
<title>Document Detail</title>
</head>

<body>

<h1><?= sanitise_out($row['key']) ?></h1>

<p style="color:red"><?= @$error_message ?></p>

<h2>Info</h2>

<p>
<?= sanitise_out($row['value']) ?>
</p>

<p><a href="<?= $_base_url . 'index.php/read/list/TestData' ?>">Return Thanks</a></p>

<p>
<form action="<?= $_base_url . 'index.php/update/detail/TestData' . $row['id'] ?>" method="POST">
   <input type="text" name="key" />
   <input type="text" name="value" />
   <input type="submit" value="Add!!">
</form>
</p>

</body>
</html>
