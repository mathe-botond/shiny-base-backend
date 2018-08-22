<?php
namespace ShinyBaseWeb\Business\Components\PhoneExport;

use QeyWork\Common\Addresses\Locations;
use QeyWork\Components\Component;
use QeyWork\Entities\EntityList;
use QeyWork\Resources\Db\DB;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Business\Model\Customer;

/**
 * Author: Mathe E. Botond
 */
class PhoneExportPage extends Component {
    const ROUTE = 'phone-list';

    const FROM = 'from';
    const TO = 'to';
    const START = 1;
    const STEP = 200;

    /** @var DB */
    private $db;

    /** @var Request */
    private $request;

    public $from;
    public $step;
    public $customersPhoneList;
    /**
     * @var Locations
     */
    private $locations;

    public function __construct(
            Db $db,
            Request $request,
            Locations $locations) {
        $this->db = $db;
        $this->request = $request;
        $this->locations = $locations;
    }

    public function build() {
        $model = new Customer();
        $from = ($this->request->exists(self::FROM)) ? $this->request->get(self::FROM) : self::START;
        $to = ($this->request->exists(self::TO)) ? $this->request->get(self::TO) : self::STEP;
        $limit = [intval($from), intval($to)];

        $customers = $this->db->search($model, null, $model->getIdField()->getName(), Db::ORDER_ASC, $limit);
        $this->buildPhoneList($customers);

        $this->from = $from;
        $this->step = self::STEP;
    }

    private function buildPhoneList(EntityList $customers) {
        $phoneList = [];
        foreach ($customers as $customer) {
            /** @var Customer $customer */
            $phone = $customer->phone->value();
            if (strlen($phone) >= 8) {
                $phoneList[] = $phone;
            }
        }
        $this->customersPhoneList = implode($phoneList, ',');
    }

    public function previousExists() {
        return $this->from > self::START;
    }

    public function nextExists() {
        return $this->customersPhoneList != '';
    }

    public function getPrevious() {
        return $this->getUrl($this->from - $this->step);
    }

    public function getNext() {
        return $this->getUrl($this->from + $this->step);
    }

    private function getUrl($from) {
        return $this->locations->getUrlOfPage(self::ROUTE)->addFields([
            self::FROM => $from,
            self::TO => $from + self::STEP - 1
        ]);
    }

    public function getPage() {
        return ceil($this->from / $this->step);
    }
}
