<?php

namespace App\Traits ;
use Illuminate\Database\Eloquent\Model;

trait QueryTrait
{
    public function InsertData(Model $model , array $data)
    {
        if (in_array(HasTranslations::class, class_uses($model))) {
            // first insert translation data => getTranslatedAttributes == ['ar' , 'en']
            foreach ($model->getTranslatedAttributes() as $field)
            {
                if (isset($data[$field]))
                {
                    $model->setTranslations($field, $data[$field]);
                    unset($data[$field]);
                }
            }
        }
        return $model->create($data) ;
    }

    public function updataData(Model $model , $id , array $data)
    {
        $checkInDB = $model::findorfail($id); 
        if (in_array(HasTranslations::class, class_uses($model))) {
            // first insert translation data => getTranslatedAttributes == ['ar' , 'en']
            foreach ($model->getTranslatedAttributes() as $field)
            {
                if (isset($data[$field]))
                {
                    $model->setTranslations($field, $data[$field]);
                    unset($data[$field]);
                }
            }
        }
        return $checkInDB->update($data) ;

    }

    public function deleteData(Model $model , $id)
    {
        return $model::findorfail($id)->delete();
    }
}

