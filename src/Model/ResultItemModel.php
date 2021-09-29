<?php

namespace Kreemer\UX\AutoCompleteJS\Model;

class ResultItemModel implements \JsonSerializable
{
    private ?string $tag = null;
    private ?string $id = null;
    private ?string $class = null;
    private ?string $highlight = null;
    private ?string $selected = null;

    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @return ResultItemModel
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
     * @return ResultItemModel
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
     * @return ResultItemModel
     */
    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getHighlight(): ?string
    {
        return $this->highlight;
    }

    /**
     * @return ResultItemModel
     */
    public function setHighlight(?string $highlight): self
    {
        $this->highlight = $highlight;

        return $this;
    }

    public function getSelected(): ?string
    {
        return $this->selected;
    }

    /**
     * @return ResultItemModel
     */
    public function setSelected(?string $selected): self
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<mixed>
     */
    public function jsonSerialize()
    {
        return (null !== $this->getTag() ? ['tag' => $this->getTag()] : []) +
            (null !== $this->getId() ? ['id' => $this->getId()] : []) +
            (null !== $this->getClass() ? ['class' => $this->getClass()] : []) +
            (null !== $this->getHighlight() ? ['highlight' => $this->getHighlight()] : []) +
            (null !== $this->getSelected() ? ['selected' => $this->getSelected()] : []);
    }
}
