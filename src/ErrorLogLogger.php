<?php
/**
 * @author  Marco Ferrante <marco@csita.unige.it>
 * @since   may, 2018
 * @version 1.0.0
 */
namespace UniGe\logger;

class ErrorLogger extends AbstractLogger {

    public function __construct($level = \Psr\Log\LogLevel::WARNING) {
        parent::__construct($level);
    }

    public function log($level, $message, array $context = array()) {

        if (!$this->isEnabled($level)) {
            return;
        }
        
        error_log($this->interpolate($message, $context));
    }
}


