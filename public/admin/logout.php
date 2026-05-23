<?php
/**
 * Ballonsport Krohmer — Admin Logout
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

logout();

header('Location: /admin/login.php');
exit;
