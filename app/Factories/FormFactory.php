<?php declare(strict_types=1);


namespace App\Factories;


use Nette\Application\UI\Form;

interface FormFactory
{
    /** @return Form */
    function create(): Form;
}