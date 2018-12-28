<?php
/**
 * Created by PhpStorm.
 * User: SX
 * Date: 2017/12/26
 * Time: 14:20
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
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
        if (!$request->hasFile('file')) {
            return $this->sendError('上传失败');
        }

        $file = $request->file('file');


        return $this->sendResponse(['path' => 'storage/' . $file->store('images', 'public')], '上传成功');
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