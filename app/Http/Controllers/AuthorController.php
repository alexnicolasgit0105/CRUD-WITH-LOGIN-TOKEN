<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthorController extends Controller
{

    public static $base_url = 'https://symfony-skeleton.q-tests.com/';

    public function list(Request $request)
    {
        $authors = self::requestApi($request->session()->get('token_key'),'api/v2/authors','GET');
        return view('author.list', $request)->withAuthors($authors)->withUserInfo($request->session()->all()['user_data']);
    }

    public function detail(Request $request,$id)
    {
        $author = self::requestApi($request->session()->get('token_key'),"api/v2/authors/{$id}",'GET');
        return view('author.detail', $request)->withAuthor($author);
    }

    public function deleteBook(Request $request,$id)
    {
        $ids = explode("_", $id);
        $author = self::requestApi($request->session()->get('token_key'),"api/v2/books/".$ids[0],'DELETE');
        return redirect('/Author/detail/'.$ids[1]);
    }

    public function addBook(Request $request)
    {

        if ($request->submit) {


            $params = [
                "author" => [
                    "id" => (int)$request->author_id
                ],
                "title" => $request->title,
                "release_date" => $request->release_date,
                "description" => $request->description,
                "isbn" => $request->isbn,
                "format" => $request->format,
                "number_of_pages" => (int)$request->number_of_pages
            ];

            $add = self::requestApi($request->session()->get('token_key'),'api/v2/books','POST',$params);
            return redirect('/Author/detail/'.$request->author_id);

        } else {
            $authors = self::requestApi($request->session()->get('token_key'),'api/v2/authors','GET');
            return view('author.addbook', $request)->withAuthors($authors);
        }
       
    }

    public static function requestApi($token,$url,$action,$data = []) {


        if ($action != 'POST') {

            $client = new Client(['base_uri' => self::$base_url.$url]);
            $headers = [
                'Authorization' => 'Bearer ' . $token,        
                'Accept'        => 'application/json',
            ];
            $response = $client->request($action, '', [
                'headers' => $headers
            ]);
        } else {

            $client = new Client();
            $response = $client->request('POST', self::$base_url.$url, [
                   'headers' => [
                    'Content-Type' => 'application/json',
                     'Authorization' => 'Bearer '.$token,
                   ],
                   'body' => json_encode($data)
            ]);
            return true;
        }
        

        return json_decode($response->getBody(),true);
    }

}