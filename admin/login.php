<?php
require_once "../config/connect.php";
require_once '../config/session.php';
// unset($_SESSION['login']);


if (isLoggedIn()) {
  header("Location: dashboard.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = 'SELECT password FROM admins WHERE username = :username';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      if (password_verify($password, $result['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
      } else {
        $error_message = "Mật khẩu không chính xác";
      }
    } else {
      $error_message = "Tài khoản không chính xác";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      border: 3px solid #f1f1f1;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }

    img.avatar {
      width: 40%;
      border-radius: 50%;
    }

    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    .boxcenter {
      width: 500px;
      margin: 0 auto;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="boxcenter">
    <h2>Login Admin</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="container">
        <label for="username"><b>Username</b></label>
        <input id="username" type="text" placeholder="Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input id="password" type="password" placeholder="Password" name="password" required>
        <?php if (isset($error_message)): ?>
          <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <button type="submit" name="login">Login</button>
      </div>
    </form>
  </div>

</body>

</html>