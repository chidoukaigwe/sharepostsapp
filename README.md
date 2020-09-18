# Sharepost App

A custom PHP MVC designed Application, that enables you to:

1. Create A User
2. Create A Post 
3. View A Post
4. Edit A Post
5. Delete A Post 

---

## Docker Container (LAMP Stack)

This application is wrapped within a docker container:
1. PHP image 
2. MYSQL image
3. Apache image

## Docker Container Instructions
- `docker-composer up --build` 
-  `docker ps` - find and copy  container id
- `docker exec -it {containerid} bash`

### Create Database Tables (inside the container)

- docker-compose file contains the initial database set up. 
- change values in application config file /app/config/config.php

#### Initializing A Database

N:B - If you want to find out the database hostname (for the container) run command whilst in mysql shell: `SHOW VARIABLES WHERE Variable_name = 'hostname';`

*mysql commands to run inside shell*

1.  CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
);
2.  CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
)


---
## Version 1.0

## License
This project is licensed under the MIT License - see the [LICENSE.md](https://opensource.org/licenses/MIT) file for details
