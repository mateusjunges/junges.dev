<?php declare(strict_types=1);

namespace App\Services\CommonMark\Extensions;

use Illuminate\Support\Facades\Blade;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

final class CodeRendererExtension implements ExtensionInterface, NodeRendererInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(FencedCode::class, $this, 100);
        $environment->addRenderer(IndentedCode::class, $this, 100);
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        if ($node instanceof FencedCode || $node instanceof IndentedCode) {
            if (! method_exists($node, 'getInfoWords')) {
                return null;
            }

            $info = $node->getInfoWords();

            // Any code blocks with the `+parse` keyword will be passed through blade.
            if (in_array('+parse', $info)) {
                return Blade::render($node->getLiteral());
            }
        }
    }
}