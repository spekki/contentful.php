<?php
/**
 * @copyright 2015-2016 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Unit\Delivery;

use Contentful\Delivery\LocalizedResource;
use Contentful\Delivery\Locale;

class LocalizedResourceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaultLocale()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $this->assertEquals('en-US', $resource->getLocale());
    }

    public function testSetGetLocaleString()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $resource->setLocale('de-DE');
        $this->assertEquals('de-DE', $resource->getLocale());
    }

    public function testSetGetLocaleObject()
    {
        $deLocale = new Locale('de-DE', 'German (Germany)', 'en-US');

        $resource = new ConcreteLocalizedResource([
            $deLocale,
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $resource->setLocale($deLocale);
        $this->assertEquals('de-DE', $resource->getLocale());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Trying to switch to invalid locale fr-FR. Available locales are de-DE, en-US.
     */
    public function testSetGetLocaleInvalid()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $resource->setLocale('fr-FR');
    }

    public function testGetLocaleFromInputDefault()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $this->assertEquals('en-US', $resource->getLocaleFromInput());
    }

    public function testGetLocaleFromInputString()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $this->assertEquals('de-DE', $resource->getLocaleFromInput('de-DE'));
    }

    public function testGetLocaleFromInputObject()
    {
        $deLocale = new Locale('de-DE', 'German (Germany)', 'en-US');

        $resource = new ConcreteLocalizedResource([
            $deLocale,
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $this->assertEquals('de-DE', $resource->getLocaleFromInput($deLocale));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Trying to use invalid locale en-GB. Available locales are de-DE, en-US.
     */
    public function testGetLocaleFromInputInvalid()
    {
        $resource = new ConcreteLocalizedResource([
            new Locale('de-DE', 'German (Germany)', 'en-US'),
            new Locale('en-US', 'English (United States)', null, true)
        ]);

        $resource->getLocaleFromInput('en-GB');
    }
}

class ConcreteLocalizedResource extends LocalizedResource
{
    public function getLocaleFromInput($locale = null)
    {
        return parent::getLocaleFromInput($locale);
    }
}
