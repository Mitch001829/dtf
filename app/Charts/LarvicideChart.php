<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

use App\Models\Larvicide;



class LarvicideChart
{
    public function build(): OriginalBarChart
    {

        $larvicidePerMonth = Larvicide::getLarvicidePerMonth();

        // Ensure all months are represented, even if there are no Larvicide
        $months = range(1, 12);
        $data = array_fill(0, 12, 0);

        foreach ($larvicidePerMonth as $month => $count) {
            $data[$month - 1] = $count; // Adjust for zero-based index
        }
        
        return (new OriginalBarChart)
            ->setTitle('Larvicide per Month')
            ->setSubtitle('Number of Larvicide received each month')
            ->addData('Larvicide', $data)
            ->setXAxisOption(new XAxisOption(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']));
    }
}
