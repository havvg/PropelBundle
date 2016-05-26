<?php

namespace Propel\Bundle\PropelBundle\Tests\Functional\App;

use Propel\Bundle\PropelBundle\PropelBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    /**
     * @var string
     */
    private $configFilename;

    /**
     * @var string
     */
    private $tmpDir;

    /**
     * Constructor.
     *
     * @param string $configFilename
     * @param string $environment
     * @param bool   $debug
     */
    public function __construct($configFilename, $environment = 'test', $debug = true)
    {
        $this->configFilename = $configFilename;
        $this->tmpDir = sys_get_temp_dir().'/propel_bundle_tests';

        parent::__construct($environment, $debug);
    }

    /**
     * Destructor.
     *
     * Removes all temporary files.
     */
    public function __destruct()
    {
        $fs = new Filesystem();
        $fs->remove($this->tmpDir);
    }

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
            new PropelBundle(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/fixtures/config/'.$this->configFilename);
    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return $this->tmpDir.'/cache';
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return $this->tmpDir.'/logs';
    }
}
