<?php

namespace Dqg\Wechat\src\workwx\Api;

use addons\workwx\library\src\Utils\Error\HttpError;
use addons\workwx\library\src\Utils\HttpUtils;
use addons\workwx\library\src\Utils\Error\InternalError;
use addons\workwx\library\src\Utils\Error\NetWorkError;
use addons\workwx\library\src\Utils\Error\ParameterError;
use addons\workwx\library\src\Utils\Error\QyApiError;
use addons\workwx\library\src\Utils\Utils;

abstract class API
{
    public $rspJson = null;

    public $rspRawStr = null;

    const USER_CREATE = '/cgi-bin/user/create?access_token=ACCESS_TOKEN';
    const USER_GET = '/cgi-bin/user/get?access_token=ACCESS_TOKEN';
    const USER_UPDATE = '/cgi-bin/user/update?access_token=ACCESS_TOKEN';
    const USER_DELETE = '/cgi-bin/user/delete?access_token=ACCESS_TOKEN';
    const USER_BATCH_DELETE = '/cgi-bin/user/batchdelete?access_token=ACCESS_TOKEN';
    const USER_SIMPLE_LIST = '/cgi-bin/user/simplelist?access_token=ACCESS_TOKEN';
    const USER_LIST = '/cgi-bin/user/list?access_token=ACCESS_TOKEN';
    const USER_ID_TO_OPENID = '/cgi-bin/user/convert_to_openid?access_token=ACCESS_TOKEN';
    const OPENID_TO_USER_ID = '/cgi-bin/user/convert_to_userid?access_token=ACCESS_TOKEN';
    const USER_AUTH_SUCCESS = '/cgi-bin/user/authsucc?access_token=ACCESS_TOKEN';

    const DEPARTMENT_CREATE = '/cgi-bin/department/create?access_token=ACCESS_TOKEN';
    const DEPARTMENT_UPDATE = '/cgi-bin/department/update?access_token=ACCESS_TOKEN';
    const DEPARTMENT_DELETE = '/cgi-bin/department/delete?access_token=ACCESS_TOKEN';
    const DEPARTMENT_LIST = '/cgi-bin/department/list?access_token=ACCESS_TOKEN';

    const TAG_CREATE = '/cgi-bin/tag/create?access_token=ACCESS_TOKEN';
    const TAG_UPDATE = '/cgi-bin/tag/update?access_token=ACCESS_TOKEN';
    const TAG_DELETE = '/cgi-bin/tag/delete?access_token=ACCESS_TOKEN';
    const TAG_GET_USER = '/cgi-bin/tag/get?access_token=ACCESS_TOKEN';
    const TAG_ADD_USER = '/cgi-bin/tag/addtagusers?access_token=ACCESS_TOKEN';
    const TAG_DELETE_USER = '/cgi-bin/tag/deltagusers?access_token=ACCESS_TOKEN';
    const TAG_GET_LIST = '/cgi-bin/tag/list?access_token=ACCESS_TOKEN';

    const BATCH_JOB_GET_RESULT = '/cgi-bin/batch/getresult?access_token=ACCESS_TOKEN';

    const BATCH_INVITE = '/cgi-bin/batch/invite?access_token=ACCESS_TOKEN';

    const AGENT_GET = '/cgi-bin/agent/get?access_token=ACCESS_TOKEN';
    const AGENT_SET = '/cgi-bin/agent/set?access_token=ACCESS_TOKEN';
    const AGENT_GET_LIST = '/cgi-bin/agent/list?access_token=ACCESS_TOKEN';

    const MENU_CREATE = '/cgi-bin/menu/create?access_token=ACCESS_TOKEN';
    const MENU_GET = '/cgi-bin/menu/get?access_token=ACCESS_TOKEN';
    const MENU_DELETE = '/cgi-bin/menu/delete?access_token=ACCESS_TOKEN';

    const MESSAGE_SEND = '/cgi-bin/message/send?access_token=ACCESS_TOKEN';

    const MEDIA_GET = '/cgi-bin/media/get?access_token=ACCESS_TOKEN';

