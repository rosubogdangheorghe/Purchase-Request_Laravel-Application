use purchaseflow;

SELECT purchaseheaders.*, CONCAT(costcenters.code," ",costcenters.description) as Costcenter, CONCAT(suppliers.code," ",suppliers.description) as Supplier 
FROM purchaseheaders
JOIN costcenters ON purchaseheaders.costcenters_id = costcenters.id
JOIN suppliers ON purchaseheaders.suppliers_id = suppliers.id;


SELECT purchasebodies.id,purchasebodies.purchaseheaders_id,purchasebodies.description,purchasebodies.unitMeasure,purchasebodies.quantity,purchasebodies.unitPrice,
       purchasebodies.prvalue,purchasebodies.budgeted,purchasebodies.budgetLine,
		
	  purchaseheaders.issueDate,purchaseheaders.deliveryDate,purchaseheaders.costcenters_id,purchaseheaders.suppliers_id,
      purchaseheaders.currency,purchaseheaders.status, 
  CONCAT(costcenters.code," ",costcenters.description) as Costcenter, CONCAT(suppliers.code," ",suppliers.description) as Supplier,
   users.username as user
FROM purchasebodies JOIN purchaseheaders 
JOIN costcenters ON purchaseheaders.costcenters_id = costcenters.id
JOIN suppliers ON purchaseheaders.suppliers_id = suppliers.id 
 JOIN users ON  purchaseheaders.users_id = users.id
on purchasebodies.purchaseheaders_id = purchaseheaders.id  WHERE purchaseheaders_id =5;

SELECT * from purchase_requisition;

	SELECT purchasebodies.purchaseheaders_id,purchasebodies.description,purchaseheaders.issueDate,purchaseheaders.status,users.username as user
    FROM purchasebodies JOIN purchaseheaders
     JOIN users ON  purchaseheaders.users_id = users.id
	on purchasebodies.purchaseheaders_id = purchaseheaders.id;
    
    -- Create View email_data--
    
    CREATE  OR REPLACE VIEW `email_data` AS
SELECT purchasebodies.purchaseheaders_id,purchasebodies.description,purchaseheaders.issueDate,purchaseheaders.status,users.username as user
    FROM purchasebodies JOIN purchaseheaders
     JOIN users ON  purchaseheaders.users_id = users.id
	on purchasebodies.purchaseheaders_id = purchaseheaders.id;