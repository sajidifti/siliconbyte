Evaluate if there is any problem in the following SQL:
-- Create Users table
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'writer', 'reader'),
    profile_photo VARCHAR(255)
);

-- Create Articles table
CREATE TABLE Articles (
    article_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    slug VARCHAR(255) UNIQUE,
    content TEXT,
    article_photo VARCHAR(255),
    datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category ENUM('smartphone', 'pc', 'software', 'tutorial', 'programing', 'gaming'),
    views INT DEFAULT 0,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);


-- Create Tags table
CREATE TABLE Tags (
    tag_id INT PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(255) UNIQUE
);

-- Create Article_Tags table (Many-to-Many)
CREATE TABLE Article_Tags (
    article_id INT,
    tag_id INT,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES Articles(article_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id)
);

-- Create User_Category_Read_Count table
CREATE TABLE User_Category_Read_Count (
    user_id INT,
    category ENUM('smartphone', 'pc', 'software', 'tutorial', 'programing', 'gaming'),
    read_count INT DEFAULT 0,
    PRIMARY KEY (user_id, category),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create User_Tag_Read_Count table
CREATE TABLE User_Tag_Read_Count (
    user_id INT,
    tag_id INT,
    read_count INT DEFAULT 0,
    PRIMARY KEY (user_id, tag_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (tag_id) REFERENCES Tags(tag_id)
);