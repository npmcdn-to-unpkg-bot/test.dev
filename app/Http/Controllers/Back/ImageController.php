<?php

namespace App\Http\Controllers\Back;

use App\Product;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{

    protected $photo;

    public function __construct(){

        $this->middleware('auth');

    }


    public function upload(FileRequest $request){

        $response=array();

        $files=array('files'=>$request->file('files'));

        $validator=\Validator::make($files,$request->rules());

        if($validator->fails()){

            $response=$validator->errors();

        }

        else {

            //$file=$request->file('files');

            if ($request->hasFile('files') && $request->has('id')) {

                $file = $request->file('files');

                $product = Product::find($request->get('id'));


                if($this->process($file,$product)){

                    $response=[
                        'files'=>[
                            'file'=>[
                                'path'=>'/uploads/'.$product->model.'/'.$this->photo,
                                'name'=>$this->photo
                            ]
                        ]
                    ];
                }

                else{
                    $response=[
                        'error'=>'Ошибка загрузки изображения!'
                    ];
                }

            }
        }
        return response()->json($response);

    }


     private function process(UploadedFile $file,Product $product){

         $filename=$this->generateFileName($file->getClientOriginalExtension());

         $this->photo=$filename;

         $folder=\Config::get('filesystems.disks.uploads.root').'/'.$product->model;

         if(!$product->photo){

             $product->photo=$filename;
             $product->save();
         }

         if(\Storage::disk('uploads')->exists($product->model)){

             Image::make($file)->save($folder.'/'.$filename);

             return true;

         }

         return false;
     }


    /**
     * @param string $prefix - (-,_,* и т.д.)
     * @param $ext- расширение файла
     * @return string - сгенерированное имя файла
     */
    private function generateFileName($ext,$prefix=null)
    {
       return is_null($prefix)?uniqid('_').'.'.$ext:uniqid($prefix).'.'.$ext;
    }


}
