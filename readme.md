## Shipping Tracking Module in Laravel/React

### To set it up run
```
composer install
npm install
npm run build
php artisan app:setup
```

### To run tests
`composer run test`

### To run locally
`composer run dev`

### Test tracking codes that work are as follows
```
0000000000
1234567890
```
### ENV variable to switch shipping provider is
`SHIPPING_PROVIDER`
#### possible values are:
```
csv
eloquent
```
