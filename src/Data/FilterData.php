<?php

namespace App\Data;

/**
 * class using to display form and retrieve data from the form filter menu (cf. FilterDataType)
 */
class FilterData 
{
    public string $electricityLevel;
    public string $internetLevel;
    public string $sunshineLevel;
    public string $housingLevel;
    public int $temperatureMax;
    public int $temperatureMin;
    public int $demographyMin;
    public int $demographyMax;
    public int $costMax;
    public int $costMin;
    public int $areaMin;
    public int $areaMax;
    public int $timezone;
    public string $currencyType;
    public string $visaType;
    public bool $visaRequired = false;
    public string $language;
    public string $environment;
}