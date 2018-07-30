<?php

namespace App\Services;

use Image;

class UploadImageService
{
    protected $allowed_ext = ['png', 'jpeg', 'bmp', 'gif'];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 设置存储文件,文件夹格式
        $folder_name = "uploads/images/{$folder}/" . date('Y/m/d', time());

        // 文件存储物理路径
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名
        $filename = $file_prefix . '_' . time().str_random(10) . '.' . $extension;

        // 判断上传文件是否是图片
        if (! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        // 此处添加图片裁剪逻辑 除去 gif 文件
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path. '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url')."/{$folder_name}/{$filename}",
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 实例化裁剪图片类, 参数为图片物理磁盘路径
        $image = Image::make($file_path);

        // 执行图片裁剪操作
        $image->resize($max_width, null, function ($constraint) {
            // 已最大宽度为 $max_width, 等比缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 保存裁剪后的图片
        $image->save();
    }
}