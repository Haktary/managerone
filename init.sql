CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT
);

CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    title TEXT,
    description TEXT,
    creation_date TEXT,
    status TEXT,
    FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO users (name, email) VALUES ('Simon', 'Simon.bignolles@gmail.com');
INSERT INTO users (name, email) VALUES ('Marc', 'vialatte.marc@gmail.com');


