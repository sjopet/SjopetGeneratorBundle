<?php
/*
 * (c) Sjopet Internetdiensten
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 10-12-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sjopet\Bundle\GeneratorBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Sjopet\Bundle\GeneratorBundle\Model\BundleMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\ClassMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\PropertyMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\FunctionMetadata;

class ProjectServiceTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $ps = $client->getContainer()->get('');

        $class = new ClassMetadata();
        $class->setClassName('MyClass');
        $class->setNamespace('Sjopet\Bundle\GeneratorBundle\Tests\Output');

        $prop = new PropertyMetadata();
        $class->addProperty($prop);
    }
}
