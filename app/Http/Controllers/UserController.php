<?php 
    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\StreamedResponse;

    Class UserController extends Controller {
        
        public function index() {
            
            $response = new StreamedResponse(function () {
                $data = User::all();
                
                echo "data: $data\n\n";
                
                ob_flush();
                flush();
            });

            return $response;
        }
    }

?>