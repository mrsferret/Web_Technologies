<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to check user data

    if ($_POST['inputPwd'] != $_POST[confirmPwd]){
        // display error msg if input password and confirmed password don't match
        
    { $errors[] = 'Passwords do not match.' ; }
    
    }
}
?>