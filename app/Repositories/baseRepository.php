<?php

namespace App\Repositories;

use App\Contracts\BaseInterface;
use App\Traits\image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Traits\Media;
class baseRepository implements baseInterface
{
    public Model $currentModel;
    protected $currentTable;
    protected $data;
    use image;

    public function __construct(string $modelName)
    {
        if (!empty($modelName)) {
            $this->currentModel = app("App\\Models\\{$modelName}");
            $this->currentTable = $this->currentModel->getTable();
        }
    }

    public function create(array $data)
    {
        // dd($data);
        $images = $data['image'] ?? null;

        unset($data['image'], $data['video'], $data['document'], $data['charity_id']);
        // dd($this->currentModel);

        $model = $this->currentModel->create($data);
        // dd($model);

        if (is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $this->createImage($model, $image, 'image');
                }
            }
        } else if ($images instanceof \Illuminate\Http\UploadedFile) {
            $this->createImage($model, $images, 'image');
        }

        return $model;
    }

    public function update(int $id, array $data)
    {
        // dd($data);
        $images = $data['image'] ?? null;
        $video = $data['video'] ?? null;
        $document = $data['document'] ?? null;   // single document file
        $charityId = $data['charity_id'] ?? null;

        unset($data['image'], $data['video'], $data['document'], $data['charity_id']);
        // dd($data);
        $model = $this->currentModel->find($id);
        $model->update($data);
        if (is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $this->updateImage($model, $image, 'image');
                }
            }
        } elseif ($images instanceof \Illuminate\Http\UploadedFile) {
            $this->updateImage($model, $images, 'image');
        }

        return $model;
    }
    public function delete(int $id)
    {
        return $this->currentModel->destroy($id);
    }
    public function all(array $with = []): Collection
    {
        return $this->currentModel->with($with)->get();
    }

    // Additional common methods like find, create, etc.
    public function findById($id, array $with = []): ?Model
    {
        return $this->currentModel->with($with)->find($id);
    }



    public function findByName($name)
    {
        return $this->currentModel->where('name', $name)->first();
    }

    public function syncOrDetachRelationship(Model $model, string $relation, array $ids, bool $sync = true): bool
    {
        // Check if the relationship method exists
        if (!method_exists($model, $relation)) {
            throw new \InvalidArgumentException("The relationship method {$relation} does not exist on the model.");
        }

        $relationship = $model->$relation();
        if (!$sync) {
            $relationship->detach($ids);
            return true;
        }
        $result = $relationship->sync($ids);

        return isset($result['attached']) || isset($result['detached']) || isset($result['updated']);
    }
}
