<?php

namespace App\Controllers;

use App\Services\UserService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;
use DateTime;

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

    public function home()
    {
        $apiUrl = "http://localhost:3333/hr/api/v1/data/perdept/weekly/get";

        $response = file_get_contents($apiUrl, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode([
                    'api_key' => 'P@ssw0rdKuatBanget14045'
                ])
            ]
        ]));

        $result = json_decode($response, true);
        $date = new DateTime();
        $monday = (clone $date)->modify('monday this week');
        $weekDays = [];

        for($i = 0; $i < 7; $i++){
            $day = (clone $monday)->modify("+$i day");

            $weekDays[] = [
                'date' => $day->format('Y-m-d'),
                'label_date' => $day->format('j/n/y'),
                'label_day' => $day->format('l')
            ];
        }
    }
}
