<?php

namespace App\Repositories;

use App\Dream;

class DreamRepository {

    public function getDreamsWithUserPaginate($n)
    {
        $dreams = Dream::with('user')
                ->latest()
                ->simplePaginate($n);

        return $dreams;
    }

    public function store($inputs, $user_id)
    {
        $dream = new Dream;
        $dream->content = $inputs['content'];
        $dream->user_id = $user_id;
        $dream->save();
    }

    public function update($inputs, $id)
    {
        $dream = $this->getById($id);

        if ($dream->user_id == auth()->id())
        {
            $dream->content = $inputs['content'];
            return $dream->save();
        }
        return false;
    }

    public function destroy($id)
    {
        $dream = $this->getById($id);

        if ($dream->user_id == auth()->id())
        {
            return $dream->delete();
        }
        return false;
    }

    public function getById($id)
    {
        return Dream::findOrFail($id);
    }

}
