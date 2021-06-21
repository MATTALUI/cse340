<?php
  function vehicleDisplayName($vehicle) {
    return $vehicle['invMake'].' '.$vehicle['invModel'];
  }

  function vehiclePrice($vehicle) {
    return '$'.number_format($vehicle['invPrice'], 2);
  }
?>