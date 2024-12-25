<?php

use Illuminate\Support\Facades\Storage;

    if (! function_exists('temporaryImageUpload')) {
        function temporaryImageUpload($inputImage)
        {
            $today = date('Y-m-d');
            $today = strtotime($today);
            $path = 'draft/i/'.$today;
            $storagePath = 'public/'.$path;
            $storedImage = $inputImage->store($storagePath);
            $imagePath = '/'.str_replace("public", 'storage', $storedImage);
            return $imagePath;
        }
    }

    if (! function_exists('removeTemporaryImage')) {
        function removeTemporaryImage($imageUrl)
        {
            $imageUrl = str_replace('storage', 'public', $imageUrl);

            $sourceImageArr = explode('/', $imageUrl);
            $sourceImageName = $sourceImageArr[3] ?? null;
            if ($sourceImageName == null || $sourceImageName != 'draft') return false;
            if(Storage::exists($imageUrl)) {
                Storage::delete( $imageUrl);
                return true;
            }
            return false;
        }
    }

    if (! function_exists('imageMove')) {
        function imageMove($sourceImage, $folderName = 'default', $imageStoreTypes = ['originalSize', 'list', 'thumbs'])
        {
            $mime_types = array('image/png', 'image/jpeg', 'image/gif');

            $fileInfoFromPath = public_path($sourceImage);
            $sourceImage = str_replace("storage", 'public', $sourceImage);
            $image = Image::make(Storage::get($sourceImage));
            $image->setFileInfoFromPath($fileInfoFromPath)
                    ->orientate();
            $mime = $image->mime();

            $sourceImageArr = explode('/', $sourceImage);
            $sourceImageName = end($sourceImageArr);
            $today = date('Y-m-d');
            $today = strtotime($today);
            
            $imagePath = [];
            foreach ($imageStoreTypes as $type) {
                $typeFolder = '';
                foreach (preg_split('#[^a-z]+#i', $type, -1, PREG_SPLIT_NO_EMPTY) as $word) {
                    $typeFolder .= $word[0];
                }
                // $path = 'images/uploads/'.$today.'/'.$folderName.'/'.$type;
                $path = 'u/i/'.substr($folderName, 0, 3).'/'.$today.'/'.$typeFolder;
                $storagePath = 'public/'.$path.'/'.$sourceImageName;

                if(Storage::exists($storagePath)) {
                    $d = new DateTime();
                    $miliSecond = $d->format('s-u-');
                    $storagePath = 'public/'.$path.'/'.$miliSecond.$sourceImageName;
                    // Storage::delete( $storagePath);
                }
                switch ($type) {
                    case 'originalSize':
                        Storage::copy($sourceImage, $storagePath);  
                        break;
                    case 'list':
                        if (in_array($mime, $mime_types)) {
                            $image->resize(450, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            Storage::put($storagePath, (string) $image->encode());
                        } else {
                            Storage::copy($sourceImage, $storagePath); 
                        }
                        break;
                    case 'thumbs':
                        if (in_array($mime, $mime_types)) {
                            $image->resize(100, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            Storage::put($storagePath, (string) $image->encode());
                        } else {
                            Storage::copy($sourceImage, $storagePath); 
                        }
                        break;
                    default:
                        Storage::copy($sourceImage, $storagePath);  
                        break;
                }
                $imagePath [$type] = '/'.str_replace("public", 'storage', $storagePath);
            }
            
            Storage::delete( $sourceImage);
            return $imagePath;
        }
    }

    if (! function_exists('imageDelete')) {
        function imageDelete($imageUrl, $permanentDelete = false)
        {
            $imageUrl = str_replace('storage', 'public', $imageUrl);
            $trashPath = str_replace('u', 't', $imageUrl);
            if(Storage::exists($imageUrl)) {
                if ($permanentDelete) {
                    Storage::delete( $imageUrl);
                } else {
                    Storage::move($imageUrl, $trashPath); 
                }   
                return true;
            }
            return false;
        }
    }
    if (! function_exists('temporaryImageClone')) {
        function temporaryImageClone($sourceImage)
        {
            $sourceImageArr = explode('/', $sourceImage);
            if($sourceImageArr[1] != 'storage') {
                $sourceImage = '/storage/'.$sourceImage;
            }
            $sourceImage = str_replace("storage", 'public', $sourceImage);
            $sourceImageName = end($sourceImageArr);
            $extArr = explode('.', $sourceImageName);
            $storeImageName = time().'.'.end($extArr);

            $today = date('Y-m-d');
            $today = strtotime($today);
            $path = 'draft/i/'.$today;
            $storagePath = 'public/'.$path.'/'.$storeImageName;
            if(Storage::exists($storagePath)) {
                Storage::delete( $storagePath);
            }
            Storage::copy($sourceImage, $storagePath);
            $imagePath = '/'.str_replace("public", 'storage', $storagePath);
            return $imagePath;
        }
    }
    if (! function_exists('temporaryImageUploadFromUrl')) {
        function temporaryImageUploadFromUrl($url)
        {
            $info = pathinfo($url);
            $extArr = explode('.', $info['basename']);
            $extLastArr = explode('?', end($extArr));
            $storeImageName = time().'.'.$extLastArr[0];
            
            if(@getimagesize($url)){
                $inputImage = file_get_contents($url);
            }else{
                $inputImage = public_path('/theme-1/assets/media/images/product/no_image.gif');
            }
            
            $today = date('Y-m-d');
            $today = strtotime($today);
            $path = 'draft/i/'.$today;
            $storagePath = 'public/'.$path;
            Storage::put($storagePath.'/'.$storeImageName, $inputImage);
            $storedImage = $storagePath.'/'.$storeImageName;
            $imagePath = '/'.str_replace("public", 'storage', $storedImage);
            return $imagePath;
        }
    }
    if (! function_exists('temporaryImageUploadFromBase64')) {
        function temporaryImageUploadFromBase64($url)
        {
            $inputImage = Image::make($url);
            $storeImageName = time().'.png';
            $today = date('Y-m-d');
            $today = strtotime($today);
            $path = 'draft/i/'.$today;
            $storagePath = 'public/'.$path;
            $storedImage = $storagePath.'/'.$storeImageName;

            if(Storage::exists($storedImage)) {
                $d = new DateTime();
                $miliSecond = $d->format('s-u-');
                $storedImage = $storagePath.'/'.$miliSecond.$storeImageName;
            }
            Storage::put($storedImage, (string) $inputImage->encode());
            $imagePath = '/'.str_replace("public", 'storage', $storedImage);
            return $imagePath;
        }
    }
    