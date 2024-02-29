<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residents;

class ChartController extends Controller
{
    public function showCharts()
    {
        // Fetch actual data from the Residents model
        $residentsData = Residents::selectRaw('
                SUM(CASE WHEN acknowledgement_on_community_rules = "yes" THEN 1 ELSE 0 END) as acknowledged_rules,
                SUM(CASE WHEN acknowledgement_on_community_rules = "no" THEN 1 ELSE 0 END) as not_acknowledged_rules,
                SUM(CASE WHEN disability = "n/a" THEN 1 ELSE 0 END) as without_disability,
                SUM(CASE WHEN disability != "n/a" THEN 1 ELSE 0 END) as with_disability,
                SUM(CASE WHEN gender = "Male" THEN 1 ELSE 0 END) as male_count,
                SUM(CASE WHEN gender = "Female" THEN 1 ELSE 0 END) as female_count,
                COUNT(*) as total_residents
            ')
            ->first();

        // Fetch additional data for the bar graph (example: household sizes in different blocks)
        $barGraphData = Residents::selectRaw('
                block,
                AVG(household_size) as average_household_size,
                SUM(CASE WHEN violation = "yes" THEN 1 ELSE 0 END) as violations
                ')
            ->groupBy('block')
            ->get();

        // You can also fetch data for trends over time and top-N analysis here

        return view('admin.dashboard', compact('residentsData', 'barGraphData'));
    }
}
