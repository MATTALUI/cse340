(() => {
  const classificationList = document.querySelector("#classification"); 
  const buildInventoryList = (inventoryData) => {
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    inventoryData.forEach(vehicle => { 
      dataTable += `<tr><td>${vehicle.invMake} ${vehicle.invModel}</td>`; 
      dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${vehicle.invId}' title='Click to modify'>Modify</a></td>`; 
      dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${vehicle.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    });
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
  }

  classificationList.addEventListener("change", () => { 
    const classificationId = classificationList.value;
    fetch(`/phpmotors/vehicles/index.php?action=ajaxGetInventoryItems&classificationId=${classificationId}`) 
      .then(response => response.json()) 
      .then(buildInventoryList) 
      .catch(console.error);
  });
})();