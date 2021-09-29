<?php

namespace Kreemer\UX\AutoCompleteJS\Builder;

use Kreemer\UX\AutoCompleteJS\Model\AutoCompleteModel;
use Kreemer\UX\AutoCompleteJS\Model\DataModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultItemModel;
use Kreemer\UX\AutoCompleteJS\Model\ResultListModel;

class AutoCompleteBuilder implements AutoCompleteBuilderInterface
{
    /**
     * {@inheritDoc}
     */
    public function createAutocomplete(string $identifier = 'autoComplete'): AutoCompleteModel
    {
        return new AutoCompleteModel(
            $identifier,
            $this->createData(),
            $this->createResultList(),
            $this->createResultItem()
        );
    }

    public function createData(): DataModel
    {
        return new DataModel();
    }

    public function createResultList(): ResultListModel
    {
        return new ResultListModel();
    }

    public function createResultItem(): ResultItemModel
    {
        return new ResultItemModel();
    }
}
