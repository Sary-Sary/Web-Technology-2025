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
    item_id INT NOT NULL,
    discovered TINYINT(1) DEFAULT 0,
    used TINYINT(1), DEFAULT 0,

    PRIMARY KEY (player_id, item_id),

    FOREIGN KEY (player_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE
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