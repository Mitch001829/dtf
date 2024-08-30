<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

use App\Models\Inquiries;

class InquiriesChart
{
    public function build(): OriginalBarChart
    {   
        $inquiriesPerMonth = Inquiries::getInquiriesPerMonth();

        // Ensure all months are represented, even if there are no inquiries
        $months = range(1, 12);
        $data = array_fill(0, 12, 0);

        foreach ($inquiriesPerMonth as $month => $count) {
            $data[$month - 1] = $count; // Adjust for zero-based index
        }

        return (new OriginalBarChart)
            ->setTitle('Inquiries per Month')
            ->setSubtitle('Number of inquiries received each month')
            ->addData('Inquiries', $data)
            ->setXAxisOption(new XAxisOption(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']));
    }   
}
