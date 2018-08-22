<?php
namespace ShinyBaseWeb;
use QeyWork\Common\IRenderer;
use QeyWork\Common\IRunner;
use QeyWork\Common\IWebsiteBuilder;
use QeyWork\QeyWork;
use QeyWork\Tools\Logger;
use ShinyBaseWeb\Auth\LoginAction;
use ShinyBaseWeb\Business\Controller\Calendar\OrdersCalendar;
use ShinyBaseWeb\Business\Controller\Calendar\SaveCalendar;
use ShinyBaseWeb\Business\Controller\CustomerSearch;
use ShinyBaseWeb\Business\Controller\DataInput\SaveCustomer;
use ShinyBaseWeb\Business\Controller\DataInput\SaveOrder;
use ShinyBaseWeb\Business\Controller\OrderList;
use ShinyBaseWeb\Business\Controller\ProductSearch;
use ShinyBaseWeb\Business\Components\PhoneExport\PhoneExportPage;
use ShinyBaseWeb\Common\JsonErrorResponder;
use ShinyBaseWeb\Root\RootPage;

/**
 * Author: Mathe E. Botond
 */
class ShinyBaseWeb implements IWebsiteBuilder
{
    const DB_PREFIX = "shiny_";

    /** @var QeyWork */
    private $engine;
    /** @var MyConfig */
    private $config;

    public function __construct(MyConfig $config) {
        $this->config = $config;
        $this->engine = new QeyWork($config);
        $this->engine->getAssembler()->getIoC()->assign(new Logger('log.txt', Logger::DEBUG));
    }

    /** @return IRenderer */
    public function getAsRenderer() {
        $this->engine->registerPageClass(RootPage::ROUTE, RootPage::class);
        $this->engine->registerPageClass(PhoneExportPage::ROUTE, PhoneExportPage::class);
        return $this->engine;
    }

    /** @return IRunner */
    public function getAsProcessor() {
        $this->engine->registerActionErrorHandler(JsonErrorResponder::class);
        $this->engine->registerActionClass(LoginAction::ROUTE, LoginAction::class);
        $this->engine->registerActionClass(ProductSearch::ROUTE, ProductSearch::class);
        $this->engine->registerActionClass(CustomerSearch::ROUTE, CustomerSearch::class);
        $this->engine->registerActionClass(SaveCustomer::ROUTE, SaveCustomer::class);
        $this->engine->registerActionClass(SaveOrder::ROUTE, SaveOrder::class);
        $this->engine->registerActionClass(OrderList::ROUTE, OrderList::class);
        $this->engine->registerActionClass(OrdersCalendar::ROUTE, OrdersCalendar::class);
        $this->engine->registerActionClass(SaveCalendar::ROUTE, SaveCalendar::class);
        return $this->engine;
    }
}
