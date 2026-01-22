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