# Reapit Connect Socialite

Reapit Connect Socialite is a Laravel Socialite provider to allow you to authenticate against Reapit Connect. Reapit Connect is part of Reapit Foundations, the new PropTech Marketplace for the Reapit CRM.

## Installation

Use the package manager [composer](https://getcomposer.org/) to use Reapit Connect Socialite. Also, remember to make sure you have Laravel Socialite installed too!

```bash
composer require jaetooledev/reapitconnectsocialite
```
### Configuration
Currently, we require very little in the way of configuration. I aim to keep it that way for as long as possible. Once installed, open up your `config/services.php` file and pop in the below.
```php
'reapit_connect' => [
        'client_id' => env('REAPIT_CONNECT_CLIENT_ID'),
        'client_secret' => '',
        'redirect' => '<YOUR CALLBACK URL SETUP IN THE REAPIT MARKETPLACE>'
    ]
```
Then, as you may have noticed above, we need to define a variable in our `.env` file.
`REAPIT_CONNECT_CLIENT_ID=<YOUR CLIENT ID>`

## Usage
By default, we have three routes - `/reapit/login`, `/reapit/callback` and `/reapit/success`. As you may have guessed, one is to send the user to the Reapit Connect login and the other is a callback. This provider comes with a default controller which takes care of authenticating the user using Laravel's default user authentication. It will then redirect to `/reapit/success` which you can catch in your `web.php` and get information using `Auth::user()`.

## Next Up
I'm actively working on this plugin for a few projects. I'm looking at expanding the functionality and creating a specific middleware and API wrapper. If you keep your eyes posted on the issue board and the todo label specifically, you can see what I'm working on next. Any issues, please use the Github Issue board and I'll look straight into it. Any security issues should be reported to me at: jaetooledev@gmail.com

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)