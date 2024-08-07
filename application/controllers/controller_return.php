<?

class Controller_Return extends Controller
{
	//Функция отображения страницы возврата с проверкой наличия доступа
	function action_index()
	{	
		if (Profile::isHavePermission("return")) {
			if(isset($_GET["id"]))
				$data["documentID"] = $_GET["id"]; 

			$data["return"] = Helper::getConscriptsWithDocuments("return", 1, Profile::isHavePermission("viewForAll") ? null : Profile::$user["id"]);
			$this->view->generateView('return_view.php', "Возврат", $data);
		}
		else
			$this->view->failAccess();
	}
}