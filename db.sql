
CREATE database log_db;

    USE log_db;

CREATE TABLE user_student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE logbook_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_date DATE NOT NULL,
    entry_time TIME NOT NULL,
    days VARCHAR(50) NOT NULL,
    week INT NOT NULL,
    activity_description TEXT NOT NULL,
    working_hours DECIMAL(4,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE logbook_entries ADD user_id INT NOT NULL;
