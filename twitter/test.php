<?php

require 'user.php';

echo "<pre>";
var_dump(User::readWithProvider(1,2));
echo "</pre>";

 ?>