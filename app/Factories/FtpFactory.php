<?php declare(strict_types=1);


namespace app\Factories;


use Exception;
use Ftp;

/**
 * Class FtpFactory
 * @package app\Factories
 */
class FtpFactory
{
    private string $host;
    private string $user;
    private string $password;
    private string $homeDirectory;

    /**
     * FtpFactory constructor.
     * @param mixed[] $connection
     */
    public function __construct(
        private array $connection
    )
    {
        $this->host = $this->connection['host'];
        $this->user = $this->connection['username'];
        $this->password = $this->connection['password'];
        $this->homeDirectory = $this->connection['homeDirectory'];
    }

    /**
     * @return Ftp
     * @throws Exception
     */
    public function create(): Ftp
    {
        $ftp = new Ftp();
        $ftp->connect($this->host);
        $ftp->login($this->user, $this->password);
        $ftp->chDir($this->homeDirectory);
        return $ftp;
    }

}
