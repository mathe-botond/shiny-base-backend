<?php
/**
 * Author: Mathe E. Botond
 */
namespace ShinyBaseWeb\Business\Controller;

use QeyWork\Common\Actions\JsonAction;
use QeyWork\Entities\ArrayEntityMapper;
use QeyWork\Entities\Persistence\EntityManager;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Model\Customer;
use ShinyBaseWeb\Business\Model\Order;
use ShinyBaseWeb\Responder;

class SaveOrderAction extends JsonAction
{
    const ROUTE = "save-order";

    /** @var Responder */
    private $responder;
    /**
     * @var EntityManager
     */
    private $manager;

    public function __construct(
            Request $request,
            ArrayEntityMapper $mapper,
            EntityManager $manager,
            Responder $responder) {

        parent::__construct($request, $mapper);
        $this->responder = $responder;
        $this->manager = $manager;
    }

    public function getBodyType()
    {
        $order = new Order(new Customer());
        return $order;
    }

    public function executeOnBody($order)
    {
        /** @var Order $order */
        $order->customer->loadLinkedId();
        $this->manager->save($order);
        $this->responder->success();
    }
}
