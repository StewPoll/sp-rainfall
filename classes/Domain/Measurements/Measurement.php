<?php


namespace Rainfall\Domain\Measurements;


use Ramsey\Uuid\Uuid;

class Measurement
{
    private string $id;
    private string $gaugeId;
    private int $value;
    private string $notes;
    private \DateTime $measuredAt;

    /**
     * Measurement constructor.
     * @param string $id
     * @param string $gaugeId
     * @param int $value
     * @param string $notes
     * @param \DateTime $measuredAt
     */
    private function __construct(string $id, string $gaugeId, int $value, string $notes, \DateTime $measuredAt)
    {
        $this->id = $id;
        $this->gaugeId = $gaugeId;
        $this->value = $value;
        $this->notes = $notes;
        $this->measuredAt = $measuredAt;
    }

    /**
     * @param string $id
     * @param string $gaugeId
     * @param int $value
     * @param string $notes
     * @param \DateTime $measuredAt
     * @return $this
     */
    public function restore(string $id, string $gaugeId, int $value, string $notes, \DateTime $measuredAt): Measurement
    {
        return new static(
            $id,
            $gaugeId,
            $value,
            $notes,
            $measuredAt
        );
    }

    /**
     * @param string $gaugeId
     * @param int $value
     * @param string $notes
     * @param \DateTime $measuredAt
     * @return $this
     */
    public function createWith(string $gaugeId, int $value, string $notes, \DateTime $measuredAt): Measurement
    {
        $id = Uuid::uuid4()->toString();
        return new static(
            $id,
            $gaugeId,
            $value,
            $notes,
            $measuredAt
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
    public function getGaugeId(): string
    {
        return $this->gaugeId;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return \DateTime
     */
    public function getMeasuredAt(): \DateTime
    {
        return $this->measuredAt;
    }
}