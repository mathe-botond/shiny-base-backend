<?php
namespace ShinyBaseWeb\Common;
use QeyWork\Common\IErrorHandler;
use ShinyBaseWeb\Responder;

/**
 * Author: Mathe E. Botond
 */
class JsonErrorResponder implements IErrorHandler {
    /**
     * @var Responder
     */
    private $responder;

    public function __construct(Responder $responder) {
        $this->responder = $responder;
    }

    public function handle(\Exception $e) {
        $code = $e->getCode() ? $e->getCode(): 500;
        $this->responder->error($e->getMessage(), $code, $e->getTrace());
    }
}