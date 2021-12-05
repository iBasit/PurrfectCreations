<?php

namespace App\Service;


use App\Enum\Status;

/**
 * Sales class
 *
 * @author i@basit.me
 */
class SalesManager implements SalesInterface
{
    protected $apiKey;
    protected $baseId;

    protected $rows = [];

    public function __construct($apiKey, $baseId)
    {
        $this->apiKey = $apiKey;
        $this->baseId = $baseId;
    }

    /**
     * @inheritDoc
     */
    public function totalOrders(): int
    {
        return count($this->rows);
    }

    /**
     * @inheritDoc
     */
    public function totalOrdersByMonth(\DateTime $month): int
    {
        $count = 0;

        foreach ($this->rows as $row) {
            if ($month->format('Y-m') === $row['order_placed']->format('Y-m')) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @inheritDoc
     */
    public function totalOrdersByStatus(Status $status): int
    {
        $count = 0;

        foreach ($this->rows as $row) {
           if ($status == Status::IN_PROGRESS && $row['order_status'] === 'in_progress') {
                $count++;
           }
        }

        return $count;
    }

    /**
     * @inheritDoc
     */
    public function totalRevenue()
    {
        $sum = 0;
        foreach ($this->rows as $row) {
            $sum += $row['price'];
        }

        $formatter = new \NumberFormatter('en_GP', \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($sum, 'GBP');
    }

    /**
     * @inheritDoc
     */
    public function listRecentOrders($numRows = 5): array
    {
        if (empty($this->rows)) {
            return [];
        }

        $list = $this->rows;
        usort($list, function($a, $b) {
            return ($a['order_placed'] > $b['order_placed']) ? -1 : 1;
        });

        $list = array_slice($list, 0, $numRows);
        return $list;
    }

    public function loadData()
    {
        // reset data
        $this->rows = [];

        $airtable = new \TANIOS\Airtable\Airtable(array(
            'api_key' => $this->apiKey,
            'base'    => $this->baseId
        ));

        $request = $airtable->getContent('Orders');

        do {
            $response = $request->getResponse();

            // library returns back in objects, we will convert them into arrays
            $records = json_decode(json_encode($response['records']), true);

            foreach ($records as $body) {
                $row = $body['fields'];
                $row['order_placed'] = \DateTime::createFromFormat('Y-m-d', $row['order_placed']);
                $this->rows[] = $row;
            }
        }
        while( $request = $response->next() );
    }
}
