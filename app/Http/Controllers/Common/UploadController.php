<?php
/**
 * Created by PhpStorm.
 * User: SX
 * Date: 2017/12/26
 * Time: 14:20
 */

namespace App\Http\Controllers\Common;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesserInterface;

class UploadController extends AppBaseController
{
    public function __construct()
    {
        $this->registerExtension();
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('file_data')) {
            return $this->sendError('上传失败');
        }

        $file = $request->file('file_data');


        return $this->sendResponse(['path' => 'storage/' . $file->store('images', 'public')], '上传成功');
    }

    public function delete(Request $request)
    {
        $path = $request->post('path');

        if (!$path) {
            return $this->sendError('path参数错误');
        }

        if ($success = Storage::delete('public' . DIRECTORY_SEPARATOR . $path)) {
            return $this->sendResponse($success, '删除成功');
        }
        return $this->sendError($success);
    }

    protected function registerExtension()
    {
        $guesser = ExtensionGuesser::getInstance();

        $guesser->register(new class implements ExtensionGuesserInterface {

            const EXT = [
                'application/vnd.ms-excel' => 'xlsx',
            ];

            public function guess($mimeType)
            {
                return array_get(static::EXT, $mimeType);
            }
        });
    }
}