    CREATE TABLE route (
        id int AUTO_INCREMENT, 
        distance decimal DEFAULT 0,
        location1 varchar(255) NOT NULL,
        lat1 decimal NOT NULL,
        long1 decimal NOT NULL,
        location2 varchar(255) NOT NULL,
        lat2 decimal NOT NULL,
        long2 decimal NOT NULL,
        PRIMARY KEY (id)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE ship (
        id varchar(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        speed_class int NOT NULL,
        price decimal,
        eta decimal DEFAULT 0,
        route_id int,
        PRIMARY KEY (id),
        FOREIGN KEY (route_id) REFERENCES `route` (id)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    CREATE TABLE crew (
        id varchar(11) NOT NULL,
        `fname` varchar(255) NOT NULL,
        `lname` varchar(255) NOT NULL,
        bdate date NOT NULL,
        sex char NOT NULL,
        `address` varchar(255) NOT NULL,
        contact_no varchar(13) NOT NULL,
        email varchar(255) NOT NULL,
        `rank` int NOT NULL,
        ship_id varchar(11),
        PRIMARY KEY (id),
        FOREIGN KEY (ship_id) REFERENCES `ship` (id)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;