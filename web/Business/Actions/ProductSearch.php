<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Controller;


use QeyWork\Resources\Db\ConditionList;
use QeyWork\Resources\Db\DB;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Model\Product;
use ShinyBaseWeb\Responder;

class ProductSearch
{
    const SEARCH = "search";
    const ROUTE = "product";

    /** @var Request */
    private $request;
    /**
     * @var DB
     */
    private $db;
    /**
     * @var Responder
     */
    private $responder;

    public function __construct(Request $request, DB $db, Responder $responder) {
        $this->request = $request;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function execute()
    {
        $query = $this->request->get(self::SEARCH);
        $result = $this->search($query);
        $this->responder->success("success", $result->toArray());
    }

    private function search($query)
    {
        $product = new Product();
        $conditions = new ConditionList();
        $conditions->add($product->description)->equals('%' . $query . '%');
        return $this->db->search($product, $conditions);
    }
}