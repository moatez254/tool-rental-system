<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-rental-system/app/UI/Home/login.latte */
final class Template_8e274af34a extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-rental-system/app/UI/Home/login.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
		echo '

';
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<div class="login-container">
    <div class="login-box">
        <h1>Login</h1>
';
		$form = $this->global->formsStack[] = $this->global->uiControl['loginForm'] /* line 5 */;
		Nette\Bridges\FormsLatte\Runtime::initializeForm($form);
		echo '        <form';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), ['method' => null], false) /* line 5 */;
		echo ' method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit"';
		echo ($ʟ_elem = Nette\Bridges\FormsLatte\Runtime::item('login', $this->global)->getControlPart())->addAttributes(['type' => null, 'class' => null])->attributes() /* line 14 */;
		echo ' class="login-button">Login</button>
        ';
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(end($this->global->formsStack), false) /* line 5 */;
		echo '</form>
';
		array_pop($this->global->formsStack);
		echo '    </div>
</div>
 <script>
    function adjustLoginBoxSize() {
        const loginBox = document.querySelector(\'.login-box\');
        const viewportWidth = window.innerWidth;

        if (viewportWidth < 480) {
            loginBox.style.width = \'90%\';
            loginBox.style.padding = \'40px\';   
            loginBox.style.width = \'80%\';
        } else {
            loginBox.style.width = \'400px\';   
        }
    }
 
    window.addEventListener(\'resize\', adjustLoginBoxSize);
    window.addEventListener(\'load\', adjustLoginBoxSize);
</script>
';
	}
}
