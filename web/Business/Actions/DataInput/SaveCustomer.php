<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb\Business\Controller\DataInput;

use QeyWork\Common\Actions\JsonAction;
use QeyWork\Entities\ArrayEntityMapper;
use QeyWork\Entities\Persistence\EntityManager;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Dao\CustomerDao;
use ShinyBaseWeb\Business\Model\Customer;
use ShinyBaseWeb\Responder;

class SaveCustomer extends JsonAction
{
    const ROUTE = 'save-customer';

    /** @var CustomerDao */
    private $manager;

    /** @var Responder */
    private $responder;

    public function __construct(
            Request $request,
            ArrayEntityMapper $mapper,
            EntityManager $manager,
            Responder $responder) {
        parent::__construct($request, $mapper);
        $this->manager = $manager;
        $this->responder = $responder;
    }

    public function getBodyType() {
        return new Customer();
    }

    public function executeOnBody($customer) {
        /** @var Customer $customer */
        $this->manager->save($customer);
        $this->responder->success('', $customer->getId());
    }
}
