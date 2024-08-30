<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

use App\Models\OVITrap;



class OVITrapChart
{
    public function build(): OriginalBarChart
    {

        $ovitrapPerMonth = OVITrap::getOVITrapChartPerMonth();

        // Ensure all months are represented, even if there are no OVITrapChart
        $months = range(1, 12);
        $data = array_fill(0, 12, 0);

        foreach ($ovitrapPerMonth as $month => $count) {
            $data[$month - 1] = $count; // Adjust for zero-based index
        }
        
        return (new OriginalBarChart)
            ->setTitle('OVITrapChart per Month')
            ->setSubtitle('Number of OVITrapChart received each month')
            ->addData('OVITrapChart', $data)
            ->setXAxisOption(new XAxisOption(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']));
    }
}
