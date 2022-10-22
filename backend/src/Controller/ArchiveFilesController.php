<?php

namespace App\Controller;

use App\Core\Response;
use App\Service\ArchiveFilesService;

class ArchiveFilesController
{
    public function getArchiveFiles()
    {
        $user1Files = [
            'user' => 'User1',
            'files' => ['file1.txt', 'file3.txt', 'file5.txt', 'file7.txt', 'file9.txt']
        ];

        $user2Files = [
            'user' => 'User2',
            'files' => ['file2.txt', 'file4.txt', 'file6.txt', 'file8.txt', 'file10.txt']
        ];

        $service = new ArchiveFilesService();

        $id = $service->setArchiveFilesTask([$user1Files, $user2Files]);

        return new Response([
            'id' => $id
        ]);
    }
}