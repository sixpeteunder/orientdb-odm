<?php

namespace test\Doctrine\ODM\OrientDB\Proxy;

use Doctrine\ODM\OrientDB\Configuration;
use Doctrine\ODM\OrientDB\Manager;
use Doctrine\OrientDB\Binding\BindingParameters;
use Doctrine\OrientDB\Binding\HttpBinding;
use test\Integration\Document\Country;
use test\PHPUnit\TestCase;

/**
 * Class ProxyFactoryTest
 *
 * @package test\Doctrine\ODM\OrientDB\Proxy
 * @author  Tamás Millián <tamas.millian@gmail.com>
 */
class ProxyFactoryTest extends TestCase
{

    public function testGenerate()
    {
        $manager = $this->createManager();
        $metadata = $manager->getClassMetadata('test\Integration\Document\Country');
        $proxyFactory = $manager->getProxyFactory();
        $proxyFactory->generateProxyClasses(array($metadata));

        $filename = $this->getProxyDirectory().'/__CG__testIntegrationDocumentCountry.php';
        $this->assertFileExists($filename);
    }

    public function testLazyLoad()
    {
        $manager = $this->createManager();

        $rid = '#'.$this->getClassId('City').':0';
        $proxy = $manager->getReference('test\Integration\Document\Country', $rid);
        $this->assertEquals($rid, $proxy->rid);
        $this->assertFalse($proxy->__isInitialized());
        $this->assertEquals('Rome1', $proxy->name);
        $this->assertTrue($proxy->__isInitialized());
    }

    public function testEagerLoad()
    {
        $manager = $this->createManager();
        $rid = '#'.$this->getClassId('City').':0';
        $proxy = $manager->find($rid);
        $this->assertTrue($proxy->__isInitialized());
        $this->assertEquals($rid, $proxy->rid);
        $this->assertEquals('Rome1', $proxy->name);
    }
}