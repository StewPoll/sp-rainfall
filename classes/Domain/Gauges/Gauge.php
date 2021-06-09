<?php


namespace Rainfall\Domain\Gauges;


use Ramsey\Uuid\Uuid;

class Gauge
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $userId;

    /**
     * @var string
     */
    private string $units;

    /**
     * @var int
     */
    private int $max;

    /**
     * @var string
     */
    private string $notes;

    /**
     * @var string
     */
    private string $name;

    /**
     * Gauge constructor.
     * @param string $id
     * @param string $userId
     * @param string $name
     * @param string $units
     * @param int $max
     * @param string $notes
     */
    private function __construct(string $id, string $userId, string $name, string $units, int $max, string $notes)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->units = $units;
        $this->max = $max;
        $this->notes = $notes;
    }

    /**
     * @param string $id
     * @param string $userId
     * @param string $name
     * @param string $units
     * @param int $max
     * @param string $notes
     * @return $this
     */
    public function restore(string $id, string $userId, string $name, string $units, int $max, string $notes): Gauge
    {
        return new static(
            $id,
            $userId,
            $name,
            $units,
            $max,
            $notes
        );
    }

    /**
     * @param string $userId
     * @param string $name
     * @param string $units
     * @param int $max
     * @param string $notes
     * @return $this
     */
    public function createWith(string $userId, string $name, string $units, int $max, string $notes): Gauge
    {
        if (!in_array($units, ['i', 'm'])) {
            throw new \InvalidArgumentException('Units must be Imperial (i) or Metric (m)');
        }

        $id = Uuid::uuid4()->toString();

        return new static(
            $id,
            $userId,
            $name,
            $units,
            $max,
            $notes
        );
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUnits(): string
    {
        return $this->units;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @param int $max
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * @param string $units
     */
    public function setUnits(string $units): void
    {
        if (!in_array($units, ['i', 'm'])) {
            throw new \InvalidArgumentException('Units must be Imperial (i) or Metric (m)');
        }
        $this->units = $units;
    }
}