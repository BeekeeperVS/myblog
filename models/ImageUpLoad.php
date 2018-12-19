<?php
/**
 * Created by PhpStorm.
 * User: vitalii
 * Date: 17.12.18
 * Time: 15:21
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpLoad extends Model
{
    public $image;

//    public function uploadFile(UploadedFile $file){
////        die($file->tempName);
//
//       $file->saveAs("uploads/".$file->name);
//    }
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function upload($currentImage)
    {

        if($this->validate()){
            $this->deleteCurrentImage($currentImage);
            $fileName=$this->generationFileName();
            $this->image->saveAs($this->getFolder().$fileName);
            return $fileName;
        }

    }

    private function getFolder(){
        return 'uploads/';
    }
    private function generationFileName(){
        return strtolower(md5(uniqid($this->image->baseName)).'.'.$this->image->extension);

    }
    public function deleteCurrentImage($currentImage){
        //if (file_exists($this->getFolder().$currentImage))
        if (!empty($currentImage) && $currentImage != null)
        {
            unlink($this->getFolder().$currentImage);
        }
    }


}