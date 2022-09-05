<?php

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function getRecentlyCreatedAttribute(): bool
    {
        if (isset($this->created_at, $this->updated_at)) {
            return $this->wasRecentlyCreated || $this->created_at === $this->updated_at || $this->created_at->diffInSeconds($this->updated_at) <= 1;
        }
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    public function scopeWhereLike($query, $column, $value)
    {
        if (!isset($value)) {
            return $query;
        }
        return $query->where($column, 'like', '%' . $value . '%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        if (!isset($value)) {
            return $query;
        }
        return $query->orWhere($column, 'like', '%' . $value . '%');
    }

//    public function scopeSearchFullText($query, $term)
//    {
//        $columns = implode(',', $this->searchable);
//
//        $searchableTerm = $this->fullTextWildcards($term);
//
//        return $query->selectRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$searchableTerm])
//            ->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $searchableTerm)
//            ->orderByDesc('relevance_score');
//    }

//    protected function fullTextWildcards($term)
//    {
//        // removing symbols used by MySQL
//        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
//        $term = str_replace($reservedSymbols, '', $term);
//
//        $words = explode(' ', $term);
//
//        foreach ($words as $key => $word) {
//            /*
//             * applying + operator (required word) only big words
//             * because smaller ones are not indexed by mysql
//             */
//            if (strlen($word) >= 3) {
//                $words[$key] = '+' . $word . '*';
//            }
//        }
//
//        $searchTerm = implode(' ', $words);
//
//        return $searchTerm;
//    }

//    public function scopeOrSearchFullText($query, $term)
//    {
//        $columns = implode(',', $this->searchable);
//
//        $searchableTerm = $this->fullTextWildcards($term);
//
//        return $query
//            ->orWhereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $searchableTerm)
//            ->orderByDesc('relevance_score');
//    }

    public function getCreatedAtHumanAgoAttribute()
    {
        if (isset($this->created_at)) {
            return verta($this->attributes['created_at'])->timezone('Asia/Tehran')->formatDifference();
        }
    }

    public function getCreatedAtHumanAttribute()
    {
        if (isset($this->created_at)) {
            return verta($this->attributes['created_at'])->timezone('Asia/Tehran')->format('H:i %B %d، %Y');
        }
    }

    public function getUpdatedAtHumanAgoAttribute()
    {
        if (isset($this->updated_at)) {
            return verta($this->attributes['updated_at'])->timezone('Asia/Tehran')->formatDifference();
        }
    }


    public function getUpdatedAtHumanAttribute()
    {
        if (isset($this->updated_at)) {
            return verta($this->attributes['updated_at'])->timezone('Asia/Tehran')->format('H:i %B %d، %Y');
        }
    }

    public function getStatusNameAttribute()
    {
        return $this->showStatus();
    }

    public function showStatus()
    {
        if (!isset($this->attributes['status'])) {
            return;
        }


        switch ($this->attributes['status']) {
                case 1:
                    return 'فعال';
                case 0:
                    return 'غیر فعال';
                default:
                    return 'تعیین نشده';
            }
    }
}
