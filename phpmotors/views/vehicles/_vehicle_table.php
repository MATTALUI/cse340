<table>
  <thead>
    <tr>
      <th colspan="2">Details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>Make</th>
      <td><?php echo $vehicle['invMake']; ?></td>
    </tr>
    <tr>
      <th>Model</th>
      <td><?php echo $vehicle['invModel']; ?></td>
    </tr>
    <tr>
      <th>Price</th>
      <td><?php echo vehiclePrice($vehicle); ?></td>
    </tr>
    <tr>
      <th>Color</th>
      <td><?php echo $vehicle['invColor']; ?></td>
    </tr>
    <tr>
      <th>Classification</th>
      <td><?php echo $classification['classificationName']; ?></td>
    </tr>
    <tr>
      <th>Stock</th>
      <td><?php echo $vehicle['invStock']; ?></td>
    </tr>
  </tbody>
</table>