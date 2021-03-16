<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Tests;

use Ansien\FormToJsonBundle\Tests\TestClasses\SuperFormType;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Button\ButtonTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Button\ResetTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Button\SubmitTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\ChoiceTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\CountryTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\CurrencyTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\EntityTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\LanguageTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\LocaleTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Choice\TimezoneTypeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\BirthdayTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\DateIntervalTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\DateTimeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\DateTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\TimeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\DateTime\WeekTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\FormTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Group\CollectionTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Group\RepeatedTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Hidden\HiddenTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Other\CheckboxTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Other\FileTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Other\RadioTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\ColorTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\EmailTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\IntegerTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\MoneyTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\NumberTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\PasswordTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\PercentTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\RangeTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\SearchTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\TelTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\TextareaTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\TextTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\BuiltIn\Text\UrlTypeTransformer;
use Ansien\FormToJsonBundle\Transformer\Context\TransformerContext;
use Ansien\FormToJsonBundle\Transformer\Service\FormTransformer;

class TransformTest extends FormToJsonBundleTestCase
{
    private const expectedJson = <<<EOT
    {
      "id": "test",
      "name": "test",
      "type": "super_form",
      "disabled": false,
      "label": null,
      "label_format": null,
      "label_html": false,
      "multipart": true,
      "unique_block_prefix": "_test",
      "row_attr": [],
      "translation_domain": null,
      "label_translation_parameters": [],
      "attr_translation_parameters": [],
      "valid": true,
      "value": null,
      "required": true,
      "size": null,
      "label_attr": [],
      "help": null,
      "help_attr": [],
      "help_html": false,
      "help_translation_parameters": [],
      "compound": true,
      "method": "POST",
      "action": "",
      "submitted": false,
      "attr": [],
      "children": {
        "text": {
          "id": "test_text",
          "name": "text",
          "type": "text",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_text",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "textarea": {
          "id": "test_textarea",
          "name": "textarea",
          "type": "textarea",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_textarea",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "email": {
          "id": "test_email",
          "name": "email",
          "type": "email",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_email",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "integer": {
          "id": "test_integer",
          "name": "integer",
          "type": "integer",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_integer",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "grouping": false,
            "rounding_mode": 2
          },
          "errors": []
        },
        "money": {
          "id": "test_money",
          "name": "money",
          "type": "money",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_money",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "currency": "EUR",
            "divisor": 1,
            "grouping": false,
            "rounding_mode": 6,
            "html5": false,
            "scale": 2
          },
          "errors": []
        },
        "number": {
          "id": "test_number",
          "name": "number",
          "type": "number",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_number",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "grouping": false,
            "html5": false,
            "input": "number",
            "scale": null,
            "rounding_mode": 6
          },
          "errors": []
        },
        "password": {
          "id": "test_password",
          "name": "password",
          "type": "password",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_password",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "always_empty": true
          },
          "errors": []
        },
        "percent": {
          "id": "test_percent",
          "name": "percent",
          "type": "percent",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_percent",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "rounding_mode": null,
            "html5": false,
            "scale": 0,
            "symbol": "%",
            "type": "fractional"
          },
          "errors": []
        },
        "search": {
          "id": "test_search",
          "name": "search",
          "type": "search",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_search",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "url": {
          "id": "test_url",
          "name": "url",
          "type": "url",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_url",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": {
            "inputmode": "url"
          },
          "options": {
            "default_protocol": "http"
          },
          "errors": []
        },
        "range": {
          "id": "test_range",
          "name": "range",
          "type": "range",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_range",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "tel": {
          "id": "test_tel",
          "name": "tel",
          "type": "tel",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_tel",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "color": {
          "id": "test_color",
          "name": "color",
          "type": "color",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_color",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "html5": false
          },
          "errors": []
        },
        "choice": {
          "id": "test_choice",
          "name": "choice",
          "type": "choice",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_choice",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": null,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": []
          },
          "errors": []
        },
        "country": {
          "id": "test_country",
          "name": "country",
          "type": "country",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_country",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [
              {
                "label": "Afghanistan",
                "value": "AF"
              },
              {
                "label": "Åland Islands",
                "value": "AX"
              },
              {
                "label": "Albania",
                "value": "AL"
              },
              {
                "label": "Algeria",
                "value": "DZ"
              },
              {
                "label": "American Samoa",
                "value": "AS"
              },
              {
                "label": "Andorra",
                "value": "AD"
              },
              {
                "label": "Angola",
                "value": "AO"
              },
              {
                "label": "Anguilla",
                "value": "AI"
              },
              {
                "label": "Antarctica",
                "value": "AQ"
              },
              {
                "label": "Antigua & Barbuda",
                "value": "AG"
              },
              {
                "label": "Argentina",
                "value": "AR"
              },
              {
                "label": "Armenia",
                "value": "AM"
              },
              {
                "label": "Aruba",
                "value": "AW"
              },
              {
                "label": "Australia",
                "value": "AU"
              },
              {
                "label": "Austria",
                "value": "AT"
              },
              {
                "label": "Azerbaijan",
                "value": "AZ"
              },
              {
                "label": "Bahamas",
                "value": "BS"
              },
              {
                "label": "Bahrain",
                "value": "BH"
              },
              {
                "label": "Bangladesh",
                "value": "BD"
              },
              {
                "label": "Barbados",
                "value": "BB"
              },
              {
                "label": "Belarus",
                "value": "BY"
              },
              {
                "label": "Belgium",
                "value": "BE"
              },
              {
                "label": "Belize",
                "value": "BZ"
              },
              {
                "label": "Benin",
                "value": "BJ"
              },
              {
                "label": "Bermuda",
                "value": "BM"
              },
              {
                "label": "Bhutan",
                "value": "BT"
              },
              {
                "label": "Bolivia",
                "value": "BO"
              },
              {
                "label": "Bosnia & Herzegovina",
                "value": "BA"
              },
              {
                "label": "Botswana",
                "value": "BW"
              },
              {
                "label": "Bouvet Island",
                "value": "BV"
              },
              {
                "label": "Brazil",
                "value": "BR"
              },
              {
                "label": "British Indian Ocean Territory",
                "value": "IO"
              },
              {
                "label": "British Virgin Islands",
                "value": "VG"
              },
              {
                "label": "Brunei",
                "value": "BN"
              },
              {
                "label": "Bulgaria",
                "value": "BG"
              },
              {
                "label": "Burkina Faso",
                "value": "BF"
              },
              {
                "label": "Burundi",
                "value": "BI"
              },
              {
                "label": "Cambodia",
                "value": "KH"
              },
              {
                "label": "Cameroon",
                "value": "CM"
              },
              {
                "label": "Canada",
                "value": "CA"
              },
              {
                "label": "Cape Verde",
                "value": "CV"
              },
              {
                "label": "Caribbean Netherlands",
                "value": "BQ"
              },
              {
                "label": "Cayman Islands",
                "value": "KY"
              },
              {
                "label": "Central African Republic",
                "value": "CF"
              },
              {
                "label": "Chad",
                "value": "TD"
              },
              {
                "label": "Chile",
                "value": "CL"
              },
              {
                "label": "China",
                "value": "CN"
              },
              {
                "label": "Christmas Island",
                "value": "CX"
              },
              {
                "label": "Cocos (Keeling) Islands",
                "value": "CC"
              },
              {
                "label": "Colombia",
                "value": "CO"
              },
              {
                "label": "Comoros",
                "value": "KM"
              },
              {
                "label": "Congo - Brazzaville",
                "value": "CG"
              },
              {
                "label": "Congo - Kinshasa",
                "value": "CD"
              },
              {
                "label": "Cook Islands",
                "value": "CK"
              },
              {
                "label": "Costa Rica",
                "value": "CR"
              },
              {
                "label": "Côte d’Ivoire",
                "value": "CI"
              },
              {
                "label": "Croatia",
                "value": "HR"
              },
              {
                "label": "Cuba",
                "value": "CU"
              },
              {
                "label": "Curaçao",
                "value": "CW"
              },
              {
                "label": "Cyprus",
                "value": "CY"
              },
              {
                "label": "Czechia",
                "value": "CZ"
              },
              {
                "label": "Denmark",
                "value": "DK"
              },
              {
                "label": "Djibouti",
                "value": "DJ"
              },
              {
                "label": "Dominica",
                "value": "DM"
              },
              {
                "label": "Dominican Republic",
                "value": "DO"
              },
              {
                "label": "Ecuador",
                "value": "EC"
              },
              {
                "label": "Egypt",
                "value": "EG"
              },
              {
                "label": "El Salvador",
                "value": "SV"
              },
              {
                "label": "Equatorial Guinea",
                "value": "GQ"
              },
              {
                "label": "Eritrea",
                "value": "ER"
              },
              {
                "label": "Estonia",
                "value": "EE"
              },
              {
                "label": "Eswatini",
                "value": "SZ"
              },
              {
                "label": "Ethiopia",
                "value": "ET"
              },
              {
                "label": "Falkland Islands",
                "value": "FK"
              },
              {
                "label": "Faroe Islands",
                "value": "FO"
              },
              {
                "label": "Fiji",
                "value": "FJ"
              },
              {
                "label": "Finland",
                "value": "FI"
              },
              {
                "label": "France",
                "value": "FR"
              },
              {
                "label": "French Guiana",
                "value": "GF"
              },
              {
                "label": "French Polynesia",
                "value": "PF"
              },
              {
                "label": "French Southern Territories",
                "value": "TF"
              },
              {
                "label": "Gabon",
                "value": "GA"
              },
              {
                "label": "Gambia",
                "value": "GM"
              },
              {
                "label": "Georgia",
                "value": "GE"
              },
              {
                "label": "Germany",
                "value": "DE"
              },
              {
                "label": "Ghana",
                "value": "GH"
              },
              {
                "label": "Gibraltar",
                "value": "GI"
              },
              {
                "label": "Greece",
                "value": "GR"
              },
              {
                "label": "Greenland",
                "value": "GL"
              },
              {
                "label": "Grenada",
                "value": "GD"
              },
              {
                "label": "Guadeloupe",
                "value": "GP"
              },
              {
                "label": "Guam",
                "value": "GU"
              },
              {
                "label": "Guatemala",
                "value": "GT"
              },
              {
                "label": "Guernsey",
                "value": "GG"
              },
              {
                "label": "Guinea",
                "value": "GN"
              },
              {
                "label": "Guinea-Bissau",
                "value": "GW"
              },
              {
                "label": "Guyana",
                "value": "GY"
              },
              {
                "label": "Haiti",
                "value": "HT"
              },
              {
                "label": "Heard & McDonald Islands",
                "value": "HM"
              },
              {
                "label": "Honduras",
                "value": "HN"
              },
              {
                "label": "Hong Kong SAR China",
                "value": "HK"
              },
              {
                "label": "Hungary",
                "value": "HU"
              },
              {
                "label": "Iceland",
                "value": "IS"
              },
              {
                "label": "India",
                "value": "IN"
              },
              {
                "label": "Indonesia",
                "value": "ID"
              },
              {
                "label": "Iran",
                "value": "IR"
              },
              {
                "label": "Iraq",
                "value": "IQ"
              },
              {
                "label": "Ireland",
                "value": "IE"
              },
              {
                "label": "Isle of Man",
                "value": "IM"
              },
              {
                "label": "Israel",
                "value": "IL"
              },
              {
                "label": "Italy",
                "value": "IT"
              },
              {
                "label": "Jamaica",
                "value": "JM"
              },
              {
                "label": "Japan",
                "value": "JP"
              },
              {
                "label": "Jersey",
                "value": "JE"
              },
              {
                "label": "Jordan",
                "value": "JO"
              },
              {
                "label": "Kazakhstan",
                "value": "KZ"
              },
              {
                "label": "Kenya",
                "value": "KE"
              },
              {
                "label": "Kiribati",
                "value": "KI"
              },
              {
                "label": "Kuwait",
                "value": "KW"
              },
              {
                "label": "Kyrgyzstan",
                "value": "KG"
              },
              {
                "label": "Laos",
                "value": "LA"
              },
              {
                "label": "Latvia",
                "value": "LV"
              },
              {
                "label": "Lebanon",
                "value": "LB"
              },
              {
                "label": "Lesotho",
                "value": "LS"
              },
              {
                "label": "Liberia",
                "value": "LR"
              },
              {
                "label": "Libya",
                "value": "LY"
              },
              {
                "label": "Liechtenstein",
                "value": "LI"
              },
              {
                "label": "Lithuania",
                "value": "LT"
              },
              {
                "label": "Luxembourg",
                "value": "LU"
              },
              {
                "label": "Macao SAR China",
                "value": "MO"
              },
              {
                "label": "Madagascar",
                "value": "MG"
              },
              {
                "label": "Malawi",
                "value": "MW"
              },
              {
                "label": "Malaysia",
                "value": "MY"
              },
              {
                "label": "Maldives",
                "value": "MV"
              },
              {
                "label": "Mali",
                "value": "ML"
              },
              {
                "label": "Malta",
                "value": "MT"
              },
              {
                "label": "Marshall Islands",
                "value": "MH"
              },
              {
                "label": "Martinique",
                "value": "MQ"
              },
              {
                "label": "Mauritania",
                "value": "MR"
              },
              {
                "label": "Mauritius",
                "value": "MU"
              },
              {
                "label": "Mayotte",
                "value": "YT"
              },
              {
                "label": "Mexico",
                "value": "MX"
              },
              {
                "label": "Micronesia",
                "value": "FM"
              },
              {
                "label": "Moldova",
                "value": "MD"
              },
              {
                "label": "Monaco",
                "value": "MC"
              },
              {
                "label": "Mongolia",
                "value": "MN"
              },
              {
                "label": "Montenegro",
                "value": "ME"
              },
              {
                "label": "Montserrat",
                "value": "MS"
              },
              {
                "label": "Morocco",
                "value": "MA"
              },
              {
                "label": "Mozambique",
                "value": "MZ"
              },
              {
                "label": "Myanmar (Burma)",
                "value": "MM"
              },
              {
                "label": "Namibia",
                "value": "NA"
              },
              {
                "label": "Nauru",
                "value": "NR"
              },
              {
                "label": "Nepal",
                "value": "NP"
              },
              {
                "label": "Netherlands",
                "value": "NL"
              },
              {
                "label": "New Caledonia",
                "value": "NC"
              },
              {
                "label": "New Zealand",
                "value": "NZ"
              },
              {
                "label": "Nicaragua",
                "value": "NI"
              },
              {
                "label": "Niger",
                "value": "NE"
              },
              {
                "label": "Nigeria",
                "value": "NG"
              },
              {
                "label": "Niue",
                "value": "NU"
              },
              {
                "label": "Norfolk Island",
                "value": "NF"
              },
              {
                "label": "North Korea",
                "value": "KP"
              },
              {
                "label": "North Macedonia",
                "value": "MK"
              },
              {
                "label": "Northern Mariana Islands",
                "value": "MP"
              },
              {
                "label": "Norway",
                "value": "NO"
              },
              {
                "label": "Oman",
                "value": "OM"
              },
              {
                "label": "Pakistan",
                "value": "PK"
              },
              {
                "label": "Palau",
                "value": "PW"
              },
              {
                "label": "Palestinian Territories",
                "value": "PS"
              },
              {
                "label": "Panama",
                "value": "PA"
              },
              {
                "label": "Papua New Guinea",
                "value": "PG"
              },
              {
                "label": "Paraguay",
                "value": "PY"
              },
              {
                "label": "Peru",
                "value": "PE"
              },
              {
                "label": "Philippines",
                "value": "PH"
              },
              {
                "label": "Pitcairn Islands",
                "value": "PN"
              },
              {
                "label": "Poland",
                "value": "PL"
              },
              {
                "label": "Portugal",
                "value": "PT"
              },
              {
                "label": "Puerto Rico",
                "value": "PR"
              },
              {
                "label": "Qatar",
                "value": "QA"
              },
              {
                "label": "Réunion",
                "value": "RE"
              },
              {
                "label": "Romania",
                "value": "RO"
              },
              {
                "label": "Russia",
                "value": "RU"
              },
              {
                "label": "Rwanda",
                "value": "RW"
              },
              {
                "label": "Samoa",
                "value": "WS"
              },
              {
                "label": "San Marino",
                "value": "SM"
              },
              {
                "label": "São Tomé & Príncipe",
                "value": "ST"
              },
              {
                "label": "Saudi Arabia",
                "value": "SA"
              },
              {
                "label": "Senegal",
                "value": "SN"
              },
              {
                "label": "Serbia",
                "value": "RS"
              },
              {
                "label": "Seychelles",
                "value": "SC"
              },
              {
                "label": "Sierra Leone",
                "value": "SL"
              },
              {
                "label": "Singapore",
                "value": "SG"
              },
              {
                "label": "Sint Maarten",
                "value": "SX"
              },
              {
                "label": "Slovakia",
                "value": "SK"
              },
              {
                "label": "Slovenia",
                "value": "SI"
              },
              {
                "label": "Solomon Islands",
                "value": "SB"
              },
              {
                "label": "Somalia",
                "value": "SO"
              },
              {
                "label": "South Africa",
                "value": "ZA"
              },
              {
                "label": "South Georgia & South Sandwich Islands",
                "value": "GS"
              },
              {
                "label": "South Korea",
                "value": "KR"
              },
              {
                "label": "South Sudan",
                "value": "SS"
              },
              {
                "label": "Spain",
                "value": "ES"
              },
              {
                "label": "Sri Lanka",
                "value": "LK"
              },
              {
                "label": "St. Barthélemy",
                "value": "BL"
              },
              {
                "label": "St. Helena",
                "value": "SH"
              },
              {
                "label": "St. Kitts & Nevis",
                "value": "KN"
              },
              {
                "label": "St. Lucia",
                "value": "LC"
              },
              {
                "label": "St. Martin",
                "value": "MF"
              },
              {
                "label": "St. Pierre & Miquelon",
                "value": "PM"
              },
              {
                "label": "St. Vincent & Grenadines",
                "value": "VC"
              },
              {
                "label": "Sudan",
                "value": "SD"
              },
              {
                "label": "Suriname",
                "value": "SR"
              },
              {
                "label": "Svalbard & Jan Mayen",
                "value": "SJ"
              },
              {
                "label": "Sweden",
                "value": "SE"
              },
              {
                "label": "Switzerland",
                "value": "CH"
              },
              {
                "label": "Syria",
                "value": "SY"
              },
              {
                "label": "Taiwan",
                "value": "TW"
              },
              {
                "label": "Tajikistan",
                "value": "TJ"
              },
              {
                "label": "Tanzania",
                "value": "TZ"
              },
              {
                "label": "Thailand",
                "value": "TH"
              },
              {
                "label": "Timor-Leste",
                "value": "TL"
              },
              {
                "label": "Togo",
                "value": "TG"
              },
              {
                "label": "Tokelau",
                "value": "TK"
              },
              {
                "label": "Tonga",
                "value": "TO"
              },
              {
                "label": "Trinidad & Tobago",
                "value": "TT"
              },
              {
                "label": "Tunisia",
                "value": "TN"
              },
              {
                "label": "Turkey",
                "value": "TR"
              },
              {
                "label": "Turkmenistan",
                "value": "TM"
              },
              {
                "label": "Turks & Caicos Islands",
                "value": "TC"
              },
              {
                "label": "Tuvalu",
                "value": "TV"
              },
              {
                "label": "U.S. Outlying Islands",
                "value": "UM"
              },
              {
                "label": "U.S. Virgin Islands",
                "value": "VI"
              },
              {
                "label": "Uganda",
                "value": "UG"
              },
              {
                "label": "Ukraine",
                "value": "UA"
              },
              {
                "label": "United Arab Emirates",
                "value": "AE"
              },
              {
                "label": "United Kingdom",
                "value": "GB"
              },
              {
                "label": "United States",
                "value": "US"
              },
              {
                "label": "Uruguay",
                "value": "UY"
              },
              {
                "label": "Uzbekistan",
                "value": "UZ"
              },
              {
                "label": "Vanuatu",
                "value": "VU"
              },
              {
                "label": "Vatican City",
                "value": "VA"
              },
              {
                "label": "Venezuela",
                "value": "VE"
              },
              {
                "label": "Vietnam",
                "value": "VN"
              },
              {
                "label": "Wallis & Futuna",
                "value": "WF"
              },
              {
                "label": "Western Sahara",
                "value": "EH"
              },
              {
                "label": "Yemen",
                "value": "YE"
              },
              {
                "label": "Zambia",
                "value": "ZM"
              },
              {
                "label": "Zimbabwe",
                "value": "ZW"
              }
            ],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": false,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": [],
            "alpha3": false
          },
          "errors": []
        },
        "language": {
          "id": "test_language",
          "name": "language",
          "type": "language",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_language",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [
              {
                "label": "Abkhazian",
                "value": "ab"
              },
              {
                "label": "Achinese",
                "value": "ace"
              },
              {
                "label": "Acoli",
                "value": "ach"
              },
              {
                "label": "Adangme",
                "value": "ada"
              },
              {
                "label": "Adyghe",
                "value": "ady"
              },
              {
                "label": "Afar",
                "value": "aa"
              },
              {
                "label": "Afrihili",
                "value": "afh"
              },
              {
                "label": "Afrikaans",
                "value": "af"
              },
              {
                "label": "Aghem",
                "value": "agq"
              },
              {
                "label": "Ainu",
                "value": "ain"
              },
              {
                "label": "Akan",
                "value": "ak"
              },
              {
                "label": "Akkadian",
                "value": "akk"
              },
              {
                "label": "Akoose",
                "value": "bss"
              },
              {
                "label": "Alabama",
                "value": "akz"
              },
              {
                "label": "Albanian",
                "value": "sq"
              },
              {
                "label": "Aleut",
                "value": "ale"
              },
              {
                "label": "Algerian Arabic",
                "value": "arq"
              },
              {
                "label": "American Sign Language",
                "value": "ase"
              },
              {
                "label": "Amharic",
                "value": "am"
              },
              {
                "label": "Ancient Egyptian",
                "value": "egy"
              },
              {
                "label": "Ancient Greek",
                "value": "grc"
              },
              {
                "label": "Angika",
                "value": "anp"
              },
              {
                "label": "Ao Naga",
                "value": "njo"
              },
              {
                "label": "Arabic",
                "value": "ar"
              },
              {
                "label": "Aragonese",
                "value": "an"
              },
              {
                "label": "Aramaic",
                "value": "arc"
              },
              {
                "label": "Araona",
                "value": "aro"
              },
              {
                "label": "Arapaho",
                "value": "arp"
              },
              {
                "label": "Arawak",
                "value": "arw"
              },
              {
                "label": "Armenian",
                "value": "hy"
              },
              {
                "label": "Aromanian",
                "value": "rup"
              },
              {
                "label": "Arpitan",
                "value": "frp"
              },
              {
                "label": "Assamese",
                "value": "as"
              },
              {
                "label": "Asturian",
                "value": "ast"
              },
              {
                "label": "Asu",
                "value": "asa"
              },
              {
                "label": "Atsam",
                "value": "cch"
              },
              {
                "label": "Avaric",
                "value": "av"
              },
              {
                "label": "Avestan",
                "value": "ae"
              },
              {
                "label": "Awadhi",
                "value": "awa"
              },
              {
                "label": "Aymara",
                "value": "ay"
              },
              {
                "label": "Azerbaijani",
                "value": "az"
              },
              {
                "label": "Badaga",
                "value": "bfq"
              },
              {
                "label": "Bafia",
                "value": "ksf"
              },
              {
                "label": "Bafut",
                "value": "bfd"
              },
              {
                "label": "Bakhtiari",
                "value": "bqi"
              },
              {
                "label": "Balinese",
                "value": "ban"
              },
              {
                "label": "Baluchi",
                "value": "bal"
              },
              {
                "label": "Bambara",
                "value": "bm"
              },
              {
                "label": "Bamun",
                "value": "bax"
              },
              {
                "label": "Bangla",
                "value": "bn"
              },
              {
                "label": "Banjar",
                "value": "bjn"
              },
              {
                "label": "Basaa",
                "value": "bas"
              },
              {
                "label": "Bashkir",
                "value": "ba"
              },
              {
                "label": "Basque",
                "value": "eu"
              },
              {
                "label": "Batak Toba",
                "value": "bbc"
              },
              {
                "label": "Bavarian",
                "value": "bar"
              },
              {
                "label": "Beja",
                "value": "bej"
              },
              {
                "label": "Belarusian",
                "value": "be"
              },
              {
                "label": "Bemba",
                "value": "bem"
              },
              {
                "label": "Bena",
                "value": "bez"
              },
              {
                "label": "Betawi",
                "value": "bew"
              },
              {
                "label": "Bhojpuri",
                "value": "bho"
              },
              {
                "label": "Bikol",
                "value": "bik"
              },
              {
                "label": "Bini",
                "value": "bin"
              },
              {
                "label": "Bishnupriya",
                "value": "bpy"
              },
              {
                "label": "Bislama",
                "value": "bi"
              },
              {
                "label": "Blin",
                "value": "byn"
              },
              {
                "label": "Blissymbols",
                "value": "zbl"
              },
              {
                "label": "Bodo",
                "value": "brx"
              },
              {
                "label": "Bosnian",
                "value": "bs"
              },
              {
                "label": "Brahui",
                "value": "brh"
              },
              {
                "label": "Braj",
                "value": "bra"
              },
              {
                "label": "Breton",
                "value": "br"
              },
              {
                "label": "Buginese",
                "value": "bug"
              },
              {
                "label": "Bulgarian",
                "value": "bg"
              },
              {
                "label": "Bulu",
                "value": "bum"
              },
              {
                "label": "Buriat",
                "value": "bua"
              },
              {
                "label": "Burmese",
                "value": "my"
              },
              {
                "label": "Caddo",
                "value": "cad"
              },
              {
                "label": "Cajun French",
                "value": "frc"
              },
              {
                "label": "Cantonese",
                "value": "yue"
              },
              {
                "label": "Capiznon",
                "value": "cps"
              },
              {
                "label": "Carib",
                "value": "car"
              },
              {
                "label": "Catalan",
                "value": "ca"
              },
              {
                "label": "Cayuga",
                "value": "cay"
              },
              {
                "label": "Cebuano",
                "value": "ceb"
              },
              {
                "label": "Central Atlas Tamazight",
                "value": "tzm"
              },
              {
                "label": "Central Dusun",
                "value": "dtp"
              },
              {
                "label": "Central Kurdish",
                "value": "ckb"
              },
              {
                "label": "Central Yupik",
                "value": "esu"
              },
              {
                "label": "Chadian Arabic",
                "value": "shu"
              },
              {
                "label": "Chagatai",
                "value": "chg"
              },
              {
                "label": "Chakma",
                "value": "ccp"
              },
              {
                "label": "Chamorro",
                "value": "ch"
              },
              {
                "label": "Chechen",
                "value": "ce"
              },
              {
                "label": "Cherokee",
                "value": "chr"
              },
              {
                "label": "Cheyenne",
                "value": "chy"
              },
              {
                "label": "Chibcha",
                "value": "chb"
              },
              {
                "label": "Chickasaw",
                "value": "cic"
              },
              {
                "label": "Chiga",
                "value": "cgg"
              },
              {
                "label": "Chimborazo Highland Quichua",
                "value": "qug"
              },
              {
                "label": "Chinese",
                "value": "zh"
              },
              {
                "label": "Chinook Jargon",
                "value": "chn"
              },
              {
                "label": "Chipewyan",
                "value": "chp"
              },
              {
                "label": "Choctaw",
                "value": "cho"
              },
              {
                "label": "Church Slavic",
                "value": "cu"
              },
              {
                "label": "Chuukese",
                "value": "chk"
              },
              {
                "label": "Chuvash",
                "value": "cv"
              },
              {
                "label": "Classical Newari",
                "value": "nwc"
              },
              {
                "label": "Classical Syriac",
                "value": "syc"
              },
              {
                "label": "Colognian",
                "value": "ksh"
              },
              {
                "label": "Comorian",
                "value": "swb"
              },
              {
                "label": "Coptic",
                "value": "cop"
              },
              {
                "label": "Cornish",
                "value": "kw"
              },
              {
                "label": "Corsican",
                "value": "co"
              },
              {
                "label": "Cree",
                "value": "cr"
              },
              {
                "label": "Crimean Turkish",
                "value": "crh"
              },
              {
                "label": "Croatian",
                "value": "hr"
              },
              {
                "label": "Czech",
                "value": "cs"
              },
              {
                "label": "Dakota",
                "value": "dak"
              },
              {
                "label": "Danish",
                "value": "da"
              },
              {
                "label": "Dargwa",
                "value": "dar"
              },
              {
                "label": "Dazaga",
                "value": "dzg"
              },
              {
                "label": "Delaware",
                "value": "del"
              },
              {
                "label": "Dinka",
                "value": "din"
              },
              {
                "label": "Divehi",
                "value": "dv"
              },
              {
                "label": "Dogri",
                "value": "doi"
              },
              {
                "label": "Dogrib",
                "value": "dgr"
              },
              {
                "label": "Duala",
                "value": "dua"
              },
              {
                "label": "Dutch",
                "value": "nl"
              },
              {
                "label": "Dyula",
                "value": "dyu"
              },
              {
                "label": "Dzongkha",
                "value": "dz"
              },
              {
                "label": "Eastern Frisian",
                "value": "frs"
              },
              {
                "label": "Efik",
                "value": "efi"
              },
              {
                "label": "Egyptian Arabic",
                "value": "arz"
              },
              {
                "label": "Ekajuk",
                "value": "eka"
              },
              {
                "label": "Elamite",
                "value": "elx"
              },
              {
                "label": "Embu",
                "value": "ebu"
              },
              {
                "label": "Emilian",
                "value": "egl"
              },
              {
                "label": "English",
                "value": "en"
              },
              {
                "label": "Erzya",
                "value": "myv"
              },
              {
                "label": "Esperanto",
                "value": "eo"
              },
              {
                "label": "Estonian",
                "value": "et"
              },
              {
                "label": "Ewe",
                "value": "ee"
              },
              {
                "label": "Ewondo",
                "value": "ewo"
              },
              {
                "label": "Extremaduran",
                "value": "ext"
              },
              {
                "label": "Fang",
                "value": "fan"
              },
              {
                "label": "Fanti",
                "value": "fat"
              },
              {
                "label": "Faroese",
                "value": "fo"
              },
              {
                "label": "Fiji Hindi",
                "value": "hif"
              },
              {
                "label": "Fijian",
                "value": "fj"
              },
              {
                "label": "Filipino",
                "value": "fil"
              },
              {
                "label": "Finnish",
                "value": "fi"
              },
              {
                "label": "Fon",
                "value": "fon"
              },
              {
                "label": "Frafra",
                "value": "gur"
              },
              {
                "label": "French",
                "value": "fr"
              },
              {
                "label": "Friulian",
                "value": "fur"
              },
              {
                "label": "Fulah",
                "value": "ff"
              },
              {
                "label": "Ga",
                "value": "gaa"
              },
              {
                "label": "Gagauz",
                "value": "gag"
              },
              {
                "label": "Galician",
                "value": "gl"
              },
              {
                "label": "Gan Chinese",
                "value": "gan"
              },
              {
                "label": "Ganda",
                "value": "lg"
              },
              {
                "label": "Gayo",
                "value": "gay"
              },
              {
                "label": "Gbaya",
                "value": "gba"
              },
              {
                "label": "Geez",
                "value": "gez"
              },
              {
                "label": "Georgian",
                "value": "ka"
              },
              {
                "label": "German",
                "value": "de"
              },
              {
                "label": "Gheg Albanian",
                "value": "aln"
              },
              {
                "label": "Ghomala",
                "value": "bbj"
              },
              {
                "label": "Gilaki",
                "value": "glk"
              },
              {
                "label": "Gilbertese",
                "value": "gil"
              },
              {
                "label": "Goan Konkani",
                "value": "gom"
              },
              {
                "label": "Gondi",
                "value": "gon"
              },
              {
                "label": "Gorontalo",
                "value": "gor"
              },
              {
                "label": "Gothic",
                "value": "got"
              },
              {
                "label": "Grebo",
                "value": "grb"
              },
              {
                "label": "Greek",
                "value": "el"
              },
              {
                "label": "Guarani",
                "value": "gn"
              },
              {
                "label": "Gujarati",
                "value": "gu"
              },
              {
                "label": "Gusii",
                "value": "guz"
              },
              {
                "label": "Gwichʼin",
                "value": "gwi"
              },
              {
                "label": "Haida",
                "value": "hai"
              },
              {
                "label": "Haitian Creole",
                "value": "ht"
              },
              {
                "label": "Hakka Chinese",
                "value": "hak"
              },
              {
                "label": "Hausa",
                "value": "ha"
              },
              {
                "label": "Hawaiian",
                "value": "haw"
              },
              {
                "label": "Hebrew",
                "value": "he"
              },
              {
                "label": "Herero",
                "value": "hz"
              },
              {
                "label": "Hiligaynon",
                "value": "hil"
              },
              {
                "label": "Hindi",
                "value": "hi"
              },
              {
                "label": "Hiri Motu",
                "value": "ho"
              },
              {
                "label": "Hittite",
                "value": "hit"
              },
              {
                "label": "Hmong",
                "value": "hmn"
              },
              {
                "label": "Hungarian",
                "value": "hu"
              },
              {
                "label": "Hupa",
                "value": "hup"
              },
              {
                "label": "Iban",
                "value": "iba"
              },
              {
                "label": "Ibibio",
                "value": "ibb"
              },
              {
                "label": "Icelandic",
                "value": "is"
              },
              {
                "label": "Ido",
                "value": "io"
              },
              {
                "label": "Igbo",
                "value": "ig"
              },
              {
                "label": "Iloko",
                "value": "ilo"
              },
              {
                "label": "Inari Sami",
                "value": "smn"
              },
              {
                "label": "Indonesian",
                "value": "id"
              },
              {
                "label": "Ingrian",
                "value": "izh"
              },
              {
                "label": "Ingush",
                "value": "inh"
              },
              {
                "label": "Interlingua",
                "value": "ia"
              },
              {
                "label": "Interlingue",
                "value": "ie"
              },
              {
                "label": "Inuktitut",
                "value": "iu"
              },
              {
                "label": "Inupiaq",
                "value": "ik"
              },
              {
                "label": "Irish",
                "value": "ga"
              },
              {
                "label": "Italian",
                "value": "it"
              },
              {
                "label": "Jamaican Creole English",
                "value": "jam"
              },
              {
                "label": "Japanese",
                "value": "ja"
              },
              {
                "label": "Javanese",
                "value": "jv"
              },
              {
                "label": "Jju",
                "value": "kaj"
              },
              {
                "label": "Jola-Fonyi",
                "value": "dyo"
              },
              {
                "label": "Judeo-Arabic",
                "value": "jrb"
              },
              {
                "label": "Judeo-Persian",
                "value": "jpr"
              },
              {
                "label": "Jutish",
                "value": "jut"
              },
              {
                "label": "Kabardian",
                "value": "kbd"
              },
              {
                "label": "Kabuverdianu",
                "value": "kea"
              },
              {
                "label": "Kabyle",
                "value": "kab"
              },
              {
                "label": "Kachin",
                "value": "kac"
              },
              {
                "label": "Kaingang",
                "value": "kgp"
              },
              {
                "label": "Kako",
                "value": "kkj"
              },
              {
                "label": "Kalaallisut",
                "value": "kl"
              },
              {
                "label": "Kalenjin",
                "value": "kln"
              },
              {
                "label": "Kalmyk",
                "value": "xal"
              },
              {
                "label": "Kamba",
                "value": "kam"
              },
              {
                "label": "Kanembu",
                "value": "kbl"
              },
              {
                "label": "Kannada",
                "value": "kn"
              },
              {
                "label": "Kanuri",
                "value": "kr"
              },
              {
                "label": "Kara-Kalpak",
                "value": "kaa"
              },
              {
                "label": "Karachay-Balkar",
                "value": "krc"
              },
              {
                "label": "Karelian",
                "value": "krl"
              },
              {
                "label": "Kashmiri",
                "value": "ks"
              },
              {
                "label": "Kashubian",
                "value": "csb"
              },
              {
                "label": "Kawi",
                "value": "kaw"
              },
              {
                "label": "Kazakh",
                "value": "kk"
              },
              {
                "label": "Kenyang",
                "value": "ken"
              },
              {
                "label": "Khasi",
                "value": "kha"
              },
              {
                "label": "Khmer",
                "value": "km"
              },
              {
                "label": "Khotanese",
                "value": "kho"
              },
              {
                "label": "Khowar",
                "value": "khw"
              },
              {
                "label": "Kikuyu",
                "value": "ki"
              },
              {
                "label": "Kimbundu",
                "value": "kmb"
              },
              {
                "label": "Kinaray-a",
                "value": "krj"
              },
              {
                "label": "Kinyarwanda",
                "value": "rw"
              },
              {
                "label": "Kirmanjki",
                "value": "kiu"
              },
              {
                "label": "Klingon",
                "value": "tlh"
              },
              {
                "label": "Kom",
                "value": "bkm"
              },
              {
                "label": "Komi",
                "value": "kv"
              },
              {
                "label": "Komi-Permyak",
                "value": "koi"
              },
              {
                "label": "Kongo",
                "value": "kg"
              },
              {
                "label": "Konkani",
                "value": "kok"
              },
              {
                "label": "Korean",
                "value": "ko"
              },
              {
                "label": "Koro",
                "value": "kfo"
              },
              {
                "label": "Kosraean",
                "value": "kos"
              },
              {
                "label": "Kotava",
                "value": "avk"
              },
              {
                "label": "Koyra Chiini",
                "value": "khq"
              },
              {
                "label": "Koyraboro Senni",
                "value": "ses"
              },
              {
                "label": "Kpelle",
                "value": "kpe"
              },
              {
                "label": "Krio",
                "value": "kri"
              },
              {
                "label": "Kuanyama",
                "value": "kj"
              },
              {
                "label": "Kumyk",
                "value": "kum"
              },
              {
                "label": "Kurdish",
                "value": "ku"
              },
              {
                "label": "Kurukh",
                "value": "kru"
              },
              {
                "label": "Kutenai",
                "value": "kut"
              },
              {
                "label": "Kwasio",
                "value": "nmg"
              },
              {
                "label": "Kyrgyz",
                "value": "ky"
              },
              {
                "label": "Kʼicheʼ",
                "value": "quc"
              },
              {
                "label": "Ladino",
                "value": "lad"
              },
              {
                "label": "Lahnda",
                "value": "lah"
              },
              {
                "label": "Lakota",
                "value": "lkt"
              },
              {
                "label": "Lamba",
                "value": "lam"
              },
              {
                "label": "Langi",
                "value": "lag"
              },
              {
                "label": "Lao",
                "value": "lo"
              },
              {
                "label": "Latgalian",
                "value": "ltg"
              },
              {
                "label": "Latin",
                "value": "la"
              },
              {
                "label": "Latvian",
                "value": "lv"
              },
              {
                "label": "Laz",
                "value": "lzz"
              },
              {
                "label": "Lezghian",
                "value": "lez"
              },
              {
                "label": "Ligurian",
                "value": "lij"
              },
              {
                "label": "Limburgish",
                "value": "li"
              },
              {
                "label": "Lingala",
                "value": "ln"
              },
              {
                "label": "Lingua Franca Nova",
                "value": "lfn"
              },
              {
                "label": "Literary Chinese",
                "value": "lzh"
              },
              {
                "label": "Lithuanian",
                "value": "lt"
              },
              {
                "label": "Livonian",
                "value": "liv"
              },
              {
                "label": "Lojban",
                "value": "jbo"
              },
              {
                "label": "Lombard",
                "value": "lmo"
              },
              {
                "label": "Louisiana Creole",
                "value": "lou"
              },
              {
                "label": "Low German",
                "value": "nds"
              },
              {
                "label": "Lower Silesian",
                "value": "sli"
              },
              {
                "label": "Lower Sorbian",
                "value": "dsb"
              },
              {
                "label": "Lozi",
                "value": "loz"
              },
              {
                "label": "Luba-Katanga",
                "value": "lu"
              },
              {
                "label": "Luba-Lulua",
                "value": "lua"
              },
              {
                "label": "Luiseno",
                "value": "lui"
              },
              {
                "label": "Lule Sami",
                "value": "smj"
              },
              {
                "label": "Lunda",
                "value": "lun"
              },
              {
                "label": "Luo",
                "value": "luo"
              },
              {
                "label": "Luxembourgish",
                "value": "lb"
              },
              {
                "label": "Luyia",
                "value": "luy"
              },
              {
                "label": "Maba",
                "value": "mde"
              },
              {
                "label": "Macedonian",
                "value": "mk"
              },
              {
                "label": "Machame",
                "value": "jmc"
              },
              {
                "label": "Madurese",
                "value": "mad"
              },
              {
                "label": "Mafa",
                "value": "maf"
              },
              {
                "label": "Magahi",
                "value": "mag"
              },
              {
                "label": "Main-Franconian",
                "value": "vmf"
              },
              {
                "label": "Maithili",
                "value": "mai"
              },
              {
                "label": "Makasar",
                "value": "mak"
              },
              {
                "label": "Makhuwa-Meetto",
                "value": "mgh"
              },
              {
                "label": "Makonde",
                "value": "kde"
              },
              {
                "label": "Malagasy",
                "value": "mg"
              },
              {
                "label": "Malay",
                "value": "ms"
              },
              {
                "label": "Malayalam",
                "value": "ml"
              },
              {
                "label": "Maltese",
                "value": "mt"
              },
              {
                "label": "Manchu",
                "value": "mnc"
              },
              {
                "label": "Mandar",
                "value": "mdr"
              },
              {
                "label": "Mandingo",
                "value": "man"
              },
              {
                "label": "Manipuri",
                "value": "mni"
              },
              {
                "label": "Manx",
                "value": "gv"
              },
              {
                "label": "Maori",
                "value": "mi"
              },
              {
                "label": "Mapuche",
                "value": "arn"
              },
              {
                "label": "Marathi",
                "value": "mr"
              },
              {
                "label": "Mari",
                "value": "chm"
              },
              {
                "label": "Marshallese",
                "value": "mh"
              },
              {
                "label": "Marwari",
                "value": "mwr"
              },
              {
                "label": "Masai",
                "value": "mas"
              },
              {
                "label": "Mazanderani",
                "value": "mzn"
              },
              {
                "label": "Medumba",
                "value": "byv"
              },
              {
                "label": "Mende",
                "value": "men"
              },
              {
                "label": "Mentawai",
                "value": "mwv"
              },
              {
                "label": "Meru",
                "value": "mer"
              },
              {
                "label": "Metaʼ",
                "value": "mgo"
              },
              {
                "label": "Mi'kmaq",
                "value": "mic"
              },
              {
                "label": "Middle Dutch",
                "value": "dum"
              },
              {
                "label": "Middle English",
                "value": "enm"
              },
              {
                "label": "Middle French",
                "value": "frm"
              },
              {
                "label": "Middle High German",
                "value": "gmh"
              },
              {
                "label": "Middle Irish",
                "value": "mga"
              },
              {
                "label": "Min Nan Chinese",
                "value": "nan"
              },
              {
                "label": "Minangkabau",
                "value": "min"
              },
              {
                "label": "Mingrelian",
                "value": "xmf"
              },
              {
                "label": "Mirandese",
                "value": "mwl"
              },
              {
                "label": "Mizo",
                "value": "lus"
              },
              {
                "label": "Mohawk",
                "value": "moh"
              },
              {
                "label": "Moksha",
                "value": "mdf"
              },
              {
                "label": "Mongo",
                "value": "lol"
              },
              {
                "label": "Mongolian",
                "value": "mn"
              },
              {
                "label": "Morisyen",
                "value": "mfe"
              },
              {
                "label": "Moroccan Arabic",
                "value": "ary"
              },
              {
                "label": "Mossi",
                "value": "mos"
              },
              {
                "label": "Mundang",
                "value": "mua"
              },
              {
                "label": "Muscogee",
                "value": "mus"
              },
              {
                "label": "Muslim Tat",
                "value": "ttt"
              },
              {
                "label": "Myene",
                "value": "mye"
              },
              {
                "label": "N’Ko",
                "value": "nqo"
              },
              {
                "label": "Najdi Arabic",
                "value": "ars"
              },
              {
                "label": "Nama",
                "value": "naq"
              },
              {
                "label": "Nauru",
                "value": "na"
              },
              {
                "label": "Navajo",
                "value": "nv"
              },
              {
                "label": "Ndonga",
                "value": "ng"
              },
              {
                "label": "Neapolitan",
                "value": "nap"
              },
              {
                "label": "Nepali",
                "value": "ne"
              },
              {
                "label": "Newari",
                "value": "new"
              },
              {
                "label": "Ngambay",
                "value": "sba"
              },
              {
                "label": "Ngiemboon",
                "value": "nnh"
              },
              {
                "label": "Ngomba",
                "value": "jgo"
              },
              {
                "label": "Nheengatu",
                "value": "yrl"
              },
              {
                "label": "Nias",
                "value": "nia"
              },
              {
                "label": "Nigerian Pidgin",
                "value": "pcm"
              },
              {
                "label": "Niuean",
                "value": "niu"
              },
              {
                "label": "Nogai",
                "value": "nog"
              },
              {
                "label": "North Ndebele",
                "value": "nd"
              },
              {
                "label": "Northern Frisian",
                "value": "frr"
              },
              {
                "label": "Northern Luri",
                "value": "lrc"
              },
              {
                "label": "Northern Sami",
                "value": "se"
              },
              {
                "label": "Northern Sotho",
                "value": "nso"
              },
              {
                "label": "Norwegian",
                "value": "no"
              },
              {
                "label": "Norwegian Bokmål",
                "value": "nb"
              },
              {
                "label": "Norwegian Nynorsk",
                "value": "nn"
              },
              {
                "label": "Novial",
                "value": "nov"
              },
              {
                "label": "Nuer",
                "value": "nus"
              },
              {
                "label": "Nyamwezi",
                "value": "nym"
              },
              {
                "label": "Nyanja",
                "value": "ny"
              },
              {
                "label": "Nyankole",
                "value": "nyn"
              },
              {
                "label": "Nyasa Tonga",
                "value": "tog"
              },
              {
                "label": "Nyoro",
                "value": "nyo"
              },
              {
                "label": "Nzima",
                "value": "nzi"
              },
              {
                "label": "Occitan",
                "value": "oc"
              },
              {
                "label": "Odia",
                "value": "or"
              },
              {
                "label": "Ojibwa",
                "value": "oj"
              },
              {
                "label": "Old English",
                "value": "ang"
              },
              {
                "label": "Old French",
                "value": "fro"
              },
              {
                "label": "Old High German",
                "value": "goh"
              },
              {
                "label": "Old Irish",
                "value": "sga"
              },
              {
                "label": "Old Norse",
                "value": "non"
              },
              {
                "label": "Old Persian",
                "value": "peo"
              },
              {
                "label": "Old Provençal",
                "value": "pro"
              },
              {
                "label": "Oromo",
                "value": "om"
              },
              {
                "label": "Osage",
                "value": "osa"
              },
              {
                "label": "Ossetic",
                "value": "os"
              },
              {
                "label": "Ottoman Turkish",
                "value": "ota"
              },
              {
                "label": "Pahlavi",
                "value": "pal"
              },
              {
                "label": "Palatine German",
                "value": "pfl"
              },
              {
                "label": "Palauan",
                "value": "pau"
              },
              {
                "label": "Pali",
                "value": "pi"
              },
              {
                "label": "Pampanga",
                "value": "pam"
              },
              {
                "label": "Pangasinan",
                "value": "pag"
              },
              {
                "label": "Papiamento",
                "value": "pap"
              },
              {
                "label": "Pashto",
                "value": "ps"
              },
              {
                "label": "Pennsylvania German",
                "value": "pdc"
              },
              {
                "label": "Persian",
                "value": "fa"
              },
              {
                "label": "Phoenician",
                "value": "phn"
              },
              {
                "label": "Picard",
                "value": "pcd"
              },
              {
                "label": "Piedmontese",
                "value": "pms"
              },
              {
                "label": "Plautdietsch",
                "value": "pdt"
              },
              {
                "label": "Pohnpeian",
                "value": "pon"
              },
              {
                "label": "Polish",
                "value": "pl"
              },
              {
                "label": "Pontic",
                "value": "pnt"
              },
              {
                "label": "Portuguese",
                "value": "pt"
              },
              {
                "label": "Prussian",
                "value": "prg"
              },
              {
                "label": "Punjabi",
                "value": "pa"
              },
              {
                "label": "Quechua",
                "value": "qu"
              },
              {
                "label": "Rajasthani",
                "value": "raj"
              },
              {
                "label": "Rapanui",
                "value": "rap"
              },
              {
                "label": "Rarotongan",
                "value": "rar"
              },
              {
                "label": "Riffian",
                "value": "rif"
              },
              {
                "label": "Romagnol",
                "value": "rgn"
              },
              {
                "label": "Romanian",
                "value": "ro"
              },
              {
                "label": "Romansh",
                "value": "rm"
              },
              {
                "label": "Romany",
                "value": "rom"
              },
              {
                "label": "Rombo",
                "value": "rof"
              },
              {
                "label": "Rotuman",
                "value": "rtm"
              },
              {
                "label": "Roviana",
                "value": "rug"
              },
              {
                "label": "Rundi",
                "value": "rn"
              },
              {
                "label": "Russian",
                "value": "ru"
              },
              {
                "label": "Rusyn",
                "value": "rue"
              },
              {
                "label": "Rwa",
                "value": "rwk"
              },
              {
                "label": "Saho",
                "value": "ssy"
              },
              {
                "label": "Sakha",
                "value": "sah"
              },
              {
                "label": "Samaritan Aramaic",
                "value": "sam"
              },
              {
                "label": "Samburu",
                "value": "saq"
              },
              {
                "label": "Samoan",
                "value": "sm"
              },
              {
                "label": "Samogitian",
                "value": "sgs"
              },
              {
                "label": "Sandawe",
                "value": "sad"
              },
              {
                "label": "Sango",
                "value": "sg"
              },
              {
                "label": "Sangu",
                "value": "sbp"
              },
              {
                "label": "Sanskrit",
                "value": "sa"
              },
              {
                "label": "Santali",
                "value": "sat"
              },
              {
                "label": "Sardinian",
                "value": "sc"
              },
              {
                "label": "Sasak",
                "value": "sas"
              },
              {
                "label": "Sassarese Sardinian",
                "value": "sdc"
              },
              {
                "label": "Saterland Frisian",
                "value": "stq"
              },
              {
                "label": "Saurashtra",
                "value": "saz"
              },
              {
                "label": "Scots",
                "value": "sco"
              },
              {
                "label": "Scottish Gaelic",
                "value": "gd"
              },
              {
                "label": "Selayar",
                "value": "sly"
              },
              {
                "label": "Selkup",
                "value": "sel"
              },
              {
                "label": "Sena",
                "value": "seh"
              },
              {
                "label": "Seneca",
                "value": "see"
              },
              {
                "label": "Serbian",
                "value": "sr"
              },
              {
                "label": "Serbo-Croatian",
                "value": "sh"
              },
              {
                "label": "Serer",
                "value": "srr"
              },
              {
                "label": "Seri",
                "value": "sei"
              },
              {
                "label": "Seselwa Creole French",
                "value": "crs"
              },
              {
                "label": "Shambala",
                "value": "ksb"
              },
              {
                "label": "Shan",
                "value": "shn"
              },
              {
                "label": "Shona",
                "value": "sn"
              },
              {
                "label": "Sichuan Yi",
                "value": "ii"
              },
              {
                "label": "Sicilian",
                "value": "scn"
              },
              {
                "label": "Sidamo",
                "value": "sid"
              },
              {
                "label": "Siksika",
                "value": "bla"
              },
              {
                "label": "Silesian",
                "value": "szl"
              },
              {
                "label": "Sindhi",
                "value": "sd"
              },
              {
                "label": "Sinhala",
                "value": "si"
              },
              {
                "label": "Skolt Sami",
                "value": "sms"
              },
              {
                "label": "Slave",
                "value": "den"
              },
              {
                "label": "Slovak",
                "value": "sk"
              },
              {
                "label": "Slovenian",
                "value": "sl"
              },
              {
                "label": "Soga",
                "value": "xog"
              },
              {
                "label": "Sogdien",
                "value": "sog"
              },
              {
                "label": "Somali",
                "value": "so"
              },
              {
                "label": "Soninke",
                "value": "snk"
              },
              {
                "label": "South Ndebele",
                "value": "nr"
              },
              {
                "label": "Southern Altai",
                "value": "alt"
              },
              {
                "label": "Southern Kurdish",
                "value": "sdh"
              },
              {
                "label": "Southern Sami",
                "value": "sma"
              },
              {
                "label": "Southern Sotho",
                "value": "st"
              },
              {
                "label": "Spanish",
                "value": "es"
              },
              {
                "label": "Sranan Tongo",
                "value": "srn"
              },
              {
                "label": "Standard Moroccan Tamazight",
                "value": "zgh"
              },
              {
                "label": "Sukuma",
                "value": "suk"
              },
              {
                "label": "Sumerian",
                "value": "sux"
              },
              {
                "label": "Sundanese",
                "value": "su"
              },
              {
                "label": "Susu",
                "value": "sus"
              },
              {
                "label": "Swahili",
                "value": "sw"
              },
              {
                "label": "Swati",
                "value": "ss"
              },
              {
                "label": "Swedish",
                "value": "sv"
              },
              {
                "label": "Swiss German",
                "value": "gsw"
              },
              {
                "label": "Syriac",
                "value": "syr"
              },
              {
                "label": "Tachelhit",
                "value": "shi"
              },
              {
                "label": "Tagalog",
                "value": "tl"
              },
              {
                "label": "Tahitian",
                "value": "ty"
              },
              {
                "label": "Taita",
                "value": "dav"
              },
              {
                "label": "Tajik",
                "value": "tg"
              },
              {
                "label": "Talysh",
                "value": "tly"
              },
              {
                "label": "Tamashek",
                "value": "tmh"
              },
              {
                "label": "Tamil",
                "value": "ta"
              },
              {
                "label": "Taroko",
                "value": "trv"
              },
              {
                "label": "Tasawaq",
                "value": "twq"
              },
              {
                "label": "Tatar",
                "value": "tt"
              },
              {
                "label": "Telugu",
                "value": "te"
              },
              {
                "label": "Tereno",
                "value": "ter"
              },
              {
                "label": "Teso",
                "value": "teo"
              },
              {
                "label": "Tetum",
                "value": "tet"
              },
              {
                "label": "Thai",
                "value": "th"
              },
              {
                "label": "Tibetan",
                "value": "bo"
              },
              {
                "label": "Tigre",
                "value": "tig"
              },
              {
                "label": "Tigrinya",
                "value": "ti"
              },
              {
                "label": "Timne",
                "value": "tem"
              },
              {
                "label": "Tiv",
                "value": "tiv"
              },
              {
                "label": "Tlingit",
                "value": "tli"
              },
              {
                "label": "Tok Pisin",
                "value": "tpi"
              },
              {
                "label": "Tokelau",
                "value": "tkl"
              },
              {
                "label": "Tongan",
                "value": "to"
              },
              {
                "label": "Tornedalen Finnish",
                "value": "fit"
              },
              {
                "label": "Tsakhur",
                "value": "tkr"
              },
              {
                "label": "Tsakonian",
                "value": "tsd"
              },
              {
                "label": "Tsimshian",
                "value": "tsi"
              },
              {
                "label": "Tsonga",
                "value": "ts"
              },
              {
                "label": "Tswana",
                "value": "tn"
              },
              {
                "label": "Tulu",
                "value": "tcy"
              },
              {
                "label": "Tumbuka",
                "value": "tum"
              },
              {
                "label": "Tunisian Arabic",
                "value": "aeb"
              },
              {
                "label": "Turkish",
                "value": "tr"
              },
              {
                "label": "Turkmen",
                "value": "tk"
              },
              {
                "label": "Turoyo",
                "value": "tru"
              },
              {
                "label": "Tuvalu",
                "value": "tvl"
              },
              {
                "label": "Tuvinian",
                "value": "tyv"
              },
              {
                "label": "Twi",
                "value": "tw"
              },
              {
                "label": "Tyap",
                "value": "kcg"
              },
              {
                "label": "Udmurt",
                "value": "udm"
              },
              {
                "label": "Ugaritic",
                "value": "uga"
              },
              {
                "label": "Ukrainian",
                "value": "uk"
              },
              {
                "label": "Umbundu",
                "value": "umb"
              },
              {
                "label": "Upper Sorbian",
                "value": "hsb"
              },
              {
                "label": "Urdu",
                "value": "ur"
              },
              {
                "label": "Uyghur",
                "value": "ug"
              },
              {
                "label": "Uzbek",
                "value": "uz"
              },
              {
                "label": "Vai",
                "value": "vai"
              },
              {
                "label": "Venda",
                "value": "ve"
              },
              {
                "label": "Venetian",
                "value": "vec"
              },
              {
                "label": "Veps",
                "value": "vep"
              },
              {
                "label": "Vietnamese",
                "value": "vi"
              },
              {
                "label": "Volapük",
                "value": "vo"
              },
              {
                "label": "Võro",
                "value": "vro"
              },
              {
                "label": "Votic",
                "value": "vot"
              },
              {
                "label": "Vunjo",
                "value": "vun"
              },
              {
                "label": "Walloon",
                "value": "wa"
              },
              {
                "label": "Walser",
                "value": "wae"
              },
              {
                "label": "Waray",
                "value": "war"
              },
              {
                "label": "Warlpiri",
                "value": "wbp"
              },
              {
                "label": "Washo",
                "value": "was"
              },
              {
                "label": "Wayuu",
                "value": "guc"
              },
              {
                "label": "Welsh",
                "value": "cy"
              },
              {
                "label": "West Flemish",
                "value": "vls"
              },
              {
                "label": "Western Balochi",
                "value": "bgn"
              },
              {
                "label": "Western Frisian",
                "value": "fy"
              },
              {
                "label": "Western Mari",
                "value": "mrj"
              },
              {
                "label": "Wolaytta",
                "value": "wal"
              },
              {
                "label": "Wolof",
                "value": "wo"
              },
              {
                "label": "Wu Chinese",
                "value": "wuu"
              },
              {
                "label": "Xhosa",
                "value": "xh"
              },
              {
                "label": "Xiang Chinese",
                "value": "hsn"
              },
              {
                "label": "Yangben",
                "value": "yav"
              },
              {
                "label": "Yao",
                "value": "yao"
              },
              {
                "label": "Yapese",
                "value": "yap"
              },
              {
                "label": "Yemba",
                "value": "ybb"
              },
              {
                "label": "Yiddish",
                "value": "yi"
              },
              {
                "label": "Yoruba",
                "value": "yo"
              },
              {
                "label": "Zapotec",
                "value": "zap"
              },
              {
                "label": "Zarma",
                "value": "dje"
              },
              {
                "label": "Zaza",
                "value": "zza"
              },
              {
                "label": "Zeelandic",
                "value": "zea"
              },
              {
                "label": "Zenaga",
                "value": "zen"
              },
              {
                "label": "Zhuang",
                "value": "za"
              },
              {
                "label": "Zoroastrian Dari",
                "value": "gbz"
              },
              {
                "label": "Zulu",
                "value": "zu"
              },
              {
                "label": "Zuni",
                "value": "zun"
              }
            ],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": false,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": [],
            "alpha3": false,
            "choice_self_translation": false
          },
          "errors": []
        },
        "locale": {
          "id": "test_locale",
          "name": "locale",
          "type": "locale",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_locale",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [
              {
                "label": "Afrikaans",
                "value": "af"
              },
              {
                "label": "Afrikaans (Namibia)",
                "value": "af_NA"
              },
              {
                "label": "Afrikaans (South Africa)",
                "value": "af_ZA"
              },
              {
                "label": "Akan",
                "value": "ak"
              },
              {
                "label": "Akan (Ghana)",
                "value": "ak_GH"
              },
              {
                "label": "Albanian",
                "value": "sq"
              },
              {
                "label": "Albanian (Albania)",
                "value": "sq_AL"
              },
              {
                "label": "Albanian (North Macedonia)",
                "value": "sq_MK"
              },
              {
                "label": "Amharic",
                "value": "am"
              },
              {
                "label": "Amharic (Ethiopia)",
                "value": "am_ET"
              },
              {
                "label": "Arabic",
                "value": "ar"
              },
              {
                "label": "Arabic (Algeria)",
                "value": "ar_DZ"
              },
              {
                "label": "Arabic (Bahrain)",
                "value": "ar_BH"
              },
              {
                "label": "Arabic (Chad)",
                "value": "ar_TD"
              },
              {
                "label": "Arabic (Comoros)",
                "value": "ar_KM"
              },
              {
                "label": "Arabic (Djibouti)",
                "value": "ar_DJ"
              },
              {
                "label": "Arabic (Egypt)",
                "value": "ar_EG"
              },
              {
                "label": "Arabic (Eritrea)",
                "value": "ar_ER"
              },
              {
                "label": "Arabic (Iraq)",
                "value": "ar_IQ"
              },
              {
                "label": "Arabic (Israel)",
                "value": "ar_IL"
              },
              {
                "label": "Arabic (Jordan)",
                "value": "ar_JO"
              },
              {
                "label": "Arabic (Kuwait)",
                "value": "ar_KW"
              },
              {
                "label": "Arabic (Lebanon)",
                "value": "ar_LB"
              },
              {
                "label": "Arabic (Libya)",
                "value": "ar_LY"
              },
              {
                "label": "Arabic (Mauritania)",
                "value": "ar_MR"
              },
              {
                "label": "Arabic (Morocco)",
                "value": "ar_MA"
              },
              {
                "label": "Arabic (Oman)",
                "value": "ar_OM"
              },
              {
                "label": "Arabic (Palestinian Territories)",
                "value": "ar_PS"
              },
              {
                "label": "Arabic (Qatar)",
                "value": "ar_QA"
              },
              {
                "label": "Arabic (Saudi Arabia)",
                "value": "ar_SA"
              },
              {
                "label": "Arabic (Somalia)",
                "value": "ar_SO"
              },
              {
                "label": "Arabic (South Sudan)",
                "value": "ar_SS"
              },
              {
                "label": "Arabic (Sudan)",
                "value": "ar_SD"
              },
              {
                "label": "Arabic (Syria)",
                "value": "ar_SY"
              },
              {
                "label": "Arabic (Tunisia)",
                "value": "ar_TN"
              },
              {
                "label": "Arabic (United Arab Emirates)",
                "value": "ar_AE"
              },
              {
                "label": "Arabic (Western Sahara)",
                "value": "ar_EH"
              },
              {
                "label": "Arabic (World)",
                "value": "ar_001"
              },
              {
                "label": "Arabic (Yemen)",
                "value": "ar_YE"
              },
              {
                "label": "Armenian",
                "value": "hy"
              },
              {
                "label": "Armenian (Armenia)",
                "value": "hy_AM"
              },
              {
                "label": "Assamese",
                "value": "as"
              },
              {
                "label": "Assamese (India)",
                "value": "as_IN"
              },
              {
                "label": "Azerbaijani",
                "value": "az"
              },
              {
                "label": "Azerbaijani (Azerbaijan)",
                "value": "az_AZ"
              },
              {
                "label": "Azerbaijani (Cyrillic, Azerbaijan)",
                "value": "az_Cyrl_AZ"
              },
              {
                "label": "Azerbaijani (Cyrillic)",
                "value": "az_Cyrl"
              },
              {
                "label": "Azerbaijani (Latin, Azerbaijan)",
                "value": "az_Latn_AZ"
              },
              {
                "label": "Azerbaijani (Latin)",
                "value": "az_Latn"
              },
              {
                "label": "Bambara",
                "value": "bm"
              },
              {
                "label": "Bambara (Mali)",
                "value": "bm_ML"
              },
              {
                "label": "Bangla",
                "value": "bn"
              },
              {
                "label": "Bangla (Bangladesh)",
                "value": "bn_BD"
              },
              {
                "label": "Bangla (India)",
                "value": "bn_IN"
              },
              {
                "label": "Basque",
                "value": "eu"
              },
              {
                "label": "Basque (Spain)",
                "value": "eu_ES"
              },
              {
                "label": "Belarusian",
                "value": "be"
              },
              {
                "label": "Belarusian (Belarus)",
                "value": "be_BY"
              },
              {
                "label": "Bosnian",
                "value": "bs"
              },
              {
                "label": "Bosnian (Bosnia & Herzegovina)",
                "value": "bs_BA"
              },
              {
                "label": "Bosnian (Cyrillic, Bosnia & Herzegovina)",
                "value": "bs_Cyrl_BA"
              },
              {
                "label": "Bosnian (Cyrillic)",
                "value": "bs_Cyrl"
              },
              {
                "label": "Bosnian (Latin, Bosnia & Herzegovina)",
                "value": "bs_Latn_BA"
              },
              {
                "label": "Bosnian (Latin)",
                "value": "bs_Latn"
              },
              {
                "label": "Breton",
                "value": "br"
              },
              {
                "label": "Breton (France)",
                "value": "br_FR"
              },
              {
                "label": "Bulgarian",
                "value": "bg"
              },
              {
                "label": "Bulgarian (Bulgaria)",
                "value": "bg_BG"
              },
              {
                "label": "Burmese",
                "value": "my"
              },
              {
                "label": "Burmese (Myanmar [Burma])",
                "value": "my_MM"
              },
              {
                "label": "Catalan",
                "value": "ca"
              },
              {
                "label": "Catalan (Andorra)",
                "value": "ca_AD"
              },
              {
                "label": "Catalan (France)",
                "value": "ca_FR"
              },
              {
                "label": "Catalan (Italy)",
                "value": "ca_IT"
              },
              {
                "label": "Catalan (Spain)",
                "value": "ca_ES"
              },
              {
                "label": "Chechen",
                "value": "ce"
              },
              {
                "label": "Chechen (Russia)",
                "value": "ce_RU"
              },
              {
                "label": "Chinese",
                "value": "zh"
              },
              {
                "label": "Chinese (China)",
                "value": "zh_CN"
              },
              {
                "label": "Chinese (Hong Kong SAR China)",
                "value": "zh_HK"
              },
              {
                "label": "Chinese (Macao SAR China)",
                "value": "zh_MO"
              },
              {
                "label": "Chinese (Simplified, China)",
                "value": "zh_Hans_CN"
              },
              {
                "label": "Chinese (Simplified, Hong Kong SAR China)",
                "value": "zh_Hans_HK"
              },
              {
                "label": "Chinese (Simplified, Macao SAR China)",
                "value": "zh_Hans_MO"
              },
              {
                "label": "Chinese (Simplified, Singapore)",
                "value": "zh_Hans_SG"
              },
              {
                "label": "Chinese (Simplified)",
                "value": "zh_Hans"
              },
              {
                "label": "Chinese (Singapore)",
                "value": "zh_SG"
              },
              {
                "label": "Chinese (Taiwan)",
                "value": "zh_TW"
              },
              {
                "label": "Chinese (Traditional, Hong Kong SAR China)",
                "value": "zh_Hant_HK"
              },
              {
                "label": "Chinese (Traditional, Macao SAR China)",
                "value": "zh_Hant_MO"
              },
              {
                "label": "Chinese (Traditional, Taiwan)",
                "value": "zh_Hant_TW"
              },
              {
                "label": "Chinese (Traditional)",
                "value": "zh_Hant"
              },
              {
                "label": "Cornish",
                "value": "kw"
              },
              {
                "label": "Cornish (United Kingdom)",
                "value": "kw_GB"
              },
              {
                "label": "Croatian",
                "value": "hr"
              },
              {
                "label": "Croatian (Bosnia & Herzegovina)",
                "value": "hr_BA"
              },
              {
                "label": "Croatian (Croatia)",
                "value": "hr_HR"
              },
              {
                "label": "Czech",
                "value": "cs"
              },
              {
                "label": "Czech (Czechia)",
                "value": "cs_CZ"
              },
              {
                "label": "Danish",
                "value": "da"
              },
              {
                "label": "Danish (Denmark)",
                "value": "da_DK"
              },
              {
                "label": "Danish (Greenland)",
                "value": "da_GL"
              },
              {
                "label": "Dutch",
                "value": "nl"
              },
              {
                "label": "Dutch (Aruba)",
                "value": "nl_AW"
              },
              {
                "label": "Dutch (Belgium)",
                "value": "nl_BE"
              },
              {
                "label": "Dutch (Caribbean Netherlands)",
                "value": "nl_BQ"
              },
              {
                "label": "Dutch (Curaçao)",
                "value": "nl_CW"
              },
              {
                "label": "Dutch (Netherlands)",
                "value": "nl_NL"
              },
              {
                "label": "Dutch (Sint Maarten)",
                "value": "nl_SX"
              },
              {
                "label": "Dutch (Suriname)",
                "value": "nl_SR"
              },
              {
                "label": "Dzongkha",
                "value": "dz"
              },
              {
                "label": "Dzongkha (Bhutan)",
                "value": "dz_BT"
              },
              {
                "label": "English",
                "value": "en"
              },
              {
                "label": "English (American Samoa)",
                "value": "en_AS"
              },
              {
                "label": "English (Anguilla)",
                "value": "en_AI"
              },
              {
                "label": "English (Antigua & Barbuda)",
                "value": "en_AG"
              },
              {
                "label": "English (Australia)",
                "value": "en_AU"
              },
              {
                "label": "English (Austria)",
                "value": "en_AT"
              },
              {
                "label": "English (Bahamas)",
                "value": "en_BS"
              },
              {
                "label": "English (Barbados)",
                "value": "en_BB"
              },
              {
                "label": "English (Belgium)",
                "value": "en_BE"
              },
              {
                "label": "English (Belize)",
                "value": "en_BZ"
              },
              {
                "label": "English (Bermuda)",
                "value": "en_BM"
              },
              {
                "label": "English (Botswana)",
                "value": "en_BW"
              },
              {
                "label": "English (British Indian Ocean Territory)",
                "value": "en_IO"
              },
              {
                "label": "English (British Virgin Islands)",
                "value": "en_VG"
              },
              {
                "label": "English (Burundi)",
                "value": "en_BI"
              },
              {
                "label": "English (Cameroon)",
                "value": "en_CM"
              },
              {
                "label": "English (Canada)",
                "value": "en_CA"
              },
              {
                "label": "English (Cayman Islands)",
                "value": "en_KY"
              },
              {
                "label": "English (Christmas Island)",
                "value": "en_CX"
              },
              {
                "label": "English (Cocos [Keeling] Islands)",
                "value": "en_CC"
              },
              {
                "label": "English (Cook Islands)",
                "value": "en_CK"
              },
              {
                "label": "English (Cyprus)",
                "value": "en_CY"
              },
              {
                "label": "English (Denmark)",
                "value": "en_DK"
              },
              {
                "label": "English (Dominica)",
                "value": "en_DM"
              },
              {
                "label": "English (Eritrea)",
                "value": "en_ER"
              },
              {
                "label": "English (Eswatini)",
                "value": "en_SZ"
              },
              {
                "label": "English (Europe)",
                "value": "en_150"
              },
              {
                "label": "English (Falkland Islands)",
                "value": "en_FK"
              },
              {
                "label": "English (Fiji)",
                "value": "en_FJ"
              },
              {
                "label": "English (Finland)",
                "value": "en_FI"
              },
              {
                "label": "English (Gambia)",
                "value": "en_GM"
              },
              {
                "label": "English (Germany)",
                "value": "en_DE"
              },
              {
                "label": "English (Ghana)",
                "value": "en_GH"
              },
              {
                "label": "English (Gibraltar)",
                "value": "en_GI"
              },
              {
                "label": "English (Grenada)",
                "value": "en_GD"
              },
              {
                "label": "English (Guam)",
                "value": "en_GU"
              },
              {
                "label": "English (Guernsey)",
                "value": "en_GG"
              },
              {
                "label": "English (Guyana)",
                "value": "en_GY"
              },
              {
                "label": "English (Hong Kong SAR China)",
                "value": "en_HK"
              },
              {
                "label": "English (India)",
                "value": "en_IN"
              },
              {
                "label": "English (Ireland)",
                "value": "en_IE"
              },
              {
                "label": "English (Isle of Man)",
                "value": "en_IM"
              },
              {
                "label": "English (Israel)",
                "value": "en_IL"
              },
              {
                "label": "English (Jamaica)",
                "value": "en_JM"
              },
              {
                "label": "English (Jersey)",
                "value": "en_JE"
              },
              {
                "label": "English (Kenya)",
                "value": "en_KE"
              },
              {
                "label": "English (Kiribati)",
                "value": "en_KI"
              },
              {
                "label": "English (Lesotho)",
                "value": "en_LS"
              },
              {
                "label": "English (Liberia)",
                "value": "en_LR"
              },
              {
                "label": "English (Macao SAR China)",
                "value": "en_MO"
              },
              {
                "label": "English (Madagascar)",
                "value": "en_MG"
              },
              {
                "label": "English (Malawi)",
                "value": "en_MW"
              },
              {
                "label": "English (Malaysia)",
                "value": "en_MY"
              },
              {
                "label": "English (Malta)",
                "value": "en_MT"
              },
              {
                "label": "English (Marshall Islands)",
                "value": "en_MH"
              },
              {
                "label": "English (Mauritius)",
                "value": "en_MU"
              },
              {
                "label": "English (Micronesia)",
                "value": "en_FM"
              },
              {
                "label": "English (Montserrat)",
                "value": "en_MS"
              },
              {
                "label": "English (Namibia)",
                "value": "en_NA"
              },
              {
                "label": "English (Nauru)",
                "value": "en_NR"
              },
              {
                "label": "English (Netherlands)",
                "value": "en_NL"
              },
              {
                "label": "English (New Zealand)",
                "value": "en_NZ"
              },
              {
                "label": "English (Nigeria)",
                "value": "en_NG"
              },
              {
                "label": "English (Niue)",
                "value": "en_NU"
              },
              {
                "label": "English (Norfolk Island)",
                "value": "en_NF"
              },
              {
                "label": "English (Northern Mariana Islands)",
                "value": "en_MP"
              },
              {
                "label": "English (Pakistan)",
                "value": "en_PK"
              },
              {
                "label": "English (Palau)",
                "value": "en_PW"
              },
              {
                "label": "English (Papua New Guinea)",
                "value": "en_PG"
              },
              {
                "label": "English (Philippines)",
                "value": "en_PH"
              },
              {
                "label": "English (Pitcairn Islands)",
                "value": "en_PN"
              },
              {
                "label": "English (Puerto Rico)",
                "value": "en_PR"
              },
              {
                "label": "English (Rwanda)",
                "value": "en_RW"
              },
              {
                "label": "English (Samoa)",
                "value": "en_WS"
              },
              {
                "label": "English (Seychelles)",
                "value": "en_SC"
              },
              {
                "label": "English (Sierra Leone)",
                "value": "en_SL"
              },
              {
                "label": "English (Singapore)",
                "value": "en_SG"
              },
              {
                "label": "English (Sint Maarten)",
                "value": "en_SX"
              },
              {
                "label": "English (Slovenia)",
                "value": "en_SI"
              },
              {
                "label": "English (Solomon Islands)",
                "value": "en_SB"
              },
              {
                "label": "English (South Africa)",
                "value": "en_ZA"
              },
              {
                "label": "English (South Sudan)",
                "value": "en_SS"
              },
              {
                "label": "English (St. Helena)",
                "value": "en_SH"
              },
              {
                "label": "English (St. Kitts & Nevis)",
                "value": "en_KN"
              },
              {
                "label": "English (St. Lucia)",
                "value": "en_LC"
              },
              {
                "label": "English (St. Vincent & Grenadines)",
                "value": "en_VC"
              },
              {
                "label": "English (Sudan)",
                "value": "en_SD"
              },
              {
                "label": "English (Sweden)",
                "value": "en_SE"
              },
              {
                "label": "English (Switzerland)",
                "value": "en_CH"
              },
              {
                "label": "English (Tanzania)",
                "value": "en_TZ"
              },
              {
                "label": "English (Tokelau)",
                "value": "en_TK"
              },
              {
                "label": "English (Tonga)",
                "value": "en_TO"
              },
              {
                "label": "English (Trinidad & Tobago)",
                "value": "en_TT"
              },
              {
                "label": "English (Turks & Caicos Islands)",
                "value": "en_TC"
              },
              {
                "label": "English (Tuvalu)",
                "value": "en_TV"
              },
              {
                "label": "English (U.S. Outlying Islands)",
                "value": "en_UM"
              },
              {
                "label": "English (U.S. Virgin Islands)",
                "value": "en_VI"
              },
              {
                "label": "English (Uganda)",
                "value": "en_UG"
              },
              {
                "label": "English (United Arab Emirates)",
                "value": "en_AE"
              },
              {
                "label": "English (United Kingdom)",
                "value": "en_GB"
              },
              {
                "label": "English (United States)",
                "value": "en_US"
              },
              {
                "label": "English (Vanuatu)",
                "value": "en_VU"
              },
              {
                "label": "English (World)",
                "value": "en_001"
              },
              {
                "label": "English (Zambia)",
                "value": "en_ZM"
              },
              {
                "label": "English (Zimbabwe)",
                "value": "en_ZW"
              },
              {
                "label": "Esperanto",
                "value": "eo"
              },
              {
                "label": "Esperanto (World)",
                "value": "eo_001"
              },
              {
                "label": "Estonian",
                "value": "et"
              },
              {
                "label": "Estonian (Estonia)",
                "value": "et_EE"
              },
              {
                "label": "Ewe",
                "value": "ee"
              },
              {
                "label": "Ewe (Ghana)",
                "value": "ee_GH"
              },
              {
                "label": "Ewe (Togo)",
                "value": "ee_TG"
              },
              {
                "label": "Faroese",
                "value": "fo"
              },
              {
                "label": "Faroese (Denmark)",
                "value": "fo_DK"
              },
              {
                "label": "Faroese (Faroe Islands)",
                "value": "fo_FO"
              },
              {
                "label": "Finnish",
                "value": "fi"
              },
              {
                "label": "Finnish (Finland)",
                "value": "fi_FI"
              },
              {
                "label": "French",
                "value": "fr"
              },
              {
                "label": "French (Algeria)",
                "value": "fr_DZ"
              },
              {
                "label": "French (Belgium)",
                "value": "fr_BE"
              },
              {
                "label": "French (Benin)",
                "value": "fr_BJ"
              },
              {
                "label": "French (Burkina Faso)",
                "value": "fr_BF"
              },
              {
                "label": "French (Burundi)",
                "value": "fr_BI"
              },
              {
                "label": "French (Cameroon)",
                "value": "fr_CM"
              },
              {
                "label": "French (Canada)",
                "value": "fr_CA"
              },
              {
                "label": "French (Central African Republic)",
                "value": "fr_CF"
              },
              {
                "label": "French (Chad)",
                "value": "fr_TD"
              },
              {
                "label": "French (Comoros)",
                "value": "fr_KM"
              },
              {
                "label": "French (Congo - Brazzaville)",
                "value": "fr_CG"
              },
              {
                "label": "French (Congo - Kinshasa)",
                "value": "fr_CD"
              },
              {
                "label": "French (Côte d’Ivoire)",
                "value": "fr_CI"
              },
              {
                "label": "French (Djibouti)",
                "value": "fr_DJ"
              },
              {
                "label": "French (Equatorial Guinea)",
                "value": "fr_GQ"
              },
              {
                "label": "French (France)",
                "value": "fr_FR"
              },
              {
                "label": "French (French Guiana)",
                "value": "fr_GF"
              },
              {
                "label": "French (French Polynesia)",
                "value": "fr_PF"
              },
              {
                "label": "French (Gabon)",
                "value": "fr_GA"
              },
              {
                "label": "French (Guadeloupe)",
                "value": "fr_GP"
              },
              {
                "label": "French (Guinea)",
                "value": "fr_GN"
              },
              {
                "label": "French (Haiti)",
                "value": "fr_HT"
              },
              {
                "label": "French (Luxembourg)",
                "value": "fr_LU"
              },
              {
                "label": "French (Madagascar)",
                "value": "fr_MG"
              },
              {
                "label": "French (Mali)",
                "value": "fr_ML"
              },
              {
                "label": "French (Martinique)",
                "value": "fr_MQ"
              },
              {
                "label": "French (Mauritania)",
                "value": "fr_MR"
              },
              {
                "label": "French (Mauritius)",
                "value": "fr_MU"
              },
              {
                "label": "French (Mayotte)",
                "value": "fr_YT"
              },
              {
                "label": "French (Monaco)",
                "value": "fr_MC"
              },
              {
                "label": "French (Morocco)",
                "value": "fr_MA"
              },
              {
                "label": "French (New Caledonia)",
                "value": "fr_NC"
              },
              {
                "label": "French (Niger)",
                "value": "fr_NE"
              },
              {
                "label": "French (Réunion)",
                "value": "fr_RE"
              },
              {
                "label": "French (Rwanda)",
                "value": "fr_RW"
              },
              {
                "label": "French (Senegal)",
                "value": "fr_SN"
              },
              {
                "label": "French (Seychelles)",
                "value": "fr_SC"
              },
              {
                "label": "French (St. Barthélemy)",
                "value": "fr_BL"
              },
              {
                "label": "French (St. Martin)",
                "value": "fr_MF"
              },
              {
                "label": "French (St. Pierre & Miquelon)",
                "value": "fr_PM"
              },
              {
                "label": "French (Switzerland)",
                "value": "fr_CH"
              },
              {
                "label": "French (Syria)",
                "value": "fr_SY"
              },
              {
                "label": "French (Togo)",
                "value": "fr_TG"
              },
              {
                "label": "French (Tunisia)",
                "value": "fr_TN"
              },
              {
                "label": "French (Vanuatu)",
                "value": "fr_VU"
              },
              {
                "label": "French (Wallis & Futuna)",
                "value": "fr_WF"
              },
              {
                "label": "Fulah",
                "value": "ff"
              },
              {
                "label": "Fulah (Adlam, Burkina Faso)",
                "value": "ff_Adlm_BF"
              },
              {
                "label": "Fulah (Adlam, Cameroon)",
                "value": "ff_Adlm_CM"
              },
              {
                "label": "Fulah (Adlam, Gambia)",
                "value": "ff_Adlm_GM"
              },
              {
                "label": "Fulah (Adlam, Ghana)",
                "value": "ff_Adlm_GH"
              },
              {
                "label": "Fulah (Adlam, Guinea-Bissau)",
                "value": "ff_Adlm_GW"
              },
              {
                "label": "Fulah (Adlam, Guinea)",
                "value": "ff_Adlm_GN"
              },
              {
                "label": "Fulah (Adlam, Liberia)",
                "value": "ff_Adlm_LR"
              },
              {
                "label": "Fulah (Adlam, Mauritania)",
                "value": "ff_Adlm_MR"
              },
              {
                "label": "Fulah (Adlam, Niger)",
                "value": "ff_Adlm_NE"
              },
              {
                "label": "Fulah (Adlam, Nigeria)",
                "value": "ff_Adlm_NG"
              },
              {
                "label": "Fulah (Adlam, Senegal)",
                "value": "ff_Adlm_SN"
              },
              {
                "label": "Fulah (Adlam, Sierra Leone)",
                "value": "ff_Adlm_SL"
              },
              {
                "label": "Fulah (Adlam)",
                "value": "ff_Adlm"
              },
              {
                "label": "Fulah (Cameroon)",
                "value": "ff_CM"
              },
              {
                "label": "Fulah (Guinea)",
                "value": "ff_GN"
              },
              {
                "label": "Fulah (Latin, Burkina Faso)",
                "value": "ff_Latn_BF"
              },
              {
                "label": "Fulah (Latin, Cameroon)",
                "value": "ff_Latn_CM"
              },
              {
                "label": "Fulah (Latin, Gambia)",
                "value": "ff_Latn_GM"
              },
              {
                "label": "Fulah (Latin, Ghana)",
                "value": "ff_Latn_GH"
              },
              {
                "label": "Fulah (Latin, Guinea-Bissau)",
                "value": "ff_Latn_GW"
              },
              {
                "label": "Fulah (Latin, Guinea)",
                "value": "ff_Latn_GN"
              },
              {
                "label": "Fulah (Latin, Liberia)",
                "value": "ff_Latn_LR"
              },
              {
                "label": "Fulah (Latin, Mauritania)",
                "value": "ff_Latn_MR"
              },
              {
                "label": "Fulah (Latin, Niger)",
                "value": "ff_Latn_NE"
              },
              {
                "label": "Fulah (Latin, Nigeria)",
                "value": "ff_Latn_NG"
              },
              {
                "label": "Fulah (Latin, Senegal)",
                "value": "ff_Latn_SN"
              },
              {
                "label": "Fulah (Latin, Sierra Leone)",
                "value": "ff_Latn_SL"
              },
              {
                "label": "Fulah (Latin)",
                "value": "ff_Latn"
              },
              {
                "label": "Fulah (Mauritania)",
                "value": "ff_MR"
              },
              {
                "label": "Fulah (Senegal)",
                "value": "ff_SN"
              },
              {
                "label": "Galician",
                "value": "gl"
              },
              {
                "label": "Galician (Spain)",
                "value": "gl_ES"
              },
              {
                "label": "Ganda",
                "value": "lg"
              },
              {
                "label": "Ganda (Uganda)",
                "value": "lg_UG"
              },
              {
                "label": "Georgian",
                "value": "ka"
              },
              {
                "label": "Georgian (Georgia)",
                "value": "ka_GE"
              },
              {
                "label": "German",
                "value": "de"
              },
              {
                "label": "German (Austria)",
                "value": "de_AT"
              },
              {
                "label": "German (Belgium)",
                "value": "de_BE"
              },
              {
                "label": "German (Germany)",
                "value": "de_DE"
              },
              {
                "label": "German (Italy)",
                "value": "de_IT"
              },
              {
                "label": "German (Liechtenstein)",
                "value": "de_LI"
              },
              {
                "label": "German (Luxembourg)",
                "value": "de_LU"
              },
              {
                "label": "German (Switzerland)",
                "value": "de_CH"
              },
              {
                "label": "Greek",
                "value": "el"
              },
              {
                "label": "Greek (Cyprus)",
                "value": "el_CY"
              },
              {
                "label": "Greek (Greece)",
                "value": "el_GR"
              },
              {
                "label": "Gujarati",
                "value": "gu"
              },
              {
                "label": "Gujarati (India)",
                "value": "gu_IN"
              },
              {
                "label": "Hausa",
                "value": "ha"
              },
              {
                "label": "Hausa (Ghana)",
                "value": "ha_GH"
              },
              {
                "label": "Hausa (Niger)",
                "value": "ha_NE"
              },
              {
                "label": "Hausa (Nigeria)",
                "value": "ha_NG"
              },
              {
                "label": "Hebrew",
                "value": "he"
              },
              {
                "label": "Hebrew (Israel)",
                "value": "he_IL"
              },
              {
                "label": "Hindi",
                "value": "hi"
              },
              {
                "label": "Hindi (India)",
                "value": "hi_IN"
              },
              {
                "label": "Hungarian",
                "value": "hu"
              },
              {
                "label": "Hungarian (Hungary)",
                "value": "hu_HU"
              },
              {
                "label": "Icelandic",
                "value": "is"
              },
              {
                "label": "Icelandic (Iceland)",
                "value": "is_IS"
              },
              {
                "label": "Igbo",
                "value": "ig"
              },
              {
                "label": "Igbo (Nigeria)",
                "value": "ig_NG"
              },
              {
                "label": "Indonesian",
                "value": "id"
              },
              {
                "label": "Indonesian (Indonesia)",
                "value": "id_ID"
              },
              {
                "label": "Interlingua",
                "value": "ia"
              },
              {
                "label": "Interlingua (World)",
                "value": "ia_001"
              },
              {
                "label": "Irish",
                "value": "ga"
              },
              {
                "label": "Irish (Ireland)",
                "value": "ga_IE"
              },
              {
                "label": "Irish (United Kingdom)",
                "value": "ga_GB"
              },
              {
                "label": "Italian",
                "value": "it"
              },
              {
                "label": "Italian (Italy)",
                "value": "it_IT"
              },
              {
                "label": "Italian (San Marino)",
                "value": "it_SM"
              },
              {
                "label": "Italian (Switzerland)",
                "value": "it_CH"
              },
              {
                "label": "Italian (Vatican City)",
                "value": "it_VA"
              },
              {
                "label": "Japanese",
                "value": "ja"
              },
              {
                "label": "Japanese (Japan)",
                "value": "ja_JP"
              },
              {
                "label": "Javanese",
                "value": "jv"
              },
              {
                "label": "Javanese (Indonesia)",
                "value": "jv_ID"
              },
              {
                "label": "Kalaallisut",
                "value": "kl"
              },
              {
                "label": "Kalaallisut (Greenland)",
                "value": "kl_GL"
              },
              {
                "label": "Kannada",
                "value": "kn"
              },
              {
                "label": "Kannada (India)",
                "value": "kn_IN"
              },
              {
                "label": "Kashmiri",
                "value": "ks"
              },
              {
                "label": "Kashmiri (Arabic, India)",
                "value": "ks_Arab_IN"
              },
              {
                "label": "Kashmiri (Arabic)",
                "value": "ks_Arab"
              },
              {
                "label": "Kashmiri (India)",
                "value": "ks_IN"
              },
              {
                "label": "Kazakh",
                "value": "kk"
              },
              {
                "label": "Kazakh (Kazakhstan)",
                "value": "kk_KZ"
              },
              {
                "label": "Khmer",
                "value": "km"
              },
              {
                "label": "Khmer (Cambodia)",
                "value": "km_KH"
              },
              {
                "label": "Kikuyu",
                "value": "ki"
              },
              {
                "label": "Kikuyu (Kenya)",
                "value": "ki_KE"
              },
              {
                "label": "Kinyarwanda",
                "value": "rw"
              },
              {
                "label": "Kinyarwanda (Rwanda)",
                "value": "rw_RW"
              },
              {
                "label": "Korean",
                "value": "ko"
              },
              {
                "label": "Korean (North Korea)",
                "value": "ko_KP"
              },
              {
                "label": "Korean (South Korea)",
                "value": "ko_KR"
              },
              {
                "label": "Kurdish",
                "value": "ku"
              },
              {
                "label": "Kurdish (Turkey)",
                "value": "ku_TR"
              },
              {
                "label": "Kyrgyz",
                "value": "ky"
              },
              {
                "label": "Kyrgyz (Kyrgyzstan)",
                "value": "ky_KG"
              },
              {
                "label": "Lao",
                "value": "lo"
              },
              {
                "label": "Lao (Laos)",
                "value": "lo_LA"
              },
              {
                "label": "Latvian",
                "value": "lv"
              },
              {
                "label": "Latvian (Latvia)",
                "value": "lv_LV"
              },
              {
                "label": "Lingala",
                "value": "ln"
              },
              {
                "label": "Lingala (Angola)",
                "value": "ln_AO"
              },
              {
                "label": "Lingala (Central African Republic)",
                "value": "ln_CF"
              },
              {
                "label": "Lingala (Congo - Brazzaville)",
                "value": "ln_CG"
              },
              {
                "label": "Lingala (Congo - Kinshasa)",
                "value": "ln_CD"
              },
              {
                "label": "Lithuanian",
                "value": "lt"
              },
              {
                "label": "Lithuanian (Lithuania)",
                "value": "lt_LT"
              },
              {
                "label": "Luba-Katanga",
                "value": "lu"
              },
              {
                "label": "Luba-Katanga (Congo - Kinshasa)",
                "value": "lu_CD"
              },
              {
                "label": "Luxembourgish",
                "value": "lb"
              },
              {
                "label": "Luxembourgish (Luxembourg)",
                "value": "lb_LU"
              },
              {
                "label": "Macedonian",
                "value": "mk"
              },
              {
                "label": "Macedonian (North Macedonia)",
                "value": "mk_MK"
              },
              {
                "label": "Malagasy",
                "value": "mg"
              },
              {
                "label": "Malagasy (Madagascar)",
                "value": "mg_MG"
              },
              {
                "label": "Malay",
                "value": "ms"
              },
              {
                "label": "Malay (Brunei)",
                "value": "ms_BN"
              },
              {
                "label": "Malay (Indonesia)",
                "value": "ms_ID"
              },
              {
                "label": "Malay (Malaysia)",
                "value": "ms_MY"
              },
              {
                "label": "Malay (Singapore)",
                "value": "ms_SG"
              },
              {
                "label": "Malayalam",
                "value": "ml"
              },
              {
                "label": "Malayalam (India)",
                "value": "ml_IN"
              },
              {
                "label": "Maltese",
                "value": "mt"
              },
              {
                "label": "Maltese (Malta)",
                "value": "mt_MT"
              },
              {
                "label": "Manx",
                "value": "gv"
              },
              {
                "label": "Manx (Isle of Man)",
                "value": "gv_IM"
              },
              {
                "label": "Maori",
                "value": "mi"
              },
              {
                "label": "Maori (New Zealand)",
                "value": "mi_NZ"
              },
              {
                "label": "Marathi",
                "value": "mr"
              },
              {
                "label": "Marathi (India)",
                "value": "mr_IN"
              },
              {
                "label": "Mongolian",
                "value": "mn"
              },
              {
                "label": "Mongolian (Mongolia)",
                "value": "mn_MN"
              },
              {
                "label": "Nepali",
                "value": "ne"
              },
              {
                "label": "Nepali (India)",
                "value": "ne_IN"
              },
              {
                "label": "Nepali (Nepal)",
                "value": "ne_NP"
              },
              {
                "label": "North Ndebele",
                "value": "nd"
              },
              {
                "label": "North Ndebele (Zimbabwe)",
                "value": "nd_ZW"
              },
              {
                "label": "Northern Sami",
                "value": "se"
              },
              {
                "label": "Northern Sami (Finland)",
                "value": "se_FI"
              },
              {
                "label": "Northern Sami (Norway)",
                "value": "se_NO"
              },
              {
                "label": "Northern Sami (Sweden)",
                "value": "se_SE"
              },
              {
                "label": "Norwegian",
                "value": "no"
              },
              {
                "label": "Norwegian (Norway)",
                "value": "no_NO"
              },
              {
                "label": "Norwegian Bokmål",
                "value": "nb"
              },
              {
                "label": "Norwegian Bokmål (Norway)",
                "value": "nb_NO"
              },
              {
                "label": "Norwegian Bokmål (Svalbard & Jan Mayen)",
                "value": "nb_SJ"
              },
              {
                "label": "Norwegian Nynorsk",
                "value": "nn"
              },
              {
                "label": "Norwegian Nynorsk (Norway)",
                "value": "nn_NO"
              },
              {
                "label": "Odia",
                "value": "or"
              },
              {
                "label": "Odia (India)",
                "value": "or_IN"
              },
              {
                "label": "Oromo",
                "value": "om"
              },
              {
                "label": "Oromo (Ethiopia)",
                "value": "om_ET"
              },
              {
                "label": "Oromo (Kenya)",
                "value": "om_KE"
              },
              {
                "label": "Ossetic",
                "value": "os"
              },
              {
                "label": "Ossetic (Georgia)",
                "value": "os_GE"
              },
              {
                "label": "Ossetic (Russia)",
                "value": "os_RU"
              },
              {
                "label": "Pashto",
                "value": "ps"
              },
              {
                "label": "Pashto (Afghanistan)",
                "value": "ps_AF"
              },
              {
                "label": "Pashto (Pakistan)",
                "value": "ps_PK"
              },
              {
                "label": "Persian",
                "value": "fa"
              },
              {
                "label": "Persian (Afghanistan)",
                "value": "fa_AF"
              },
              {
                "label": "Persian (Iran)",
                "value": "fa_IR"
              },
              {
                "label": "Polish",
                "value": "pl"
              },
              {
                "label": "Polish (Poland)",
                "value": "pl_PL"
              },
              {
                "label": "Portuguese",
                "value": "pt"
              },
              {
                "label": "Portuguese (Angola)",
                "value": "pt_AO"
              },
              {
                "label": "Portuguese (Brazil)",
                "value": "pt_BR"
              },
              {
                "label": "Portuguese (Cape Verde)",
                "value": "pt_CV"
              },
              {
                "label": "Portuguese (Equatorial Guinea)",
                "value": "pt_GQ"
              },
              {
                "label": "Portuguese (Guinea-Bissau)",
                "value": "pt_GW"
              },
              {
                "label": "Portuguese (Luxembourg)",
                "value": "pt_LU"
              },
              {
                "label": "Portuguese (Macao SAR China)",
                "value": "pt_MO"
              },
              {
                "label": "Portuguese (Mozambique)",
                "value": "pt_MZ"
              },
              {
                "label": "Portuguese (Portugal)",
                "value": "pt_PT"
              },
              {
                "label": "Portuguese (São Tomé & Príncipe)",
                "value": "pt_ST"
              },
              {
                "label": "Portuguese (Switzerland)",
                "value": "pt_CH"
              },
              {
                "label": "Portuguese (Timor-Leste)",
                "value": "pt_TL"
              },
              {
                "label": "Punjabi",
                "value": "pa"
              },
              {
                "label": "Punjabi (Arabic, Pakistan)",
                "value": "pa_Arab_PK"
              },
              {
                "label": "Punjabi (Arabic)",
                "value": "pa_Arab"
              },
              {
                "label": "Punjabi (Gurmukhi, India)",
                "value": "pa_Guru_IN"
              },
              {
                "label": "Punjabi (Gurmukhi)",
                "value": "pa_Guru"
              },
              {
                "label": "Punjabi (India)",
                "value": "pa_IN"
              },
              {
                "label": "Punjabi (Pakistan)",
                "value": "pa_PK"
              },
              {
                "label": "Quechua",
                "value": "qu"
              },
              {
                "label": "Quechua (Bolivia)",
                "value": "qu_BO"
              },
              {
                "label": "Quechua (Ecuador)",
                "value": "qu_EC"
              },
              {
                "label": "Quechua (Peru)",
                "value": "qu_PE"
              },
              {
                "label": "Romanian",
                "value": "ro"
              },
              {
                "label": "Romanian (Moldova)",
                "value": "ro_MD"
              },
              {
                "label": "Romanian (Romania)",
                "value": "ro_RO"
              },
              {
                "label": "Romansh",
                "value": "rm"
              },
              {
                "label": "Romansh (Switzerland)",
                "value": "rm_CH"
              },
              {
                "label": "Rundi",
                "value": "rn"
              },
              {
                "label": "Rundi (Burundi)",
                "value": "rn_BI"
              },
              {
                "label": "Russian",
                "value": "ru"
              },
              {
                "label": "Russian (Belarus)",
                "value": "ru_BY"
              },
              {
                "label": "Russian (Kazakhstan)",
                "value": "ru_KZ"
              },
              {
                "label": "Russian (Kyrgyzstan)",
                "value": "ru_KG"
              },
              {
                "label": "Russian (Moldova)",
                "value": "ru_MD"
              },
              {
                "label": "Russian (Russia)",
                "value": "ru_RU"
              },
              {
                "label": "Russian (Ukraine)",
                "value": "ru_UA"
              },
              {
                "label": "Sango",
                "value": "sg"
              },
              {
                "label": "Sango (Central African Republic)",
                "value": "sg_CF"
              },
              {
                "label": "Sanskrit",
                "value": "sa"
              },
              {
                "label": "Sanskrit (India)",
                "value": "sa_IN"
              },
              {
                "label": "Scottish Gaelic",
                "value": "gd"
              },
              {
                "label": "Scottish Gaelic (United Kingdom)",
                "value": "gd_GB"
              },
              {
                "label": "Serbian",
                "value": "sr"
              },
              {
                "label": "Serbian (Bosnia & Herzegovina)",
                "value": "sr_BA"
              },
              {
                "label": "Serbian (Cyrillic, Bosnia & Herzegovina)",
                "value": "sr_Cyrl_BA"
              },
              {
                "label": "Serbian (Cyrillic, Montenegro)",
                "value": "sr_Cyrl_ME"
              },
              {
                "label": "Serbian (Cyrillic, Serbia)",
                "value": "sr_Cyrl_RS"
              },
              {
                "label": "Serbian (Cyrillic)",
                "value": "sr_Cyrl"
              },
              {
                "label": "Serbian (Latin, Bosnia & Herzegovina)",
                "value": "sr_Latn_BA"
              },
              {
                "label": "Serbian (Latin, Montenegro)",
                "value": "sr_Latn_ME"
              },
              {
                "label": "Serbian (Latin, Serbia)",
                "value": "sr_Latn_RS"
              },
              {
                "label": "Serbian (Latin)",
                "value": "sr_Latn"
              },
              {
                "label": "Serbian (Montenegro)",
                "value": "sr_ME"
              },
              {
                "label": "Serbian (Serbia)",
                "value": "sr_RS"
              },
              {
                "label": "Serbo-Croatian",
                "value": "sh"
              },
              {
                "label": "Serbo-Croatian (Bosnia & Herzegovina)",
                "value": "sh_BA"
              },
              {
                "label": "Shona",
                "value": "sn"
              },
              {
                "label": "Shona (Zimbabwe)",
                "value": "sn_ZW"
              },
              {
                "label": "Sichuan Yi",
                "value": "ii"
              },
              {
                "label": "Sichuan Yi (China)",
                "value": "ii_CN"
              },
              {
                "label": "Sindhi",
                "value": "sd"
              },
              {
                "label": "Sindhi (Arabic, Pakistan)",
                "value": "sd_Arab_PK"
              },
              {
                "label": "Sindhi (Arabic)",
                "value": "sd_Arab"
              },
              {
                "label": "Sindhi (Devanagari, India)",
                "value": "sd_Deva_IN"
              },
              {
                "label": "Sindhi (Devanagari)",
                "value": "sd_Deva"
              },
              {
                "label": "Sindhi (Pakistan)",
                "value": "sd_PK"
              },
              {
                "label": "Sinhala",
                "value": "si"
              },
              {
                "label": "Sinhala (Sri Lanka)",
                "value": "si_LK"
              },
              {
                "label": "Slovak",
                "value": "sk"
              },
              {
                "label": "Slovak (Slovakia)",
                "value": "sk_SK"
              },
              {
                "label": "Slovenian",
                "value": "sl"
              },
              {
                "label": "Slovenian (Slovenia)",
                "value": "sl_SI"
              },
              {
                "label": "Somali",
                "value": "so"
              },
              {
                "label": "Somali (Djibouti)",
                "value": "so_DJ"
              },
              {
                "label": "Somali (Ethiopia)",
                "value": "so_ET"
              },
              {
                "label": "Somali (Kenya)",
                "value": "so_KE"
              },
              {
                "label": "Somali (Somalia)",
                "value": "so_SO"
              },
              {
                "label": "Spanish",
                "value": "es"
              },
              {
                "label": "Spanish (Argentina)",
                "value": "es_AR"
              },
              {
                "label": "Spanish (Belize)",
                "value": "es_BZ"
              },
              {
                "label": "Spanish (Bolivia)",
                "value": "es_BO"
              },
              {
                "label": "Spanish (Brazil)",
                "value": "es_BR"
              },
              {
                "label": "Spanish (Chile)",
                "value": "es_CL"
              },
              {
                "label": "Spanish (Colombia)",
                "value": "es_CO"
              },
              {
                "label": "Spanish (Costa Rica)",
                "value": "es_CR"
              },
              {
                "label": "Spanish (Cuba)",
                "value": "es_CU"
              },
              {
                "label": "Spanish (Dominican Republic)",
                "value": "es_DO"
              },
              {
                "label": "Spanish (Ecuador)",
                "value": "es_EC"
              },
              {
                "label": "Spanish (El Salvador)",
                "value": "es_SV"
              },
              {
                "label": "Spanish (Equatorial Guinea)",
                "value": "es_GQ"
              },
              {
                "label": "Spanish (Guatemala)",
                "value": "es_GT"
              },
              {
                "label": "Spanish (Honduras)",
                "value": "es_HN"
              },
              {
                "label": "Spanish (Latin America)",
                "value": "es_419"
              },
              {
                "label": "Spanish (Mexico)",
                "value": "es_MX"
              },
              {
                "label": "Spanish (Nicaragua)",
                "value": "es_NI"
              },
              {
                "label": "Spanish (Panama)",
                "value": "es_PA"
              },
              {
                "label": "Spanish (Paraguay)",
                "value": "es_PY"
              },
              {
                "label": "Spanish (Peru)",
                "value": "es_PE"
              },
              {
                "label": "Spanish (Philippines)",
                "value": "es_PH"
              },
              {
                "label": "Spanish (Puerto Rico)",
                "value": "es_PR"
              },
              {
                "label": "Spanish (Spain)",
                "value": "es_ES"
              },
              {
                "label": "Spanish (United States)",
                "value": "es_US"
              },
              {
                "label": "Spanish (Uruguay)",
                "value": "es_UY"
              },
              {
                "label": "Spanish (Venezuela)",
                "value": "es_VE"
              },
              {
                "label": "Sundanese",
                "value": "su"
              },
              {
                "label": "Sundanese (Indonesia)",
                "value": "su_ID"
              },
              {
                "label": "Sundanese (Latin, Indonesia)",
                "value": "su_Latn_ID"
              },
              {
                "label": "Sundanese (Latin)",
                "value": "su_Latn"
              },
              {
                "label": "Swahili",
                "value": "sw"
              },
              {
                "label": "Swahili (Congo - Kinshasa)",
                "value": "sw_CD"
              },
              {
                "label": "Swahili (Kenya)",
                "value": "sw_KE"
              },
              {
                "label": "Swahili (Tanzania)",
                "value": "sw_TZ"
              },
              {
                "label": "Swahili (Uganda)",
                "value": "sw_UG"
              },
              {
                "label": "Swedish",
                "value": "sv"
              },
              {
                "label": "Swedish (Åland Islands)",
                "value": "sv_AX"
              },
              {
                "label": "Swedish (Finland)",
                "value": "sv_FI"
              },
              {
                "label": "Swedish (Sweden)",
                "value": "sv_SE"
              },
              {
                "label": "Tagalog",
                "value": "tl"
              },
              {
                "label": "Tagalog (Philippines)",
                "value": "tl_PH"
              },
              {
                "label": "Tajik",
                "value": "tg"
              },
              {
                "label": "Tajik (Tajikistan)",
                "value": "tg_TJ"
              },
              {
                "label": "Tamil",
                "value": "ta"
              },
              {
                "label": "Tamil (India)",
                "value": "ta_IN"
              },
              {
                "label": "Tamil (Malaysia)",
                "value": "ta_MY"
              },
              {
                "label": "Tamil (Singapore)",
                "value": "ta_SG"
              },
              {
                "label": "Tamil (Sri Lanka)",
                "value": "ta_LK"
              },
              {
                "label": "Tatar",
                "value": "tt"
              },
              {
                "label": "Tatar (Russia)",
                "value": "tt_RU"
              },
              {
                "label": "Telugu",
                "value": "te"
              },
              {
                "label": "Telugu (India)",
                "value": "te_IN"
              },
              {
                "label": "Thai",
                "value": "th"
              },
              {
                "label": "Thai (Thailand)",
                "value": "th_TH"
              },
              {
                "label": "Tibetan",
                "value": "bo"
              },
              {
                "label": "Tibetan (China)",
                "value": "bo_CN"
              },
              {
                "label": "Tibetan (India)",
                "value": "bo_IN"
              },
              {
                "label": "Tigrinya",
                "value": "ti"
              },
              {
                "label": "Tigrinya (Eritrea)",
                "value": "ti_ER"
              },
              {
                "label": "Tigrinya (Ethiopia)",
                "value": "ti_ET"
              },
              {
                "label": "Tongan",
                "value": "to"
              },
              {
                "label": "Tongan (Tonga)",
                "value": "to_TO"
              },
              {
                "label": "Turkish",
                "value": "tr"
              },
              {
                "label": "Turkish (Cyprus)",
                "value": "tr_CY"
              },
              {
                "label": "Turkish (Turkey)",
                "value": "tr_TR"
              },
              {
                "label": "Turkmen",
                "value": "tk"
              },
              {
                "label": "Turkmen (Turkmenistan)",
                "value": "tk_TM"
              },
              {
                "label": "Ukrainian",
                "value": "uk"
              },
              {
                "label": "Ukrainian (Ukraine)",
                "value": "uk_UA"
              },
              {
                "label": "Urdu",
                "value": "ur"
              },
              {
                "label": "Urdu (India)",
                "value": "ur_IN"
              },
              {
                "label": "Urdu (Pakistan)",
                "value": "ur_PK"
              },
              {
                "label": "Uyghur",
                "value": "ug"
              },
              {
                "label": "Uyghur (China)",
                "value": "ug_CN"
              },
              {
                "label": "Uzbek",
                "value": "uz"
              },
              {
                "label": "Uzbek (Afghanistan)",
                "value": "uz_AF"
              },
              {
                "label": "Uzbek (Arabic, Afghanistan)",
                "value": "uz_Arab_AF"
              },
              {
                "label": "Uzbek (Arabic)",
                "value": "uz_Arab"
              },
              {
                "label": "Uzbek (Cyrillic, Uzbekistan)",
                "value": "uz_Cyrl_UZ"
              },
              {
                "label": "Uzbek (Cyrillic)",
                "value": "uz_Cyrl"
              },
              {
                "label": "Uzbek (Latin, Uzbekistan)",
                "value": "uz_Latn_UZ"
              },
              {
                "label": "Uzbek (Latin)",
                "value": "uz_Latn"
              },
              {
                "label": "Uzbek (Uzbekistan)",
                "value": "uz_UZ"
              },
              {
                "label": "Vietnamese",
                "value": "vi"
              },
              {
                "label": "Vietnamese (Vietnam)",
                "value": "vi_VN"
              },
              {
                "label": "Welsh",
                "value": "cy"
              },
              {
                "label": "Welsh (United Kingdom)",
                "value": "cy_GB"
              },
              {
                "label": "Western Frisian",
                "value": "fy"
              },
              {
                "label": "Western Frisian (Netherlands)",
                "value": "fy_NL"
              },
              {
                "label": "Wolof",
                "value": "wo"
              },
              {
                "label": "Wolof (Senegal)",
                "value": "wo_SN"
              },
              {
                "label": "Xhosa",
                "value": "xh"
              },
              {
                "label": "Xhosa (South Africa)",
                "value": "xh_ZA"
              },
              {
                "label": "Yiddish",
                "value": "yi"
              },
              {
                "label": "Yiddish (World)",
                "value": "yi_001"
              },
              {
                "label": "Yoruba",
                "value": "yo"
              },
              {
                "label": "Yoruba (Benin)",
                "value": "yo_BJ"
              },
              {
                "label": "Yoruba (Nigeria)",
                "value": "yo_NG"
              },
              {
                "label": "Zulu",
                "value": "zu"
              },
              {
                "label": "Zulu (South Africa)",
                "value": "zu_ZA"
              }
            ],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": false,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": [],
            "choice_self_translation": null
          },
          "errors": []
        },
        "timezone": {
          "id": "test_timezone",
          "name": "timezone",
          "type": "timezone",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_timezone",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [
              {
                "label": "Africa / Abidjan",
                "value": "Africa/Abidjan"
              },
              {
                "label": "Africa / Accra",
                "value": "Africa/Accra"
              },
              {
                "label": "Africa / Addis Ababa",
                "value": "Africa/Addis_Ababa"
              },
              {
                "label": "Africa / Algiers",
                "value": "Africa/Algiers"
              },
              {
                "label": "Africa / Asmara",
                "value": "Africa/Asmara"
              },
              {
                "label": "Africa / Bamako",
                "value": "Africa/Bamako"
              },
              {
                "label": "Africa / Bangui",
                "value": "Africa/Bangui"
              },
              {
                "label": "Africa / Banjul",
                "value": "Africa/Banjul"
              },
              {
                "label": "Africa / Bissau",
                "value": "Africa/Bissau"
              },
              {
                "label": "Africa / Blantyre",
                "value": "Africa/Blantyre"
              },
              {
                "label": "Africa / Brazzaville",
                "value": "Africa/Brazzaville"
              },
              {
                "label": "Africa / Bujumbura",
                "value": "Africa/Bujumbura"
              },
              {
                "label": "Africa / Cairo",
                "value": "Africa/Cairo"
              },
              {
                "label": "Africa / Casablanca",
                "value": "Africa/Casablanca"
              },
              {
                "label": "Africa / Ceuta",
                "value": "Africa/Ceuta"
              },
              {
                "label": "Africa / Conakry",
                "value": "Africa/Conakry"
              },
              {
                "label": "Africa / Dakar",
                "value": "Africa/Dakar"
              },
              {
                "label": "Africa / Dar es Salaam",
                "value": "Africa/Dar_es_Salaam"
              },
              {
                "label": "Africa / Djibouti",
                "value": "Africa/Djibouti"
              },
              {
                "label": "Africa / Douala",
                "value": "Africa/Douala"
              },
              {
                "label": "Africa / El Aaiun",
                "value": "Africa/El_Aaiun"
              },
              {
                "label": "Africa / Freetown",
                "value": "Africa/Freetown"
              },
              {
                "label": "Africa / Gaborone",
                "value": "Africa/Gaborone"
              },
              {
                "label": "Africa / Harare",
                "value": "Africa/Harare"
              },
              {
                "label": "Africa / Johannesburg",
                "value": "Africa/Johannesburg"
              },
              {
                "label": "Africa / Juba",
                "value": "Africa/Juba"
              },
              {
                "label": "Africa / Kampala",
                "value": "Africa/Kampala"
              },
              {
                "label": "Africa / Khartoum",
                "value": "Africa/Khartoum"
              },
              {
                "label": "Africa / Kigali",
                "value": "Africa/Kigali"
              },
              {
                "label": "Africa / Kinshasa",
                "value": "Africa/Kinshasa"
              },
              {
                "label": "Africa / Lagos",
                "value": "Africa/Lagos"
              },
              {
                "label": "Africa / Libreville",
                "value": "Africa/Libreville"
              },
              {
                "label": "Africa / Lome",
                "value": "Africa/Lome"
              },
              {
                "label": "Africa / Luanda",
                "value": "Africa/Luanda"
              },
              {
                "label": "Africa / Lubumbashi",
                "value": "Africa/Lubumbashi"
              },
              {
                "label": "Africa / Lusaka",
                "value": "Africa/Lusaka"
              },
              {
                "label": "Africa / Malabo",
                "value": "Africa/Malabo"
              },
              {
                "label": "Africa / Maputo",
                "value": "Africa/Maputo"
              },
              {
                "label": "Africa / Maseru",
                "value": "Africa/Maseru"
              },
              {
                "label": "Africa / Mbabane",
                "value": "Africa/Mbabane"
              },
              {
                "label": "Africa / Mogadishu",
                "value": "Africa/Mogadishu"
              },
              {
                "label": "Africa / Monrovia",
                "value": "Africa/Monrovia"
              },
              {
                "label": "Africa / Nairobi",
                "value": "Africa/Nairobi"
              },
              {
                "label": "Africa / Ndjamena",
                "value": "Africa/Ndjamena"
              },
              {
                "label": "Africa / Niamey",
                "value": "Africa/Niamey"
              },
              {
                "label": "Africa / Nouakchott",
                "value": "Africa/Nouakchott"
              },
              {
                "label": "Africa / Ouagadougou",
                "value": "Africa/Ouagadougou"
              },
              {
                "label": "Africa / Porto-Novo",
                "value": "Africa/Porto-Novo"
              },
              {
                "label": "Africa / Sao Tome",
                "value": "Africa/Sao_Tome"
              },
              {
                "label": "Africa / Tripoli",
                "value": "Africa/Tripoli"
              },
              {
                "label": "Africa / Tunis",
                "value": "Africa/Tunis"
              },
              {
                "label": "Africa / Windhoek",
                "value": "Africa/Windhoek"
              },
              {
                "label": "America / Adak",
                "value": "America/Adak"
              },
              {
                "label": "America / Anchorage",
                "value": "America/Anchorage"
              },
              {
                "label": "America / Anguilla",
                "value": "America/Anguilla"
              },
              {
                "label": "America / Antigua",
                "value": "America/Antigua"
              },
              {
                "label": "America / Araguaina",
                "value": "America/Araguaina"
              },
              {
                "label": "America / Argentina / Buenos Aires",
                "value": "America/Argentina/Buenos_Aires"
              },
              {
                "label": "America / Argentina / Catamarca",
                "value": "America/Argentina/Catamarca"
              },
              {
                "label": "America / Argentina / Cordoba",
                "value": "America/Argentina/Cordoba"
              },
              {
                "label": "America / Argentina / Jujuy",
                "value": "America/Argentina/Jujuy"
              },
              {
                "label": "America / Argentina / La Rioja",
                "value": "America/Argentina/La_Rioja"
              },
              {
                "label": "America / Argentina / Mendoza",
                "value": "America/Argentina/Mendoza"
              },
              {
                "label": "America / Argentina / Rio Gallegos",
                "value": "America/Argentina/Rio_Gallegos"
              },
              {
                "label": "America / Argentina / Salta",
                "value": "America/Argentina/Salta"
              },
              {
                "label": "America / Argentina / San Juan",
                "value": "America/Argentina/San_Juan"
              },
              {
                "label": "America / Argentina / San Luis",
                "value": "America/Argentina/San_Luis"
              },
              {
                "label": "America / Argentina / Tucuman",
                "value": "America/Argentina/Tucuman"
              },
              {
                "label": "America / Argentina / Ushuaia",
                "value": "America/Argentina/Ushuaia"
              },
              {
                "label": "America / Aruba",
                "value": "America/Aruba"
              },
              {
                "label": "America / Asuncion",
                "value": "America/Asuncion"
              },
              {
                "label": "America / Atikokan",
                "value": "America/Atikokan"
              },
              {
                "label": "America / Bahia",
                "value": "America/Bahia"
              },
              {
                "label": "America / Bahia Banderas",
                "value": "America/Bahia_Banderas"
              },
              {
                "label": "America / Barbados",
                "value": "America/Barbados"
              },
              {
                "label": "America / Belem",
                "value": "America/Belem"
              },
              {
                "label": "America / Belize",
                "value": "America/Belize"
              },
              {
                "label": "America / Blanc-Sablon",
                "value": "America/Blanc-Sablon"
              },
              {
                "label": "America / Boa Vista",
                "value": "America/Boa_Vista"
              },
              {
                "label": "America / Bogota",
                "value": "America/Bogota"
              },
              {
                "label": "America / Boise",
                "value": "America/Boise"
              },
              {
                "label": "America / Cambridge Bay",
                "value": "America/Cambridge_Bay"
              },
              {
                "label": "America / Campo Grande",
                "value": "America/Campo_Grande"
              },
              {
                "label": "America / Cancun",
                "value": "America/Cancun"
              },
              {
                "label": "America / Caracas",
                "value": "America/Caracas"
              },
              {
                "label": "America / Cayenne",
                "value": "America/Cayenne"
              },
              {
                "label": "America / Cayman",
                "value": "America/Cayman"
              },
              {
                "label": "America / Chicago",
                "value": "America/Chicago"
              },
              {
                "label": "America / Chihuahua",
                "value": "America/Chihuahua"
              },
              {
                "label": "America / Costa Rica",
                "value": "America/Costa_Rica"
              },
              {
                "label": "America / Creston",
                "value": "America/Creston"
              },
              {
                "label": "America / Cuiaba",
                "value": "America/Cuiaba"
              },
              {
                "label": "America / Curacao",
                "value": "America/Curacao"
              },
              {
                "label": "America / Danmarkshavn",
                "value": "America/Danmarkshavn"
              },
              {
                "label": "America / Dawson",
                "value": "America/Dawson"
              },
              {
                "label": "America / Dawson Creek",
                "value": "America/Dawson_Creek"
              },
              {
                "label": "America / Denver",
                "value": "America/Denver"
              },
              {
                "label": "America / Detroit",
                "value": "America/Detroit"
              },
              {
                "label": "America / Dominica",
                "value": "America/Dominica"
              },
              {
                "label": "America / Edmonton",
                "value": "America/Edmonton"
              },
              {
                "label": "America / Eirunepe",
                "value": "America/Eirunepe"
              },
              {
                "label": "America / El Salvador",
                "value": "America/El_Salvador"
              },
              {
                "label": "America / Fort Nelson",
                "value": "America/Fort_Nelson"
              },
              {
                "label": "America / Fortaleza",
                "value": "America/Fortaleza"
              },
              {
                "label": "America / Glace Bay",
                "value": "America/Glace_Bay"
              },
              {
                "label": "America / Goose Bay",
                "value": "America/Goose_Bay"
              },
              {
                "label": "America / Grand Turk",
                "value": "America/Grand_Turk"
              },
              {
                "label": "America / Grenada",
                "value": "America/Grenada"
              },
              {
                "label": "America / Guadeloupe",
                "value": "America/Guadeloupe"
              },
              {
                "label": "America / Guatemala",
                "value": "America/Guatemala"
              },
              {
                "label": "America / Guayaquil",
                "value": "America/Guayaquil"
              },
              {
                "label": "America / Guyana",
                "value": "America/Guyana"
              },
              {
                "label": "America / Halifax",
                "value": "America/Halifax"
              },
              {
                "label": "America / Havana",
                "value": "America/Havana"
              },
              {
                "label": "America / Hermosillo",
                "value": "America/Hermosillo"
              },
              {
                "label": "America / Indiana / Indianapolis",
                "value": "America/Indiana/Indianapolis"
              },
              {
                "label": "America / Indiana / Knox",
                "value": "America/Indiana/Knox"
              },
              {
                "label": "America / Indiana / Marengo",
                "value": "America/Indiana/Marengo"
              },
              {
                "label": "America / Indiana / Petersburg",
                "value": "America/Indiana/Petersburg"
              },
              {
                "label": "America / Indiana / Tell City",
                "value": "America/Indiana/Tell_City"
              },
              {
                "label": "America / Indiana / Vevay",
                "value": "America/Indiana/Vevay"
              },
              {
                "label": "America / Indiana / Vincennes",
                "value": "America/Indiana/Vincennes"
              },
              {
                "label": "America / Indiana / Winamac",
                "value": "America/Indiana/Winamac"
              },
              {
                "label": "America / Inuvik",
                "value": "America/Inuvik"
              },
              {
                "label": "America / Iqaluit",
                "value": "America/Iqaluit"
              },
              {
                "label": "America / Jamaica",
                "value": "America/Jamaica"
              },
              {
                "label": "America / Juneau",
                "value": "America/Juneau"
              },
              {
                "label": "America / Kentucky / Louisville",
                "value": "America/Kentucky/Louisville"
              },
              {
                "label": "America / Kentucky / Monticello",
                "value": "America/Kentucky/Monticello"
              },
              {
                "label": "America / Kralendijk",
                "value": "America/Kralendijk"
              },
              {
                "label": "America / La Paz",
                "value": "America/La_Paz"
              },
              {
                "label": "America / Lima",
                "value": "America/Lima"
              },
              {
                "label": "America / Los Angeles",
                "value": "America/Los_Angeles"
              },
              {
                "label": "America / Lower Princes",
                "value": "America/Lower_Princes"
              },
              {
                "label": "America / Maceio",
                "value": "America/Maceio"
              },
              {
                "label": "America / Managua",
                "value": "America/Managua"
              },
              {
                "label": "America / Manaus",
                "value": "America/Manaus"
              },
              {
                "label": "America / Marigot",
                "value": "America/Marigot"
              },
              {
                "label": "America / Martinique",
                "value": "America/Martinique"
              },
              {
                "label": "America / Matamoros",
                "value": "America/Matamoros"
              },
              {
                "label": "America / Mazatlan",
                "value": "America/Mazatlan"
              },
              {
                "label": "America / Menominee",
                "value": "America/Menominee"
              },
              {
                "label": "America / Merida",
                "value": "America/Merida"
              },
              {
                "label": "America / Metlakatla",
                "value": "America/Metlakatla"
              },
              {
                "label": "America / Mexico City",
                "value": "America/Mexico_City"
              },
              {
                "label": "America / Miquelon",
                "value": "America/Miquelon"
              },
              {
                "label": "America / Moncton",
                "value": "America/Moncton"
              },
              {
                "label": "America / Monterrey",
                "value": "America/Monterrey"
              },
              {
                "label": "America / Montevideo",
                "value": "America/Montevideo"
              },
              {
                "label": "America / Montserrat",
                "value": "America/Montserrat"
              },
              {
                "label": "America / Nassau",
                "value": "America/Nassau"
              },
              {
                "label": "America / New York",
                "value": "America/New_York"
              },
              {
                "label": "America / Nipigon",
                "value": "America/Nipigon"
              },
              {
                "label": "America / Nome",
                "value": "America/Nome"
              },
              {
                "label": "America / Noronha",
                "value": "America/Noronha"
              },
              {
                "label": "America / North Dakota / Beulah",
                "value": "America/North_Dakota/Beulah"
              },
              {
                "label": "America / North Dakota / Center",
                "value": "America/North_Dakota/Center"
              },
              {
                "label": "America / North Dakota / New Salem",
                "value": "America/North_Dakota/New_Salem"
              },
              {
                "label": "America / Nuuk",
                "value": "America/Nuuk"
              },
              {
                "label": "America / Ojinaga",
                "value": "America/Ojinaga"
              },
              {
                "label": "America / Panama",
                "value": "America/Panama"
              },
              {
                "label": "America / Pangnirtung",
                "value": "America/Pangnirtung"
              },
              {
                "label": "America / Paramaribo",
                "value": "America/Paramaribo"
              },
              {
                "label": "America / Phoenix",
                "value": "America/Phoenix"
              },
              {
                "label": "America / Port-au-Prince",
                "value": "America/Port-au-Prince"
              },
              {
                "label": "America / Port of Spain",
                "value": "America/Port_of_Spain"
              },
              {
                "label": "America / Porto Velho",
                "value": "America/Porto_Velho"
              },
              {
                "label": "America / Puerto Rico",
                "value": "America/Puerto_Rico"
              },
              {
                "label": "America / Punta Arenas",
                "value": "America/Punta_Arenas"
              },
              {
                "label": "America / Rainy River",
                "value": "America/Rainy_River"
              },
              {
                "label": "America / Rankin Inlet",
                "value": "America/Rankin_Inlet"
              },
              {
                "label": "America / Recife",
                "value": "America/Recife"
              },
              {
                "label": "America / Regina",
                "value": "America/Regina"
              },
              {
                "label": "America / Resolute",
                "value": "America/Resolute"
              },
              {
                "label": "America / Rio Branco",
                "value": "America/Rio_Branco"
              },
              {
                "label": "America / Santarem",
                "value": "America/Santarem"
              },
              {
                "label": "America / Santiago",
                "value": "America/Santiago"
              },
              {
                "label": "America / Santo Domingo",
                "value": "America/Santo_Domingo"
              },
              {
                "label": "America / Sao Paulo",
                "value": "America/Sao_Paulo"
              },
              {
                "label": "America / Scoresbysund",
                "value": "America/Scoresbysund"
              },
              {
                "label": "America / Sitka",
                "value": "America/Sitka"
              },
              {
                "label": "America / St Barthelemy",
                "value": "America/St_Barthelemy"
              },
              {
                "label": "America / St Johns",
                "value": "America/St_Johns"
              },
              {
                "label": "America / St Kitts",
                "value": "America/St_Kitts"
              },
              {
                "label": "America / St Lucia",
                "value": "America/St_Lucia"
              },
              {
                "label": "America / St Thomas",
                "value": "America/St_Thomas"
              },
              {
                "label": "America / St Vincent",
                "value": "America/St_Vincent"
              },
              {
                "label": "America / Swift Current",
                "value": "America/Swift_Current"
              },
              {
                "label": "America / Tegucigalpa",
                "value": "America/Tegucigalpa"
              },
              {
                "label": "America / Thule",
                "value": "America/Thule"
              },
              {
                "label": "America / Thunder Bay",
                "value": "America/Thunder_Bay"
              },
              {
                "label": "America / Tijuana",
                "value": "America/Tijuana"
              },
              {
                "label": "America / Toronto",
                "value": "America/Toronto"
              },
              {
                "label": "America / Tortola",
                "value": "America/Tortola"
              },
              {
                "label": "America / Vancouver",
                "value": "America/Vancouver"
              },
              {
                "label": "America / Whitehorse",
                "value": "America/Whitehorse"
              },
              {
                "label": "America / Winnipeg",
                "value": "America/Winnipeg"
              },
              {
                "label": "America / Yakutat",
                "value": "America/Yakutat"
              },
              {
                "label": "America / Yellowknife",
                "value": "America/Yellowknife"
              },
              {
                "label": "Antarctica / Casey",
                "value": "Antarctica/Casey"
              },
              {
                "label": "Antarctica / Davis",
                "value": "Antarctica/Davis"
              },
              {
                "label": "Antarctica / DumontDUrville",
                "value": "Antarctica/DumontDUrville"
              },
              {
                "label": "Antarctica / Macquarie",
                "value": "Antarctica/Macquarie"
              },
              {
                "label": "Antarctica / Mawson",
                "value": "Antarctica/Mawson"
              },
              {
                "label": "Antarctica / McMurdo",
                "value": "Antarctica/McMurdo"
              },
              {
                "label": "Antarctica / Palmer",
                "value": "Antarctica/Palmer"
              },
              {
                "label": "Antarctica / Rothera",
                "value": "Antarctica/Rothera"
              },
              {
                "label": "Antarctica / Syowa",
                "value": "Antarctica/Syowa"
              },
              {
                "label": "Antarctica / Troll",
                "value": "Antarctica/Troll"
              },
              {
                "label": "Antarctica / Vostok",
                "value": "Antarctica/Vostok"
              },
              {
                "label": "Arctic / Longyearbyen",
                "value": "Arctic/Longyearbyen"
              },
              {
                "label": "Asia / Aden",
                "value": "Asia/Aden"
              },
              {
                "label": "Asia / Almaty",
                "value": "Asia/Almaty"
              },
              {
                "label": "Asia / Amman",
                "value": "Asia/Amman"
              },
              {
                "label": "Asia / Anadyr",
                "value": "Asia/Anadyr"
              },
              {
                "label": "Asia / Aqtau",
                "value": "Asia/Aqtau"
              },
              {
                "label": "Asia / Aqtobe",
                "value": "Asia/Aqtobe"
              },
              {
                "label": "Asia / Ashgabat",
                "value": "Asia/Ashgabat"
              },
              {
                "label": "Asia / Atyrau",
                "value": "Asia/Atyrau"
              },
              {
                "label": "Asia / Baghdad",
                "value": "Asia/Baghdad"
              },
              {
                "label": "Asia / Bahrain",
                "value": "Asia/Bahrain"
              },
              {
                "label": "Asia / Baku",
                "value": "Asia/Baku"
              },
              {
                "label": "Asia / Bangkok",
                "value": "Asia/Bangkok"
              },
              {
                "label": "Asia / Barnaul",
                "value": "Asia/Barnaul"
              },
              {
                "label": "Asia / Beirut",
                "value": "Asia/Beirut"
              },
              {
                "label": "Asia / Bishkek",
                "value": "Asia/Bishkek"
              },
              {
                "label": "Asia / Brunei",
                "value": "Asia/Brunei"
              },
              {
                "label": "Asia / Chita",
                "value": "Asia/Chita"
              },
              {
                "label": "Asia / Choibalsan",
                "value": "Asia/Choibalsan"
              },
              {
                "label": "Asia / Colombo",
                "value": "Asia/Colombo"
              },
              {
                "label": "Asia / Damascus",
                "value": "Asia/Damascus"
              },
              {
                "label": "Asia / Dhaka",
                "value": "Asia/Dhaka"
              },
              {
                "label": "Asia / Dili",
                "value": "Asia/Dili"
              },
              {
                "label": "Asia / Dubai",
                "value": "Asia/Dubai"
              },
              {
                "label": "Asia / Dushanbe",
                "value": "Asia/Dushanbe"
              },
              {
                "label": "Asia / Famagusta",
                "value": "Asia/Famagusta"
              },
              {
                "label": "Asia / Gaza",
                "value": "Asia/Gaza"
              },
              {
                "label": "Asia / Hebron",
                "value": "Asia/Hebron"
              },
              {
                "label": "Asia / Ho Chi Minh",
                "value": "Asia/Ho_Chi_Minh"
              },
              {
                "label": "Asia / Hong Kong",
                "value": "Asia/Hong_Kong"
              },
              {
                "label": "Asia / Hovd",
                "value": "Asia/Hovd"
              },
              {
                "label": "Asia / Irkutsk",
                "value": "Asia/Irkutsk"
              },
              {
                "label": "Asia / Jakarta",
                "value": "Asia/Jakarta"
              },
              {
                "label": "Asia / Jayapura",
                "value": "Asia/Jayapura"
              },
              {
                "label": "Asia / Jerusalem",
                "value": "Asia/Jerusalem"
              },
              {
                "label": "Asia / Kabul",
                "value": "Asia/Kabul"
              },
              {
                "label": "Asia / Kamchatka",
                "value": "Asia/Kamchatka"
              },
              {
                "label": "Asia / Karachi",
                "value": "Asia/Karachi"
              },
              {
                "label": "Asia / Kathmandu",
                "value": "Asia/Kathmandu"
              },
              {
                "label": "Asia / Khandyga",
                "value": "Asia/Khandyga"
              },
              {
                "label": "Asia / Kolkata",
                "value": "Asia/Kolkata"
              },
              {
                "label": "Asia / Krasnoyarsk",
                "value": "Asia/Krasnoyarsk"
              },
              {
                "label": "Asia / Kuala Lumpur",
                "value": "Asia/Kuala_Lumpur"
              },
              {
                "label": "Asia / Kuching",
                "value": "Asia/Kuching"
              },
              {
                "label": "Asia / Kuwait",
                "value": "Asia/Kuwait"
              },
              {
                "label": "Asia / Macau",
                "value": "Asia/Macau"
              },
              {
                "label": "Asia / Magadan",
                "value": "Asia/Magadan"
              },
              {
                "label": "Asia / Makassar",
                "value": "Asia/Makassar"
              },
              {
                "label": "Asia / Manila",
                "value": "Asia/Manila"
              },
              {
                "label": "Asia / Muscat",
                "value": "Asia/Muscat"
              },
              {
                "label": "Asia / Nicosia",
                "value": "Asia/Nicosia"
              },
              {
                "label": "Asia / Novokuznetsk",
                "value": "Asia/Novokuznetsk"
              },
              {
                "label": "Asia / Novosibirsk",
                "value": "Asia/Novosibirsk"
              },
              {
                "label": "Asia / Omsk",
                "value": "Asia/Omsk"
              },
              {
                "label": "Asia / Oral",
                "value": "Asia/Oral"
              },
              {
                "label": "Asia / Phnom Penh",
                "value": "Asia/Phnom_Penh"
              },
              {
                "label": "Asia / Pontianak",
                "value": "Asia/Pontianak"
              },
              {
                "label": "Asia / Pyongyang",
                "value": "Asia/Pyongyang"
              },
              {
                "label": "Asia / Qatar",
                "value": "Asia/Qatar"
              },
              {
                "label": "Asia / Qostanay",
                "value": "Asia/Qostanay"
              },
              {
                "label": "Asia / Qyzylorda",
                "value": "Asia/Qyzylorda"
              },
              {
                "label": "Asia / Riyadh",
                "value": "Asia/Riyadh"
              },
              {
                "label": "Asia / Sakhalin",
                "value": "Asia/Sakhalin"
              },
              {
                "label": "Asia / Samarkand",
                "value": "Asia/Samarkand"
              },
              {
                "label": "Asia / Seoul",
                "value": "Asia/Seoul"
              },
              {
                "label": "Asia / Shanghai",
                "value": "Asia/Shanghai"
              },
              {
                "label": "Asia / Singapore",
                "value": "Asia/Singapore"
              },
              {
                "label": "Asia / Srednekolymsk",
                "value": "Asia/Srednekolymsk"
              },
              {
                "label": "Asia / Taipei",
                "value": "Asia/Taipei"
              },
              {
                "label": "Asia / Tashkent",
                "value": "Asia/Tashkent"
              },
              {
                "label": "Asia / Tbilisi",
                "value": "Asia/Tbilisi"
              },
              {
                "label": "Asia / Tehran",
                "value": "Asia/Tehran"
              },
              {
                "label": "Asia / Thimphu",
                "value": "Asia/Thimphu"
              },
              {
                "label": "Asia / Tokyo",
                "value": "Asia/Tokyo"
              },
              {
                "label": "Asia / Tomsk",
                "value": "Asia/Tomsk"
              },
              {
                "label": "Asia / Ulaanbaatar",
                "value": "Asia/Ulaanbaatar"
              },
              {
                "label": "Asia / Urumqi",
                "value": "Asia/Urumqi"
              },
              {
                "label": "Asia / Ust-Nera",
                "value": "Asia/Ust-Nera"
              },
              {
                "label": "Asia / Vientiane",
                "value": "Asia/Vientiane"
              },
              {
                "label": "Asia / Vladivostok",
                "value": "Asia/Vladivostok"
              },
              {
                "label": "Asia / Yakutsk",
                "value": "Asia/Yakutsk"
              },
              {
                "label": "Asia / Yangon",
                "value": "Asia/Yangon"
              },
              {
                "label": "Asia / Yekaterinburg",
                "value": "Asia/Yekaterinburg"
              },
              {
                "label": "Asia / Yerevan",
                "value": "Asia/Yerevan"
              },
              {
                "label": "Atlantic / Azores",
                "value": "Atlantic/Azores"
              },
              {
                "label": "Atlantic / Bermuda",
                "value": "Atlantic/Bermuda"
              },
              {
                "label": "Atlantic / Canary",
                "value": "Atlantic/Canary"
              },
              {
                "label": "Atlantic / Cape Verde",
                "value": "Atlantic/Cape_Verde"
              },
              {
                "label": "Atlantic / Faroe",
                "value": "Atlantic/Faroe"
              },
              {
                "label": "Atlantic / Madeira",
                "value": "Atlantic/Madeira"
              },
              {
                "label": "Atlantic / Reykjavik",
                "value": "Atlantic/Reykjavik"
              },
              {
                "label": "Atlantic / South Georgia",
                "value": "Atlantic/South_Georgia"
              },
              {
                "label": "Atlantic / St Helena",
                "value": "Atlantic/St_Helena"
              },
              {
                "label": "Atlantic / Stanley",
                "value": "Atlantic/Stanley"
              },
              {
                "label": "Australia / Adelaide",
                "value": "Australia/Adelaide"
              },
              {
                "label": "Australia / Brisbane",
                "value": "Australia/Brisbane"
              },
              {
                "label": "Australia / Broken Hill",
                "value": "Australia/Broken_Hill"
              },
              {
                "label": "Australia / Darwin",
                "value": "Australia/Darwin"
              },
              {
                "label": "Australia / Eucla",
                "value": "Australia/Eucla"
              },
              {
                "label": "Australia / Hobart",
                "value": "Australia/Hobart"
              },
              {
                "label": "Australia / Lindeman",
                "value": "Australia/Lindeman"
              },
              {
                "label": "Australia / Lord Howe",
                "value": "Australia/Lord_Howe"
              },
              {
                "label": "Australia / Melbourne",
                "value": "Australia/Melbourne"
              },
              {
                "label": "Australia / Perth",
                "value": "Australia/Perth"
              },
              {
                "label": "Australia / Sydney",
                "value": "Australia/Sydney"
              },
              {
                "label": "Europe / Amsterdam",
                "value": "Europe/Amsterdam"
              },
              {
                "label": "Europe / Andorra",
                "value": "Europe/Andorra"
              },
              {
                "label": "Europe / Astrakhan",
                "value": "Europe/Astrakhan"
              },
              {
                "label": "Europe / Athens",
                "value": "Europe/Athens"
              },
              {
                "label": "Europe / Belgrade",
                "value": "Europe/Belgrade"
              },
              {
                "label": "Europe / Berlin",
                "value": "Europe/Berlin"
              },
              {
                "label": "Europe / Bratislava",
                "value": "Europe/Bratislava"
              },
              {
                "label": "Europe / Brussels",
                "value": "Europe/Brussels"
              },
              {
                "label": "Europe / Bucharest",
                "value": "Europe/Bucharest"
              },
              {
                "label": "Europe / Budapest",
                "value": "Europe/Budapest"
              },
              {
                "label": "Europe / Busingen",
                "value": "Europe/Busingen"
              },
              {
                "label": "Europe / Chisinau",
                "value": "Europe/Chisinau"
              },
              {
                "label": "Europe / Copenhagen",
                "value": "Europe/Copenhagen"
              },
              {
                "label": "Europe / Dublin",
                "value": "Europe/Dublin"
              },
              {
                "label": "Europe / Gibraltar",
                "value": "Europe/Gibraltar"
              },
              {
                "label": "Europe / Guernsey",
                "value": "Europe/Guernsey"
              },
              {
                "label": "Europe / Helsinki",
                "value": "Europe/Helsinki"
              },
              {
                "label": "Europe / Isle of Man",
                "value": "Europe/Isle_of_Man"
              },
              {
                "label": "Europe / Istanbul",
                "value": "Europe/Istanbul"
              },
              {
                "label": "Europe / Jersey",
                "value": "Europe/Jersey"
              },
              {
                "label": "Europe / Kaliningrad",
                "value": "Europe/Kaliningrad"
              },
              {
                "label": "Europe / Kiev",
                "value": "Europe/Kiev"
              },
              {
                "label": "Europe / Kirov",
                "value": "Europe/Kirov"
              },
              {
                "label": "Europe / Lisbon",
                "value": "Europe/Lisbon"
              },
              {
                "label": "Europe / Ljubljana",
                "value": "Europe/Ljubljana"
              },
              {
                "label": "Europe / London",
                "value": "Europe/London"
              },
              {
                "label": "Europe / Luxembourg",
                "value": "Europe/Luxembourg"
              },
              {
                "label": "Europe / Madrid",
                "value": "Europe/Madrid"
              },
              {
                "label": "Europe / Malta",
                "value": "Europe/Malta"
              },
              {
                "label": "Europe / Mariehamn",
                "value": "Europe/Mariehamn"
              },
              {
                "label": "Europe / Minsk",
                "value": "Europe/Minsk"
              },
              {
                "label": "Europe / Monaco",
                "value": "Europe/Monaco"
              },
              {
                "label": "Europe / Moscow",
                "value": "Europe/Moscow"
              },
              {
                "label": "Europe / Oslo",
                "value": "Europe/Oslo"
              },
              {
                "label": "Europe / Paris",
                "value": "Europe/Paris"
              },
              {
                "label": "Europe / Podgorica",
                "value": "Europe/Podgorica"
              },
              {
                "label": "Europe / Prague",
                "value": "Europe/Prague"
              },
              {
                "label": "Europe / Riga",
                "value": "Europe/Riga"
              },
              {
                "label": "Europe / Rome",
                "value": "Europe/Rome"
              },
              {
                "label": "Europe / Samara",
                "value": "Europe/Samara"
              },
              {
                "label": "Europe / San Marino",
                "value": "Europe/San_Marino"
              },
              {
                "label": "Europe / Sarajevo",
                "value": "Europe/Sarajevo"
              },
              {
                "label": "Europe / Saratov",
                "value": "Europe/Saratov"
              },
              {
                "label": "Europe / Simferopol",
                "value": "Europe/Simferopol"
              },
              {
                "label": "Europe / Skopje",
                "value": "Europe/Skopje"
              },
              {
                "label": "Europe / Sofia",
                "value": "Europe/Sofia"
              },
              {
                "label": "Europe / Stockholm",
                "value": "Europe/Stockholm"
              },
              {
                "label": "Europe / Tallinn",
                "value": "Europe/Tallinn"
              },
              {
                "label": "Europe / Tirane",
                "value": "Europe/Tirane"
              },
              {
                "label": "Europe / Ulyanovsk",
                "value": "Europe/Ulyanovsk"
              },
              {
                "label": "Europe / Uzhgorod",
                "value": "Europe/Uzhgorod"
              },
              {
                "label": "Europe / Vaduz",
                "value": "Europe/Vaduz"
              },
              {
                "label": "Europe / Vatican",
                "value": "Europe/Vatican"
              },
              {
                "label": "Europe / Vienna",
                "value": "Europe/Vienna"
              },
              {
                "label": "Europe / Vilnius",
                "value": "Europe/Vilnius"
              },
              {
                "label": "Europe / Volgograd",
                "value": "Europe/Volgograd"
              },
              {
                "label": "Europe / Warsaw",
                "value": "Europe/Warsaw"
              },
              {
                "label": "Europe / Zagreb",
                "value": "Europe/Zagreb"
              },
              {
                "label": "Europe / Zaporozhye",
                "value": "Europe/Zaporozhye"
              },
              {
                "label": "Europe / Zurich",
                "value": "Europe/Zurich"
              },
              {
                "label": "Indian / Antananarivo",
                "value": "Indian/Antananarivo"
              },
              {
                "label": "Indian / Chagos",
                "value": "Indian/Chagos"
              },
              {
                "label": "Indian / Christmas",
                "value": "Indian/Christmas"
              },
              {
                "label": "Indian / Cocos",
                "value": "Indian/Cocos"
              },
              {
                "label": "Indian / Comoro",
                "value": "Indian/Comoro"
              },
              {
                "label": "Indian / Kerguelen",
                "value": "Indian/Kerguelen"
              },
              {
                "label": "Indian / Mahe",
                "value": "Indian/Mahe"
              },
              {
                "label": "Indian / Maldives",
                "value": "Indian/Maldives"
              },
              {
                "label": "Indian / Mauritius",
                "value": "Indian/Mauritius"
              },
              {
                "label": "Indian / Mayotte",
                "value": "Indian/Mayotte"
              },
              {
                "label": "Indian / Reunion",
                "value": "Indian/Reunion"
              },
              {
                "label": "Pacific / Apia",
                "value": "Pacific/Apia"
              },
              {
                "label": "Pacific / Auckland",
                "value": "Pacific/Auckland"
              },
              {
                "label": "Pacific / Bougainville",
                "value": "Pacific/Bougainville"
              },
              {
                "label": "Pacific / Chatham",
                "value": "Pacific/Chatham"
              },
              {
                "label": "Pacific / Chuuk",
                "value": "Pacific/Chuuk"
              },
              {
                "label": "Pacific / Easter",
                "value": "Pacific/Easter"
              },
              {
                "label": "Pacific / Efate",
                "value": "Pacific/Efate"
              },
              {
                "label": "Pacific / Enderbury",
                "value": "Pacific/Enderbury"
              },
              {
                "label": "Pacific / Fakaofo",
                "value": "Pacific/Fakaofo"
              },
              {
                "label": "Pacific / Fiji",
                "value": "Pacific/Fiji"
              },
              {
                "label": "Pacific / Funafuti",
                "value": "Pacific/Funafuti"
              },
              {
                "label": "Pacific / Galapagos",
                "value": "Pacific/Galapagos"
              },
              {
                "label": "Pacific / Gambier",
                "value": "Pacific/Gambier"
              },
              {
                "label": "Pacific / Guadalcanal",
                "value": "Pacific/Guadalcanal"
              },
              {
                "label": "Pacific / Guam",
                "value": "Pacific/Guam"
              },
              {
                "label": "Pacific / Honolulu",
                "value": "Pacific/Honolulu"
              },
              {
                "label": "Pacific / Kiritimati",
                "value": "Pacific/Kiritimati"
              },
              {
                "label": "Pacific / Kosrae",
                "value": "Pacific/Kosrae"
              },
              {
                "label": "Pacific / Kwajalein",
                "value": "Pacific/Kwajalein"
              },
              {
                "label": "Pacific / Majuro",
                "value": "Pacific/Majuro"
              },
              {
                "label": "Pacific / Marquesas",
                "value": "Pacific/Marquesas"
              },
              {
                "label": "Pacific / Midway",
                "value": "Pacific/Midway"
              },
              {
                "label": "Pacific / Nauru",
                "value": "Pacific/Nauru"
              },
              {
                "label": "Pacific / Niue",
                "value": "Pacific/Niue"
              },
              {
                "label": "Pacific / Norfolk",
                "value": "Pacific/Norfolk"
              },
              {
                "label": "Pacific / Noumea",
                "value": "Pacific/Noumea"
              },
              {
                "label": "Pacific / Pago Pago",
                "value": "Pacific/Pago_Pago"
              },
              {
                "label": "Pacific / Palau",
                "value": "Pacific/Palau"
              },
              {
                "label": "Pacific / Pitcairn",
                "value": "Pacific/Pitcairn"
              },
              {
                "label": "Pacific / Pohnpei",
                "value": "Pacific/Pohnpei"
              },
              {
                "label": "Pacific / Port Moresby",
                "value": "Pacific/Port_Moresby"
              },
              {
                "label": "Pacific / Rarotonga",
                "value": "Pacific/Rarotonga"
              },
              {
                "label": "Pacific / Saipan",
                "value": "Pacific/Saipan"
              },
              {
                "label": "Pacific / Tahiti",
                "value": "Pacific/Tahiti"
              },
              {
                "label": "Pacific / Tarawa",
                "value": "Pacific/Tarawa"
              },
              {
                "label": "Pacific / Tongatapu",
                "value": "Pacific/Tongatapu"
              },
              {
                "label": "Pacific / Wake",
                "value": "Pacific/Wake"
              },
              {
                "label": "Pacific / Wallis",
                "value": "Pacific/Wallis"
              },
              {
                "label": "UTC",
                "value": "UTC"
              }
            ],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": false,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": [],
            "input": "string",
            "intl": false
          },
          "errors": []
        },
        "currency": {
          "id": "test_currency",
          "name": "currency",
          "type": "currency",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_currency",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choices": [
              {
                "label": "Afghan Afghani",
                "value": "AFN"
              },
              {
                "label": "Afghan Afghani (1927–2002)",
                "value": "AFA"
              },
              {
                "label": "Albanian Lek",
                "value": "ALL"
              },
              {
                "label": "Albanian Lek (1946–1965)",
                "value": "ALK"
              },
              {
                "label": "Algerian Dinar",
                "value": "DZD"
              },
              {
                "label": "Andorran Peseta",
                "value": "ADP"
              },
              {
                "label": "Angolan Kwanza",
                "value": "AOA"
              },
              {
                "label": "Angolan Kwanza (1977–1991)",
                "value": "AOK"
              },
              {
                "label": "Angolan New Kwanza (1990–2000)",
                "value": "AON"
              },
              {
                "label": "Angolan Readjusted Kwanza (1995–1999)",
                "value": "AOR"
              },
              {
                "label": "Argentine Austral",
                "value": "ARA"
              },
              {
                "label": "Argentine Peso",
                "value": "ARS"
              },
              {
                "label": "Argentine Peso (1881–1970)",
                "value": "ARM"
              },
              {
                "label": "Argentine Peso (1983–1985)",
                "value": "ARP"
              },
              {
                "label": "Argentine Peso Ley (1970–1983)",
                "value": "ARL"
              },
              {
                "label": "Armenian Dram",
                "value": "AMD"
              },
              {
                "label": "Aruban Florin",
                "value": "AWG"
              },
              {
                "label": "Australian Dollar",
                "value": "AUD"
              },
              {
                "label": "Austrian Schilling",
                "value": "ATS"
              },
              {
                "label": "Azerbaijani Manat",
                "value": "AZN"
              },
              {
                "label": "Azerbaijani Manat (1993–2006)",
                "value": "AZM"
              },
              {
                "label": "Bahamian Dollar",
                "value": "BSD"
              },
              {
                "label": "Bahraini Dinar",
                "value": "BHD"
              },
              {
                "label": "Bangladeshi Taka",
                "value": "BDT"
              },
              {
                "label": "Barbadian Dollar",
                "value": "BBD"
              },
              {
                "label": "Belarusian Ruble",
                "value": "BYN"
              },
              {
                "label": "Belarusian Ruble (1994–1999)",
                "value": "BYB"
              },
              {
                "label": "Belarusian Ruble (2000–2016)",
                "value": "BYR"
              },
              {
                "label": "Belgian Franc",
                "value": "BEF"
              },
              {
                "label": "Belgian Franc (convertible)",
                "value": "BEC"
              },
              {
                "label": "Belgian Franc (financial)",
                "value": "BEL"
              },
              {
                "label": "Belize Dollar",
                "value": "BZD"
              },
              {
                "label": "Bermudan Dollar",
                "value": "BMD"
              },
              {
                "label": "Bhutanese Ngultrum",
                "value": "BTN"
              },
              {
                "label": "Bolivian Boliviano",
                "value": "BOB"
              },
              {
                "label": "Bolivian Boliviano (1863–1963)",
                "value": "BOL"
              },
              {
                "label": "Bolivian Mvdol",
                "value": "BOV"
              },
              {
                "label": "Bolivian Peso",
                "value": "BOP"
              },
              {
                "label": "Bosnia-Herzegovina Convertible Mark",
                "value": "BAM"
              },
              {
                "label": "Bosnia-Herzegovina Dinar (1992–1994)",
                "value": "BAD"
              },
              {
                "label": "Bosnia-Herzegovina New Dinar (1994–1997)",
                "value": "BAN"
              },
              {
                "label": "Botswanan Pula",
                "value": "BWP"
              },
              {
                "label": "Brazilian Cruzado (1986–1989)",
                "value": "BRC"
              },
              {
                "label": "Brazilian Cruzeiro (1942–1967)",
                "value": "BRZ"
              },
              {
                "label": "Brazilian Cruzeiro (1990–1993)",
                "value": "BRE"
              },
              {
                "label": "Brazilian Cruzeiro (1993–1994)",
                "value": "BRR"
              },
              {
                "label": "Brazilian New Cruzado (1989–1990)",
                "value": "BRN"
              },
              {
                "label": "Brazilian New Cruzeiro (1967–1986)",
                "value": "BRB"
              },
              {
                "label": "Brazilian Real",
                "value": "BRL"
              },
              {
                "label": "British Pound",
                "value": "GBP"
              },
              {
                "label": "Brunei Dollar",
                "value": "BND"
              },
              {
                "label": "Bulgarian Hard Lev",
                "value": "BGL"
              },
              {
                "label": "Bulgarian Lev",
                "value": "BGN"
              },
              {
                "label": "Bulgarian Lev (1879–1952)",
                "value": "BGO"
              },
              {
                "label": "Bulgarian Socialist Lev",
                "value": "BGM"
              },
              {
                "label": "Burmese Kyat",
                "value": "BUK"
              },
              {
                "label": "Burundian Franc",
                "value": "BIF"
              },
              {
                "label": "Cambodian Riel",
                "value": "KHR"
              },
              {
                "label": "Canadian Dollar",
                "value": "CAD"
              },
              {
                "label": "Cape Verdean Escudo",
                "value": "CVE"
              },
              {
                "label": "Cayman Islands Dollar",
                "value": "KYD"
              },
              {
                "label": "Central African CFA Franc",
                "value": "XAF"
              },
              {
                "label": "CFP Franc",
                "value": "XPF"
              },
              {
                "label": "Chilean Escudo",
                "value": "CLE"
              },
              {
                "label": "Chilean Peso",
                "value": "CLP"
              },
              {
                "label": "Chilean Unit of Account (UF)",
                "value": "CLF"
              },
              {
                "label": "Chinese People’s Bank Dollar",
                "value": "CNX"
              },
              {
                "label": "Chinese Yuan",
                "value": "CNY"
              },
              {
                "label": "Chinese Yuan (offshore)",
                "value": "CNH"
              },
              {
                "label": "Colombian Peso",
                "value": "COP"
              },
              {
                "label": "Colombian Real Value Unit",
                "value": "COU"
              },
              {
                "label": "Comorian Franc",
                "value": "KMF"
              },
              {
                "label": "Congolese Franc",
                "value": "CDF"
              },
              {
                "label": "Costa Rican Colón",
                "value": "CRC"
              },
              {
                "label": "Croatian Dinar",
                "value": "HRD"
              },
              {
                "label": "Croatian Kuna",
                "value": "HRK"
              },
              {
                "label": "Cuban Convertible Peso",
                "value": "CUC"
              },
              {
                "label": "Cuban Peso",
                "value": "CUP"
              },
              {
                "label": "Cypriot Pound",
                "value": "CYP"
              },
              {
                "label": "Czech Koruna",
                "value": "CZK"
              },
              {
                "label": "Czechoslovak Hard Koruna",
                "value": "CSK"
              },
              {
                "label": "Danish Krone",
                "value": "DKK"
              },
              {
                "label": "Djiboutian Franc",
                "value": "DJF"
              },
              {
                "label": "Dominican Peso",
                "value": "DOP"
              },
              {
                "label": "Dutch Guilder",
                "value": "NLG"
              },
              {
                "label": "East Caribbean Dollar",
                "value": "XCD"
              },
              {
                "label": "East German Mark",
                "value": "DDM"
              },
              {
                "label": "Ecuadorian Sucre",
                "value": "ECS"
              },
              {
                "label": "Ecuadorian Unit of Constant Value",
                "value": "ECV"
              },
              {
                "label": "Egyptian Pound",
                "value": "EGP"
              },
              {
                "label": "Equatorial Guinean Ekwele",
                "value": "GQE"
              },
              {
                "label": "Eritrean Nakfa",
                "value": "ERN"
              },
              {
                "label": "Estonian Kroon",
                "value": "EEK"
              },
              {
                "label": "Ethiopian Birr",
                "value": "ETB"
              },
              {
                "label": "Euro",
                "value": "EUR"
              },
              {
                "label": "European Currency Unit",
                "value": "XEU"
              },
              {
                "label": "Falkland Islands Pound",
                "value": "FKP"
              },
              {
                "label": "Fijian Dollar",
                "value": "FJD"
              },
              {
                "label": "Finnish Markka",
                "value": "FIM"
              },
              {
                "label": "French Franc",
                "value": "FRF"
              },
              {
                "label": "French Gold Franc",
                "value": "XFO"
              },
              {
                "label": "French UIC-Franc",
                "value": "XFU"
              },
              {
                "label": "Gambian Dalasi",
                "value": "GMD"
              },
              {
                "label": "Georgian Kupon Larit",
                "value": "GEK"
              },
              {
                "label": "Georgian Lari",
                "value": "GEL"
              },
              {
                "label": "German Mark",
                "value": "DEM"
              },
              {
                "label": "Ghanaian Cedi",
                "value": "GHS"
              },
              {
                "label": "Ghanaian Cedi (1979–2007)",
                "value": "GHC"
              },
              {
                "label": "Gibraltar Pound",
                "value": "GIP"
              },
              {
                "label": "Greek Drachma",
                "value": "GRD"
              },
              {
                "label": "Guatemalan Quetzal",
                "value": "GTQ"
              },
              {
                "label": "Guinea-Bissau Peso",
                "value": "GWP"
              },
              {
                "label": "Guinean Franc",
                "value": "GNF"
              },
              {
                "label": "Guinean Syli",
                "value": "GNS"
              },
              {
                "label": "Guyanaese Dollar",
                "value": "GYD"
              },
              {
                "label": "Haitian Gourde",
                "value": "HTG"
              },
              {
                "label": "Honduran Lempira",
                "value": "HNL"
              },
              {
                "label": "Hong Kong Dollar",
                "value": "HKD"
              },
              {
                "label": "Hungarian Forint",
                "value": "HUF"
              },
              {
                "label": "Icelandic Króna",
                "value": "ISK"
              },
              {
                "label": "Icelandic Króna (1918–1981)",
                "value": "ISJ"
              },
              {
                "label": "Indian Rupee",
                "value": "INR"
              },
              {
                "label": "Indonesian Rupiah",
                "value": "IDR"
              },
              {
                "label": "Iranian Rial",
                "value": "IRR"
              },
              {
                "label": "Iraqi Dinar",
                "value": "IQD"
              },
              {
                "label": "Irish Pound",
                "value": "IEP"
              },
              {
                "label": "Israeli New Shekel",
                "value": "ILS"
              },
              {
                "label": "Israeli Pound",
                "value": "ILP"
              },
              {
                "label": "Israeli Shekel (1980–1985)",
                "value": "ILR"
              },
              {
                "label": "Italian Lira",
                "value": "ITL"
              },
              {
                "label": "Jamaican Dollar",
                "value": "JMD"
              },
              {
                "label": "Japanese Yen",
                "value": "JPY"
              },
              {
                "label": "Jordanian Dinar",
                "value": "JOD"
              },
              {
                "label": "Kazakhstani Tenge",
                "value": "KZT"
              },
              {
                "label": "Kenyan Shilling",
                "value": "KES"
              },
              {
                "label": "Kuwaiti Dinar",
                "value": "KWD"
              },
              {
                "label": "Kyrgystani Som",
                "value": "KGS"
              },
              {
                "label": "Laotian Kip",
                "value": "LAK"
              },
              {
                "label": "Latvian Lats",
                "value": "LVL"
              },
              {
                "label": "Latvian Ruble",
                "value": "LVR"
              },
              {
                "label": "Lebanese Pound",
                "value": "LBP"
              },
              {
                "label": "Lesotho Loti",
                "value": "LSL"
              },
              {
                "label": "Liberian Dollar",
                "value": "LRD"
              },
              {
                "label": "Libyan Dinar",
                "value": "LYD"
              },
              {
                "label": "Lithuanian Litas",
                "value": "LTL"
              },
              {
                "label": "Lithuanian Talonas",
                "value": "LTT"
              },
              {
                "label": "Luxembourg Financial Franc",
                "value": "LUL"
              },
              {
                "label": "Luxembourgian Convertible Franc",
                "value": "LUC"
              },
              {
                "label": "Luxembourgian Franc",
                "value": "LUF"
              },
              {
                "label": "Macanese Pataca",
                "value": "MOP"
              },
              {
                "label": "Macedonian Denar",
                "value": "MKD"
              },
              {
                "label": "Macedonian Denar (1992–1993)",
                "value": "MKN"
              },
              {
                "label": "Malagasy Ariary",
                "value": "MGA"
              },
              {
                "label": "Malagasy Franc",
                "value": "MGF"
              },
              {
                "label": "Malawian Kwacha",
                "value": "MWK"
              },
              {
                "label": "Malaysian Ringgit",
                "value": "MYR"
              },
              {
                "label": "Maldivian Rufiyaa",
                "value": "MVR"
              },
              {
                "label": "Maldivian Rupee (1947–1981)",
                "value": "MVP"
              },
              {
                "label": "Malian Franc",
                "value": "MLF"
              },
              {
                "label": "Maltese Lira",
                "value": "MTL"
              },
              {
                "label": "Maltese Pound",
                "value": "MTP"
              },
              {
                "label": "Mauritanian Ouguiya",
                "value": "MRU"
              },
              {
                "label": "Mauritanian Ouguiya (1973–2017)",
                "value": "MRO"
              },
              {
                "label": "Mauritian Rupee",
                "value": "MUR"
              },
              {
                "label": "Mexican Investment Unit",
                "value": "MXV"
              },
              {
                "label": "Mexican Peso",
                "value": "MXN"
              },
              {
                "label": "Mexican Silver Peso (1861–1992)",
                "value": "MXP"
              },
              {
                "label": "Moldovan Cupon",
                "value": "MDC"
              },
              {
                "label": "Moldovan Leu",
                "value": "MDL"
              },
              {
                "label": "Monegasque Franc",
                "value": "MCF"
              },
              {
                "label": "Mongolian Tugrik",
                "value": "MNT"
              },
              {
                "label": "Moroccan Dirham",
                "value": "MAD"
              },
              {
                "label": "Moroccan Franc",
                "value": "MAF"
              },
              {
                "label": "Mozambican Escudo",
                "value": "MZE"
              },
              {
                "label": "Mozambican Metical",
                "value": "MZN"
              },
              {
                "label": "Mozambican Metical (1980–2006)",
                "value": "MZM"
              },
              {
                "label": "Myanmar Kyat",
                "value": "MMK"
              },
              {
                "label": "Namibian Dollar",
                "value": "NAD"
              },
              {
                "label": "Nepalese Rupee",
                "value": "NPR"
              },
              {
                "label": "Netherlands Antillean Guilder",
                "value": "ANG"
              },
              {
                "label": "New Taiwan Dollar",
                "value": "TWD"
              },
              {
                "label": "New Zealand Dollar",
                "value": "NZD"
              },
              {
                "label": "Nicaraguan Córdoba",
                "value": "NIO"
              },
              {
                "label": "Nicaraguan Córdoba (1988–1991)",
                "value": "NIC"
              },
              {
                "label": "Nigerian Naira",
                "value": "NGN"
              },
              {
                "label": "North Korean Won",
                "value": "KPW"
              },
              {
                "label": "Norwegian Krone",
                "value": "NOK"
              },
              {
                "label": "Omani Rial",
                "value": "OMR"
              },
              {
                "label": "Pakistani Rupee",
                "value": "PKR"
              },
              {
                "label": "Panamanian Balboa",
                "value": "PAB"
              },
              {
                "label": "Papua New Guinean Kina",
                "value": "PGK"
              },
              {
                "label": "Paraguayan Guarani",
                "value": "PYG"
              },
              {
                "label": "Peruvian Inti",
                "value": "PEI"
              },
              {
                "label": "Peruvian Sol",
                "value": "PEN"
              },
              {
                "label": "Peruvian Sol (1863–1965)",
                "value": "PES"
              },
              {
                "label": "Philippine Piso",
                "value": "PHP"
              },
              {
                "label": "Polish Zloty",
                "value": "PLN"
              },
              {
                "label": "Polish Zloty (1950–1995)",
                "value": "PLZ"
              },
              {
                "label": "Portuguese Escudo",
                "value": "PTE"
              },
              {
                "label": "Portuguese Guinea Escudo",
                "value": "GWE"
              },
              {
                "label": "Qatari Rial",
                "value": "QAR"
              },
              {
                "label": "Rhodesian Dollar",
                "value": "RHD"
              },
              {
                "label": "RINET Funds",
                "value": "XRE"
              },
              {
                "label": "Romanian Leu",
                "value": "RON"
              },
              {
                "label": "Romanian Leu (1952–2006)",
                "value": "ROL"
              },
              {
                "label": "Russian Ruble",
                "value": "RUB"
              },
              {
                "label": "Russian Ruble (1991–1998)",
                "value": "RUR"
              },
              {
                "label": "Rwandan Franc",
                "value": "RWF"
              },
              {
                "label": "Salvadoran Colón",
                "value": "SVC"
              },
              {
                "label": "Samoan Tala",
                "value": "WST"
              },
              {
                "label": "São Tomé & Príncipe Dobra",
                "value": "STN"
              },
              {
                "label": "São Tomé & Príncipe Dobra (1977–2017)",
                "value": "STD"
              },
              {
                "label": "Saudi Riyal",
                "value": "SAR"
              },
              {
                "label": "Serbian Dinar",
                "value": "RSD"
              },
              {
                "label": "Serbian Dinar (2002–2006)",
                "value": "CSD"
              },
              {
                "label": "Seychellois Rupee",
                "value": "SCR"
              },
              {
                "label": "Sierra Leonean Leone",
                "value": "SLL"
              },
              {
                "label": "Singapore Dollar",
                "value": "SGD"
              },
              {
                "label": "Slovak Koruna",
                "value": "SKK"
              },
              {
                "label": "Slovenian Tolar",
                "value": "SIT"
              },
              {
                "label": "Solomon Islands Dollar",
                "value": "SBD"
              },
              {
                "label": "Somali Shilling",
                "value": "SOS"
              },
              {
                "label": "South African Rand",
                "value": "ZAR"
              },
              {
                "label": "South African Rand (financial)",
                "value": "ZAL"
              },
              {
                "label": "South Korean Hwan (1953–1962)",
                "value": "KRH"
              },
              {
                "label": "South Korean Won",
                "value": "KRW"
              },
              {
                "label": "South Korean Won (1945–1953)",
                "value": "KRO"
              },
              {
                "label": "South Sudanese Pound",
                "value": "SSP"
              },
              {
                "label": "Soviet Rouble",
                "value": "SUR"
              },
              {
                "label": "Spanish Peseta",
                "value": "ESP"
              },
              {
                "label": "Spanish Peseta (A account)",
                "value": "ESA"
              },
              {
                "label": "Spanish Peseta (convertible account)",
                "value": "ESB"
              },
              {
                "label": "Sri Lankan Rupee",
                "value": "LKR"
              },
              {
                "label": "St. Helena Pound",
                "value": "SHP"
              },
              {
                "label": "Sudanese Dinar (1992–2007)",
                "value": "SDD"
              },
              {
                "label": "Sudanese Pound",
                "value": "SDG"
              },
              {
                "label": "Sudanese Pound (1957–1998)",
                "value": "SDP"
              },
              {
                "label": "Surinamese Dollar",
                "value": "SRD"
              },
              {
                "label": "Surinamese Guilder",
                "value": "SRG"
              },
              {
                "label": "Swazi Lilangeni",
                "value": "SZL"
              },
              {
                "label": "Swedish Krona",
                "value": "SEK"
              },
              {
                "label": "Swiss Franc",
                "value": "CHF"
              },
              {
                "label": "Syrian Pound",
                "value": "SYP"
              },
              {
                "label": "Tajikistani Ruble",
                "value": "TJR"
              },
              {
                "label": "Tajikistani Somoni",
                "value": "TJS"
              },
              {
                "label": "Tanzanian Shilling",
                "value": "TZS"
              },
              {
                "label": "Thai Baht",
                "value": "THB"
              },
              {
                "label": "Timorese Escudo",
                "value": "TPE"
              },
              {
                "label": "Tongan Paʻanga",
                "value": "TOP"
              },
              {
                "label": "Trinidad & Tobago Dollar",
                "value": "TTD"
              },
              {
                "label": "Tunisian Dinar",
                "value": "TND"
              },
              {
                "label": "Turkish Lira",
                "value": "TRY"
              },
              {
                "label": "Turkish Lira (1922–2005)",
                "value": "TRL"
              },
              {
                "label": "Turkmenistani Manat",
                "value": "TMT"
              },
              {
                "label": "Turkmenistani Manat (1993–2009)",
                "value": "TMM"
              },
              {
                "label": "Ugandan Shilling",
                "value": "UGX"
              },
              {
                "label": "Ugandan Shilling (1966–1987)",
                "value": "UGS"
              },
              {
                "label": "Ukrainian Hryvnia",
                "value": "UAH"
              },
              {
                "label": "Ukrainian Karbovanets",
                "value": "UAK"
              },
              {
                "label": "United Arab Emirates Dirham",
                "value": "AED"
              },
              {
                "label": "Uruguayan Nominal Wage Index Unit",
                "value": "UYW"
              },
              {
                "label": "Uruguayan Peso",
                "value": "UYU"
              },
              {
                "label": "Uruguayan Peso (1975–1993)",
                "value": "UYP"
              },
              {
                "label": "Uruguayan Peso (Indexed Units)",
                "value": "UYI"
              },
              {
                "label": "US Dollar",
                "value": "USD"
              },
              {
                "label": "US Dollar (Next day)",
                "value": "USN"
              },
              {
                "label": "US Dollar (Same day)",
                "value": "USS"
              },
              {
                "label": "Uzbekistani Som",
                "value": "UZS"
              },
              {
                "label": "Vanuatu Vatu",
                "value": "VUV"
              },
              {
                "label": "Venezuelan Bolívar",
                "value": "VES"
              },
              {
                "label": "Venezuelan Bolívar (1871–2008)",
                "value": "VEB"
              },
              {
                "label": "Venezuelan Bolívar (2008–2018)",
                "value": "VEF"
              },
              {
                "label": "Vietnamese Dong",
                "value": "VND"
              },
              {
                "label": "Vietnamese Dong (1978–1985)",
                "value": "VNN"
              },
              {
                "label": "West African CFA Franc",
                "value": "XOF"
              },
              {
                "label": "WIR Euro",
                "value": "CHE"
              },
              {
                "label": "WIR Franc",
                "value": "CHW"
              },
              {
                "label": "Yemeni Dinar",
                "value": "YDD"
              },
              {
                "label": "Yemeni Rial",
                "value": "YER"
              },
              {
                "label": "Yugoslavian Convertible Dinar (1990–1992)",
                "value": "YUN"
              },
              {
                "label": "Yugoslavian Hard Dinar (1966–1990)",
                "value": "YUD"
              },
              {
                "label": "Yugoslavian New Dinar (1994–2002)",
                "value": "YUM"
              },
              {
                "label": "Yugoslavian Reformed Dinar (1992–1993)",
                "value": "YUR"
              },
              {
                "label": "Zairean New Zaire (1993–1998)",
                "value": "ZRN"
              },
              {
                "label": "Zairean Zaire (1971–1993)",
                "value": "ZRZ"
              },
              {
                "label": "Zambian Kwacha",
                "value": "ZMW"
              },
              {
                "label": "Zambian Kwacha (1968–2012)",
                "value": "ZMK"
              },
              {
                "label": "Zimbabwean Dollar (1980–2008)",
                "value": "ZWD"
              },
              {
                "label": "Zimbabwean Dollar (2008)",
                "value": "ZWR"
              },
              {
                "label": "Zimbabwean Dollar (2009)",
                "value": "ZWL"
              }
            ],
            "choice_attr": null,
            "choice_filter": null,
            "choice_label": null,
            "choice_name": null,
            "choice_translation_domain": false,
            "choice_value": null,
            "expanded": false,
            "group_by": null,
            "multiple": false,
            "placeholder": null,
            "preferred_choices": [],
            "choice_translation_locale": null
          },
          "errors": []
        },
        "date": {
          "id": "test_date",
          "name": "date",
          "type": "date",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_date",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "year": "",
            "month": "",
            "day": ""
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "days": [
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31
            ],
            "placeholder": {
              "year": null,
              "month": null,
              "day": null
            },
            "format": 2,
            "html5": true,
            "input": "datetime",
            "input_format": "Y-m-d",
            "model_timezone": null,
            "months": [
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12
            ],
            "view_timezone": null,
            "widget": "choice",
            "years": [
              2016,
              2017,
              2018,
              2019,
              2020,
              2021,
              2022,
              2023,
              2024,
              2025,
              2026
            ]
          },
          "errors": []
        },
        "dateInterval": {
          "id": "test_dateInterval",
          "name": "dateInterval",
          "type": "dateinterval",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_dateInterval",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "years": "",
            "months": "",
            "days": ""
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "days": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31
            ],
            "placeholder": {
              "years": null,
              "months": null,
              "weeks": null,
              "days": null,
              "hours": null,
              "minutes": null,
              "seconds": null
            },
            "hours": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24
            ],
            "input": "dateinterval",
            "labels": {
              "years": null,
              "months": null,
              "days": null,
              "weeks": null,
              "hours": null,
              "minutes": null,
              "seconds": null,
              "invert": "Negative interval"
            },
            "minutes": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52,
              53,
              54,
              55,
              56,
              57,
              58,
              59,
              60
            ],
            "months": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12
            ],
            "seconds": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52,
              53,
              54,
              55,
              56,
              57,
              58,
              59,
              60
            ],
            "weeks": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52
            ],
            "widget": "choice",
            "with_days": true,
            "with_hours": false,
            "with_invert": false,
            "with_minutes": false,
            "with_months": true,
            "with_seconds": false,
            "with_weeks": false,
            "with_years": true,
            "years": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52,
              53,
              54,
              55,
              56,
              57,
              58,
              59,
              60,
              61,
              62,
              63,
              64,
              65,
              66,
              67,
              68,
              69,
              70,
              71,
              72,
              73,
              74,
              75,
              76,
              77,
              78,
              79,
              80,
              81,
              82,
              83,
              84,
              85,
              86,
              87,
              88,
              89,
              90,
              91,
              92,
              93,
              94,
              95,
              96,
              97,
              98,
              99,
              100
            ]
          },
          "errors": []
        },
        "dateTime": {
          "id": "test_dateTime",
          "name": "dateTime",
          "type": "datetime",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_dateTime",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "date": {
              "year": "",
              "month": "",
              "day": ""
            },
            "time": {
              "hour": "",
              "minute": ""
            }
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choice_translation_domain": null,
            "date_format": null,
            "date_label": null,
            "date_widget": null,
            "days": null,
            "placeholder": null,
            "format": "yyyy-MM-dd'T'HH:mm:ss",
            "hours": null,
            "html5": true,
            "input": "datetime",
            "input_format": "Y-m-d H:i:s",
            "minutes": null,
            "model_timezone": null,
            "months": null,
            "seconds": null,
            "time_label": null,
            "time_widget": null,
            "view_timezone": null,
            "widget": null,
            "with_minutes": true,
            "with_seconds": false,
            "years": null
          },
          "errors": []
        },
        "time": {
          "id": "test_time",
          "name": "time",
          "type": "time",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_time",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "hour": "",
            "minute": ""
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choice_translation_domain": {
              "hour": false,
              "minute": false,
              "second": false
            },
            "placeholder": {
              "hour": null,
              "minute": null,
              "second": null
            },
            "hours": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23
            ],
            "html5": true,
            "input": "datetime",
            "input_format": "H:i:s",
            "minutes": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52,
              53,
              54,
              55,
              56,
              57,
              58,
              59
            ],
            "model_timezone": null,
            "reference_date": null,
            "seconds": [
              0,
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31,
              32,
              33,
              34,
              35,
              36,
              37,
              38,
              39,
              40,
              41,
              42,
              43,
              44,
              45,
              46,
              47,
              48,
              49,
              50,
              51,
              52,
              53,
              54,
              55,
              56,
              57,
              58,
              59
            ],
            "view_timezone": null,
            "widget": "choice",
            "with_minutes": true,
            "with_seconds": false
          },
          "errors": []
        },
        "birthday": {
          "id": "test_birthday",
          "name": "birthday",
          "type": "birthday",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_birthday",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "year": "",
            "month": "",
            "day": ""
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "days": [
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12,
              13,
              14,
              15,
              16,
              17,
              18,
              19,
              20,
              21,
              22,
              23,
              24,
              25,
              26,
              27,
              28,
              29,
              30,
              31
            ],
            "placeholder": {
              "year": null,
              "month": null,
              "day": null
            },
            "format": 2,
            "html5": true,
            "input": "datetime",
            "input_format": "Y-m-d",
            "model_timezone": null,
            "months": [
              1,
              2,
              3,
              4,
              5,
              6,
              7,
              8,
              9,
              10,
              11,
              12
            ],
            "view_timezone": null,
            "widget": "choice",
            "years": [
              1901,
              1902,
              1903,
              1904,
              1905,
              1906,
              1907,
              1908,
              1909,
              1910,
              1911,
              1912,
              1913,
              1914,
              1915,
              1916,
              1917,
              1918,
              1919,
              1920,
              1921,
              1922,
              1923,
              1924,
              1925,
              1926,
              1927,
              1928,
              1929,
              1930,
              1931,
              1932,
              1933,
              1934,
              1935,
              1936,
              1937,
              1938,
              1939,
              1940,
              1941,
              1942,
              1943,
              1944,
              1945,
              1946,
              1947,
              1948,
              1949,
              1950,
              1951,
              1952,
              1953,
              1954,
              1955,
              1956,
              1957,
              1958,
              1959,
              1960,
              1961,
              1962,
              1963,
              1964,
              1965,
              1966,
              1967,
              1968,
              1969,
              1970,
              1971,
              1972,
              1973,
              1974,
              1975,
              1976,
              1977,
              1978,
              1979,
              1980,
              1981,
              1982,
              1983,
              1984,
              1985,
              1986,
              1987,
              1988,
              1989,
              1990,
              1991,
              1992,
              1993,
              1994,
              1995,
              1996,
              1997,
              1998,
              1999,
              2000,
              2001,
              2002,
              2003,
              2004,
              2005,
              2006,
              2007,
              2008,
              2009,
              2010,
              2011,
              2012,
              2013,
              2014,
              2015,
              2016,
              2017,
              2018,
              2019,
              2020,
              2021
            ]
          },
          "errors": []
        },
        "week": {
          "id": "test_week",
          "name": "week",
          "type": "week",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_week",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": null,
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "choice_translation_domain": {
              "year": false,
              "week": false
            },
            "placeholder": {
              "year": null,
              "week": null
            },
            "html5": true,
            "input": "array",
            "widget": "single_text",
            "years": [
              2011,
              2012,
              2013,
              2014,
              2015,
              2016,
              2017,
              2018,
              2019,
              2020,
              2021,
              2022,
              2023,
              2024,
              2025,
              2026,
              2027,
              2028,
              2029,
              2030,
              2031
            ],
            "weeks": {
              "1": 1,
              "2": 2,
              "3": 3,
              "4": 4,
              "5": 5,
              "6": 6,
              "7": 7,
              "8": 8,
              "9": 9,
              "10": 10,
              "11": 11,
              "12": 12,
              "13": 13,
              "14": 14,
              "15": 15,
              "16": 16,
              "17": 17,
              "18": 18,
              "19": 19,
              "20": 20,
              "21": 21,
              "22": 22,
              "23": 23,
              "24": 24,
              "25": 25,
              "26": 26,
              "27": 27,
              "28": 28,
              "29": 29,
              "30": 30,
              "31": 31,
              "32": 32,
              "33": 33,
              "34": 34,
              "35": 35,
              "36": 36,
              "37": 37,
              "38": 38,
              "39": 39,
              "40": 40,
              "41": 41,
              "42": 42,
              "43": 43,
              "44": 44,
              "45": 45,
              "46": 46,
              "47": 47,
              "48": 48,
              "49": 49,
              "50": 50,
              "51": 51,
              "52": 52,
              "53": 53
            }
          },
          "errors": []
        },
        "checkbox": {
          "id": "test_checkbox",
          "name": "checkbox",
          "type": "checkbox",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_checkbox",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "1",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "false_values": [
              null
            ],
            "value": "1"
          },
          "errors": []
        },
        "file": {
          "id": "test_file",
          "name": "file",
          "type": "file",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": true,
          "unique_block_prefix": "_test_file",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "multiple": false
          },
          "errors": []
        },
        "radio": {
          "id": "test_radio",
          "name": "radio",
          "type": "radio",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_radio",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "1",
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "false_values": [
              null
            ],
            "value": "1"
          },
          "errors": []
        },
        "collection": {
          "id": "test_collection",
          "name": "collection",
          "type": "collection",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_collection",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": null,
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "allow_add": true,
            "allow_delete": false,
            "delete_empty": false,
            "entry_options": {
              "block_name": "entry"
            },
            "prototype_name": "__name__"
          },
          "errors": []
        },
        "repeated": {
          "id": "test_repeated",
          "name": "repeated",
          "type": "repeated",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_repeated",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": {
            "first": null,
            "second": null
          },
          "required": true,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": true,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "options": {
            "first_name": "first",
            "first_options": [],
            "options": [],
            "second_name": "second",
            "second_options": []
          },
          "errors": []
        },
        "hidden": {
          "id": "test_hidden",
          "name": "hidden",
          "type": "hidden",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_hidden",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": true,
          "value": "",
          "required": false,
          "size": null,
          "label_attr": [],
          "help": null,
          "help_attr": [],
          "help_html": false,
          "help_translation_parameters": [],
          "compound": false,
          "method": "POST",
          "action": "",
          "submitted": false,
          "attr": [],
          "errors": []
        },
        "button": {
          "id": "test_button",
          "name": "button",
          "type": "button",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_button",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": null,
          "value": null,
          "required": null,
          "size": null,
          "label_attr": null,
          "help": null,
          "help_attr": null,
          "help_html": null,
          "help_translation_parameters": null,
          "compound": null,
          "method": null,
          "action": null,
          "submitted": null,
          "attr": [],
          "errors": []
        },
        "reset": {
          "id": "test_reset",
          "name": "reset",
          "type": "reset",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_reset",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": null,
          "value": null,
          "required": null,
          "size": null,
          "label_attr": null,
          "help": null,
          "help_attr": null,
          "help_html": null,
          "help_translation_parameters": null,
          "compound": null,
          "method": null,
          "action": null,
          "submitted": null,
          "attr": [],
          "errors": []
        },
        "submit": {
          "id": "test_submit",
          "name": "submit",
          "type": "submit",
          "disabled": false,
          "label": null,
          "label_format": null,
          "label_html": false,
          "multipart": false,
          "unique_block_prefix": "_test_submit",
          "row_attr": [],
          "translation_domain": null,
          "label_translation_parameters": [],
          "attr_translation_parameters": [],
          "valid": null,
          "value": null,
          "required": null,
          "size": null,
          "label_attr": null,
          "help": null,
          "help_attr": null,
          "help_html": null,
          "help_translation_parameters": null,
          "compound": null,
          "method": null,
          "action": null,
          "submitted": null,
          "attr": [],
          "options": {
            "validate": true
          },
          "errors": []
        }
      },
      "errors": []
    }
    EOT;

    public function test(): void
    {
        $form = $this->factory->createNamedBuilder('test', SuperFormType::class)->getForm();

        $transformerContext = new TransformerContext();
        $transformer = new FormTransformer($transformerContext);

        // Default
        $transformerContext->addTransformer(new FormTypeTransformer($this->translator, $transformer));
        // Text
        $transformerContext->addTransformer(new TextTypeTransformer($this->translator));
        $transformerContext->addTransformer(new TextareaTypeTransformer($this->translator));
        $transformerContext->addTransformer(new EmailTypeTransformer($this->translator));
        $transformerContext->addTransformer(new IntegerTypeTransformer($this->translator));
        $transformerContext->addTransformer(new MoneyTypeTransformer($this->translator));
        $transformerContext->addTransformer(new NumberTypeTransformer($this->translator));
        $transformerContext->addTransformer(new PasswordTypeTransformer($this->translator));
        $transformerContext->addTransformer(new PercentTypeTransformer($this->translator));
        $transformerContext->addTransformer(new SearchTypeTransformer($this->translator));
        $transformerContext->addTransformer(new UrlTypeTransformer($this->translator));
        $transformerContext->addTransformer(new RangeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new TelTypeTransformer($this->translator));
        $transformerContext->addTransformer(new ColorTypeTransformer($this->translator));
        // Choice
        $transformerContext->addTransformer(new ChoiceTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new EntityTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new CountryTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new LanguageTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new LocaleTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new TimezoneTypeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new CurrencyTypeTypeTransformer($this->translator));
        // DateTime
        $transformerContext->addTransformer(new DateTypeTransformer($this->translator));
        $transformerContext->addTransformer(new DateIntervalTypeTransformer($this->translator));
        $transformerContext->addTransformer(new DateTimeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new TimeTypeTransformer($this->translator));
        $transformerContext->addTransformer(new BirthdayTypeTransformer($this->translator));
        $transformerContext->addTransformer(new WeekTypeTransformer($this->translator));
        // Other
        $transformerContext->addTransformer(new CheckboxTypeTransformer($this->translator));
        $transformerContext->addTransformer(new FileTypeTransformer($this->translator));
        $transformerContext->addTransformer(new RadioTypeTransformer($this->translator));
        // Group
        $transformerContext->addTransformer(new CollectionTypeTransformer($this->translator, $transformer));
        $transformerContext->addTransformer(new RepeatedTypeTransformer($this->translator));
        // Hidden
        $transformerContext->addTransformer(new HiddenTypeTransformer($this->translator));
        // Button
        $transformerContext->addTransformer(new ButtonTypeTransformer($this->translator));
        $transformerContext->addTransformer(new ResetTypeTransformer($this->translator));
        $transformerContext->addTransformer(new SubmitTypeTransformer($this->translator));

        $result = $transformer->transform($form);

        self::assertEquals(json_encode(json_decode(self::expectedJson)), json_encode($result));
    }
}
