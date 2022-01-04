<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Attachment</title>
	<style>
		.image {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width:50%;
			padding: 10px;
		}
		
	</style>
</head>

<body>
	
	<div class="image"><?php
	echo "<embed src='" . $_GET['path'] . "', width=100%, height=800px />";
	?></div>
</body>

</html>