<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Model;

use QeyWork\Entities\Entity;
use QeyWork\Entities\Fields\Field;
use QeyWork\Entities\Persistence\EntityDbData;
use ShinyBaseWeb\ShinyBaseWeb;

class Product extends Entity
{
    const TABLE = "product";

    /** @var Field */
    public $price;

    /** @var Field */
    public $description;

    public function __construct() {
        parent::__construct(new EntityDbData(ShinyBaseWeb::DB_PREFIX . self::TABLE));
        $this->addClassPropertiesAsFields();
    }
}