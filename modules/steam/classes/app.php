<?
namespace app\classes;

class steam{

    public $error = '';

    public $QUERY = '';
    static $ELEMENTS_ON_PAGE = 10;

    static $CSGO_API = 730;
    static $CS2_API = 710;
    static $CLIENT_KEY = 'FFA68153B6E905648D016F8BCDE65D1E';


    public function setFormatingParams(){
        $url = $_SERVER['REQUEST_URI'];

        $parts = parse_url($url); 
        parse_str($parts['query'], $query);

        $this->$QUERY = $query;
    }

    public function getAppList(){
        return file_get_contents('http://api.steampowered.com/ISteamApps/GetAppList/v2');
    }

    public function appListHtml($limit = 50, $page = 1){

        $array = $this->getAppList();
        $array = json_decode($array, true);
        $apps = $array['applist']['apps'];

        $html = array();
        $i = 1;

        if ($page != 0){
            $start_el = ($page * self::$ELEMENTS_ON_PAGE) - self::$ELEMENTS_ON_PAGE;
            $end_el = $page * self::$ELEMENTS_ON_PAGE;
        } else {
            $start_el = 1;
            $end_el = self::$ELEMENTS_ON_PAGE;
        }
       
        $html["ELEMENTS"] = '<div class="card-list">';

        foreach ($apps as $app){
            
            if ($i > $end_el){
                break;
            }
            if ($limit > 0){
                if ($i > $limit){
                    break;
                }
            }

            if ($i >= $start_el){
                if ($app['name'] == ''){
                    continue;
                }
    
                $html["ELEMENTS"] .= '<div class="card-game">
                        <div class="title">
                            <b>'.$i.'.</b>
                            <h5>'.$app["name"].'</h5>
                        </div>
                        <div class="bg"></div>
                    </div>';
    
               
            }
          
            
            $i++;
        }

        $html["ELEMENTS"] .= '</div>';

        $limit = ($limit == 0) ? count($apps) : $limit;


        $pages_count = ceil($limit/self::$ELEMENTS_ON_PAGE);

        $j = 0;
        $li = '';

        $query = $this->$QUERY;
        $queryStr = '';
        $pageCurr = 1;

        foreach($query as $param => $val){
            
            $char = ($j == 0) ? '?' : '&';

            if ($param == 'page') {
                $pageCurr = $val;
                continue;
            } else {
                $queryStr .= $char.$param.'='.$val;
            }

            $j++;
        }

        $i = 1;

        while($pages_count >= $i){

            $class = '';

            if ($i == $pageCurr){
                $class .= ' active';
            }


            if ($i > 6 && $i < ($pages_count - 1)){

                $i = $pages_count - 1;

                $li .= '<li class="page-item '.$class.'">
                    <a class="page-link" href="'.$queryStr.'&page='.$i.'">...</a>
                </li>';
            } else {
                $li .= '<li class="page-item '.$class.'">
                    <a class="page-link" href="'.$queryStr.'&page='.$i.'">'.$i.'</a>
                </li>';
            }
            
          
            $i++;
        }

        $prev_page = $pageCurr - 1;
        $next_page = $pageCurr + 1;

        if ($prev_page < 1){
            $prev_page = 1;
            $prev_page_class = 'disabled';
        }
        if ($next_page > $pages_count){
            $next_page = $pages_count;
            $next_page_class = 'disabled';
        }

        $html["NAV_PAGES"] = '<nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item '.$prev_page_class.'">
                        <a class="page-link" href="'.$queryStr.'&page='.$prev_page.'" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    '.$li.'
                    <li class="page-item '.$next_page_class.'">
                        <a class="page-link" href="'.$queryStr.'&page='.$next_page.'" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>';

        return $html;
    }

    public function UpToUpdateCheck($app, $version){
        if ($app == '' && $version == ''){
            $url = "http://api.steampowered.com/ISteamApps/UpToDateCheck/v1";
        } else {
            $url = "http://api.steampowered.com/ISteamApps/UpToDateCheck/v1?appid=$app&version=$version";            
        }

        return file_get_contents($url);
    }

    public function homePage(){
        return '<div class="homePage d-flex flex-column">
                    <h1>Главная страница</h1>   
                </div>';
        
    }

    public function page404(){
        return '<div class="page404 d-flex flex-column">
                    <img src="" alt="">
                    <h3>Ты ошибся адресом, тебе не сюда</h3>
                    <span>Твой запрос - '.$_SERVER['REQUEST_URI'].'</span>
                </div>';
    }

    public function handlerParamsGet(){

        $this->setFormatingParams();
        $query = $this->$QUERY;

        if ($query == '' || empty($query)) {
            return $this->homePage();
            // return $this->page404();
        }

        foreach($query as $param => $value){

            if ($param == 'method'){
                $method = $value;
            } elseif ($param == 'limit'){
                $limit = $value;
            } elseif ($param == 'page'){
                $page = $value;
            }
        }        
        
        
        if ($method == 'getAppList'){
            return $this->appListHtml($limit, $page);
        } else {
            // return pageError(403)
        }
    }
   
}
?>