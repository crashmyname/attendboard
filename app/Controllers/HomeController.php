<?php

namespace App\Controllers;

use App\Services\UserService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class HomeController extends BaseController
{
    // Controller logic here
    public function index(UserService $userService)
    {
        $title = 'Dashboard';
        $user = $userService->Count();
        return view('dashboard', compact('title','user'),'layout/app');
    }

    public function indexHome()
    {
        $title = 'Papan Monitoring Absensi & Overtime';
        return view('home', compact('title'));
    }
}
