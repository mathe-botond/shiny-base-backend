<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb;

use QeyWork\Common\Addresses\Locations;
use QeyWork\Common\Config;
use QeyWork\Common\Routers\IndexToken;
use QeyWork\Resources\Db\DBConfig;
use ShinyBaseWeb\Root\RootPage;

class MyConfig extends Config {
    const DB_NAME = "shiny-base";

    public function __construct(Locations $loc) {
        parent::__construct($loc, new IndexToken(RootPage::ROUTE));
    }

    public function getAppName() {
        return "shiny-base-web";
    }

    public function getDbConfig() {
        $dbConfig = new DBConfig();
        $dbConfig->dbName = self::DB_NAME;
        return $dbConfig;
    }
}
