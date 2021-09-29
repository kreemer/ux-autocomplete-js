<?php

namespace Kreemer\UX\AutoCompleteJS\Model;

class ResultListModel implements \JsonSerializable
{
    private ?string $tag = null;
    private ?string $id = null;
    private ?string $class = null;
    private ?string $destination = null;
    private ?string $position = null;
    private ?int $maxResults = null;
    private ?bool $tabSelect = null;
    private ?bool $noResults = null;

    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return ResultListModel
     */
    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return ResultListModel
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return ResultListModel
     */
    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @return ResultListModel
     */
    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @return ResultListModel
     */
    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    /**
     * @return ResultListModel
     */
    public function setMaxResults(?int $maxResults): self
    {
        $this->maxResults = $maxResults;

        return $this;
    }

    public function getTabSelect(): ?bool
    {
        return $this->tabSelect;
    }

    /**
     * @return ResultListModel
     */
    public function setTabSelect(?bool $tabSelect): self
    {
        $this->tabSelect = $tabSelect;

        return $this;
    }

    public function getNoResults(): ?bool
    {
        return $this->noResults;
    }

    /**
     * @return ResultListModel
     */
    public function setNoResults(?bool $noResults): self
    {
        $this->noResults = $noResults;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return (null !== $this->getTag() ? ['tag' => $this->getTag()] : []) +
            (null !== $this->getId() ? ['id' => $this->getId()] : []) +
            (null !== $this->getClass() ? ['class' => $this->getClass()] : []) +
            (null !== $this->getDestination() ? ['destination' => $this->getDestination()] : []) +
            (null !== $this->getPosition() ? ['position' => $this->getPosition()] : []) +
            (null !== $this->getMaxResults() ? ['maxResults' => $this->getMaxResults()] : []) +
            (null !== $this->getTabSelect() ? ['tabSelect' => $this->getTabSelect()] : []) +
            (null !== $this->getNoResults() ? ['noResults' => $this->getNoResults()] : [])
            ;
    }
}
