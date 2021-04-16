<?php

class ElevatorTransport {

  private Elevator $elevator;
  private int $maxFloor = 10;
  private int $minFloor = 1;

  public function __construct(int $initialFloor) {

    if ($initialFloor > $this->maxFloor || $initialFloor < $this->minFloor) {
      throw new \Exception("Initial floor is not valid, max floor is {$this->maxFloor}, min floor is {$this->minFloor}");
    }

    $this->elevator = new Elevator($initialFloor);
  }

  public function callElevator($floorCalled) {

    if ($floorCalled > $this->maxFloor || $floorCalled < $this->minFloor) {
      throw new \Exception("Elevator cannot be called on {$floorCalled} floor, max floor is {$this->maxFloor}, min floor is {$this->minFloor}");
    }

    $this->elevator->addDestination($floorCalled);
  }

  public function elevatorIsBusy() {
    $available = $this->elevator->checkAvailability();
    return !$available;
  }

  public function gotoFloor($floor) {

    if ($this->elevator->isBusy()) {
      throw new \Exception("Elevator is busy");
    }

    if ($floor > $this->maxFloor || $floor < $this->minFloor) {
      throw new \Exception("Elevator cannot go on {$floor} floor, max floor is {$this->maxFloor}, min floor is {$this->minFloor}");
    }

    $this->elevator->freeUp();
    $this->elevator->addDestination($floor);
    $this->elevator->start();
  }

  public function getOut() {
    if ($this->elevatorIsBusy()) {
      throw new \Exception("Cannot get out, elevator must stop first");
    }

    $this->elevator->freeUp();
  }
}