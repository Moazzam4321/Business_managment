<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['item_name','item_type','item_price','item_description','item_pic'];

    public static function create_item($item_name,$item_type,$item_price,$item_description,$item_pic)
    {
       return Item::create([
            'item_name'=> $item_name,
            'item_type'=> $item_type,
            'item_price' => $item_price,
            'item_description'=> $item_description,
            'item_pic'=>$item_pic
       ]);

    }
}
