<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;


class FolderController extends Controller
{
    /**
     *  【フォルダ作成ページの表示機能】
     *  機能：フォルダの新規作成ページの画面を表示する
     *
     *  GET /folders/create
     *  @return \Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('folders/create');
    }

    /**
     *  【フォルダを新規作成してDBに書き込む処理】
     *  機能：フォルダを新規作成してDBに書き込む処理をしてタスク一覧にリダイレクトする
     *
     *  POST /folders/create
     *  @param CreateFolder $request （Requestクラスの機能は引き継がれる）
     *  @return \Illuminate\Http\RedirectResponse
     *  @var App\Http\Requests\CreateFolder
     */
    public function create(CreateFolder $request)
    {
        $folder = new Folder();
        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
