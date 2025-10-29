<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Monthly Sales Chart';

    protected function getData(): array
    {
        $data = Order::select(
            DB::raw('strftime(\'%Y-%m\', created_at) as month'),
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total) as total_revenue')
        )
        ->where('created_at', '>=', now()->subMonths(12))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = $data->pluck('month')->map(function ($month) {
            return date('M Y', strtotime($month . '-01'));
        })->toArray();

        $orders = $data->pluck('total_orders')->toArray();
        $revenue = $data->pluck('total_revenue')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Orders',
                    'data' => $orders,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Total Revenue (Rp)',
                    'data' => $revenue,
                    'borderColor' => 'rgb(255, 99, 132)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Total Orders',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Revenue (Rp)',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
        ];
    }
}