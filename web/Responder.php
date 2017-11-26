<?php
/**
 * Author: Mathe E. Botond
 */

namespace ShinyBaseWeb;

class Responder {
    const ERROR = "failed";
    const SUCCESS = "success";

    public function error($message = "", $code = 500, $params = []) {
        $this->respond(self::ERROR, $message, $code, $params);
    }

    private function respond($status, $message, $code = 200, $params = []) {
        echo json_encode([
            "status" => $status,
            "code" => $code,
            "message" => $message,
            "params" => $params
        ]);
    }

    public function success($message = "", $params = [], $code = 200) {
        $this->respond(self::SUCCESS, $message, $code, $params);
    }
}
