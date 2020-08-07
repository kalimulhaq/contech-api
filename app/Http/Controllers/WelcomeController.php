<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller {

    public function index(Request $request) {
        return $this->success(null, 200, 'WELCOME! Server is UP and Runing');
    }

}
