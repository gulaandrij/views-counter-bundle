<?php

namespace Tests\App;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Lavulator\ViewsCounterBundle\LavulatorViewsCounterBundle;
use Liip\FunctionalTestBundle\LiipFunctionalTestBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
            new LavulatorViewsCounterBundle(),
            new DoctrineBundle(),
            new LiipFunctionalTestBundle(),
        );
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yaml');
    }
}