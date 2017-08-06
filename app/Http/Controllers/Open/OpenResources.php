<?php

namespace Db19\Http\Controllers\Open;

use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;

class OpenResources extends MainController
{
    public function execute()
    {
        echo "<h1>Открытые ресурсы</h1>";
        return url('/open/index.html');
    }
}
