<?php

namespace Kreemer\UX\AutoCompleteJS\Model;

class AutoCompleteModel implements \JsonSerializable
{
    private string $identifier;
    private DataModel $dataModel;
    private ResultListModel $resultListModel;
    private ResultItemModel $resultItemModel;
    private ?bool $wrapper = null;
    private ?string $placeholder = null;
    private ?int $threshold = null;
    private ?int $debounce = null;
    private ?string $searchEngine = null;
    private ?bool $diacritics = null;
    private ?bool $submit = null;
    /**
     * @var array<string, mixed>
     */
    private array $attributes = [];
    /**
     * @var array<string, mixed>
     */
    private array $inputAttributes = [];

    /**
     * @var array<string, mixed>
     */
    private array $dataAttributes = [];

    public function __construct(string $identifier, DataModel $dataModel, ResultListModel $resultListModel, ResultItemModel $resultListItemModel)
    {
        $this->identifier = $identifier;
        $this->dataModel = $dataModel;
        $this->resultListModel = $resultListModel;
        $this->resultItemModel = $resultListItemModel;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getDataModel(): DataModel
    {
        return $this->dataModel;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setDataModel(DataModel $dataModel): self
    {
        $this->dataModel = $dataModel;

        return $this;
    }

    public function getResultListModel(): ResultListModel
    {
        return $this->resultListModel;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setResultListModel(ResultListModel $resultListModel): self
    {
        $this->resultListModel = $resultListModel;

        return $this;
    }

    public function getResultItemModel(): ResultItemModel
    {
        return $this->resultItemModel;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setResultItemModel(ResultItemModel $resultItemModel): self
    {
        $this->resultItemModel = $resultItemModel;

        return $this;
    }

    public function getWrapper(): ?bool
    {
        return $this->wrapper;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setWrapper(?bool $wrapper): self
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setPlaceholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setThreshold(?int $threshold): self
    {
        $this->threshold = $threshold;

        return $this;
    }

    public function getDebounce(): ?int
    {
        return $this->debounce;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setDebounce(?int $debounce): self
    {
        $this->debounce = $debounce;

        return $this;
    }

    public function getSearchEngine(): ?string
    {
        return $this->searchEngine;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setSearchEngine(?string $searchEngine): self
    {
        $this->searchEngine = $searchEngine;

        return $this;
    }

    public function getDiacritics(): ?bool
    {
        return $this->diacritics;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setDiacritics(?bool $diacritics): self
    {
        $this->diacritics = $diacritics;

        return $this;
    }

    public function getSubmit(): ?bool
    {
        return $this->submit;
    }

    /**
     * @return AutoCompleteModel
     */
    public function setSubmit(?bool $submit): self
    {
        $this->submit = $submit;

        return $this;
    }

    /**
     * @return array<string,mixed>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array<string,mixed> $attributes
     *
     * @return AutoCompleteModel
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getInputAttributes(): array
    {
        return $this->inputAttributes;
    }

    /**
     * @param array<string, mixed> $inputAttributes
     *
     * @return AutoCompleteModel
     */
    public function setInputAttributes(array $inputAttributes): self
    {
        $this->inputAttributes = $inputAttributes;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getDataAttributes(): array
    {
        return $this->dataAttributes;
    }

    /**
     * @param array<string, mixed> $dataAttributes
     *
     * @return AutoCompleteModel
     */
    public function setDataAttributes(array $dataAttributes): self
    {
        $this->dataAttributes = $dataAttributes;

        return $this;
    }

    public function getDataController(): ?string
    {
        return $this->attributes['data-controller'] ?? null;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        $array = ['identifier' => $this->identifier];
        if (!empty($this->getDataModel()->jsonSerialize())) {
            $array['data'] = $this->getDataModel()->jsonSerialize();
        }
        if (!empty($this->getResultListModel()->jsonSerialize())) {
            $array['resultsList'] = $this->getResultListModel()->jsonSerialize();
        }
        if (!empty($this->getResultItemModel()->jsonSerialize())) {
            $array['resultItem'] = $this->getResultItemModel()->jsonSerialize();
        }

        $array +=
            (null !== $this->getWrapper() ? ['wrapper' => $this->getWrapper()] : []) +
            (null !== $this->getPlaceholder() ? ['placeholder' => $this->getPlaceholder()] : []) +
            (null !== $this->getThreshold() ? ['threshold' => $this->getThreshold()] : []) +
            (null !== $this->getDebounce() ? ['debounce' => $this->getDebounce()] : []) +
            (null !== $this->getSearchEngine() ? ['searchEngine' => $this->getSearchEngine()] : []) +
            (null !== $this->getDiacritics() ? ['diacritics' => $this->getDiacritics()] : []) +
            (null !== $this->getSubmit() ? ['submit' => $this->getSubmit()] : [])
        ;

        return $array;
    }
}
