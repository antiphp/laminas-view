<?php

/**
 * @see       https://github.com/laminas/laminas-view for the canonical source repository
 * @copyright https://github.com/laminas/laminas-view/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-view/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Renderer\PhpRenderer;

/**
 * Tests for {@see \Zend\View\Helper\AbstractHtmlElement}
 *
 * @covers \Zend\View\Helper\AbstractHtmlElement
 */
class AbstractHtmlElementTest extends TestCase
{
    /**
     * @var \Zend\View\Helper\AbstractHtmlElement|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $helper;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->helper = $this->getMockForAbstractClass('Zend\View\Helper\AbstractHtmlElement');

        $this->helper->setView(new PhpRenderer());
    }

    /**
     * @group 5991
     */
    public function testWillEscapeValueAttributeValuesCorrectly()
    {
        $reflectionMethod = new \ReflectionMethod($this->helper, 'htmlAttribs');

        $reflectionMethod->setAccessible(true);

        $this->assertSame(
            ' data-value="breaking&#x20;your&#x20;HTML&#x20;like&#x20;a&#x20;boss&#x21;&#x20;&#x5C;"',
            $reflectionMethod->invoke($this->helper, array('data-value' => 'breaking your HTML like a boss! \\'))
        );
    }
}