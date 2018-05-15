<?php
/**
 * @author  Marco Ferrante <marco@csita.unige.it>
 * @since   may, 2018
 * @version 1.0.2
 */
namespace UniGe\logger;

abstract class AbstractLogger extends \Psr\Log\AbstractLogger
{

    protected $activeLevel;

    protected $logLevels = array(
        \Psr\Log\LogLevel::EMERGENCY => 0,
        \Psr\Log\LogLevel::ALERT     => 1,
        \Psr\Log\LogLevel::CRITICAL  => 2,
        \Psr\Log\LogLevel::ERROR     => 3,
        \Psr\Log\LogLevel::WARNING   => 4,
        \Psr\Log\LogLevel::NOTICE    => 5,
        \Psr\Log\LogLevel::INFO      => 6,
        \Psr\Log\LogLevel::DEBUG     => 7
    );

    public function __construct($level)
    {
        if (is_numeric($level)) {
            $this->activeLevel = $level;
        }
        elseif (!isset($this->logLevels[$level])) {
            // Required by PSR-3
            throw new \Psr\Log\InvalidArgumentException('Unknown severity level');
        }

        $this->activeLevel = $this->logLevels[$level];
    }

    protected function isEnabled($level)
    {
        if (is_numeric($level)) {
            if ( $this->activeLevel < $level ) {
                return false;
            }
        }
        elseif (!isset($this->logLevels[$level])) {
            // Required by PSR-3
            throw new \Psr\Log\InvalidArgumentException('Unknown severity level');
        }
        elseif ( $this->activeLevel < $this->logLevels[$level] ) {
            return false;
        }

        return true;
    }

    /**
     * Interpolates context values into the message placeholders.
     * Reference implementation from PSR-3.
     */
    protected function interpolate($message, array $context = array())
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            // check that the value can be casted to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }
}
