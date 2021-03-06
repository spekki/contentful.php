<?php
/**
 * @copyright 2015 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Unit\Delivery;

use Contentful\Delivery\ContentTypeField;

class ContentTypeFieldTest extends \PHPUnit_Framework_TestCase
{
    public function testGetter()
    {
        $field = new ContentTypeField(
            'id',
            'name',
            'type',
            'linkType',
            'itemsType',
            'itemsLinkType',
            true,
            false,
            false
        );

        $this->assertEquals('id', $field->getId());
        $this->assertEquals('name', $field->getName());
        $this->assertEquals('type', $field->getType());
        $this->assertEquals('linkType', $field->getLinkType());
        $this->assertEquals('itemsLinkType', $field->getItemsLinkType());
        $this->assertEquals('itemsType', $field->getItemsType());
        $this->assertEquals(true, $field->isRequired());
        $this->assertEquals(false, $field->isLocalized());
        $this->assertEquals(false, $field->isDisabled());
    }

    public function testJsonSerialize()
    {
        $field1 = new ContentTypeField(
            'one',
            'oneField',
            'Link',
            'Asset',
            null,
            null,
            true,
            true,
            true
        );

        $this->assertJsonStringEqualsJsonString('{"name":"oneField","id":"one","type":"Link","required":true,"localized":true,"disabled":true,"linkType":"Asset"}', json_encode($field1));

        $field2 = new ContentTypeField(
            'many',
            'manyField',
            'Array',
            null,
            'Link',
            'Asset',
            false,
            true,
            false
        );

        $this->assertJsonStringEqualsJsonString('{"name":"manyField","id":"many","type":"Array","required":false,"localized":true,"items":{"type":"Link","linkType":"Asset"}}', json_encode($field2));
    }
}
