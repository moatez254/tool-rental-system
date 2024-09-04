<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/faleh/tool-rental-system/app/UI/@layout.latte */
final class Template_671838201c extends Latte\Runtime\Template
{
	public const Source = '/home/faleh/tool-rental-system/app/UI/@layout.latte';

	public const Blocks = [
		['title' => 'blockTitle'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo ' <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>';
		$this->renderBlock('title', get_defined_vars()) /* line 5 */;
		echo '</title>
	<link rel="stylesheet" href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 6 */;
		echo '/css/styles.css">
</head>
<body>
    <div class="container">
';
		$this->renderBlock('content', [], 'html') /* line 10 */;
		echo '    </div>
</body>
</html>
';
	}


	/** {block title} on line 5 */
	public function blockTitle(array $ʟ_args): void
	{
		echo 'Tool Management';
	}
}
