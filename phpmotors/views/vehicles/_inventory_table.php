<table id="inventoryDisplay">
  <thead>
    <tr>
      <th>Vehicle Name</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      if  (isset($inventory)) {
        buildInventoryTableDataRows($inventory);
      }
    ?>
  </tbody>
</table>