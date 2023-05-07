<?php
session_start();
if (isset($_SESSION['USER_ID'])) {
    header("Location: index.php");
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<form action="actions.php" method="post">
<input type="hidden"  name="signup" />  
    <?php
    if (isset($_GET['message'])) {
        echo $_GET['message'];
    }
    ?>
    <div class="mb-3">
        <label class="form-label">Name </label>
        <input name="name" type="text" class="form-control" placeholder="enter name" required="">
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" placeholder="enter password" required="">
    </div>
    <button type="submit" class="btn btn-primary"> Submit </button>
</form>

<a href="login.php">Login</a>