<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb;

use QeyWork\Common\Addresses\Location;
use QeyWork\Common\Addresses\Locations;
use QeyWork\Common\Addresses\Path;
use QeyWork\Common\Addresses\RelativePath;
use QeyWork\Common\Addresses\Url;
use QeyWork\Common\Config;
use QeyWork\Common\Routers\IndexToken;
use QeyWork\Resources\Db\DBConfig;
use ShinyBaseWeb\Root\RootPage;

class MyConfig extends Config {
    const DB_NAME = "shiny-base";
    const BASE = "shiny-base-backend";

    public function __construct() {
        $loc = new Locations(
            new Location(new Path(__DIR__), Url::getDomainUrl($_SERVER)->param(self::BASE)),
            new RelativePath(),
            new RelativePath('qeyWork')
        );
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
