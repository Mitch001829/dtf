<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

use App\Models\Participant;



class ParticipantChart
{
    public function build(): OriginalBarChart
    {

        $participantPerMonth = Participant::getParticipantPerMonth();

        // Ensure all months are represented, even if there are no Participant
        $months = range(1, 12);
        $data = array_fill(0, 12, 0);

        foreach ($participantPerMonth as $month => $count) {
            $data[$month - 1] = $count; // Adjust for zero-based index
        }
        
        return (new OriginalBarChart)
            ->setTitle('Participant per Month')
            ->setSubtitle('Number of Participant received each month')
            ->addData('Participant', $data)
            ->setXAxisOption(new XAxisOption(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']));
    }
}
