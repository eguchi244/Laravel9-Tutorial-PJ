<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定する
    protected $table = 'folders';

    /*
    * フォルダクラスとタスククラスを関連付けするメソッド
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
