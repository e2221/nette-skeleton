<?php declare(strict_types=1);


namespace App\UI\BackendModule\Components;


use Nette\Application\UI\Control;
use Nittro\Bridges\NittroUI\ComponentUtils;

class BaseControl extends Control
{
    use ComponentUtils;

    public function redrawDummy(): void
    {
        $this->redrawControl('dummy');
    }

}