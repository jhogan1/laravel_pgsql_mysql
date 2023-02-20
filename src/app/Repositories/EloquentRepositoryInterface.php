<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * BaseRepositoryInterface_Interface
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params = []): Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function update(int $id, array $params = []): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;

    /**
     * @return Collection
     */
    public function all(): Collection;

    public function getFillable(): array;
}
