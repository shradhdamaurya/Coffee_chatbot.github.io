<?php
session_start();
session_destroy();
header('location:admin_index.php?logged_out');
