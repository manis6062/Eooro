<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class CountryCodes
{
    /**
     * It is an array containing country codes.
     * 
     * @var array
     */
    protected $codes;
    
    /**
     * It is an array containing country names.
     * 
     * @var array
     */
    protected $countries;
    
    /**
     * It is an Associative array with country code as key and country name as 
     * value.
     * 
     * @var array
     */
    protected $countryAndCodes;
    
    public function __construct() 
    {
        $this->countryAndCodes = array(
                            "GB" => "United Kingdom",
                            "US" => "United States",
                            "AU" => "Australia",
                            "NZ" => "New Zealand",
                            "IE" => "Ireland",
                            "CA" => "Canada",
                            "AF" => "Afghanistan",
                            "AX" => "Åland Islands",
                            "AL" => "Albania",
                            "DZ" => "Algeria",
                            "AS" => "American Samoa",
                            "AD" => "Andorra",
                            "AO" => "Angola",
                            "AI" => "Anguilla",
                            "AQ" => "Antarctica",
                            "AG" => "Antigua and Barbuda",
                            "AR" => "Argentina",
                            "AM" => "Armenia",
                            "AW" => "Aruba",
                            "AT" => "Austria",
                            "AZ" => "Azerbaijan",
                            "BS" => "Bahamas",
                            "BH" => "Bahrain",
                            "BD" => "Bangladesh",
                            "BB" => "Barbados",
                            "BY" => "Belarus",
                            "BE" => "Belgium",
                            "BZ" => "Belize",
                            "BJ" => "Benin",
                            "BM" => "Bermuda",
                            "BT" => "Bhutan",
                            "BO" => "Bolivia",
                            "BA" => "Bosnia and Herzegovina",
                            "BW" => "Botswana",
                            "BV" => "Bouvet Island",
                            "BR" => "Brazil",
                            "IO" => "British Indian Ocean Territory",
                            "BN" => "Brunei Darussalam",
                            "BG" => "Bulgaria",
                            "BF" => "Burkina Faso",
                            "BI" => "Burundi",
                            "KH" => "Cambodia",
                            "CM" => "Cameroon",
                            "CV" => "Cape Verde",
                            "KY" => "Cayman Islands",
                            "CF" => "Central African Republic",
                            "TD" => "Chad",
                            "CL" => "Chile",
                            "CN" => "China",
                            "CX" => "Christmas Island",
                            "CC" => "Cocos (Keeling) Islands",
                            "CO" => "Colombia",
                            "KM" => "Comoros",
                            "CG" => "Congo",
                            "CD" => "Congo, The Democratic Republic of The",
                            "CK" => "Cook Islands",
                            "CR" => "Costa Rica",
                            "CI" => "Cote D'ivoire",
                            "HR" => "Croatia",
                            "CU" => "Cuba",
                            "CY" => "Cyprus",
                            "CZ" => "Czech Republic",
                            "DK" => "Denmark",
                            "DJ" => "Djibouti",
                            "DM" => "Dominica",
                            "DO" => "Dominican Republic",
                            "EC" => "Ecuador",
                            "EG" => "Egypt",
                            "SV" => "El Salvador",
                            "GQ" => "Equatorial Guinea",
                            "ER" => "Eritrea",
                            "EE" => "Estonia",
                            "ET" => "Ethiopia",
                            "FK" => "Falkland Islands (Malvinas)",
                            "FO" => "Faroe Islands",
                            "FJ" => "Fiji",
                            "FI" => "Finland",
                            "FR" => "France",
                            "GF" => "French Guiana",
                            "PF" => "French Polynesia",
                            "TF" => "French Southern Territories",
                            "GA" => "Gabon",
                            "GM" => "Gambia",
                            "GE" => "Georgia",
                            "DE" => "Germany",
                            "GH" => "Ghana",
                            "GI" => "Gibraltar",
                            "GR" => "Greece",
                            "GL" => "Greenland",
                            "GD" => "Grenada",
                            "GP" => "Guadeloupe",
                            "GU" => "Guam",
                            "GT" => "Guatemala",
                            "GG" => "Guernsey",
                            "GN" => "Guinea",
                            "GW" => "Guinea-bissau",
                            "GY" => "Guyana",
                            "HT" => "Haiti",
                            "HM" => "Heard Island and Mcdonald Islands",
                            "VA" => "Holy See (Vatican City State)",
                            "HN" => "Honduras",
                            "HK" => "Hong Kong",
                            "HU" => "Hungary",
                            "IS" => "Iceland",
                            "IN" => "India",
                            "ID" => "Indonesia",
                            "IR" => "Iran, Islamic Republic of",
                            "IQ" => "Iraq",
                            "IM" => "Isle of Man",
                            "IL" => "Israel",
                            "IT" => "Italy",
                            "JM" => "Jamaica",
                            "JP" => "Japan",
                            "JE" => "Jersey",
                            "JO" => "Jordan",
                            "KZ" => "Kazakhstan",
                            "KE" => "Kenya",
                            "KI" => "Kiribati",
                            "KP" => "Korea, Democratic People's Republic of",
                            "KR" => "Korea, Republic of",
                            "KW" => "Kuwait",
                            "KG" => "Kyrgyzstan",
                            "LA" => "Lao People's Democratic Republic",
                            "LV" => "Latvia",
                            "LB" => "Lebanon",
                            "LS" => "Lesotho",
                            "LR" => "Liberia",
                            "LY" => "Libyan Arab Jamahiriya",
                            "LI" => "Liechtenstein",
                            "LT" => "Lithuania",
                            "LU" => "Luxembourg",
                            "MO" => "Macao",
                            "MK" => "Macedonia, The Former Yugoslav Republic of",
                            "MG" => "Madagascar",
                            "MW" => "Malawi",
                            "MY" => "Malaysia",
                            "MV" => "Maldives",
                            "ML" => "Mali",
                            "MT" => "Malta",
                            "MH" => "Marshall Islands",
                            "MQ" => "Martinique",
                            "MR" => "Mauritania",
                            "MU" => "Mauritius",
                            "YT" => "Mayotte",
                            "MX" => "Mexico",
                            "FM" => "Micronesia, Federated States of",
                            "MD" => "Moldova, Republic of",
                            "MC" => "Monaco",
                            "MN" => "Mongolia",
                            "ME" => "Montenegro",
                            "MS" => "Montserrat",
                            "MA" => "Morocco",
                            "MZ" => "Mozambique",
                            "MM" => "Myanmar",
                            "NA" => "Namibia",
                            "NR" => "Nauru",
                            "NP" => "Nepal",
                            "NL" => "Netherlands",
                            "AN" => "Netherlands Antilles",
                            "NC" => "New Caledonia",
                            "NI" => "Nicaragua",
                            "NE" => "Niger",
                            "NG" => "Nigeria",
                            "NU" => "Niue",
                            "NF" => "Norfolk Island",
                            "MP" => "Northern Mariana Islands",
                            "NO" => "Norway",
                            "OM" => "Oman",
                            "PK" => "Pakistan",
                            "PW" => "Palau",
                            "PS" => "Palestinian Territory, Occupied",
                            "PA" => "Panama",
                            "PG" => "Papua New Guinea",
                            "PY" => "Paraguay",
                            "PE" => "Peru",
                            "PH" => "Philippines",
                            "PN" => "Pitcairn",
                            "PL" => "Poland",
                            "PT" => "Portugal",
                            "PR" => "Puerto Rico",
                            "QA" => "Qatar",
                            "RE" => "Reunion",
                            "RO" => "Romania",
                            "RU" => "Russian Federation",
                            "RW" => "Rwanda",
                            "SH" => "Saint Helena",
                            "KN" => "Saint Kitts and Nevis",
                            "LC" => "Saint Lucia",
                            "PM" => "Saint Pierre and Miquelon",
                            "VC" => "Saint Vincent and The Grenadines",
                            "WS" => "Samoa",
                            "SM" => "San Marino",
                            "ST" => "Sao Tome and Principe",
                            "SA" => "Saudi Arabia",
                            "SN" => "Senegal",
                            "RS" => "Serbia",
                            "SC" => "Seychelles",
                            "SL" => "Sierra Leone",
                            "SG" => "Singapore",
                            "SK" => "Slovakia",
                            "SI" => "Slovenia",
                            "SB" => "Solomon Islands",
                            "SO" => "Somalia",
                            "ZA" => "South Africa",
                            "GS" => "South Georgia and The South Sandwich Islands",
                            "ES" => "Spain",
                            "LK" => "Sri Lanka",
                            "SD" => "Sudan",
                            "SR" => "Suriname",
                            "SJ" => "Svalbard and Jan Mayen",
                            "SZ" => "Swaziland",
                            "SE" => "Sweden",
                            "CH" => "Switzerland",
                            "SY" => "Syrian Arab Republic",
                            "TW" => "Taiwan, Province of China",
                            "TJ" => "Tajikistan",
                            "TZ" => "Tanzania, United Republic of",
                            "TH" => "Thailand",
                            "TL" => "Timor-leste",
                            "TG" => "Togo",
                            "TK" => "Tokelau",
                            "TO" => "Tonga",
                            "TT" => "Trinidad and Tobago",
                            "TN" => "Tunisia",
                            "TR" => "Turkey",
                            "TM" => "Turkmenistan",
                            "TC" => "Turks and Caicos Islands",
                            "TV" => "Tuvalu",
                            "UG" => "Uganda",
                            "UA" => "Ukraine",
                            "AE" => "United Arab Emirates",
                            "UM" => "United States Minor Outlying Islands",
                            "UY" => "Uruguay",
                            "UZ" => "Uzbekistan",
                            "VU" => "Vanuatu",
                            "VE" => "Venezuela",
                            "VN" => "Viet Nam",
                            "VG" => "Virgin Islands, British",
                            "VI" => "Virgin Islands, U.S.",
                            "WF" => "Wallis and Futuna",
                            "EH" => "Western Sahara",
                            "YE" => "Yemen",
                            "ZM" => "Zambia",
                            "ZW" => "Zimbabwe"
            );
        $this->setProperties();
    }
    
    protected function setProperties()
    {
        foreach ( $this->countryAndCodes as $code => $country ){
            $this->codes[]      = $code;
            $this->countries[]  = $country;
        }
    }
    
    /**
     * Returns an Array containing names of all the countries.
     * 
     * @return array
     */
    public function getCountryNamesOnly()
    {
        return $this->countries;
    }
    
    /**
     * Returns an Array containing all the country codes.
     *  
     * @return array
     */
    public function getCountryCodesOnly()
    {
        return $this->codes;
    }
    
    /**
     * Returns Code of a country when its name is supplied.
     * 
     * @param string $countryName
     * @return string
     */
    public function getCode( $countryName )
    {
        return array_search( $countryName, $this->countryAndCodes );
    }
    
    /**
     * Returns Name of a country when its code is supplied
     * 
     * @param string $countryCode
     * @return string
     */
    public function getCountry( $countryCode )
    {
        return $this->countryAndCodes[$countryCode];
    }
    
    /**
     * Returns associative array of country code as key and country name as 
     * value.
     * 
     * @return array
     */
    public function getCountriesAndCodes()
    {
        return $this->countryAndCodes;
    }
}