CREATE TABLE posts(
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    author VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);