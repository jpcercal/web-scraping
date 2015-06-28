<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Template\Outlet;

use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchAuthorSelector;
use Cekurte\WebScrapingBundle\Template\Core\AuthorTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Outlet\TechCrunchAuthorTemplate;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchAuthorTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorTemplateInterface
     */
    private $author;

    public function setUp()
    {
        $body = <<<EOT
<html>
<body>
    <article>
        <div class="article-header">
            <a rel="author" href="fake_href_profile">AuthorName</a>
            <div class="twitter-handle">
                <a>Twitter</a>
            </div>
        </div>
    </article>
</body>
</html>
EOT;

        $this->author = new TechCrunchAuthorTemplate(new Crawler($body), new TechCrunchAuthorSelector());
    }

    public function testImplementsAuthorTemplateInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Template\\Outlet\\TechCrunchAuthorTemplate'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\AuthorTemplateInterface'
        ));
    }

    public function testGetName()
    {
        $this->assertEquals('AuthorName', $this->author->getName());
    }

    public function testGetImage()
    {
        $this->assertNull($this->author->getImage());
    }

    public function testGetBiography()
    {
        $this->assertNull($this->author->getBiography());
    }

    public function testGetProfileUrl()
    {
        $this->assertEquals('fake_href_profile', $this->author->getProfileUrl());
    }

    public function testGetFacebook()
    {
        $this->assertNull($this->author->getFacebook());
    }

    public function testGetTwitter()
    {
        $this->assertEquals('Twitter', $this->author->getTwitter());
    }
}
