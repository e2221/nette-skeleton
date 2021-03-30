<?php declare(strict_types=1);


namespace App\Factories;


use e2221\BootstrapComponents\Tabs\Tabs;

interface TabsFactory
{
    /** @return Tabs */
    function create(): Tabs;
}