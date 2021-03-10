## Test Assignment

- Scraper lego retiring soon products cron that runs twice per day, send email when spotted new products
- Table UI to display products

## Install

- Run ```$ git clone {repo}```
- Clone ```.env.example``` and name it ```.env```
- Edit ```.env``` in root folder for email, database settings, base url, .etc for now using mailtrap in local env
- Run ```$ npm install```
- Run ```$ composer install```
- Run ```$ php artisan migrate```


## Testing

### Scaper Command

- Run ```$ php artisan scrape:retiring_soon_products```
- Or access this endpoint to trigger the process immediately ```GET {base_url}/scrape```

### Cron

- Run ```$ while true; do php artisan schedule:run; sleep 60; done``` to fake cronjob
- Edit ```app/Console/Kernel.php``` to change how often the script executes

### UI

- Run ```$ php artisan serve --port={port} --host={host}```
- Run ```$ npm run watch```
- Access ```{base_url}/app```

