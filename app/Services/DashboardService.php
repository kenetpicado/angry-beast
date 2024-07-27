<?php

namespace App\Services;

class DashboardService
{
    public function getHomeStats()
    {
        $startOfMonth = now()->startOfMonth();

        return [
            'reminders_count' => auth()->user()->reminders()
                ->where('date', now()->format('Y-m-d'))
                ->count(),

            'ingresos' => auth()->user()->transactions()
                ->where('created_at', '>=', $startOfMonth)
                ->where('type', 'INGRESO')
                ->sum('total'),

            'egresos' => auth()->user()->transactions()
                ->where('created_at', '>=', $startOfMonth)
                ->where('type', 'EGRESO')
                ->sum('total'),
        ];
    }
}
