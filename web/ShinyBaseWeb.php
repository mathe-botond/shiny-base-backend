<?php
namespace ShinyBaseWeb;
use QeyWork\Common\IRenderer;
use QeyWork\Common\IRunner;
use QeyWork\Common\IWebsiteBuilder;
use QeyWork\QeyWork;
use QeyWork\Tools\Logger;
use ShinyBaseWeb\Auth\LoginAction;
use ShinyBaseWeb\Business\Controller\FindCustomerAction;
use ShinyBaseWeb\Business\Controller\ListOrderAction;
use ShinyBaseWeb\Business\Controller\OrdersCalendarAction;
use ShinyBaseWeb\Business\Controller\ProductSearchAction;
use ShinyBaseWeb\Business\Controller\SaveCalendarAction;
use ShinyBaseWeb\Business\Controller\SaveCustomerAction;
use ShinyBaseWeb\Business\Controller\SaveOrderAction;
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
        return $this->engine;
    }

    /** @return IRunner */
    public function getAsProcessor() {
        $this->engine->registerActionErrorHandler(JsonErrorResponder::class);
        $this->engine->registerActionClass(LoginAction::ROUTE, LoginAction::class);
        $this->engine->registerActionClass(ProductSearchAction::ROUTE, ProductSearchAction::class);
        $this->engine->registerActionClass(FindCustomerAction::ROUTE, FindCustomerAction::class);
        $this->engine->registerActionClass(SaveCustomerAction::ROUTE, SaveCustomerAction::class);
        $this->engine->registerActionClass(SaveOrderAction::ROUTE, SaveOrderAction::class);
        $this->engine->registerActionClass(ListOrderAction::ROUTE, ListOrderAction::class);
        $this->engine->registerActionClass(OrdersCalendarAction::ROUTE, OrdersCalendarAction::class);
        $this->engine->registerActionClass(SaveCalendarAction::ROUTE, SaveCalendarAction::class);
        return $this->engine;
    }
}
