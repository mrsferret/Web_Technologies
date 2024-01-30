<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Example</title>
    <!-- Add Bootstrap CSS and JavaScript files -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php
  // Include the header
  include 'includes\header.php';
  ?>
        <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-4 p-4">
                    <form action="login_action.php" method="post" class="row g-3">
                        <h4>Login</h4>
                        <div class="col-12">
                            <label for="inputemail">Email</label>
                            <!-- <input type="text" name="email" class="form-control" required placeholder="* Enter Email"> -->
                            <input type="email" name="email" class="form-control" placeholder="* Enter Email">
                        </div>
                        <div class="col-12">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="* Enter Password">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe"> Remember me</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-end mt-2">Login</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">No account yet? <a href="create_acct.php">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 
     <form action="login_action.php" method="post"> 
      <div class="form-group">
        <label for="inputemail">Email</label> -->
        <!-- <input type="text" name="email" class="form-control" required placeholder="* Enter Email"> 
        <input type="text" name="email" class="form-control" placeholder="* Enter Email">
        </div>
        <div class="form-group">
          input type="password" name="pass"  class="form-control" placeholder="* Enter Password"></p>
      </div>
      <input type="submit" class="btn btn-dark btn-lg btn-block" value="Login" ></p>
    </form> 
    -->    
  <?php
  // Include the footer
  include 'includes\footer.php';
  ?>
  </body>
</html>
