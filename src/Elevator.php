<?php

class Elevator {

  private int $floor;
  private bool $busy = false;
  private array $destinations = [];
  private int $startTime;

  // How many seconds takes to pass one floor
  private $speed = 0.8;

  public function __construct(int $floor) {
    $this->floor = $floor;
  }

  public function isBusy() {
    return $this->busy;
  }

  public function getDestintions() {
    return $this->destinations;
  }

  public function addDestination($floor) {
    $this->destinations[] = $floor;
  }

  public function checkAvailability() {

    if (empty($this->destinations)) {
      return true;
    }

    $allFloors = array_merge([$this->floor], $this->destinations);

    $offset = 0;
    $tripTime = time() - $this->startTime;
    $floorsPassed = floor($tripTime / $this->speed);
    $tripLength = 0;

    while (count($slice = array_slice($allFloors, $offset, 2)) == 2) {
      $tripLength += abs($slice[0] - $slice[1]);
      $offset++;
    }

    if ($floorsPassed >= $tripLength) {
      $this->floor = array_slice($this->destinations, -1, 1)[0];
      $this->destinations = [];
      $this->freeUp();
      return true;
    }

    return false;
  }

  public function start() {

    if (empty($this->destinations)) {
      throw new \Exception("Cannot start a trip without destination");
    }

    $this->busy = true;
    $this->startTime = time();
  }

  public function freeUp() {
    $this->busy = false;
  }
}