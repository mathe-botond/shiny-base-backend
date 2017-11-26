<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Controller;

use QeyWork\Common\IAction;
use QeyWork\Resources\Db\ConditionList;
use QeyWork\Resources\Db\DB;
use QeyWork\Resources\Db\Join;
use QeyWork\Resources\Db\Joins;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Model\CalendarEvent;
use ShinyBaseWeb\Business\Model\Order;
use ShinyBaseWeb\Responder;

class OrdersCalendarAction implements IAction {
    const ROUTE = 'orders-calendar';

    /** @var Request */
    private $request;

    /** @var DB */
    private $db;

    function __construct(Request $request,
                 Db $db) {

        $this->request = $request;
        $this->db = $db;
    }

    public function execute() {
        $start = $this->request->get('start');
        $end = $this->request->get('end');

        $result = $this->loadOrders($start, $end);
        $events = $this->convertResponse($result);
        echo json_encode($events);
    }

    private function loadOrders($start, $end) {
        $entity = new Order();
        $main = new ConditionList();
        $main->add($entity->taskStart)->lessOrEqualThen($end);

        $endConditions = new ConditionList(ConditionList::OR_COND);
        $endConditions->add($entity->taskEnd)->equals(null);
        $endConditions->add($entity->taskEnd)->greaterOrEqualThen($start);
        $main->addConditionList($endConditions);

        return $this->db->search($entity, $main);
    }

    private function convertResponse($orders) {
        $response = [];
        foreach ($orders as $order) {
            /** @var Order $order */
            $response[] = CalendarEvent::fromOrder($order);
        }
        return $response;
    }
}
