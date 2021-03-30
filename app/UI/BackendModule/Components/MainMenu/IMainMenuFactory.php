<?php
declare(strict_types=1);

namespace App\Model\Managers\MainMenu;


use App\BackendModule\Components\MainMenu\MainMenu;

interface IMainMenuFactory
{
    /** @return MainMenu */
    function create(): MainMenu;
}