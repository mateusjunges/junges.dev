<?php declare(strict_types=1);

namespace App\Modules\Docs\Support\Highlighting;

use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Renderer\Inline\LinkRenderer as CommonMarkLinkRenderer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\RegexHelper;
use League\CommonMark\Xml\XmlNodeRendererInterface;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

final class LinkRenderer  implements NodeRendererInterface, XmlNodeRendererInterface, ConfigurationAwareInterface
{
    private readonly CommonMarkLinkRenderer $linkRenderer;

    /** @psalm-readonly-allow-private-mutation */
    private ConfigurationInterface $config;

    public function __construct()
    {
        $this->linkRenderer = new CommonMarkLinkRenderer;
    }

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
        $this->linkRenderer->setConfiguration($configuration);
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Link::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');

        $forbidUnsafeLinks = ! $this->config->get('allow_unsafe_links');
        if (! ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($node->getUrl()))) {
            $attrs['href'] = $node->getUrl();
        }

        if (($title = $node->getTitle()) !== null) {
            $attrs['title'] = $title;
        }

        if (isset($attrs['target']) && $attrs['target'] === '_blank' && ! isset($attrs['rel'])) {
            $attrs['rel'] = 'noopener noreferrer';
        }

        if (array_key_exists('href', $attrs)) {
            $attrs['href'] = str_replace('.md', '', $attrs['href']);
        }


        return new HtmlElement('a', $attrs, $childRenderer->renderNodes($node->children()));
    }

    public function getXmlTagName(Node $node): string
    {
        return $this->linkRenderer->getXmlTagName($node);
    }

    public function getXmlAttributes(Node $node): array
    {
        return $this->linkRenderer->getXmlAttributes($node);
    }
}