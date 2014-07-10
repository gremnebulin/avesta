<html>
<head>
<!-- To be included in view.class.php -->
<title>Home Page</title>
</head>

<body>

<h1>Home Page</h1>

<p>A Great Website</p>

<p style="color:red"><?= @$error_message ?></p>


<?php
foreach($item_list as $row): ?>
	<li><?= sanitise_out($row['key']) ?>: <a href="<?= $_base_url?>index.php/read/detail/TestData/<?= sanitise_out($row['id']) ?>">More Info</a>
        </li>
<?php endforeach; ?>


</body>
</html>
