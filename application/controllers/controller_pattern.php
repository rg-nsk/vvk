<?

class Controller_Pattern extends Controller
{

	//Функция отображения обычной страницы с проверкой наличия доступа
	function action_index()
	{
		if (Profile::isHavePermission("pattern")) {
			$data['userPatternList'] = Helper::getUserPatternList();
			$this->view->generateView('pattern/pattern_view.php', "Шаблоны", $data);
		} else
			$this->view->failAccess();
	}

	//Функция отображения страницы добавления шаблона с проверкой наличия доступа
	function action_editor()
	{
		if (Profile::isHavePermission("pattern")) {
			if(isset($_GET["id"])) {
				$data['currentPattern'] = $this->getUserPatternByID($_GET["id"]);

				if($data['currentPattern'] != null) {
					if($data['currentPattern'][0]['ownerID'] == Profile::$user['id'] || Profile::isHavePermission("viewForAll"))
						$this->view->generateView('pattern/patternEditor_view.php', "Редактирование шаблона", $data);
					else
						$this->view->errorPage('Вы не являетесь владельцем шаблона.');
				}
				else
					$this->view->errorPage('Идентификатор шаблона не найден.');
			} else {
				$this->view->generateView('pattern/patternEditor_view.php', "Добавление шаблона");
			}
		}
		else
			$this->view->failAccess();
	}

	//Функция для получения шаблона по ID
	function getUserPatternByID($id)
	{
		$quary = "SELECT * FROM `patternList` WHERE id=:id;";
		$dataArr = [
			"id" => $id
		];
		return Database::execute($quary, $dataArr);
	}
}