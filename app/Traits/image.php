<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait image
{
    
    public function createImage($model, UploadedFile $file, string $type = 'image')
    {
        // Save file to 'public/images'
        $path = $file->store('images', 'public');

        // Create related image record
        $model->images()->create([
            'path' => $path,
            'type' => $type,
        ]);
    }

    /**
     * Handle updating image for a model.
     * Deletes old images of the same type, stores new one.
     */
    public function updateImage($model, UploadedFile $file, string $type = 'image')
    {
        // Delete old images of this type
        $oldImages = $model->images()->where('type', $type)->get();

        foreach ($oldImages as $oldImage) {
            // Delete file from storage
            if (Storage::disk('public')->exists($oldImage->path)) {
                Storage::disk('public')->delete($oldImage->path);
            }
            // Delete DB record
            $oldImage->delete();
        }

        // Store new image
        $this->createImage($model, $file, $type);
    }
}
