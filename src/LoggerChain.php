<?php
/**
 * @author  Marco Ferrante <marco@csita.unige.it>
 * @since   may, 2018
 * @version 1.0.0
 */
namespace UniGe\logger;

class LoggerChain extends AbstractLogger {

    protected $loggers = array();

    public function __construct(array $loggers) {
        $this->loggers = $loggers;
    }

    public function log($level, $message, array $context = array()) {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }
}