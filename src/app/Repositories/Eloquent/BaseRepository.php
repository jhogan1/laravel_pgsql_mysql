<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * BaseRepository_Class
 */
class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * Constructs BaseRepository
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(array $params = []): Model
    {
        return $this->model->create($params);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $params = []): bool
    {
        $record = $this->model->find($id);

        return $record->update($params);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id): bool
    {
        $record = $this->model->find($id);

        return $record->delete();
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->all()->sortByDesc('id');
    }

    /**
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }
}
