<?

namespace App\Controllers;

use \Core\View;
use \Core\Controller;

class Home extends Controller
{


    public function indexAction()
    {
        View::renderTemplate('Home/index.html');
    }
    

}