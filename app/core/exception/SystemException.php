<?php
/**
 * @class \core\exception\SystemException
 */

namespace core\exception;

class SystemException extends \Exception {

    /**
     * Error codes
     */

    const ERR_404 = 404;
    const ERR_403 = 403;
}