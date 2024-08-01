<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class Cacher
{
    protected string $store;

    public function __construct(string $store = 'file')
    {
        $this->store = $store;
    }

    // Méthode pour définir les données en cache avec une durée de vie
    public function setCached(string $key, array $value, int $minutes = 5256000): bool
    {
        // Récupérer les données existantes
        $existingData = $this->getCached($key);

        // Si des données existent déjà, les ajouter au tableau
        if (is_array($existingData)) {
            $existingData[] = $value;
        } else {
            // Sinon, créer un nouveau tableau avec la nouvelle valeur
            $existingData = [$value];
        }

        // Convertir le tableau mis à jour en JSON
        $jsonValue = json_encode($existingData);

        // Stocker le tableau mis à jour dans le cache
        return Cache::store($this->store)->put($key, $jsonValue, $minutes);
    }

    // Méthode pour obtenir les données en cache
    public function getCached(string $key)
    {
        $value = Cache::store($this->store)->get($key);

        // Vérifie si la valeur est un JSON valide, si oui, la convertir en tableau
        $decodedValue = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decodedValue;
        }

        // Si ce n'est pas un JSON valide, retourner la valeur telle quelle
        return $value;
    }

    // Méthode pour supprimer les données en cache
    public function removeCached(string $key): bool
    {
        return Cache::store($this->store)->forget($key);
    }

    // Méthode pour mettre à jour les données en cache
    public function updateCached(string $key, array $newData): bool
    {
        // Récupérer les données existantes
        $existingData = $this->getCached($key);

        // Si des données existent déjà, les fusionner avec les nouvelles données
        if (is_array($existingData)) {
            $existingData = array_merge($existingData, $newData);
        } else {
            // Sinon, créer un nouveau tableau avec les nouvelles données
            $existingData = $newData;
        }

        // Convertir le tableau mis à jour en JSON
        $jsonValue = json_encode($existingData);

        // Stocker le tableau mis à jour dans le cache
        return Cache::store($this->store)->put($key, $jsonValue, 5256000);
    }
}
