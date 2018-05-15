<?php
/**
 * @author  Marco Ferrante <marco@csita.unige.it>
 * @since   may, 2018
 * @version 1.0.0
 */
namespace UniGe\logger;

class EchoLogger extends AbstractLogger {

    public function __construct($level = \Psr\Log\LogLevel::INFO) {
        parent::__construct($level);
    }

    public function log($level, $message, array $context = array()) {

        if (!$this->isEnabled($level)) {
            return;
        }

        $message = trim($message);
        echo $this->interpolate($message . "\n", $context);

    }
}