<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function performance(Request $request)
{
    $classFilter = $request->get('class');
   
    $ranges = [
        '<60%' => [0, 59],
        '60-70%' => [60, 70],
        '70-80%' => [71, 80],
        '80-90%' => [81, 90],
        '90-100%' => [91, 100],
    ];

    $classes = $classFilter == ''
        ? Students::distinct()->pluck('class')
        : collect([$classFilter]);

    $data = [];
    foreach ($classes as $class) {
        $barData = [];
        foreach ($ranges as $label => [$min, $max]) {
            $barData[] = Students::where('class', $class)
                ->whereBetween('performance', [$min, $max])
                ->count();
        }

        $data[] = [
            'name' => "Class ".$class,
            'data' => $barData,
            'color' => self::getColor($class),
        ];
    }

    return response()->json([
        'xAxis' => array_keys($ranges),
        'series' => $data,
    ]);
}

private static function getColor($class)
{
    
    return match ($class) {
        1 => 'rgba(87, 181, 231, 1)',    
        2 => 'rgba(141, 211, 199, 1)',  
        3 => 'rgba(251, 191, 114, 1)',  
        4 => 'rgba(252, 141, 98, 1)',    
        5 => 'rgba(190, 186, 218, 1)',   
        6 => 'rgba(255, 255, 179, 1)',    
        7 => 'rgba(128, 177, 211, 1)', 
        8 => 'rgba(253, 180, 98, 1)',
        9 => 'rgba(179, 222, 105, 1)',  
        10 => 'rgba(252, 205, 229, 1)',  
        11 => 'rgba(217, 217, 217, 1)',  
        12 => 'rgba(188, 128, 189, 1)',  
        default => 'rgba(160, 160, 160, 1)'
    };
}

}
