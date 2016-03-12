<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps=true;

    protected  $fillable=['model','article','category_id','growth','size','description','new'];


    public function seasons(){

        return $this->belongsToMany('App\Season');

    }

    public function category(){
        //return $this->hasOne('App\Category');
        return $this->belongsTo('App\Category');
    }


    public function materials(){
        return $this->belongsToMany(Material::class);
    }

    /**
     * get list (id) related seasons with this instance
     */
    public function getSeasonListAttribute(){
        return $this->seasons->pluck('id')->all();
    }

    public function getMaterialListAttribute(){
        return $this->materials->pluck('id')->all();
    }

    /*public function getCategoryListAttribute(){

        return $this->categories->pluck('id')->all();

    }*/

    /***
     * @param $value - created_at поле модели
     * @return string  локализованная дата
     */
   /* public function getCreatedAtAttribute($value){

        Carbon::setLocale('ru');
        return Carbon::parse($value)->formatLocalized('%d.%m.%Y');
    }*/

    /***
     * @param $value
     * @return string размеры как интревал
     */
    public  function  getSizeAttribute($value){
        $size=explode(';',$value);
        return sprintf("%d - %d",$size[0]/2,$size[1]/2);
    }

    /***
     * Выясняем, модель новая или нет (старше 31 дня?)
     * @return int
     */
    public function isNew(){
       return  Carbon::now()->diffInDays(Carbon::parse($this->getAttribute('created_at')))<31?1:0;
    }

    /***
     * @return array получаем массив изображений для текущей модели
     */

    public function images(){
        $images=\Storage::disk('uploads')->files($this->model);

        $images=array_map(function($item){
            $parts=explode('/',$item);
            return $parts[1];
        },$images);

        return $images;
    }

    /***
     * @param $query
     * @return mixed записи, которые помечены, как опубликованные
     */
    public function scopePublished($query){
        return $query->where('published',1);
    }


    /***
     * @param $query
     * @return mixed только новые модели
     */
    public function scopeNew($query){
        return $query->whereBetween('created_at',[
            Carbon::now()->subMonth(),Carbon::now()
        ]);
    }


    /***
     * @param $query
     * @param array $seasons - массив с идентификаторами сезонов
     * @return mixed выбираем модели, которые соотвутствую сезону
     */
    public function scopeBySeason($query,array $seasons){

        return $query->whereHas('seasons', function ($query) use ($seasons) {
            $query->whereIn('id', $seasons);
        });

    }


    public function scopeByCategory($query,Category $category){

        if($category->isRoot())
            return $query->whereIn('category_id',$category->descendants()->get(['id']));
        else
            return $query->where('category_id',$category->id);


    }
}
