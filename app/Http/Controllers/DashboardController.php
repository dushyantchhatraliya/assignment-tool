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

        // Define performance ranges
        $rangeDefinitions = [
            '<60%' => [0, 59],
            '60-70%' => [60, 70],
            '70-80%' => [71, 80],
            '80-90%' => [81, 90],
            '90-100%' => [91, 100],
        ];

        $result = [
            'ranges' => $rangeDefinitions,
            'counts' => array_fill_keys(array_keys($rangeDefinitions), 0),
            'total' => 0,
            'percentages' => []
        ];

        if (!empty($classFilter)) {
            $items = Students::where('class', $classFilter)->pluck('performance')->toArray();
            $result['total'] = count($items);

            foreach ($items as $performance) {
                foreach ($rangeDefinitions as $range => $bounds) {
                    if ($performance >= $bounds[0] && $performance <= $bounds[1]) {
                        $result['counts'][$range]++;
                        break;
                    }
                }
            }

            if ($result['total'] > 0) {
                foreach ($result['counts'] as $range => $count) {
                    $result['percentages'][$range] = round(($count / $result['total']) * 100, 2);
                }
            }
        }

        // Prepare chart data
        $classes = empty($classFilter)
            ? Students::distinct()->orderBy('class')->pluck('class')
            : collect([$classFilter]);

        $totalStudent = empty($classFilter)
            ? $students = Students::select('performance', 'attendance')
            ->selectRaw("CASE WHEN attendance <= 33 THEN 1 ELSE 0 END AS is_at_risk")
            ->get()
            : Students::select('performance', 'attendance') ->selectRaw("CASE WHEN attendance <= 33 THEN 1 ELSE 0 END AS is_at_risk")->where('class', $classFilter)->get();

       
        $totalPossibleDays = 180; // Adjust based on your school's total days

        $avgAttendanceRate = $totalStudent
            ->filter(function ($student) {
                return is_numeric($student->attendance); // Ensure attendance is numeric
            })
            ->avg(function ($student) use ($totalPossibleDays) {
                return ($student->attendance / $totalPossibleDays) * 100;
            });

        $seriesData = [];
        foreach ($classes as $class) {
            $barData = [];
            foreach ($rangeDefinitions as [$min, $max]) {
                $barData[] = Students::where('class', $class)
                    ->whereBetween('performance', [$min, $max])
                    ->count();
            }

            $classNumber = (int) filter_var($class, FILTER_SANITIZE_NUMBER_INT);
            $seriesData[] = [
                'name' => "Class " . $class,
                'data' => $barData,
                'color' => self::getColor($classNumber),
            ];
        }

        return response()->json([
            'xAxis' => array_keys($rangeDefinitions),
            'series' => $seriesData,
            'totalStudent' => count($totalStudent),
            'studentAvgPer' => round($totalStudent->avg('performance'), 2) . '%',
            'average_attendance_rate' => round($avgAttendanceRate, 2) . '%',
            'is_at_risk' => $totalStudent->sum('is_at_risk'),
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
