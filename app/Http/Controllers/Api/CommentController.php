<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CommentController extends BaseController
{
  public function index()
  {
    $client = new Client();
    $res = $client->request("GET", "https://api.comments.hk");
    $res = $res->getBody()->getContents();
    return $res;
  }
}
