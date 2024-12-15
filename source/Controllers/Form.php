<?php

namespace Source\Controllers;

use League\Plates\Engine;
use PDOException;
use Source\models\User;

class Form
{
  /**
   * @var Engine
   */
  private Engine $view;
  /**
   * Constructor Method
   *
   * @param void
   */
  public function __construct($router)
  {
    $this->view = new Engine(dirname(__DIR__, 2) . "/theme", "php");
    $this->view->addData(["router" => $router]);
  }


  public function home(): void
  {
    // echo "<h1>Olá, mundo!</h1>";
    echo $this->view->render("home", [
      "users" => (new User())->find()->order("first_name")->fetch(true)
    ]);
  }

  public function create(array $data): void
  {
    // validação
    $userData = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);
    if (in_array("", $userData)) {
      $callback["message"] = message("Informe o nome e o sobrenome!", "error");
      echo json_encode($callback);
      return;
    }
    $user = new User();
    $user->first_name = $userData["first_name"];
    $user->last_name = $userData["last_name"];
    $user->save();

    $callback["message"] = message("Usuário cadastrado com sucesso!", "success");
    $callback["user"] = $this->view->render("user", [
      "user" => $user
    ]);
    echo json_encode($callback);
    // para debugar, pegar os dados e enviar para o DevTools
    // $callback["user"] = "user";
    // $callback["message"] = message("error", "error");
    // echo json_encode($callback);
  }

  function delete(array $data): void
  {
    if (empty($data["id"])) {
      return;
    }
    $id = filter_var($data["id"], FILTER_VALIDATE_INT);
    $user = (new User())->findById($id);
    if ($user) {
      $user->destroy();
    }
    $callback["remove"] = true;
    echo json_encode($callback);
    // para debugar, pegar os dados e enviar para o DevTools
    // $callback["data"] = $data;
    // echo json_encode($data);
  }

  public function view(): Engine
  {
    return $this->view();
  }
}
