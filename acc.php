<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert(' Email or Password is Wrong.')</script>";
	}
}

?>



<?php 

include 'config.php';

error_reporting(0);

session_start();

// if (isset($_SESSION['username'])) {
//     header("Location: welcome.php");
// }

if (isset($_POST['submit-reg'])) {
	$username = $_POST['username-reg'];
	$email = $_POST['email-reg'];
	$password = md5($_POST['password-reg']);
	$cpassword = md5($_POST['cpassword-reg']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Account Info</title>
  <link rel="stylesheet" href="style.css" />
      <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      />
</head>
  
<body>

  <!-- Navigation -->
  <nav class="nav">
    <div class="navigation container">
      <div class="logo">
        <h1>GroupInvest</h1>
      </div>

      <div class="menu">
        <div class="top-nav">
          <div class="logo">
            <h1>GroupInvest</h1>
          </div>
          <div class="close">
            <i class="bx bx-x"></i>
          </div>
        </div>

        <ul class="nav-list">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#hoi" class="nav-link">How to Invest</a>
          </li>
          <li class="nav-item">
            <a href="#assets" class="nav-link">Assets</a>
          </li>
          <li class="nav-item">
            <a href="#our_partner" class="nav-link">Our Partners</a>
          </li>
          <li class="nav-item">
            <a href="acc.php" class="nav-link">Login/Register</a>
          </li>
        </ul>
      </div>

      <a href="cart.html" class="cart-icon">
        <i class="bx bx-shopping-bag"></i>
      </a>

      <div class="hamburger">
        <i class="bx bx-menu"></i>
      </div>
    </div>
  </nav>
      
  
     <!-- Account-Page -->

    <div class="account-page">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="./images/wallpaper1.png" />
          </div>

          <div class="col-2">
            <div class="form-container">
              <div class="form-btn">
                <span onclick="login()">Login</span>
                <span onclick="register()">Register</span>
                <hr id="Indicator" />
              </div>

              <form action="" method="POST" class="login-email" id="LoginForm">
			        <!-- <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p> -->
			        <div class="input-group">
				          <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			        </div>
			        <div class="input-group">
				          <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			        </div>
			        <div class="input-group">
			        	<button name="submit" class="btn">Login</button>
			        </div>
			            <!-- <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p> -->
                  <p>Forget password</p>
	          	</form>

              
            <form action="" method="POST" class="login-email" id="RegForm">
            <!-- <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p> -->
			      <div class="input-group">
				        <input type="text" placeholder="Username" name="username-reg" value="<?php echo $username; ?>" required>
			      </div>
			      <div class="input-group">
				        <input type="email" placeholder="Email" name="email-reg" value="<?php echo $email; ?>" required>
			      </div>
			      <div class="input-group">
				        <input type="password" placeholder="Password" name="password-reg" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				        <input type="password" placeholder="Confirm Password" name="cpassword-reg" value="<?php echo $_POST['cpassword']; ?>" required>
			      </div>
			      <div class="input-group">
				        <button name="submit-reg" class="btn">Register</button>
			      </div>
			    </form>





          </div>
        </div>
      </div>
    </div>
  
      
  
      <!-- java script -->
  
      <script>
        let navlist = document.getElementById("navlist");
  
        navlist.style.maxHeight = "0px";
  
        function menutoggle() {
          if (navlist.style.maxHeight == "0px") {
            navlist.style.maxHeight = "200px";
          } else {
            navlist.style.maxHeight = "0px";
          }
        }
      </script>
  
      <!-- Js for Toggle form -->
      <script>
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");
  
        function register() {
          RegForm.style.transform = "translateX(0px)";
          LoginForm.style.transform = "translateX(0px)";
          Indicator.style.transform = "translateX(100px)";
        }
        function login() {
          RegForm.style.transform = "translateX(300px)";
          LoginForm.style.transform = "translateX(300px)";
          Indicator.style.transform = "translateX(0px)";
        }
      </script>
    
  


    <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>EXTRAS</h3>
          <a href="#">Partners</a>
          <a href="#">Refferals</a>
          <a href="#">Affiliate</a>
          <a href="#">Specials</a>
        </div>
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a href="#">Order History</a>
          <a href="#">Wish List</a>
          <a href="#">Newsletter</a>
          <a href="#">Investments</a>
        </div>
        <div class="footer-center">
          <h3>CONTACT US</h3>
          <div>
            <span>
              <i class="fas fa-map-marker-alt"></i>
            </span>
            address full
          </div>
          <div>
            <span>
              <i class="far fa-envelope"></i>
            </span>
            email id 1
          </div>
          <div>
            <span>
              <i class="fas fa-phone"></i>
            </span>
            phone 1
          </div>
          <div>
            <span>
              <i class="far fa-paper-plane"></i>
            </span>
           address line 1
          </div>
        </div>
      </div>
    </div>
    </div>
  </footer>
  <!-- End Footer -->


</body>
</html>