<?php
use Carbon\Carbon;

if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;
        if ($etime < 1)
        {
            return '0 ' . trans('second');
        }
        $timeArray = array(
            trans('year') => 365 * 24 * 60 * 60,
            trans('month') => 30 * 24 * 60 * 60,
            trans('day') => 24 * 60 * 60,
            trans('hour') => 60 * 60,
            trans('minute') => 60,
            trans('second') => 1,
        );
        foreach ($timeArray as $strTime => $secs) {
            $modTime = $etime / $secs;
            if ($modTime >= 1) {
                $result = round($modTime);

                return $result . ' ' .  $strTime . trans('ago');
            }
        }
    }
}
