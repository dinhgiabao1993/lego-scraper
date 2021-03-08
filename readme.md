## Test Assignment

- Scraper lego retiring soon products cron that runs twice per day, send email when spotted new products
- Table UI to display products

## Install

- Run ```$ git clone {repo}```
- Edit ```.env``` in root folder for email, database settings, base url, .etc for now using mailtrap in local env
- Run ```$ php artisan migrate```
- Run ```$ php artisan serve --port={port} --host={host}```


## Testing

### Scaper Command

Run ```$ php artisan scrape:retiring_soon_products

### Cron

- Run ```$ while true; do php artisan schedule:run; sleep 60; done``` to fake cronjob
- Edit ```app/Console/Kernel.php``` to change how often the script executes

### UI

- Run ```$ npm run watch```
- Access /app

