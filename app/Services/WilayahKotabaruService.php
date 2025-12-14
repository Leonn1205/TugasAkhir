<?php

namespace App\Services;

class WilayahKotabaruService
{
    private array $polygon;
    private array $bounds;

    public function __construct()
    {
        $path = public_path('geojson/kotabru.geojson');

        $geojson = json_decode(file_get_contents($path), true);

        $this->polygon = $geojson['features'][0]['geometry']['coordinates'][0];
        $this->bounds = $this->hitungBoundingBox($this->polygon);
    }

    private function hitungBoundingBox(array $polygon): array
    {
        $latMin = $lngMin = INF;
        $latMax = $lngMax = -INF;

        foreach ($polygon as $point) {
            $lng = $point[0]; // urutan GeoJSON
            $lat = $point[1];

            $latMin = min($latMin, $lat);
            $latMax = max($latMax, $lat);
            $lngMin = min($lngMin, $lng);
            $lngMax = max($lngMax, $lng);
        }

        return compact('latMin', 'latMax', 'lngMin', 'lngMax');
    }

    public function dalamBoundingBox(float $lat, float $lng): bool
    {
        return
            $lat >= $this->bounds['latMin'] &&
            $lat <= $this->bounds['latMax'] &&
            $lng >= $this->bounds['lngMin'] &&
            $lng <= $this->bounds['lngMax'];
    }
}