    const GET_USER_INFO_BY_CODE = '/cgi-bin/user/getuserinfo?access_token=ACCESS_TOKEN';
    const GET_USER_DETAIL = '/cgi-bin/user/getuserdetail?access_token=ACCESS_TOKEN';

    const GET_TICKET = '/cgi-bin/ticket/get?access_token=ACCESS_TOKEN';
    const GET_JSAPI_TICKET = '/cgi-bin/get_jsapi_ticket?access_token=ACCESS_TOKEN';

    const GET_CHECKIN_OPTION = '/cgi-bin/checkin/getcheckinoption?access_token=ACCESS_TOKEN';
    const GET_CHECKIN_DATA = '/cgi-bin/checkin/getcheckindata?access_token=ACCESS_TOKEN';
    const GET_APPROVAL_DATA = '/cgi-bin/corp/getapprovaldata?access_token=ACCESS_TOKEN';

    const GET_INVOICE_INFO = '/cgi-bin/card/invoice/reimburse/getinvoiceinfo?access_token=ACCESS_TOKEN';
    const UPDATE_INVOICE_STATUS = '/cgi-bin/card/invoice/reimburse/updateinvoicestatus?access_token=ACCESS_TOKEN';
    const BATCH_UPDATE_INVOICE_STATUS = '/cgi-bin/card/invoice/reimburse/updatestatusbatch?access_token=ACCESS_TOKEN';
    const BATCH_GET_INVOICE_INFO = '/cgi-bin/card/invoice/reimburse/getinvoiceinfobatch?access_token=ACCESS_TOKEN';

    const GET_PRE_AUTH_CODE = '/cgi-bin/service/get_pre_auth_code?suite_access_token=SUITE_ACCESS_TOKEN';
    const SET_SESSION_INFO = '/cgi-bin/service/set_session_info?suite_access_token=SUITE_ACCESS_TOKEN';
    const GET_PERMANENT_CODE = '/cgi-bin/service/get_permanent_code?suite_access_token=SUITE_ACCESS_TOKEN';
    const GET_AUTH_INFO = '/cgi-bin/service/get_auth_info?suite_access_token=SUITE_ACCESS_TOKEN';
    const GET_ADMIN_LIST = '/cgi-bin/service/get_admin_list?suite_access_token=SUITE_ACCESS_TOKEN';
    const GET_USER_INFO_BY_3RD = '/cgi-bin/service/getuserinfo3rd?suite_access_token=SUITE_ACCESS_TOKEN';
    const GET_USER_DETAIL_BY_3RD = '/cgi-bin/service/getuserdetail3rd?suite_access_token=SUITE_ACCESS_TOKEN';

    const GET_LOGIN_INFO = '/cgi-bin/service/get_login_info?access_token=PROVIDER_ACCESS_TOKEN';
    const GET_REGISTER_CODE = '/cgi-bin/service/get_register_code?provider_access_token=PROVIDER_ACCESS_TOKEN';
    const GET_REGISTER_INFO = '/cgi-bin/service/get_register_info?provider_access_token=PROVIDER_ACCESS_TOKEN';
    const SET_AGENT_SCOPE = '/cgi-bin/agent/set_scope';
    const SET_CONTACT_SYNC_SUCCESS = '/cgi-bin/sync/contact_sync_success';

    const EXTERNAL_CONTACT_SEND_WELCOME_MSG = '/cgi-bin/externalcontact/send_welcome_msg?access_token=ACCESS_TOKEN';
    const EXTERNAL_CONTACT_LIST = '/cgi-bin/externalcontact/list?access_token=ACCESS_TOKEN';
    const EXTERNAL_CONTACT_GET = '/cgi-bin/externalcontact/get?access_token=ACCESS_TOKEN';
    const EXTERNAL_CONTACT_GROUPCHAT_LIST = '/cgi-bin/externalcontact/groupchat/list?access_token=ACCESS_TOKEN';
    const EXTERNAL_CONTACT_GROUPCHAT_GET = '/cgi-bin/externalcontact/groupchat/get?access_token=ACCESS_TOKEN';
    const MSGAUDIT_GROUPCHAT_GET = '/cgi-bin/msgaudit/groupchat/get?access_token=ACCESS_TOKEN';
    const MSGAUDIT_GROUPCHAT_LIST = '/cgi-bin/msgaudit/groupchat/list?access_token=ACCESS_TOKEN';

