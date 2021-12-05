<?php

namespace App\Controller;

use App\Enum\Status;
use App\Service\SalesManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * DashboardController class
 *
 * @author i@basit.me
 */
class DashboardController
{

    /**
     * @Route("/")
     * @Template("dashboard.html.twig")
     */
    public function dashboard(SalesManager $sales): array
    {
        $sales->loadData();

        return [
            'totalOrders'           => $sales->totalOrders(),
            'totalOrdersThisMonth'  => $sales->totalOrdersByMonth((new \DateTime())),
            'totalOrdersInProgress' => $sales->totalOrdersByStatus(Status::IN_PROGRESS),
            'totalRevenue'          => $sales->totalRevenue(),
            'listRecentOrders'      => $sales->listRecentOrders(10)
        ];
    }
}
