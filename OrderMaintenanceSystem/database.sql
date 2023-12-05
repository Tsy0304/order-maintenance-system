CREATE TABLE `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `staffID`  varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `outlets` varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

CREATE TABLE `outlets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `outletsID`  varchar(255) NOT NULL,
  `outlets`  varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 


CREATE TABLE `order_list` (
    `orderID` int NOT NULL AUTO_INCREMENT,
    `staffID` varchar(255) NOT NULL,
    `staffname` varchar(255) NOT NULL,
    `outlets` varchar(255) NOT NULL,
    `deliveryrecipient` varchar(255) NOT NULL,
    `products` JSON,
    `orderTotal` DECIMAL(7,2),
    `orderDate` DATE,
    `deliveryStreet` VARCHAR(100),
    `deliveryCity` VARCHAR(20),
    `deliveryState` VARCHAR(20),
    `deliveryPostcode` INT(5),
    `deliveryDate` DATE,
    `billingrecipient` varchar(255) NOT NULL,
    `billingStreet` VARCHAR(80),
    `billingCity` VARCHAR(20),
    `billingState` VARCHAR(20),
    `billingPostcode` INT(5),
    `paymentMethod` VARCHAR(15), 
    PRIMARY KEY (orderID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 


INSERT INTO `staff` (`id`,`staffID`, `name`,`department`,`email`,`phonenumber`,`password`,`outlets`) VALUES
(1,'AD0001','Mary','Admin','mary@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(2,'WR0002','Holly','Warehouses','holly@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(3,'WR0003','Linda','Warehouses','linda@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(4,'WR0004','Jeff','Warehouses','jeff@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor'),
(5,'WR0005','Jack','Warehouse','jack@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Kuala Lumpur'),
(6,'SA0001','Gordon','Sales','gordon@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(7,'SA0002','Amy','Sales','amy@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Kuala Lumpur'),
(8,'SA0003','Christy','Sales','christy@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor'),
(9,'SA0004','Mandy','Sales','mandy@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor'),
(10,'SA0005','Max','Sales','max@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(11,'OT0001','Jenny','Outlets','jenny@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Kuala Lumpur'),
(12,'OT0002','John','Outlets','john@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Seremban'),
(13,'OT0003','Rose','Outlets','rose@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor'),
(14,'OT0004','Jay','Outlets','jay@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor'),
(15,'OT0005','Chris','Outlets','chris@gmail.com','+60123456789','f8bef013ff201159001295fd41cf0e50','Selangor');

CREATE TABLE `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bookID`  varchar(255) NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `laststockin` DATE,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `book` (`id`,`bookID`, `bookname`,`description`,`quantity`,`cost`,`price`,`laststockin`) VALUES
(1,'HP001','Harry Potter and the Sorcerers Stone','Harry Potter has never been the star of a Quidditch team, scoring points while riding a broom far above the ground.','8','20','50','2023-8-25'),
(2,'HP002','Harry Potter and the Chamber of Secrets','Ever since Harry Potter had come home for the summer, the Dursleys had been so mean and hideous that all Harry wanted was to get back to the Hogwarts School of Witchcraft and Wizardry. ','23','20','50','2023-8-28'),
(3,'HP003','Harry Potter and the Prisoner of Azkaban','Harry Potter is lucky to reach the age of thirteen, since he has already survived the murderous attacks of the feared Dark Lord on more than one occasion. ','34','20','50','2023-7-25'),
(4,'HP004','Harry Potter and the Goblet of Fire','Harry Potter is in his fourth year at Hogwarts. Harry wants to get away from the pernicious Dursleys and go to the Quidditch World Cup with Hermione, Ron, and the Weasleys.','5','20','50','2023-8-12'),
(5,'HP005','Harry Potter and the Order of the Phoenix','Harry is in his fifth year at Hogwarts School as the adventures continue. There is a door at the end of a silent corridor. ','65','20','50','2023-8-27'),
(6,'HP006','Harry Potter and the Half Blood Prince','It is Harry Potters sixth year at Hogwarts School of Witchcraft and Wizardry.','67','20','50','2023-4-23'),
(7,'HP007','Harry Potter and the Deathly Hallows','Harry is waiting in Privet Drive. The Order of the Phoenix is coming to escort him safely away without Voldemort and his supporters knowing - if they can.','34','20','50','2023-5-24'),
(8,'GB001','Grumpy Bird','This book is about a bird who refuses to indulge in any activity. The book ensures that everyone must carry a smile on their face after a read-out-loud session.','23','20','50','2023-4-30'),
(9,'HD001','Hickory Dickory Dock','An engaging and entertaining book based on the famous nursery rhyme that perks the youngsters up.','3','20','50', '2023-8-8'),
(10,'KB001','Knuffle Bunny','This book is about how a little child named Trixie loses her Knuffle Bunny on a trip to Laundromat with her dad.','7','20','50','2023-8-9');

INSERT INTO `outlets` (`id`,`outletsID`,`outlets`, `street`,`city`,`state`,`postcode`) VALUES
(1,'O001','Seremban','1/Jalan Seremban','Seremban','Seremban','81300'),
(2,'O002','Selangor','1/Jalan Selangor','Petaling Jaya','Selangor','47500'),
(3,'O003','Kuala Lumpur','2/Jalan KL','Kuala Lumpur','Selangor','51300');
