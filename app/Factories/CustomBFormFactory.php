<?php declare(strict_types=1);


namespace app\Factories;


use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\BaseControl;

class CustomBFormFactory
{
    private const BOLD = 'font-weight-bold';

    public function __construct(
        private BootstrapFormFactory $formFactory
    )
    {
    }

    /**
     * @param bool $transition
     * @return BootstrapForm
     */
    public function create(bool $transition=true): BootstrapForm
    {
        $form = $this->createBase();
        $form->setHtmlAttribute('data-history', 'false');
        $form->setHtmlAttribute('data-reset', 'false');
        if($transition === false){
            $form->setHtmlAttribute('data-transition', 'false');
        }

        $form->onRender[] = function (Form $form){
            foreach($form->getControls() as $control){
                if($control instanceof BaseControl)
                    $control->getLabelPrototype()->setAttribute('class', self::BOLD);
            }
        };

        return $form;
    }


    /**
     * @return BootstrapForm
     */
    public function createBase(): BootstrapForm
    {
        return $this->formFactory->create();
    }
}