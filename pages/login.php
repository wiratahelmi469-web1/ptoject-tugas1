<?php include 'layout/header.php'; ?>

<style>
html, body {
  height: 100%;
  margin: 0;
}

body {
  background: url('assets/img/monkey.jpg') no-repeat center center fixed !important;
  background-size: cover !important;
}
</style>

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

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
  <div class="card p-4 shadow" style="width:350px;">

    <form method="POST">
      <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
      <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
      <button name="login" class="btn btn-primary w-100">Login</button>
    </form>

  </div>
</div>