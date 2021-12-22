<?php

namespace App\Application\Services;

use Intervention\Image\ImageManager;

class MessageImage implements ImageInterface
{
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * Наложение водяного знака
     * @param $file
     * @return int
     */
    public function watermark($file)
    {
        $imageManager = $this->imageManager;
        $image = $imageManager->make($file);
        $image
            ->resize(200, null, function ($image) {
                $image->aspectRatio();
            })
            ->text(
                "lolololo",
                100,
                null,
                function ($font) {
                    $font->size(40);
                    $font->color(array(255, 0, 0, 0.5));
                    $font->align("center");
                    $font->valign("center");
                }
            )
            ->save($file);

        return 0;
    }
}