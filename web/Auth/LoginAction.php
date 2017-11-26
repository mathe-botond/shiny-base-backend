<?php
namespace ShinyBaseWeb\Auth;
use QeyWork\Auth\UserContainer;
use QeyWork\Common\IAction;
use QeyWork\Resources\Db\ConditionList;
use QeyWork\Resources\Db\DB;
use QeyWork\Resources\Request;
use ShinyBaseWeb\Responder;

/**
 * Author: Mathe E. Botond
 */
class LoginAction implements IAction {
    const ROUTE = "login";

    const AUTH_FAILED = "auth-failed";
    const AUTH_SUCCESSFUL = "auth-successful";

    const NAME = "name";
    const PASSWORD = "password";

    const PASSWORD_SALT = '$6$rounds=5000$usesomesillystringforsalt$';

    /** @var UserContainer */
    private $user;

    /** @var Request */
    private $params;

    /** @var DB */
    private $db;

    /** @var Responder */
    private $responder;

    public function __construct(
        UserContainer $user,
        DB $db,
        Request $params,
        Responder $responder) {

        $this->params = $params;
        $this->user = $user;
        $this->db = $db;
        $this->responder = $responder;
    }

    public function execute() {
        $this->user->logout();
        $name = $this->params->get(self::NAME);
        $password = $this->params->get(self::PASSWORD);
        $user = $this->searchDb($name, $password);
        if ($user == null) {
            $this->responder->error(self::AUTH_FAILED, 403);
        } else {
            $this->user->login($user);
            $this->responder->success(self::AUTH_SUCCESSFUL);
        }
    }

    private function searchDb($name, $password) {
        $user = new User();
        $conditions = new ConditionList();
        $conditions->add($user->name)->equals($name);
        $conditions->add($user->password)->equals(crypt($password, self::PASSWORD_SALT));
        $list = $this->db->search($user, $conditions);
        return $list->first();
    }
}