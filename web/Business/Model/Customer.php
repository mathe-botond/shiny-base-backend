<?php
namespace ShinyBaseWeb\Business\Model;
use QeyWork\Entities\Entity;
use QeyWork\Entities\Fields\Field;
use QeyWork\Entities\Persistence\EntityDbData;
use ShinyBaseWeb\ShinyBaseWeb;

/**
 * Author: Mathe E. Botond
 */
class Customer extends Entity
{
    const TABLE_NAME = "customer";

    /** @var Field */
    public $name;

    /** @var Field */
    public $type;

    /** @var Field */
    public $phone;

    public function __construct() {
        parent::__construct(new EntityDbData(ShinyBaseWeb::DB_PREFIX . self::TABLE_NAME));
        $this->addClassPropertiesAsFields();
    }

    public function getPhoneFormatted() {
        return preg_replace('/(\d{4})(\d{2})(\d{2})(\d{2})/', '$1-$2-$3-$4', $this->phone->value());
    }
}
