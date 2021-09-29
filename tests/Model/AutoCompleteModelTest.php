<?php

namespace Kreemer\UX\AutoCompleteJS\Tests\Model;

use Kreemer\UX\AutoCompleteJS\Model\AutoCompleteModel;
use Kreemer\UX\AutoCompleteJS\Model\DataModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultItemModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultListModel;
use PHPUnit\Framework\TestCase;

class AutoCompleteModelTest extends TestCase
{

    public function testOnlyContainsIdentifierIfEverythingElseIsNull(): void
    {
        // given
        $identifier = 'test';
        $autoComplete = new AutoCompleteModel($identifier, new DataModel(), new ResultListModel(), new ResultItemModel());

        // when
        $result = json_decode(json_encode($autoComplete), true, 512, JSON_THROW_ON_ERROR);

        // then
        self::assertCount(1, $result);
        self::assertArrayHasKey('identifier', $result);
        self::assertSame($identifier, $result['identifier']);
    }

    public function testContainsDataEntryIfDataEntryIsNotEmpty(): void
    {
        // given
        $identifier = 'test';
        $autoComplete = new AutoCompleteModel($identifier, new DataModel(), new ResultListModel(), new ResultItemModel());
        $autoComplete->getDataModel()->setSrc([ 'test1', 'test2' ]);

        // when
        $result = json_decode(json_encode($autoComplete), true, 512, JSON_THROW_ON_ERROR);

        // then
        self::assertCount(2, $result);
        self::assertArrayHasKey('data', $result);
        self::assertIsArray($result['data']);
        self::assertCount(1, $result['data']);
        self::assertArrayHasKey('src', $result['data']);
        self::assertIsArray($result['data']['src']);
        self::assertCount(2, $result['data']['src']);
        self::assertContains('test1', $result['data']['src']);
        self::assertContains('test2', $result['data']['src']);
    }

    public function testContainsResultListEntryIfResultListIsNotEmpty(): void
    {
        // given
        $identifier = 'test';
        $autoComplete = new AutoCompleteModel($identifier, new DataModel(), new ResultListModel(), new ResultItemModel());
        $autoComplete->getResultListModel()->setId('identifier');

        // when
        $result = json_decode(json_encode($autoComplete), true, 512, JSON_THROW_ON_ERROR);

        // then
        self::assertCount(2, $result);
        self::assertArrayHasKey('resultsList', $result);
        self::assertIsArray($result['resultsList']);
        self::assertCount(1, $result['resultsList']);
        self::assertArrayHasKey('id', $result['resultsList']);
        self::assertSame('identifier', $result['resultsList']['id']);
    }

    public function testContainsResultItemEntryIfResultItemIsNotEmpty(): void
    {
        // given
        $identifier = 'test';
        $autoComplete = new AutoCompleteModel($identifier, new DataModel(), new ResultListModel(), new ResultItemModel());
        $autoComplete->getResultItemModel()->setId('identifier');

        // when
        $result = json_decode(json_encode($autoComplete), true, 512, JSON_THROW_ON_ERROR);

        // then
        self::assertCount(2, $result);
        self::assertArrayHasKey('resultItem', $result);
        self::assertIsArray($result['resultItem']);
        self::assertCount(1, $result['resultItem']);
        self::assertArrayHasKey('id', $result['resultItem']);
        self::assertSame('identifier', $result['resultItem']['id']);
    }
}
