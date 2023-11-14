<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class TaskController extends Controller
{
    /**
     *  【タスク一覧ページの表示機能】
     *  機能：フォルダとタスクのデータをDBから取得してタスク一覧ページに渡して表示する
     *
     *  GET /folders/{id}/tasks
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function index(int $id)
    {
        $folders = Folder::all();

        return view('tasks/index', [
            'folders' => $folders,
            "current_folder_id"=>$id
        ]);
    }
}