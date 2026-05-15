<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

logout();
set_flash('success', 'Vous etes maintenant deconnecte.');
redirect_to('admin/sign-in.php');

