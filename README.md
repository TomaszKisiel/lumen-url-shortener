# Lumen URL Shortener

Lumen based URL Shortener for your own use. Deploy repositery on your server, set environment configs, migrate database and shorten your links.

## Quickstart

Clone this repository on your server.

```
git clone https://github.com/TomaszKisiel/lumen-url-shortener
```

Migrate database.

```
php artisan migrate
```

Duplicate ```.env.example``` and change their name to ```.env```. Set this file depend on your server settings.
Remember to add ```APP_KEY``` which is basically 32 chars length random string.

Compile styles and scripts for production.
```
npx mix --production
```

## Authentication

If you want to use this software under your own domain and protect dashboard from undesirable use you can set this lines in environment config.

```
APP_PROTECTION=true
APP_PASSWORD="your_password"
```

After this only users authenticated by this password will be able to use your app.

You can also create multiple password by separating them with comma.

```
APP_PASSWORD="password_1","password_2"
```

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
