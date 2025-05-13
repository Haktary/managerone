# managerone

## Launch the App

```bash
docker compose up --build -d
```

## Initialize the Database

```bash
docker ps
```

Get the container ID (e.g., `2fcf`) and run:

```bash
cat init.sql | docker exec -i 2fcf sqlite3 /var/www/html/data/database.sqlite

# Just for Testing !
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite ".schema tasks"
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite ".schema users"
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite "SELECT * FROM users;"
docker exec -it 2fcf /bin/bash
```

## Issue

If you encounter a write permission issue with the database despite having it configured in the Dockerfile, follow these steps:

```bash
docker exec -it 2fcf /bin/bash
chmod 666 /var/www/html/data
chmod 666 /var/www/html/data/database.sqlite
```

---

