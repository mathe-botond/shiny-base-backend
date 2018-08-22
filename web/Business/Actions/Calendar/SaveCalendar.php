<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Controller\Calendar;

use QeyWork\Common\Actions\JsonAction;
use QeyWork\Entities\ArrayEntityMapper;
use QeyWork\Entities\Persistence\EntityManager;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Model\CalendarEvent;
use ShinyBaseWeb\Business\Model\Order;
use ShinyBaseWeb\Responder;

class SaveCalendar extends JsonAction {
    const ROUTE = 'save-calendar-change';

    /** @var EntityManager */
    private $manager;

    /** @var Responder */
    private $responder;

    public function __construct(
        Request $request,
        ArrayEntityMapper $mapper,
        EntityManager $manager,
        Responder $responder)
    {
        parent::__construct($request, $mapper);
        $this->manager = $manager;
        $this->responder = $responder;
    }

    public function getBodyType() {
        return new CalendarEvent();
    }

    /**
     * @param $event CalendarEvent
     */
    public function executeOnBody($event) {
        /** @var Order $order */
        $order = $this->manager->load($event->id, new Order());
        $event->toOrder($order);
        $this->manager->save($order);
        $this->responder->success();
    }
}
