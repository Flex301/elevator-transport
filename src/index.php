<?php

// Add our app files path to include paths
set_include_path(get_include_path() . PATH_SEPARATOR . ".");

// Use default autoload implementation
spl_autoload_register();

// Init the elevator transport and original elevator position on 5th floor
$transport = new ElevatorTransport(5);
$transport->gotoFloor(10);

// Call elevator on my floor and watining when it is arrive
$transport->callElevator(1);

while ($transport->elevatorIsBusy()) {
  echo "Elevator is arriving...\n";
  sleep(1);
}

// Now change the destination I'm going to
$transport->gotoFloor(3);

echo "Going to to your floor...\n";

// Waiting when it is arrive on my destination floor
while ($transport->elevatorIsBusy()) {
  echo "Not arrived on your floor yet! Waiting...\n";
  sleep(1);
}

// Go out from the elevator
$transport->getOut();

echo "Trip ended! Have a good day!";

