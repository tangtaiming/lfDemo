<?php
namespace app\api\auto;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\ValidationData;

/**
 * 单例 一次请求中所有出现使用jwt的地方都用一个用户
 * User: tangtaiming
 * Date: 2020/3/31
 * Time: 23:54
 */
class JwtAuto
{

    /**
     * token
     * @var
     */
    private $token;

    /**
     * @var 解密token
     */
    private $decodeToken;

    /**
     * issued
     * @var
     */
    private $issued = 'www.lflike.com';

    /**
     * permitted
     * @var string
     */
    private $permitted = 'www.lflike.com';

    /**
     * @var string
     */
    private $secretkey = 'tangtaiming123';

    /**
     * uid
     * @var
     */
    private $uid;


    /**
     * 单例模式 jwt Auto 句柄
     * @var
     */
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 私有化构造函数
     * JwtAuto constructor.
     */
    private function __construct()
    {
    }

    /**
     * 私有化close
     */
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 获取Token
     * @return string
     */
    public function getToken() {
        return (string) $this->token;
    }

    /**
     * 设置Token
     * @param $token
     * @return $this JwtAuto.class
     */
    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    /**
     * 用户信息的 uid
     * @param $uid 用户信息的唯一标识
     * @return $this JwtAuto.class
     */
    public function setUid($uid) {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 授权加密
     * @return $this JwtAuto.class
     */
    public function encode() {
        $time = time();
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();

        $this->token = (new Builder())
            ->issuedBy($this->issued)
            ->permittedFor($this->permitted)
            ->identifiedBy('110')
            ->issuedAt($time)
            //令牌使用时间
            ->canOnlyBeUsedAfter($time + 1)
            //令牌到期时间
            ->expiresAt($time + 3600)
            ->withClaim('uid', $this->uid)
            ->getToken($signer, new Key($this->secretkey));
        return $this;
    }

    /**
     * 解析 token
     * @return 解密token|\Lcobucci\JWT\Token
     */
    public function decode() {
        if (!$this->decodeToken) {
            $this->decodeToken = (new Parser())->parse((string) $this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }
        return $this->decodeToken;
    }

    /**
     * validate
     * @return bool
     */
    public function validate() {
        $data = new ValidationData();
        $data->setIssuer($this->issued);
        $data->setIssuer($this->permitted);

        $va = $this->decode()->validate($data);
        return $va;
    }

    /**
     * verify
     * @return bool
     */
    public function verify() {
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();

        $re = $this->decode()->verify($signer, new Key($this->secretkey));
        return $re;
    }


}