<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Model;

class CalendarEvent {
    public $id;
    public $title;
    public $start;
    public $end;

    public static function fromOrder(Order $order) {
        $event = new CalendarEvent();
        $event->id = $order->getIdField()->value();
        $event->start = $order->taskStart->value();
        $event->end = $order->taskEnd->value();
        $customerInfo = '?';
        if (! $order->customer->isEmpty()) {
            /** @var Customer $customer */
            $customer = $order->customer->getEntity();
            $customerInfo = $customer->name->value() . ' ' . $customer->getPhoneFormatted();
        }
        $event->title = $customerInfo . ' - ' . $order->details->value();
        return $event;
    }

    public function toOrder(Order $order) {
        $order->taskStart->setValue($this->start);
        $order->taskEnd->setValue($this->end);
    }
}
