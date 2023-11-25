<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditFolder;

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
     *  【フォルダの作成機能】
     *  機能：フォルダが新規作成されたらDBに書き込む処理をしてタスク一覧にリダイレクトする
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

    /**
     *  【フォルダ編集ページの表示機能】
     *  機能：フォルダIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{id}/edit
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function showEditForm(int $id)
    {
        $folder = Folder::find($id);

        return view('folders/edit', [
            'folder_id' => $folder->id,
            'folder_title' => $folder->title,
        ]);
    }

    /**
     *  【フォルダの編集機能】
     *  機能：フォルダが編集されたらDBを更新処理をしてタスク一覧にリダイレクトする
     *
     *  POST /folders/{id}/edit
     *  @param int $id
     *  @param EditTask $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function edit(int $id, EditFolder $request)
    {
        $folder = Folder::find($id);

        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     *  【フォルダ削除ページの表示機能】
     *  機能：フォルダIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{id}/delete
     *  @param int $id
     *  @return \Illuminate\View\View
     */
    public function showDeleteForm(int $id)
    {
        $folder = Folder::find($id);

        return view('folders/delete', [
            'folder_id' => $folder->id,
            'folder_title' => $folder->title,
        ]);
    }

    /**
     *  【フォルダの削除機能】
     *  機能：フォルダが削除されたらDBから削除し、フォルダ一覧にリダイレクトする
     *
     *  POST /folders/{id}/delete
     *  @param int $id
     *  @return RedirectResponse
     */
    public function delete(int $id)
    {
        $folder = Folder::find($id);

        $folder->tasks()->delete();
        $folder->delete();

        $folder = Folder::first();

        return redirect()->route('tasks.index', [
            'id' => $folder->id
        ]);
    }
}
