<?php
namespace ShinyBaseWeb\Business\Dao;
use QeyWork\Resources\Db\ConditionList;
use QeyWork\Resources\Db\DB;
use ShinyBaseWeb\Business\Model\Customer;

/**
 * Author: Mathe E. Botond
 */
class CustomerDao {
    /** @var DB */
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function findSimilarCustomers(Customer $customer) {
        $criteria = new ConditionList();
        $order = $customer->name->getName();
        $criteria->add($customer->type)->equals($customer->type->value());

        if (! $customer->phone->isEmpty()) {
            $criteria->add($customer->phone)->equals('%' . $customer->phone->value() . '%');
            $order = $customer->phone->getName();
        }

        if (! $customer->name->isEmpty()) {
            $criteria->add($customer->name)->equals('%' . $customer->name->value() . '%');
        }

        return $this->db->search($customer, $criteria, $order);
    }
}
