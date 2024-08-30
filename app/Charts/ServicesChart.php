<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;
use App\Models\Service;


class ServicesChart
{
    public function build(): OriginalBarChart
    {
        $inquiriesPerService = Service::getInquiriesPerService();

        $services = array_keys($inquiriesPerService);
        $counts = array_values($inquiriesPerService);

        return (new OriginalBarChart)
            ->setTitle('Inquiries per Service')
            ->setSubtitle('Number of inquiries received for each service')
            ->addData('Inquiries', $counts)
            ->setXAxisOption(new XAxisOption($services));
    }
}
