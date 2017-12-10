<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function wizNoteLogin()
    {
        $wizNote = new WizNoteController('boxiaozhi.bolu@gmail.com', '***REMOVED***');
//        $note = '        {
//            "documentGuid": "101e5749-25a7-4cbb-be18-aa73ea64a0af",
//            "userId": "boxiaozhi.bolu@gmail.com",
//            "title": "Tmux",
//            "kbGuid": "3a581ac6-0c45-4515-b0cc-087142646344",
//            "createdAt": "2017-10-18T09:58:03.000+0000",
//            "expiredDaysSet": null,
//            "id": 1845607,
//            "readCountLimit": null,
//            "userGuid": "6c3dd15e-d1cd-4c59-9d3b-c242b4accf0a",
//            "updatedAt": "2017-12-03T00:53:56.000+0000",
//            "password": null,
//            "readCountSet": null,
//            "shareId": "0Wm1H60chkkl2MP0xN12p6d40g7Bt90BFQOX2-6aFP3Gpa2L",
//            "spamReason": null,
//            "readCount": 303,
//            "documentOwnerGuid": "6c3dd15e-d1cd-4c59-9d3b-c242b4accf0a",
//            "spamStatus": 0,
//            "expiredAt": null,
//            "shareUrl": "http://3a581ac6.wiz03.com/share/s/0Wm1H60chkkl2MP0xN12p6d40g7Bt90BFQOX2-6aFP3Gpa2L"
//        }';
//        $note = json_decode($note,true);
//        return $wizNote->noteDetail($note);
        $wizNote->sync();
        $res = $wizNote->shareTags();
        return $res;
    }
}
