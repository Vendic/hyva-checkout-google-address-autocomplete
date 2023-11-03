# Google Address Autocomplete for the Hyvä checkout 

[![Coding Standard](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml/badge.svg)](https://github.com/Vendic/hyva-checkout-google-address-autocomplete/actions/workflows/coding-standard.yml)

Hyvä checkout compatibility module for [vendic/magento2-google-address-autocomplete](https://github.com/Vendic/magento2-google-address-autocomplete).



https://github.com/Vendic/hyva-checkout-google-address-autocomplete/assets/14849044/631af321-0848-4176-8bdd-50f18019dc87



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
- [ ] Autocomplete for adding a new address as a logged in user
- [x] Works on the company field and street 0. To add additonal fields, check `\Vendic\HyvaCheckoutGoogleAddressAutocomplete\ViewModel\AutoCompleteSelectors`
- [x] Housenumber validation to check if the housenumber contains digits. 

## Customizations
### Field mapping
The field mapping (google address response mapped to Hyvä checkout form inputs) can be modified using di.xml.
See `etc/frontend/di.xml` for the default mapping, which you can change edit in [your own di.xml](https://devdocs.mage-os.org/docs/main/di_xml#content-syntax).

### Input selectors
The input selectors (the fields that trigger the autocomplete dropdown ) can be modified using di.xml.
By default, the autocomplete is triggered for street 0 and company.