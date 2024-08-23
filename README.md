# klinik Gunung App Laravel

```bash
composer i
```

## Node Js

```bash
npm i
```

## Pusher

-   <a href="https://dashboard.pusher.com/">Pusher Apikey</a>

add to .env

```env
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=
```

example code:

```php
event(new ScreeningOfflineCreated($screeningOffline));
```
