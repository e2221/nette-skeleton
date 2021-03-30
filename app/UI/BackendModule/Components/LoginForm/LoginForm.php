<?php declare(strict_types=1);


namespace App\UI\BackendModule\Components\LoginForm;


use App\Model\Managers\GlobalManager;
use App\UI\BackendModule\Components\BaseControl;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use stdClass;

class LoginForm extends BaseControl
{

    /** @var null|callable  */
    private $onSuccess=null;

    public function __construct(
        callable|null $onSuccess,
        private User $user,
        private GlobalManager $globalManager,
    )
    {
        $this->onSuccess = $onSuccess;
    }

    /**
    * Renderer
    */
    public function render(): void
    {
        if(isset($this->user->getIdentity()->login))
        {
            $this['signInForm']->setDefaults(['username' => $this->user->getIdentity()->login]);
        }
        $this->template->company = $this->globalManager->brand;
        $this->template->signInForm = $this['signInForm'];
        $this->template->setFile(__DIR__ . '/templates/default.latte');
        $this->template->render();
    }

    protected function createComponentSignInForm(): Form
    {
        $form = new Form();
        $form->addText('username')
            ->setRequired();
        $form->addPassword('password')
            ->setRequired();
        $form->addCheckbox('remember');
        $form->onSuccess[] = [$this, 'loginSuccess'];
        return $form;
    }

    /**
     * @param Form $form
     * @param stdClass $values
     */
    public function loginSuccess(Form $form, stdClass $values): void
    {
        try {
            $this->user->setExpiration($values->remember ?
                $this->globalManager->loginSessionRemember :
                $this->globalManager->loginSessionStandard
            );
            $this->user->login($values->username, $values->password);
        } catch (AuthenticationException $e) {
            $form->addError('The username or password you entered is incorrect.');
            return;
        }
        $onSuccess = $this->onSuccess;
        if(is_callable($onSuccess))
            $onSuccess();
    }
}

/**
 * Template
 * @method mixed clamp($value, $min, $max)
 */
class LoginFormTemplate extends \Nette\Bridges\ApplicationLatte\Template
{
    use \Nette\SmartObject;
    public LoginForm $control;
    public \Nette\Security\User $user;
    public string $baseUrl;
    public string $basePath;
    public array $flashes;
    public Form $signInForm;
    public string $company;
}