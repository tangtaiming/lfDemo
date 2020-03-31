<?php
namespace app\api\auto;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Rsa\Sha256;

/**
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

    private $secrect;

    private $uid;


    /**
     * 单例模式
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

    private function __construct()
    {
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function getToken() {
        return (string) $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function setUid($uid) {
        $this->uid = $uid;
        return $this;
    }

    public function encode() {
        $time = time();
        $this->token = (new Builder())
            ->issuedBy("www.baidu.com")
            ->permittedFor("www.baidu1.com")
            ->identifiedBy('110')
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time + 60)
            ->expiresAt($time + 3600)
            ->withClaim('uid', 1)
            ->getToken(new Sha256(), $this->secrect);
        return $this;
    }


}