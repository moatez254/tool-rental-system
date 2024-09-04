<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-rental-system/app/UI/Home/default.latte */
final class Template_2adc7c4e32 extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-rental-system/app/UI/Home/default.latte';

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
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<h1>';
		echo LR\Filters::escapeHtmlText($message) /* line 2 */;
		echo '</h1>
';
	}
}
