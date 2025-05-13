# managerone


## Lauch app
```
docker compose up --build -d 
```

## Intialization Database
```
docker ps 
```

```
cat init.sql | docker exec -i 2fcf sqlite3 /var/www/html/data/database.sqlite
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite ".schema tasks"
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite ".schema users"
docker exec -it 2fcf sqlite3 /var/www/html/data/database.sqlite "SELECT * FROM users;"
docker exec -it 2fcf /bin/bash

```

