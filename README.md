## TurnoverBnb Products list code test

An api built in laravel to support the [turnover_bnb_web](https://github.com/Rarfael/turnover_bnb_web) frontend  

#### Basic routes
- get - /api/products
-- return an array of products
- post - /api/products
-- create one or many new product
- get - /api/products/{id}
-- return the selected product
- put - /api/products/{id}
-- Update a existent product
- delete - /api/products/{id}
-- Delete a existent product
- put - /mass-update/products
-- Mass updates all products provided in the request body

## To get the server up and running

- `$ composer install` <br/>
- `$ cp .env.example .env`
- `php artisan key:generate`
- create a new database <br>
- update this fields in .env to match your database configuration
- ex: 
`DB_DATABASE=turnover_bnb`
`DB_USERNAME=`
`DB_PASSWORD=`
- `$ php artisan migrate --seed`
- `$ php artisan serve`
- `$ vendor/bin/phpunit`

## License
[MIT license](https://opensource.org/licenses/MIT).
