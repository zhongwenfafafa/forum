<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserAvatarRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UploadImageService;

class UserAvatarController extends Controller
{
    public function store(UserAvatarRequest $request, User $user, UploadImageService $imageService)
    {
        $this->authorize('update', auth()->user());

        $result = $imageService->save($request->file, 'avatars', auth()->id());

        if (! $result) {
            return back()->withErrors('上传图片失败');
        }

        auth()->user()->update([
            'avatar_path' => $result['path']
        ]);

        return back();
    }
}
