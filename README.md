# Paykassa SCI & API

## Installation

```
composer require selyakovadim/paykassa
```

## Initialization

Get yours Marchant and API credentials from https://paykassa.pro

### PHP

```php
$api = new Paykassa\PaykassaApi($api_id, $api_key);
$sci = new Paykassa\PaykassaSci($sci_id, $sci_key);
```

### Laravel 
```
.env

PAYKASSA_SCI_ID=
PAYKASSA_SCI_KEY=

PAYKASSA_API_ID=
PAYKASSA_API_KEY=
```

```php
$api = new Paykassa\PaykassaApi();
$sci = new Paykassa\PaykassaSci();
```

## Usage

### Get Balance (API)

```php
$balance = $api->getBalance($shop_id)
```

### Make Payment (API)

```php
$response = $api->makePayment([
    'shop' => 999,
    'system' => 1,
    'number' => 'P123456',
    'amount' => 100,
    'currency' => 'USD',
    'comment' => 'Payment #654',
]);
```

### Get cryptocurrency address (SCI)

```php
$address = $sci->getAddress([
    'system' => 11,
    'currency' => 'BTC',
    'order_id' => 100500,
    'comment' => 'Invoice #100500'
    'amount' => 100,
]);
```

### Get invoice (SCI)

```php
$invoice = $sci->getInvoice([
    'system' => 1,
    'currency' => 'USD',
    'order_id' => 100500,
    'comment' => 'Invoice #100500'
    'amount' => 100,
]);
```

### Check payment (SCI)

```php
$response = $sci->checkPayment($payment_hash);
```

### More info
- https://paykassa.pro/docs/
- https://paykassa.pro/en/developers/
