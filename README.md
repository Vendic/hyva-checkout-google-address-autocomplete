# Google Address Autocomplete for the Hyvä checkout 

[![Coding Standard](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml/badge.svg)](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml)

Hyvä checkout compatibility module for [vendic/magento2-google-address-autocomplete](https://github.com/Vendic/magento2-google-address-autocomplete).

https://github.com/Vendic/hyva-checkout-google-address-autocomplete/assets/14849044/70274a49-cdfd-4493-96a0-954dc4a8eff5

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

## Features
- [x] Autocomplete for billing address in the Hyvä checkout
- [x] Autocomplete for shipping address in the Hyvä checkout
- [x] Works on the company field and street 0. To add additonal fields, check `\Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel\AutoCompleteSelectors`
- [x] Housenumber validation to check if the housenumber contains digits. 

## Compatibility
If you want Google Address autocomplete in the "my account"-section, you will need [this module](https://github.com/Vendic/hyva-google-address-autocomplete)



