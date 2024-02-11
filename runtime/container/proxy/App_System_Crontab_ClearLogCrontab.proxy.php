<?php

declare (strict_types=1);
namespace App\System\Crontab;

use App\System\Model\SystemApiLog;
use App\System\Model\SystemLoginLog;
use App\System\Model\SystemOperLog;
use App\System\Model\SystemQueueLog;
use Mine\Annotation\Transaction;
class ClearLogCrontab
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        $this->__handlePropertyHandler(__CLASS__);
    }
    /**
     * 清理所有日志
     * @return string
     */
    #[Transaction]
    public function execute() : string
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, self::__getParamsMap(__CLASS__, __FUNCTION__, func_get_args()), function () use($__function__, $__method__) {
            SystemOperLog::truncate();
            SystemLoginLog::truncate();
            SystemQueueLog::truncate();
            SystemApiLog::truncate();
            return 'Clear logs successfully';
        });
    }
}