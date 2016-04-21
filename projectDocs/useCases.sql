#Separate Files on Github for UI Markup

1.
Register a user/deliverer
Actor: User/Deliverer
Precondition: User/Deliverer is not registered
Postcondition: User/Deliverer is registered
Queries: 
INSERT INTO Users(`First_Name`, `Last_Name`, `Address`, `Phone`, `Email`, 'Password', `Type`, `Communication_Preference`)
VALUES ('$first','$last','$address','$phone','$email', sha1($password),'$type','$pref');

2.
Place an order
Actor: User
Precondition: User must be logged in
Postcondition: Order added to orders table, deliverers can view
Queries:
INSERT INTO Orders(`Requested_By`, `Time_Submitted`, `Delivery_Location`, `Payment_Method`, `Stage`, `Comments`, `Delivery_Charge`, `Total_Price`)
VALUES ('$currUser',NOW(),'$address','$payment','pending','$comments','$charge', '$price');
INSERT INTO Order_Items('Order_Id', 'Item_Id')
VALUES ('$orderId', '$itemId'); #User will select appropiate item and back-end will store ids of selected items

3.
Accept a delivery
Actor: Deliverer
Precondition: Deliverer must be logged in and order pending
Postcondition: Stage field has been moved to 'In Progress'.
Queries:
UPDATE Orders 
SET Stage = `In Progress`
WHERE Id = '$_POST['$button']' #button post val is loaded with order id;

4.
Write a review
Actor: User
Precondition: User must be logged in and order is completed
Postcondition: Order is reviewed, deliverer rank adjusts
Queries:
INSERT INTO Reviews(`Delivery_Person`, `Stars`, `Submitted`, `Comments`)
VALUES ('$delivPers','$stars',NOW(),'$comments');

5.
View order history
Actor: User
Precondition: User must be logged in 
Postcondition: User has viewed past orders
Queries:
SELECT *
FROM Reviews
WHERE Requested_By='$user_id';