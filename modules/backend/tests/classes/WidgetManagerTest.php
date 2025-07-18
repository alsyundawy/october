<?php

use Backend\Classes\WidgetManager;

class WidgetManagerTest extends TestCase
{
    public function testListFormWidgets()
    {
        $manager = WidgetManager::instance();
        $widgets = $manager->listFormWidgets();

        $this->assertArrayHasKey('TestVendor\Test\FormWidgets\Sample', $widgets);
        $this->assertArrayHasKey('October\Tester\FormWidgets\Preview', $widgets);
    }

    public function testIfWidgetsCanBeExtended()
    {
        $manager = WidgetManager::instance();
        $manager->registerReportWidget(\Acme\Fake\ReportWidget\HelloWorld::class, [
            'name' => 'Hello World Test',
            'context' => 'dashboard'
        ]);
        $widgets = $manager->listReportWidgets();

        $this->assertArrayHasKey(\Acme\Fake\ReportWidget\HelloWorld::class, $widgets);
    }

    public function testIfWidgetsCanBeRemoved()
    {
        $manager = WidgetManager::instance();
        $manager->registerReportWidget(\Acme\Fake\ReportWidget\HelloWorld::class, [
            'name' => 'Hello World Test',
            'context' => 'dashboard'
        ]);
        $manager->registerReportWidget(\Acme\Fake\ReportWidget\ByeWorld::class, [
            'name' => 'Hello World Bye',
            'context' => 'dashboard'
        ]);

        $manager->removeReportWidget(\Acme\Fake\ReportWidget\ByeWorld::class);

        $widgets = $manager->listReportWidgets();

        $this->assertCount(1, $widgets);
    }
}
