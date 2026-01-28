CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_order INT NOT NULL UNIQUE,
    room_name VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL
);

CREATE TABLE player_rooms (
    player_id INT NOT NULL,
    room_id INT NOT NULL,
    completed TINYINT(1) DEFAULT 0,

    PRIMARY KEY (player_id, room_id),

    FOREIGN KEY (player_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    item_key VARCHAR(50) NOT NULL,
    item_name VARCHAR(100),
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

CREATE TABLE player_items (
    player_id INT NOT NULL,
    room_id INT NOT NULL,
    item_id INT NOT NULL,
    collected TINYINT(1) DEFAULT 0,
    used TINYINT(1) DEFAULT 0,

    PRIMARY KEY (player_id, item_id),

    FOREIGN KEY (player_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELEtE CASCADE,
    FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE
);

CREATE TABLE item_info (
    item_id INT PRIMARY KEY,
    item_name VARCHAR(100),
    item_image VARCHAR(255),
    item_desc TEXT
);

CREATE TABLE coop_rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_code VARCHAR(10) NOT NULL UNIQUE,
    creator_id INT NOT NULL,
    started TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE coop_room_users (
    room_id INT NOT NULL,
    user_id INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (room_id, user_id),
    FOREIGN KEY (room_id) REFERENCES coop_rooms(id) ON DELETE CASCADE
);

ALTER TABLE coop_rooms
ADD COLUMN status ENUM('waiting', 'started', 'closed')
DEFAULT 'waiting';

ALTER TABLE coop_rooms
ADD COLUMN started_at DATETIME NULL;

INSERT INTO `items`(`room_id`, `item_key`, `item_name`) 
            VALUES ('1','test_item','Item for testing')


INSERT INTO `item_info`(`item_id`, `item_name`, `item_image`, `item_desc`) 
                VALUES ('1','Item tester','assets/triangle.png', 'A testing object')


INSERT INTO `items`(`room_id`, `item_key`, `item_name`) 
            VALUES ('1','test_item','Item for testing')


INSERT INTO `player_rooms`(`player_id`, `room_id`, `completed`) 
                   VALUES ('2','1','0')


INSERT INTO `rooms`(`room_order`, `room_name`, `file_path`) 
            VALUES ('1','Tutorial Room','rooms/room_one/room_one.php')


