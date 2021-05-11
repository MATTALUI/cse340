INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comments)
VALUES("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

UPDATE clients
SET clientLevel = 3 -- 3 Explicitly requested in assignment AC
WHERE clientEmail = "tony@starkent.com";

UPDATE inventory
SET invDescription = REPLACE(invDescription, "small", "spacious")
WHERE invMake = "GM"
AND invModel = "Hummer";

SELECT inventory.invModel
, carclassification.classificationName
FROM inventory
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = "SUV";

DELETE FROM inventory
WHERE invMake = "Jeep"
AND invModel = "Wrangler";

UPDATE inventory
SET invImage = CONCAT("/phpmotors", invImage)
, invThumbnail = CONCAT("/phpmotors", invThumbnail);
