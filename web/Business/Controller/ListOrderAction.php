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
use ShinyBaseWeb\Business\Model\Order;
use ShinyBaseWeb\Responder;

class ListOrderAction implements IAction {
    const ROUTE = 'list-orders';

    /** @var Request */
    private $request;

    /** @var Responder */
    private $responder;

    /** @var DB */
    private $db;

    function __construct(Request $request,
                 Responder $responder,
                 Db $db) {
        $this->request = $request;
        $this->responder = $responder;
        $this->db = $db;
    }

    public function execute() {
        $entity = new Order();
        $join = Joins::single($entity->customer, Join::LEFT);
        $result = $this->db->search($entity, new ConditionList());
        $this->responder->success('', $result->toArray());
    }
}
