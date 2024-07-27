<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $service
    ) {
    }

    public function __invoke(Request $request)
    {
        return inertia('Dashboard/Index', [
            'month' => Carbon::now()->month,
            'stats' => $this->service->getHomeStats()
        ]);
    }
}
