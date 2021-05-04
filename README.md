# :link: Lumen URL Shortener

Lumen based URL Shortener for your own use. Deploy repositery on your server, set environment configs, migrate database and shorten your links.

## :rabbit: Quickstart

Clone this repository on your server.

```
git clone https://github.com/TomaszKisiel/lumen-url-shortener
```

Migrate database.

```
php artisan migrate
```

Duplicate ```.env.example``` and rename it to ```.env```. Set this file depend on your server settings.
Remember to add ```APP_KEY``` which is basically 32 chars length random string.

Compile styles and scripts for production.
```
npx mix --production
```

## :clipboard: License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
