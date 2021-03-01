<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/20
 * Time: 11:19
 */

namespace pddUnionSdk\Api;


use pddUnionSdk\pddUnionGateWay;

/**
 * 拼多多链接处理
 * Class Link
 * @package pddUnionSdk\Api
 */
class Link extends pddUnionGateWay
{


    /**
     * @api 多多进宝推广链接生成
     * @param $p_id
     * @param string $goods_id
     * @param bool $short
     * @return mixed|string
     * @throws \Exception
     */
    public function createCpsUrl($data = [], $short = false)
    {
        $params = [
            'generate_short_url' => $short,
            'generate_weapp_webview' => true,
            'generate_we_app' => true,
            'generate_schema_url' => true,
            'generate_qq_app' => true,
            'generate_weiboapp_webview' => true
        ];
        $params['p_id'] = $this->pid;

        if (!empty($data['p_id'])) {
            $params['p_id'] = $data['p_id'];
        }
        if(!empty($data['goods_sign_list'])){
            $params['goods_sign_list'] = $data['goods_sign_list'];
        }
        if (!empty($data['crash_gift_id'])) {
            $params['crash_gift_id'] = $data['crash_gift_id'];
        }
        if(!empty($data['zs_duo_id'])) {
            $params['zs_duo_id'] = $data['zs_duo_id'];
        }
        if(!empty($data['search_id'])){
            $params['search_id'] = $data['search_id'];
        }
        if(!empty($data['multi_group'])){
            $params['multi_group'] = $data['multi_group'];
        }
        $result = $this->send('pdd.ddk.goods.promotion.url.generate', $params);
        if (!$result) {
            return $result;
        }
        return \current(\current($result));
    }

    /**
     * 生成红包推广链接
     * @param $p_id
     * @param bool $short
     * @return mixed|string
     * @throws \Exception
     */
    public function createRedbaoUrl($p_id = '', $channel_type =10, $parameters='',$short = false)
    {
        $params = [
            'p_id_list' => [$p_id],
            'generate_short_url' => $short,
            'generate_weapp_webview' => true,
            'generate_we_app' => true,
            'generate_schema_url' => true,
            'generate_qq_app' => true,
            'generate_weiboapp_webview' => true
        ];
        if (empty($p_id)) {
            $params['p_id_list'] = [$this->pid];
        }
        if(!empty($channel_type)){
            $params['channel_type'] = $channel_type;
        }
        if(!empty($parameters)){
            $params['custom_parameters'] = $parameters;
        }
        $result = $this->send('pdd.ddk.rp.prom.url.generate', $params);
        if (!$result) {
            return $result;
        }
        return \current(\current($result));
    }

    /**
     * @api 多多进宝主题推广链接生成
     * @param string $pid
     * @param $theme_id_list
     * @param bool $short
     * @return mixed|string
     * @throws \Exception
     */
    public function createThemeUrl($pid = '', $theme_id_list, $short = false)
    {
        $params = [
            'pid' => $pid,
            'theme_id_list' => is_array($theme_id_list) ? $theme_id_list : [$theme_id_list],
            'generate_short_url' => $short,
            'generate_weapp_webview' => true,
            'generate_we_app' => true,
            'we_app_web_view_short_url' => true
        ];
        if (empty($pid)) {
            $params['pid'] = $this->pid;
        }
        $result = $this->send('pdd.ddk.theme.prom.url.generate', $params);
        if (!$result) {
            return $result;
        }
        return \current($result);
    }

    /**
     * @api 本功能适用于采集群等场景。将其他推广者的推广链接转换成自己的；通过此api，可以将他人的招商推广链接，转换成自己的招商推广链接。
     * @param $pid
     * @param $source_url
     * @return mixed|string
     * @throws \Exception
     */
    public function covertOtherToMyPidUrl($source_url, $pid = '', $custom_parameters='')
    {
        $params = [
            'pid' => $pid,
            'source_url' => $source_url
        ];
        if (empty($pid)) {
            $params['pid'] = $this->pid;
        }
        if($custom_parameters){
            $params['custom_parameters'] = $custom_parameters;
        }
        return $this->send('pdd.ddk.goods.zs.unit.url.gen', $params);
    }

}