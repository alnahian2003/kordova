<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StatsService
{
    /**
     * Get counts for various statistics.
     */
    public function getCounts(?int $userId = null): array
    {
        $counts = [
            'totalSites'              => $this->getCachedCount('sites', $userId),
            'totalEndpoints'          => $this->getCachedCount('endpoints', $userId),
            'totalChecks'             => $this->getCachedCount('checks', $userId),
            'successfulChecks'        => $this->getCachedSuccessfulChecksCount($userId),
            'unsuccessfulChecks'      => $this->getCachedUnsuccessfulChecksCount($userId),
            'averageUptimePercentage' => $this->getCachedAverageUptimePercentage($userId),
        ];

        return $this->formatCounts($counts);
    }

    /**
     * Get the count of records from a table.
     */
    private function getCount(string $table, ?int $userId = null, array $conditions = []): int
    {
        $query = DB::table($table);

        if (! is_null($userId)) {
            $query->where('user_id', $userId);
        }

        if (! empty($conditions)) {
            $query->where($conditions);
        }

        return $query->count();
    }

    /**
     * Get the count from cache or fetch from database.
     */
    private function getCachedCount(string $table, ?int $userId = null, array $conditions = []): int
    {
        $cacheKey = $this->generateCacheKey([$table, $userId, $conditions]);

        return Cache::remember($cacheKey, 3600, function () use ($table, $userId, $conditions) {
            return $this->getCount($table, $userId, $conditions);
        });
    }

    /**
     * Get the count of successful checks from cache or fetch from database.
     */
    private function getCachedSuccessfulChecksCount(?int $userId = null): int
    {
        $cacheKey = $this->generateCacheKey(['successfulChecks', $userId]);

        return Cache::remember($cacheKey, 3600, function () use ($userId) {
            return $this->getSuccessfulChecksCount($userId);
        });
    }

    /**
     * Get the count of unsuccessful checks from cache or fetch from database.
     */
    private function getCachedUnsuccessfulChecksCount(?int $userId = null): int
    {
        $cacheKey = $this->generateCacheKey(['unsuccessfulChecks', $userId]);

        return Cache::remember($cacheKey, 3600, function () use ($userId) {
            return $this->getUnsuccessfulChecksCount($userId);
        });
    }

    /**
     * Get the average uptime percentage from cache or calculate it.
     */
    private function getCachedAverageUptimePercentage(?int $userId = null): float
    {
        $cacheKey = $this->generateCacheKey(['averageUptimePercentage', $userId]);

        return Cache::remember($cacheKey, 3600, function () use ($userId) {
            return $this->avgUptimePercentage($userId);
        });
    }

    /**
     * Get the count of successful checks.
     */
    private function getSuccessfulChecksCount(?int $userId = null): int
    {
        return $this->getCount('checks', $userId, [
            ['response_code', '>=', 200],
            ['response_code', '<', 300],
        ]);
    }

    /**
     * Get the count of unsuccessful checks.
     */
    private function getUnsuccessfulChecksCount(?int $userId = null): int
    {
        return $this->getCount('checks', $userId) - $this->getSuccessfulChecksCount($userId);
    }

    /**
     * Calculate the average uptime percentage.
     */
    private function avgUptimePercentage(?int $userId = null): float
    {
        $totalChecks           = $this->getCount('checks', $userId);
        $totalSuccessfulChecks = $this->getSuccessfulChecksCount($userId);

        if ($totalChecks > 0) {
            return ($totalSuccessfulChecks / $totalChecks) * 100;
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

    /**
     * Generate a unique cache key based on segments.
     */
    private function generateCacheKey(array $segments): string
    {
        $userId = (string) Auth::id();

        $stringSegments = array_map(static function ($segment) {
            if (is_array($segment)) {
                return json_encode($segment);
            }

            return (string) $segment;
        }, $segments);

        return 'stats:'.$userId.':'.implode(':', $stringSegments);
    }
}
