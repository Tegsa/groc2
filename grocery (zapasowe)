-- Database: `grocery`

-- Table structure for table `admins`

CREATE TABLE `admin_users` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , 
`password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`));

-- Table data for table `admins`

INSERT INTO `admin_users` (username, password)
VALUES ('Palna','palna'),('Diya','diya'),('Kunj','kunj');

-- Table structure for table `cart`

CREATE TABLE `cart` ( `id` INT NOT NULL AUTO_INCREMENT , `cat_id` INT NOT NULL ,
 `user_id` INT NOT NULL , `product_id` INT NOT NULL , `cart_qty` FLOAT NOT NULL , PRIMARY KEY (`id`));

-- Table structure for table `cart_orders`

CREATE TABLE `cart_orders` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user_id` INT NOT NULL , 
 `c_id` VARCHAR(255) NOT NULL ,  `p_id` VARCHAR(255) NOT NULL ,  `quantity` VARCHAR(255) NOT NULL , `amount` VARCHAR(255) NOT NULL,
 `fname` VARCHAR(255) NOT NULL , `lname` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL ,
 `contact` VARCHAR(10) NOT NULL , `paymode` VARCHAR(255) NULL , `pay_status` TINYINT NOT NULL  , PRIMARY KEY (`id`));


-- Table structure for table `categories`

CREATE TABLE `categories` ( `id` INT NOT NULL AUTO_INCREMENT ,  `categories` VARCHAR(255) NOT NULL ,  
`status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;

-- Table data for table `categories`

INSERT INTO `categories` (categories,status)
VALUES ('Fruits','1'),('Veggies','1'),('Pulses','1'),('Grains and Flours','1'),('Spices','1');

-- Table structure for table `customer`

CREATE TABLE `customer` ( `Id` INT NOT NULL AUTO_INCREMENT ,  
`FirstName` VARCHAR(255) NOT NULL ,  `LastName` VARCHAR(255) NOT NULL ,  `Email` VARCHAR(255) NOT NULL ,
`Password` VARCHAR(255) NOT NULL , `Gender` VARCHAR(255) NOT NULL , `Address` VARCHAR(255) NOT NULL ,
`City` VARCHAR(255) NOT NULL , `Contact` VARCHAR(10) NOT NULL , PRIMARY KEY  (`Id`)) ;

-- Table structure for table `orders`

CREATE TABLE `orders` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(255) NOT NULL ,  
`product_id` INT NOT NULL ,  `category_id` INT NOT NULL ,  `quantity` VARCHAR(255) NOT NULL ,  `amount` FLOAT NOT NULL, 
`firstname` VARCHAR(255) NOT NULL , `lastname` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `contact` VARCHAR(10) NOT NULL ,
`paymode` VARCHAR(255)  NULL , `pay_status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;


-- Table structure for table `product`

CREATE TABLE `product` ( `id` INT NOT NULL AUTO_INCREMENT ,  `categories_id` INT NOT NULL ,  
`name` VARCHAR(255) NOT NULL ,  `mrp` FLOAT NOT NULL ,  `price` FLOAT NOT NULL , `qty` VARCHAR(255) NOT NULL ,
`image` VARCHAR(255) NOT NULL, `status` TINYINT NOT NULL ,  PRIMARY KEY  (`id`)) ;

-- Table data for table `product`

INSERT INTO `product` (categories_id,name,mrp,price,qty,image,status)
VALUES ('1','Banana','20','18','50','bananas.jpg','1'),
       ('1','Orange','40','37','50','oranges.jpg','1'),
       ('1','Watermalon','30','25','50','watermelon.jpg','1'),
       ('1','Apple','94','90','50','apple.jpg','1'),
       ('1','Kiwi','80','70','50','kiwi.jpg','1'),
       ('1','Mango','300','275','50','mango.jpg','1'),
       ('1','Pomogranate','100','95','50','pomogranate.jpg','1'),
       ('1','Strawberry','150','125','50','strawberry.jpg','1'),
       ('1','Chickoo','80','75','50','chickoo.jpg','1'),
       ('1','Guava','80','78','50','guava.jpg','1'),
       ('1','Papaya','90','80','50','papaya.jpg','1'),
       ('1','Pineapple','50','45','50','pineapple.jpg','1'),

       ('2','Carrot','40','38','50','carrot.jpg','1'),
       ('2','Brocolli','110','100','50','brocolli.jpg','1'),
       ('2','Cauliflower','86','80','50','Cauliflower.jpg','1'),
       ('2','Cucumber','40','35','50','cucumber.jpg','1'),
       ('2','Brinjal','45','40','50','brinjal.jpg','1'),
       ('2','Green Chilli','45','40','50','greenchilli.jpg','1'),
       ('2','Lady Finger','60','58','50','ladyfinger.jpg','1'),
       ('2','Onion','50','45','50','onion.jpg','1'),
       ('2','Potato','20','16','50','potatoes.jpg','1'),
       ('2','Tomato','40','35','50','tomatoes.jpg','1'),
       ('2','Beet Root','40','38','50','beetroot.jpg','1'),
       ('2','Peas','65','60','50','peas.jpg','1'),

       ('3','Green Grams(Moong)','100','90','80','moong.jpg','1'),
       ('3','Black Eyed Beans(Chawli)','120','115','80','chawli.jpg','1'),
       ('3','Red Lentis(Masoor)','80','78','80','masoor.jpg','1'),
       ('3','Yellow Pigeon Peas(Toovar Dal)','130','125','80','toordal.jpg','1'),
       ('3','Turkish Gram Beans(Moth)','110','105','80','moth.jpg','1'),
       ('3','Red Kidney Beans(Rajma)','120','119','80','rajma.jpg','1'),
       ('3','Black Gram Beans(Udad)','122','120','80','udad.jpg','1'),
       
       ('4','Rice','150','145','50','rice.jpg','1'),
       ('4','Wheat','25','23','50','wheat_(1).jpg','1'),
       ('4','Corn Flour','50','48','50','cornfloor.jpg','1'),
       ('4','Barley','155','150','50','barley.jpg','1'),
       ('4','Vermicelli','85','80','50','vermicelli.jpg','1'),
       ('4','Semolina(Sooji)','50','48','50','semolina.jpg','1'),
       ('4','Maida','50','45','50','maida.jpg','1'),

       ('5','Black Pepper','1000','900','50','blackpepper.jpg','1'),
       ('5','Cumin','25','180','180','cumin.jpg','1'),
       ('5','Bay Leaf','100','90','50','bayleaf.jpg','1'),
       ('5','Cinnamon','1000','1000','50','cinnamon.jpg','1'),
       ('5','Cloves','1200','1990','50','cloves.jpg','1'),
       ('5','Elaichi','6050','6000','30','elaichi.jpg','1'),
       ('5','Star Anise','200','190','50','anise.jpg','1'),
       ('5','Saffron','20050','20000','30','saffron.jpg','1');
     
       


