<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail'];

    public function getName()
    {
        $name = $this->last_name . " " . $this->first_name;
        return $name;
    }

    protected $appends = ['gender_label'];

    public function getGenderLabelAttribute()
    {
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        return $genderLabels[$this->attributes['gender']];
    }

    public function scopeNameEmailSearch($query, $request)
    {
        if (!empty($request->name)) {
            $query->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%');
        }
        if (!empty($request->email)) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        return $query;
    }

}


