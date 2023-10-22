<?php
// session start/resume
session_start();
// For debugging - Display the contents of the session
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo '
<div class="container text-center">
        <h1 class="coming-soon-text">Coming Soon</h1>
        <p>Our website is under construction. Stay tuned for updates!</p>
        <!-- You can add a countdown timer or a subscription form here -->
    </div>';

echo '
    <form action="logout.php" method="post">
        
        <input type="submit" class="btn btn-dark btn-lg btn-block" value="Logout" ></p>
    </form>

';
?>