<?php


namespace Rainfall\Domain\Measurements;


interface MeasurementRepository
{
    /**
     * Find all Measurements
     *
     * @return array
     */
    public function findAll(): array;

    /**
     * Finds a measurement by ID
     *
     * @param string $id
     * @return array
     */
    public function findById(string $id): array;

    /**
     * Adds Measurement
     *
     * @param Measurement $measurement
     */
    public function add(Measurement $measurement);

    /**
     * Removes Measurement
     *
     * @param Measurement $measurement
     */
    public function remove(Measurement $measurement);
}