<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

use App\Models\ContainerModel;



class ContainerChart
{
    public function build(): OriginalBarChart
    {

        $containerModelPerMonth = ContainerModel::getContainerPerMonth();

        // Ensure all months are represented, even if there are no ContainerModel
        $months = range(1, 12);
        $data = array_fill(0, 12, 0);

        foreach ($containerModelPerMonth as $month => $count) {
            $data[$month - 1] = $count; // Adjust for zero-based index
        }
        
        return (new OriginalBarChart)
            ->setTitle('ContainerModel per Month')
            ->setSubtitle('Number of ContainerModel received each month')
            ->addData('ContainerModel', $data)
            ->setXAxisOption(new XAxisOption(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']));
    }
}
