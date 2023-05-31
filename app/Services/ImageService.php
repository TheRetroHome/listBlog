<?php

 namespace App\Services;
 use Illuminate\Http\UploadedFile;
 use Intervention\Image\Facades\Image;
 use Illuminate\Support\Facades\File;

 class ImageService
 {
     public function handleUpload(UploadedFile $file, $oldImage = null): string
     {
         $date = date('Y-m-d');
         if ($oldImage) {
             $oldDate = date('Y-m-d', strtotime($oldImage));
             if (File::exists(public_path("images/{$oldDate}/{$oldImage}"))) {
                 File::delete(public_path("images/{$oldDate}/{$oldImage}"));
             }
         }

         if (!File::exists(public_path("images/{$date}"))) {
             File::makeDirectory(public_path("images/{$date}"), 0777, true);
         }

         $imageName = time().'.'.$file->extension();
         $imagePath = public_path("images/{$date}/{$imageName}");
         $file->move(public_path("images/{$date}"), $imageName);
         $img = Image::make($imagePath)->resize(150, 150);
         $img->save($imagePath);

         return "images/{$date}/{$imageName}";
     }
 }