    /**
     * 获取访问令牌
     *
     * @return string
     */
    protected function GetAccessToken()
    {
    }

    /**
     * 刷新访问令牌
     *
     * @return string
     */
    protected function RefreshAccessToken()
    {
    }

    /**
     * 获取套件访问令牌
     *
     * @return string
     */
    protected function GetSuiteAccessToken()
    {
    }

    /**
     * 刷新套件访问令牌
     *
     * @return string
     */
    protected function RefreshSuiteAccessToken()
    {
    }

    /**
     * 获取提供商访问令牌
     *
     * @return string
     */
    protected function GetProviderAccessToken()
    {
    }

    /**
     * 刷新提供商访问令牌
     *
     * @return string
     */
    protected function RefreshProviderAccessToken()
    {
    }


    /**
     * Http呼叫
     *
     * @param $url
     * @param $method
     * @param $args
     *
     * @throws HttpError
     * @throws InternalError
     * @throws NetWorkError
     * @throws ParameterError
     * @throws QyApiError
     */
    protected function _HttpCall($url, $method, $args,$checkCode=true)
    {
        if ('POST' == $method) {
            $url = HttpUtils::MakeUrl($url);
            $this->_HttpPostParseToJson($url, $args);
            $this->_CheckErrCode();
        } else if ('GET' == $method) {
            if (count($args) > 0) {
                foreach ($args as $key => $value) {
                    if ($value == null) continue;
                    if (strpos($url, '?')) {
                        $url .= ('&' . $key . '=' . $value);
                    } else {
                        $url .= ('?' . $key . '=' . $value);
                    }
                }
            }
            $url = HttpUtils::MakeUrl($url);
            $this->_HttpGetParseToJson($url);
            if($checkCode){
                $this->_CheckErrCode();
            }
        } else {
            throw new QyApiError('wrong method');
        }
    }

    /**
     * Http获取解析给Json
     *
     * @param      $url
     * @param bool $refreshTokenWhenExpired
     *
     * @return bool|string|null
     * @throws QyApiError
     * @throws HttpError
     * @throws InternalError
     * @throws NetWorkError
     */
    protected function _HttpGetParseToJson($url, $refreshTokenWhenExpired = true)
    {
        $retryCnt = 0;
        $this->rspJson = null;
        $this->rspRawStr = null;

        while ($retryCnt < 2) {
            $tokenType = null;
            $realUrl = $url;

            if (strpos($url, "SUITE_ACCESS_TOKEN")) {
                $token = $this->GetSuiteAccessToken();
                $realUrl = str_replace("SUITE_ACCESS_TOKEN", $token, $url);
                $tokenType = "SUITE_ACCESS_TOKEN";
            } else if (strpos($url, "PROVIDER_ACCESS_TOKEN")) {
                $token = $this->GetProviderAccessToken();
                $realUrl = str_replace("PROVIDER_ACCESS_TOKEN", $token, $url);
                $tokenType = "PROVIDER_ACCESS_TOKEN";
            } else if (strpos($url, "ACCESS_TOKEN")) {
                $token = $this->GetAccessToken();
                $realUrl = str_replace("ACCESS_TOKEN", $token, $url);
                $tokenType = "ACCESS_TOKEN";
            } else {
                $tokenType = "NO_TOKEN";
            }


            $this->rspRawStr = HttpUtils::httpGet($realUrl);

            if (!Utils::notEmptyStr($this->rspRawStr)) throw new QyApiError("empty response");
            //
            $this->rspJson = json_decode($this->rspRawStr, true/*to array*/);
            if (strpos($this->rspRawStr, "errcode") !== false) {
                $errCode = Utils::arrayGet($this->rspJson, "errcode");
                if ($errCode == 40014 || $errCode == 42001 || $errCode == 42007 || $errCode == 42009) { // token expired
                    if ("NO_TOKEN" != $tokenType && true == $refreshTokenWhenExpired) {
                        if ("ACCESS_TOKEN" == $tokenType) {
                            $this->RefreshAccessToken();
                        } else if ("SUITE_ACCESS_TOKEN" == $tokenType) {
                            $this->RefreshSuiteAccessToken();
                        } else if ("PROVIDER_ACCESS_TOKEN" == $tokenType) {
                            $this->RefreshProviderAccessToken();
                        }
                        $retryCnt += 1;
                        continue;
                    }
                }
            }
            return $this->rspRawStr;
        }
        return null;
    }

