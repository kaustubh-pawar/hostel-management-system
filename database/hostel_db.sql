CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    prn VARCHAR(20),
    contact VARCHAR(15),
    course VARCHAR(50)
);

CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10),
    capacity INT,
    occupied INT DEFAULT 0
);

CREATE TABLE fees (
    fee_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    amount INT,
    status VARCHAR(10),
    date DATE,
    FOREIGN KEY (student_id) REFERENCES students(id)
);
CREATE TABLE allocations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    room_id INT,
    date DATE
);