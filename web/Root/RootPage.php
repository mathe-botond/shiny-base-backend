<?php
namespace ShinyBaseWeb\Root;
use QeyWork\View\Html\HtmlBuilder;
use QeyWork\View\Page\Page;

/**
 * Author: Mathe E. Botond
 */
class RootPage extends Page
{
    const ROUTE = "root";

    public function render(HtmlBuilder $h) {
        return $h->div()->text("Nothing to see here");
    }
}