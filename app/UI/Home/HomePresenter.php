<?php

declare(strict_types=1);
namespace App\UI\Home;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Database\Explorer;
use Nette\Security\Passwords;
use Nette\Security\Authenticator;
use Nette\Security\AuthenticationException;


class HomePresenter extends Presenter
{
    private $database;
    private $passwords;


    public function __construct(Explorer $database, Passwords $passwords)
    {
        $this->database = $database;
        $this->passwords = $passwords;
		 

    }
	 
    protected function createComponentLoginForm(): Form
    {
        $form = new Form;

        $form->addText('username', 'Username:')
            ->setRequired('Please enter your username.');

        $form->addPassword('password', 'Password:')
            ->setRequired('Please enter your password.');

        $form->addSubmit('login', 'Login');

        $form->onSuccess[] = [$this, 'loginFormSucceeded'];

        return $form;
    }

    
    public function loginFormSucceeded(Form $form, \stdClass $values): void
    {
        try {
            $this->getUser()->setAuthenticator($this->authenticator); // Set the authenticator here
            $this->getUser()->login($values->username, $values->password);
            $this->flashMessage('Login successful', 'success');
            $this->redirect('tools');
        } catch (AuthenticationException $e) {
            $form->addError('Invalid username or password.');
        }
    }

    public function startup(): void
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn() && $this->getAction() !== 'login') {
            $this->redirect('login');
        }
    }

    public function renderTools(): void
    {
        $this->template->tools = $this->database->table('tools')->fetchAll();
    }

    public function actionBorrow($toolId): void
    {
        $userId = $this->getUser()->getId();
        $tool = $this->database->table('tools')->get($toolId);

        if (!$tool) {
            $this->error('Tool not found');
        }

        $this->database->table('borrow_records')->insert([
            'user_id' => $userId,
            'tool_id' => $toolId,
            'borrow_date' => new \DateTime(),
            'expected_return_date' => (new \DateTime())->modify('+1 week')
        ]);

        $this->flashMessage('Tool borrowed', 'success');
        $this->redirect('tools');
    }


    public function actionReturn($id): void
    {
        $borrowRecord = $this->database->table('borrow_records')->get($id);

        if (!$borrowRecord) {
            $this->error('Borrow record not found');
        }

        $borrowRecord->update([
            'actual_return_date' => new \DateTime(),
            'status' => 'returned'
        ]);

        $this->flashMessage('Tool returned', 'success');
        $this->redirect('borrowRecords');
    }

    
    public function renderUsers(): void
    {
        $this->template->users = $this->database->table('users')->fetchAll();
    }

   
    public function actionLogin(): void
    {
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect('tools');
        }
    }

    
    public function handleLogin($username, $password): void
    {
        try {
            $this->getUser()->login($username, $password);
            $this->flashMessage('Login successful', 'success');
            $this->redirect('tools');
        } catch (AuthenticationException $e) {
            $this->flashMessage('Login failed: ' . $e->getMessage(), 'danger');
            $this->redirect('login');
        }
    }
 
    public function actionLogout(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Logged out', 'info');
        $this->redirect('login');
    }
   
    public function renderBorrowRecords(): void
    {
        $this->template->borrowRecords = $this->database->table('borrow_records')->fetchAll();
    }

    public function renderDefault(): void
    {
        $this->redirect('tools');
        }
    }
 