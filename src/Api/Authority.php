<?php
namespace pddUnionSdk\Api;

use pddUnionSdk\pddUnionGateWay;

/**
 * 会员权限查询
 * Class authority
 *
 * @package pddUnionSdk\Api
 * @date 2020-10-21 22:19
 * @author mrh111 <mrh111@126.com>
 */
class Authority extends pddUnionGateWay
{

    /**
     * 查询是否绑定备案
     * @param $pid
     * @param string $custom_parameters
     * @return mixed|string
     * @throws \Exception
     */
    public function query($pid, string $custom_parameters){
        $params = [
            'pid' => $pid,
            'custom_parameters' => $custom_parameters
        ];
        if(!$pid){
            $params['pid'] = $this->pid;
        }
        return $this->send('pdd.ddk.goods.search', $params);
    }

}