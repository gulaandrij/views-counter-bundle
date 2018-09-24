<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class SessionViewsCounterTest
 */
class SessionViewsCounterTest extends KernelTestCase
{
    public function testTest()
    {
        self::bootKernel();

//        $video = new \Tests\App\Entity\Video();

        $container = self::$container;
        $manager = $container->get('doctrine.orm.default_entity_manager');
        $video = $manager->getRepository(\Tests\App\Entity\Video::class)->find(1);
//        $manager->persist($video);
//        $manager->flush();

        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);
        $container->get('views_counter.session_views_counter')->count($video);


        $this->assertEquals(1, $video->getSingularViewCount());
    }
}
