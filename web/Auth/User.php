<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Auth;

use QeyWork\Entities\Entity;
use QeyWork\Entities\Fields\Field;
use QeyWork\Entities\Persistence\EntityDbData;
use ShinyBaseWeb\ShinyBaseWeb;

class User extends Entity {
    const TABLE_NAME = "user";

    /** @var Field */
    public $name;

    /** @var Field */
    public $password;

    /** @var Field */
    public $role;

    public function __construct(){
        parent::__construct(new EntityDbData(ShinyBaseWeb::DB_PREFIX . self::TABLE_NAME));
        $this->addClassPropertiesAsFields();
    }
}