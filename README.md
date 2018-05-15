Migrate logger
==============

A basic PSR-3 logger wrapping echo() and error_log(), even in combination, useful for migrating naive debugging

*Author:*    staff AulaWeb
*Copyright:* 2018 Università di Genova (I)
*License:*   [BSD-3]


Description
-----------

To replace echo() and error_log() debugging/logging, instantiate

$logger = new \Unige\logger\EchoLogger();
// or $logger = new \Unige\logger\ErrorLogLogger();

and replace each echo() (or error_log() with $logger->info()

Logger chain
------------

Standard output and error_log, can be chain, even with different levels:

$logger = new \Unige\logger\LoggerChain(array(
    new \Unige\logger\EchoLogger(\Psr\Log\LogLevel::INFO),
    new \Unige\logger\ErrorLogLogger(\Psr\Log\LogLevel::WARNING)
));

will log on both console with level INFO and error log with level WARNING.