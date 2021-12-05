<?php

namespace App\Service;

use App\Enum\Status;

/**
 * SalesInterface interface
 *
 * @author Basit <i@basit.me>
 */
interface SalesInterface
{
    /**
     * Total number of orders
     * @return int
     */
    public function totalOrders(): int;

    /**
     * Total number of orders by month
     * @param \DateTime $month
     *
     * @return int
     */
    public function totalOrdersByMonth(\DateTime $month): int;

    /**
     * total number of orders by
     * @param $status
     *
     * @return int
     */
    public function totalOrdersByStatus(Status $status): int;

    /**
     * Total revenue
     * @return string
     */
    public function totalRevenue();

    /**
     *list of most recent orders
     * @param int $numRows
     *
     * @return array
     */
    public function listRecentOrders($numRows = 5): array;
}