    /**
     * Http发布解析到Json
     *
     * @param      $url
     * @param      $args
     * @param bool $refreshTokenWhenExpired
     * @param bool $isPostFile
     *
     * @return mixed
     * @throws HttpError
     * @throws InternalError
     * @throws NetWorkError
     * @throws QyApiError
     */
    protected function _HttpPostParseToJson($url, $args, $refreshTokenWhenExpired = true, $isPostFile = false)
    {
        $postData = $args;
        if (!$isPostFile) {
            if (!is_string($args)) {
                $postData = HttpUtils::Array2Json($args);
            }
        }
        $this->rspJson = null;
        $this->rspRawStr = null;

        $retryCnt = 0;
        while ($retryCnt < 2) {
            $tokenType = null;
            $realUrl = $url;

            if (strpos($url, "SUITE_ACCESS_TOKEN")) {
                $token = $this->GetSuiteAccessToken();
                $realUrl = str_replace("SUITE_ACCESS_TOKEN", $token, $url);
                $tokenType = "SUITE_ACCESS_TOKEN";
            } else if (strpos($url, "PROVIDER_ACCESS_TOKEN")) {
                $token = $this->GetProviderAccessToken();
                $realUrl = str_replace("PROVIDER_ACCESS_TOKEN", $token, $url);
                $tokenType = "PROVIDER_ACCESS_TOKEN";
            } else if (strpos($url, "ACCESS_TOKEN")) {
                $token = $this->GetAccessToken();
                $realUrl = str_replace("ACCESS_TOKEN", $token, $url);
                $tokenType = "ACCESS_TOKEN";
            } else {
                $tokenType = "NO_TOKEN";
            }


            $this->rspRawStr = HttpUtils::httpPost($realUrl, $postData);

            if (!Utils::notEmptyStr($this->rspRawStr)) throw new QyApiError("empty response");

            $json = json_decode($this->rspRawStr, true/*to array*/);
            $this->rspJson = $json;

            $errCode = Utils::arrayGet($this->rspJson, "errcode");
            if ($errCode == 40014 || $errCode == 42001 || $errCode == 42007 || $errCode == 42009) { // token expired
                if ("NO_TOKEN" != $tokenType && true == $refreshTokenWhenExpired) {
                    if ("ACCESS_TOKEN" == $tokenType) {
                        $this->RefreshAccessToken();
                    } else if ("SUITE_ACCESS_TOKEN" == $tokenType) {
                        $this->RefreshSuiteAccessToken();
                    } else if ("PROVIDER_ACCESS_TOKEN" == $tokenType) {
                        $this->RefreshProviderAccessToken();
                    }
                    $retryCnt += 1;
                    continue;
                }
            }

            return $json;
        }
        return null;
    }


    /**
     * 检查错误代码
     *
     * @throws ParameterError
     * @throws QyApiError
     */
    protected function _CheckErrCode()
    {
        $rsp = $this->rspJson;
        $raw = $this->rspRawStr;
        if (is_null($rsp))
            return;

        if (!is_array($rsp))
            throw new ParameterError("invalid type " . gettype($rsp));
        if (!array_key_exists("errcode", $rsp)) {
            return;
        }
        $errCode = $rsp["errcode"];
        if (!is_int($errCode))
            throw new QyApiError("invalid errcode type " . gettype($errCode) . ":" . $raw);
        if ($errCode != 0)
            throw new QyApiError("response error:" . $raw);
    }

}
