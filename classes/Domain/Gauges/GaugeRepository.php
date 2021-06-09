<?php


namespace Rainfall\Domain\Gauges;


interface GaugeRepository
{
    /**
     * Finds all Gauges
     *
     * @return Gauge[]
     */
    public function findAll(): array;

    /**
     * Finds specific Gauge
     *
     * @param string $id
     * @return Gauge
     */
    public function findById(string $id): Gauge;

    /**
     * @param Gauge $gauge
     */
    public function add(Gauge $gauge);

    /**
     * @param Gauge $gauge
     */
    public function remove(Gauge $gauge);
}