<?
namespace site\classes;

class manageSite{

    public $error = '';

    public $title_page = 'main page';

    function setTitle($title = 'main page'){
        return '<title>'.$title.'</title>';
    }
   
}
?>