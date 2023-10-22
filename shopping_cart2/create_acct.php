<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account</title>
    <!--Linking bootstrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <style></style>
  </head>

  <body>
    <?php
      // Include the header
      include 'includes\header.php';
    ?>
    
    <div class="container p-4 my-5">
      <h1>Create Account</h1>
    </div>
    <div class="container mt-5">
      <form action="register.php" method="POST">
        <div class="row mb-3">
          <div class="col">
            <label for="first_name" class="form-label">First Name</label>
            <input
              type="text"
              class="form-control"
              id="first_name"
              name="first_name"
              placeholder="* First Name"
            />
          </div>
          <div class="col">
            <label for="last_name" class="form-label">Last Name</label>
            <input
              type="text"
              class="form-control"
              id="last_name"
              name="last_name"
              placeholder="* Last Name"
            />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              required
              placeholder="* Email"
            />
            <div id="emailHelp" class="form-text">
              We'll never share your email with anyone else.
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              required
              placeholder="* Enter Password"
            />
          </div>
          <div class="col">
            <label for="confirm_password" class="form-label"
              >Confirm Password</label
            >
            <input
              type="password"
              class="form-control"
              id="confirm_password"
              name="confirm_password"
              required
              placeholder="* Confirm Password"
            />
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Submit</button>
      </form>
      <!-- Bootstrap Modal for Alert -->
      <div class="modal" id="alertModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Alert</h5>
            </div>
            <div class="modal-body" id="alertMessage">Alert Message</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-primary"
                data-dismiss="modal"
              >
                OK
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Bootstrap Modal for information -->
      <div class="modal" id="infoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Information</h5>
            </div>
            <div class="modal-body" id="infoMessage">Information Message</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-primary"
                data-dismiss="modal"
              >
                OK
              </button>
            </div>
          </div>
        </div>
      </div>
      <div id="error_messages" class="error-messages"></div>
    </div>

    <?php
      // Include the footer
      include 'includes\footer.php';
    ?>

    <!--Bootstrap Script and Popper-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>
    <!-- Include  JavaScript file -->
    <!-- <script src="calculator.js"></script> -->
  </body>
</html>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const formElement = document.querySelector("form");
    const infoModal = new bootstrap.Modal(document.getElementById("infoModal"));
    const infoMessage = document.getElementById("infoMessage");
    const submitButton = document.querySelector("button[type=submit");

    formElement.addEventListener("submit", async (event) => {
      event.preventDefault();
      const formData = new FormData(formElement);
      const response = await fetch(formElement.action, {
        method: formElement.method,
        body: formData,
      });

      if (response.ok) {
        const responseText = await response.text();
        if (responseText.includes("Error:")) {
          alertMessage.textContent = responseText;
          alertModal.show();
        } else {
          // Display informational message in the infoModal
          infoMessage.textContent = responseText;
          infoModal.show();

          // Clear the form fields
          formElement.reset();
          submitButton.disabled = false;
        }
      } else {
        alertMessage.textContent =
          "An error occurred while submitting the form.";
        alertModal.show();
      }
    });

    // Add an event listener to the "OK" button inside the infoModal
    const infoModalOkButton = document.querySelector(
      "#infoModal button[data-dismiss='modal']"
    );
    infoModalOkButton.addEventListener("click", () => {
      infoModal.hide(); // Close the infoModal
    });
  });
</script>
