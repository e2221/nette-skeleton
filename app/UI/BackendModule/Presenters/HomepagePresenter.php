<?php declare(strict_types=1);


namespace App\BackendModule\Presenters;


use App\UI\BackendModule\Presenters\BasePresenter;
use e2221\BootstrapComponents\Breadcrumb\Breadcrumb;

final class HomepagePresenter extends BasePresenter
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Renderer
     */
    public function renderDefault(): void
    {
        $this->template->brand = $this->globalManager->brand;
    }

    /**
     * @return Breadcrumb
     */
    protected function createComponentBreadcrumb(): Breadcrumb
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->addItem('home', 'Home', $this->link('Homepage:default'));
        return $breadcrumb;
    }

}