<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StatsService
{
    /**
     * Get counts for various statistics.
     */
    public function getCounts(): array
    {
        $counts = [
            'totalSites' => $this->getCount('sites'),
            'totalEndpoints' => $this->getCount('endpoints'),
            'totalChecks' => $this->getCount('checks'),
            'successfulChecks' => $this->getSuccessfulChecksCount(),
            'unsuccessfulChecks' => $this->getUnsuccessfulChecksCount(),
            'averageUptimePercentage' => number_format($this->avgUptimePercentage(), 2),
        ];

        return $this->formatCounts($counts);
    }

    /**
     * Get the count of records from a table.
     */
    private function getCount(string $table, array $conditions = []): int
    {
        $query = DB::table($table);

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        return $query->count();
    }

    /**
     * Get the count of successful checks.
     */
    private function getSuccessfulChecksCount(): int
    {
        return $this->getCount('checks', [
            ['response_code', '>=', 200],
            ['response_code', '<', 300],
        ]);
    }

    /**
     * Get the count of unsuccessful checks.
     */
    private function getUnsuccessfulChecksCount(): int
    {
        return $this->getCount('checks', [
            ['response_code', '<', 200],
            ['response_code', '>=', 300],
        ]);
    }

    /**
     * Calculate the average uptime percentage.
     */
    private function avgUptimePercentage(): float
    {
        $total_checks = $this->getCount('checks');

        $total_successful_checks = $this->getSuccessfulChecksCount();

        if ($total_checks > 0) {
            return ($total_successful_checks / $total_checks) * 100;
        }

        return 0;
    }

    /**
     * Format the counts with number formatting.
     */
    private function formatCounts(array $counts): array
    {
        $formattedCounts = [];

        foreach ($counts as $key => $value) {
            $formattedCounts[$key] = number_format($value);
        }

        return $formattedCounts;
    }
}
