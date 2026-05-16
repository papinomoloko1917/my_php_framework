<?php

use App\Session\Auth;
?>
<h1>Это твой профиль <?= htmlspecialchars(Auth::email(), ENT_QUOTES, 'UTF-8') ?></h1>
