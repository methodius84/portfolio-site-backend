<?php

namespace App\DTO\Weather\ResponseDTO\Geocode;

class ResponseDTO
{
    /**
     * @var array<LocationDTO> $locations Locations list
     */
    private readonly array $locations;
    public function __construct(array $data)
    {
        $locations = [];
        foreach ($data as $location) {
            $locations[] = new LocationDTO($location);
        }
        $this->locations = $locations;
    }

    /**
     * @return LocationDTO[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

}
