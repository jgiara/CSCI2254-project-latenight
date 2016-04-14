create table Users (
	Eagle_Id int(11) not null auto_increment primary key,
        First_Name varchar(50) not null,
        Last_Name varchar(50) not null, 
        Address varchar(100),
        Phone varchar(12) not null, 
        Email varchar(30) not null,
        Type varchar(20) not null check(Type in ('User', 'Delivery Person', 'Admin')),
        Communication_Preference varchar(15)
);

create table Reviews (
	Id int(11) not null auto_increment primary key,
        Stars varchar(5) not null check(Stars in ('*', '**', '***', '****', '*****')),
        Submitted date not null, 
        Comments text
);

create table Orders (
	Id int(11) not null auto_increment primary key,
        Requested_By int(11) not null references Users(Eagle_Id),
        Fulfilled_By int(11) references Users(Eagle_Id),
        Time_Submitted datetime not null,
        Time_Fulfilled datetime,
        Delivery_Location varchar(100) not null,
        Payment_Method varchar(25) not null check(Payment_Method in('Meal Plan', 'Cash')),
        Stage varchar(15) not null check(Stage in('Pending', 'Progress', 'Out For Delivery', 'Delivered', 'Cancelled')),
        Comments text,
        Delivery_Charge float(3,2),
        Total_Price float(3,2)
);

create table Items (
	Id int(11) not null auto_increment primary key,
        Name varchar(20) not null,
        Price float(3,2) not null, 
        Availability varchar(20) not null check(Availability in ('Mac', 'Lower', 'Stuart'))
);
        

create table Order_Items (
	Id int(11) not null auto_increment primary key,
        Order_Id int(11) not null references Orders(Id),
        Item_Id int(11) not null references Items(Id)
);
        