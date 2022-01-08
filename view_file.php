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

  .button {
    display: block;
    width: 115px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    line-height: 25px;
	text-decoration: none;
  }

  </style>

  <script>
  function closeWindow() {
    window.open('','_parent','');
    window.close();
  }
</script>


</head>

<body>

  <a class="button" style="float:right" href="javascript:closeWindow();">Close tab</a>

  <div class="image"><?php
  echo "<embed src='" . $_GET['path'] . "', width=100%, height=800px />";
  ?></div>

</body>

</html>
