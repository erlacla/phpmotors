--Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) 
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman')
 
 --Query 2
UPDATE clients 
SET clientLevel = 3 
WHERE clientEmail = 'tony@starkent.com';

--Query 3
UPDATE inventory 
SET invDescription = 'Do you have 6 kids and like to go off-roading? The Hummer gives you a spacious interior with an engine to get you out of any muddy or rocky situation.' 
WHERE invModel = 'Hummer';

--Query 4
SELECT inventory.invModel, carclassification.classificationName
FROM carclassification
INNER JOIN inventory 
ON carclassification.classificationId = inventory.classificationId
WHERE inventory.classificationId = '1'

--Query 5
DELETE FROM inventory 
WHERE invModel = 'Wrangler'

--Query 6
UPDATE phpmotors.inventory
SET invImage = (CONCAT('/phpmotors', invImage)), invThumbnail = (CONCAT('/phpmotors', invThumbnail))