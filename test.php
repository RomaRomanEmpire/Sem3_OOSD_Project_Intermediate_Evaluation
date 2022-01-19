<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $_POST['hi'];

}
?>
<html>
<form id="signin-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <input type="submit" value="Login">
</form>
</html>
