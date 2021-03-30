<?php declare(strict_types=1);


namespace App\Factories;


use Contributte\FormsBootstrap\BootstrapForm;

interface BootstrapFormFactory
{
    /** @return BootstrapForm  */
    function create(): BootstrapForm;
}