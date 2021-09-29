<?php

namespace Kreemer\UX\AutoCompleteJS\Builder;

use Kreemer\UX\AutoCompleteJS\Model\AutoCompleteModel;
use Kreemer\UX\AutoCompleteJS\Model\DataModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultItemModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultListModel;

interface AutoCompleteBuilderInterface
{
    public function createAutocomplete(string $identifier = 'autoComplete'): AutoCompleteModel;

    public function createData(): DataModel;

    public function createResultList(): ResultListModel;

    public function createResultItem(): ResultItemModel;
}
