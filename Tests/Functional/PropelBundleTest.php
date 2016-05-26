<?php

namespace Propel\Bundle\PropelBundle\Tests\Functional;

class PropelBundleTest extends AbstractFunctionalTest
{
    public function testSqlite()
    {
        $kernel = static::createKernel(array('config_file' => 'sqlite.yml'));
        $kernel->boot();

        $bundle = $kernel->getBundle('PropelBundle');

        static::assertInstanceOf('Propel\Bundle\PropelBundle\PropelBundle', $bundle);
    }
}
