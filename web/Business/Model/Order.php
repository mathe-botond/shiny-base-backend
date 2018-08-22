<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Model;

use QeyWork\Entities\Entity;
use QeyWork\Entities\Fields\DateTimeField;
use QeyWork\Entities\Fields\Field;
use QeyWork\Entities\Fields\ReferenceField;
use QeyWork\Entities\Persistence\EntityDbData;
use ShinyBaseWeb\ShinyBaseWeb;

class Order extends Entity
{
    const TABLE = "order";

    /** @var ReferenceField */
    public $customer;

    /** @var Field */
    public $type;

    /** @var Field */
    public $price;

    /** @var Field */
    public $details;

    /** @var Field */
    public $isEmergency;

    /** @var Field */
    public $taskStart;

    /** @var Field */
    public $taskEnd;

    public function __construct(Customer $customer = null) {
        parent::__construct(new EntityDbData(ShinyBaseWeb::DB_PREFIX . self::TABLE));

        if ($customer == null) {
            $customer = new Customer();
        }
        $this->customer = new ReferenceField("customer", new Customer());
        $this->customer->setEntity($customer);

        $this->isEmergency = new Field("is_emergency");
        $this->isEmergency->setValue(0);

        $this->taskStart = new DateTimeField("task_start");
        $this->taskStart->setNow();

        $this->addClassPropertiesAsFields();
    }
}
