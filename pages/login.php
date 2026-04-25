<?php

include 'config/koneksi.php';

if (isset($_POST['login'])) {

  $user = $_POST['username'];
  $pass = md5($_POST['password']);

  $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
  $data = mysqli_fetch_assoc($query);

  if ($data) {
    $_SESSION['user'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    echo "<script>alert('Login berhasil');location='index.php'</script>";
  } else {
    echo "<script>alert('Login gagal');</script>";
  }
}
?>

<h4>Login</h4>

<form method="POST">
  <input type="text" name="username" class="form-control mb-2" placeholder="Username">
  <input type="password" name="password" class="form-control mb-2" placeholder="Password">
  <button name="login" class="btn btn-primary">Login</button>
</form>