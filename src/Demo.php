<?php

//namespace Controllers;
namespace App;
class Demo {

    public function index()
    {
        echo 'home';
    }

    public function page($id,$title,$author,$image,$content)
    {

        echo 'page';
        $title= urldecode($title) ;
        $image = urldecode($image);
        $content = urldecode($content);
        $author = urldecode($author);
        $id = $id;

        $data = json_decode(file_get_contents('articles.json'), true);

        $item = $data[$id];

        $filename = 'articles.json';

        $colors = array_column($data, 'id');
        $found_key = array_search($id, $colors); // array key

        if($title!='none'){
            $data[$found_key+1]['title'] = $title;
        }
        if($image!='none'){
            $image = str_replace("^", "/", $image);
            $image = str_replace("<", "?", $image);
            $data[$found_key+1]['image'] = $image;
        }
        if($content!='none'){
            $data[$found_key+1]['content'] = $content;
        }
        if($author!='none'){
            $data[$found_key+1]['author'] = $author;
        }


        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE ) ;

        file_put_contents($filename, $json_data);

        echo "<script>window.location.href = 'http://php.test/admin/article/edit/{$id}'</script>";
    }

    public function view($id)
    {
        echo $id;
    }

    public function delite ($id) {
        $data = json_decode(file_get_contents('articles.json'), true);

        $item = $data[$id];

        $filename = 'articles.json';

        $colors = array_column($data, 'id');
        $found_key = array_search($id, $colors); // array key

        unset($data[$found_key+1]);

        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE ) ;

        file_put_contents($filename, $json_data);
        echo "<script>window.location.href = 'http://php.test/admin/articles'</script>";
    }
}