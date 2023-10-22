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
    <form action="login_action.php" method="post">
        <div class="form-group">
          <label for="inputemail">Email</label>
          <!-- <input type="text" name="email" class="form-control" required placeholder="* Enter Email"> -->
          <input type="text" name="email" class="form-control" placeholder="* Enter Email">
        </div>
        <div class="form-group">
          <!-- <input type="password" name="pass"  class="form-control" required placeholder="* Enter Password"></p> -->
          <input type="password" name="pass"  class="form-control" placeholder="* Enter Password"></p>
        </div>
          <input type="submit" class="btn btn-dark btn-lg btn-block" value="Login" ></p>
      </form>

  </body>
</html>
