<?php declare(strict_types=1);


namespace App\Factories;


use e2221\NetteGrid\NetteGrid;

interface NetteGridFactory
{
    /** @return NetteGrid */
    function create(): NetteGrid;
}