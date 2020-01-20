<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as gRequest;

class GeocoderProvider {
    static function getGeocoder(string $typeGeocoder): IGeocoder
    {
        switch ($typeGeocoder) {
            case 'yandex':
                $geocoder = new YandexGeocoder();
                break;

            case 'sputnik':
                $geocoder = new SputnikGeocoder();
                break;

            default:
                //throw exeption
                break;
        }
        return $geocoder;
    }
}

interface IGeocoder
{
    public function getAddress(string $lat, string $lon): string;
}

class YandexGeocoder implements IGeocoder
{
    public function getAddress(string $lon, string $lat): string
    {
        $client = new Client();
        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?apikey=ec61b180-d93a-4b30-93b4-27457af284c1&geocode='.$lon.','.$lat.'&format=json');
        $content = json_decode($response->getBody()->getContents(),true);
        $address = $content["response"]["GeoObjectCollection"]["featureMember"][0]["GeoObject"]["name"];
        return $address;
    }
}

class SputnikGeocoder implements IGeocoder
{
    public function getAddress(string $lon, string $lat): string
    {
        $client = new Client();
        $response = $client->get('https://geocode-maps.yandex.ru/1.x/?apikey=ec61b180-d93a-4b30-93b4-27457af284c1&geocode='.$lon.','.$lat.'&format=json');
        $content = json_decode($response->getBody()->getContents(),true);
        $address = $content["response"]["GeoObjectCollection"]["featureMember"][0]["GeoObject"]["name"];
        return $address;
    }
}

