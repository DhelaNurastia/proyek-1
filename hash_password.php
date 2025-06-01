<?php
$password = 'admin321'; 
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Hash untuk '$password' adalah:<br><textarea rows='3' cols='80'>$hash</textarea>";
