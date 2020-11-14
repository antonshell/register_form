# Register Form

There is a simple register form application built with Symfony and Vue JS.

![demo](/public/demo.png)

# Install

1 . Clone repository

```
git clone https://github.com/antonshell/register_form.git
```

2 . Install dependencies

```
composer install
npm install
```

3 . Create database, apply migrations

```
CREATE DATABASE register_form CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'register_form'@'localhost' IDENTIFIED BY 'register_form';
GRANT ALL PRIVILEGES ON register_form.* TO 'register_form'@'localhost';
```

5 . Apply database migrations

```
php bin/console doctrine:migrations:migrate
```

6 . Rebuild Vue JS App(if needed)

```
weebpack
```

# Usage

1 . Run server

```
cd public
php -S 127.0.0.1:8000
```

2 . Open in browser

```
http://127.0.0.1:8000/
```