<?php

namespace Kreemer\UX\AutoCompleteJS\Model;

class DataModel implements \JsonSerializable
{
    /**
     * @var array<mixed>|null
     */
    private ?array $src = null;

    /**
     * @var array<mixed>|null
     */
    private ?array $keys = null;
    private ?bool $cache = null;

    /**
     * @return mixed[]|null
     */
    public function getSrc(): ?array
    {
        return $this->src;
    }

    /**
     * @param array<mixed>|null $src
     *
     * @return $this
     */
    public function setSrc(?array $src): self
    {
        $this->src = $src;

        return $this;
    }

    /**
     * @return mixed[]|null
     */
    public function getKeys(): ?array
    {
        return $this->keys;
    }

    /**
     * @param array<mixed>|null $keys
     *
     * @return $this
     */
    public function setKeys(?array $keys): self
    {
        $this->keys = $keys;

        return $this;
    }

    public function getCache(): ?bool
    {
        return $this->cache;
    }

    /**
     * @return DataModel
     */
    public function setCache(?bool $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return (null !== $this->getSrc() ? ['src' => $this->getSrc()] : []) +
            (null !== $this->getKeys() ? ['keys' => $this->getKeys()] : []) +
            (null !== $this->getCache() ? ['cache' => $this->getCache()] : []);
    }
}
