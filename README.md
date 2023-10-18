# Hyvä checkout Google Address Autocomplete
Hyvä checkout compatibility module for [vendic/magento2-google-address-autocomplete](https://github.com/Vendic/magento2-google-address-autocomplete).

## Installation
```bash
composer require vendic/hyva-checkout-google-address-autocomplete
```

## Configuration
Set your Google Maps API key in the Magento admin panel under `Stores > Configuration > Vendic > Google Address Autocomplete`.

Or - even better - via the CLI:
```bash
 n98-magerun2 config:set --lock-env google_autocomplete/general/api_key $your_api_key
```

There is no disable/enable configuration. To disable the module, simply remove the API key from the configuration.

### Video


