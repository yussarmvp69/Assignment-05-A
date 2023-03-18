<?php
$loginPressed = filter_input(INPUT_POST, 'btnLogin');
if (isset($loginPressed)) {
  $email = filter_input(INPUT_POST, 'txtEmail');
  $password = filter_input(INPUT_POST, 'txtPassword');
  if (trim($email) == '' || trim($password) == '') {
    echo '<div>Please Input Your Email and Password</div>';
  } else {
    $result = login($email, $password);
    if ($result['email'] == $email) {
      $_SESSION['registered_user'] = true;
      $_SESSION['registered_name'] = $result['name'];
      header('location:index.php');
    } else {
      echo '<div>Invalid email or Password</div>';
    }
  }
}
?>
<form>
  <div class="form-group">
    <label for="txtEmail">Email address</label>
    <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="txtPassword">Password</label>
    <input type="password" class="form-control" id="txtPassword" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" name="btnLogin">Submit</button>
</form>