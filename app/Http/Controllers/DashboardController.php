<?php

namespace App\Http\Controllers;

use App\Models\Ping;
use App\Models\PingContainer;
use Carbon\CarbonPeriod;
use Ikay\TheharvesterService\Models\Theharvester;
use Ikay\TheharvesterService\Models\TheharvesterContainer;

class DashboardController extends Controller
{
    public function index()
    {
        $pingChart = $this->pingServiceChartData();
        $theharvesterChart = $this->theharvesterServiceChartData();
        $pingPie = $this->pingServicePieData();
        $theharvesterPie = $this->theharvesterServicePieData();
        
        $theharvesters = Theharvester::with('user')->limit(5)->get();
        $pings = Ping::with('user')->limit(5)->get();
    
        return view('index', compact(
            'pingChart',
            'pingPie',
            'theharvesterChart',
            'theharvesterPie',
            'pings',
            'theharvesters'
        ));
    }
    
    
    protected function pingServiceChartData()
    {
        $startDate = CarbonPeriod::since(now()->subYear())
            ->until(now());
        
        $data = [];
        
        foreach ($startDate as $item) {
            $data[] = [
                $item->toString(),
                PingContainer::whereDay('created_at', $item->day)
                    ->whereMonth('created_at', $item->month)
                    ->whereYear('created_at', $item->year)
                    ->count()
            ];
        }
        return $data;
    }
    
    protected function theharvesterServiceChartData()
    {
        $startDate = CarbonPeriod::since(now()->subYear())
            ->until(now());
        
        $data = [];
        
        foreach ($startDate as $item) {
            $data[] = [
                $item->toString(),
                TheharvesterContainer::whereDay('created_at', $item->day)
                    ->whereMonth('created_at', $item->month)
                    ->whereYear('created_at', $item->year)
                    ->count()
            ];
        }
        return $data;
    }
    
    protected function pingServicePieData()
    {
        return [
            Ping::query()->whereStatus(1)->count(),
            Ping::query()->whereStatus(2)->count(),
            Ping::query()->whereStatus(0)->count()
        ];
    }
    
    protected function theharvesterServicePieData()
    {
        return [
            Theharvester::query()->whereStatus(1)->count(),
            Theharvester::query()->whereStatus(2)->count(),
            Theharvester::query()->whereStatus(0)->count()
        ];
    }
    
    
}
