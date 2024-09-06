<?php

namespace App\Traits ;

use App\Models\Attachment ;
use Storage ;

trait ManageFilesTrait
{
    public function updateOrCreateFiles($request , $imageable_id , $model , $folder  ,$disk)
    {
        if($request->hasFile('files'))
        {
            foreach ($request->file('files') as $file)
            {
                $path_file = $file->getClientOriginalName() ;
                // delete for server
                if(Storage::exists('files/'. $folder .'/'. $imageable_id . '/'. $path_file))
                {
                    Storage::disk($disk)->delete('files/'. $folder .'/'. $imageable_id . '/'. $path_file);
                }
                $file->storeAs('files/'. $folder .'/'. $imageable_id , $path_file , $disk) ;
                Attachment::updateOrcreate([
                    'filename' => $path_file ,
                    'imageable_id' => $imageable_id ,
                    'imageable_type' => $model ,
                    ],[
                    'filename' => $path_file ,
                    'imageable_id' => $imageable_id ,
                    'imageable_type' => $model ,
                ]) ;
            }
        }
    }

    public function deleteAllFiles($imageable_id , $model , $folder , $disk)
    {
        $files_exists = Attachment::where(['imageable_id' => $imageable_id ,'imageable_type' => $model ])->get();
        foreach ($files_exists as $file_exist)
        {
            if(Storage::disk($disk)->exists('files/'. $folder .'/'. $imageable_id . '/'. $file_exist->filename))
            {
                // delete from Server
                Storage::disk($disk)->delete('files/'. $folder .'/'. $imageable_id . '/'. $file_exist->filename );
            }
            // delete from DB
            $file_exist->delete() ;
        }
        // delete folder own company
        Storage::disk($disk)->deleteDirectory('files/'. $folder .'/'. $imageable_id) ;
    }
}



