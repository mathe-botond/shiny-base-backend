<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Controller;


use QeyWork\Common\Actions\JsonAction;
use QeyWork\Entities\ArrayEntityMapper;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Dao\CustomerDao;
use ShinyBaseWeb\Business\Model\Customer;
use ShinyBaseWeb\Responder;

class FindCustomerAction extends JsonAction
{
    const ROUTE = 'find-customer';

    /** @var CustomerDao */
    private $dao;

    /** @var Responder */
    private $responder;

    public function __construct(
            Request $request,
            ArrayEntityMapper $mapper,
            CustomerDao $manager,
            Responder $responder) {
        parent::__construct($request, $mapper);
        $this->dao = $manager;
        $this->responder = $responder;
    }

    public function getBodyType() {
        return new Customer();
    }

    public function executeOnBody($customer) {
        /** @var Customer $customer */
        $result = $this->dao->findSimilarCustomers($customer);
        $resultArray = [];
        if ($result != null) {
            $resultArray = $result->toArray();
        }
        $this->responder->success('Search complete', $resultArray);
    }
}
