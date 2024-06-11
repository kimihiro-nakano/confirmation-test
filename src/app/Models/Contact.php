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
        // return $genderLabels[$this->attributes['gender']];
        // return $genderLabels[$this->gender];
        return $genderLabels[$this->gender] ?? '不明';
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        return $query;
    }

    public function scopeGenderFilter($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $genderMap = ['male' => 1, 'female' => 2, 'other' => 3];
            if (array_key_exists($gender, $genderMap)) {
                $query->where('gender', $genderMap[$gender]);
            }
        }
        return $query;
    }

    public function scopeCategoryFilter($query, $categoryId)
    {
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }
        return $query;
    }

    public function scopeDateFilter($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}


