<?php
# Access session.
session_start() ;
# Redirect if not logged in.
echo "session.php <bk>";
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
?>