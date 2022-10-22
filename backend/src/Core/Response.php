<?php

namespace App\Core;

class Response
{
    const RESPONSE_OK = 200;

    const RESPONSE_ERROR = 500;

    const CONTENT_TYPE_JSON = 'application/json';

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param mixed $data
     * @param int $code
     * @param string $contentType
     */
    public function __construct($data, int $code = self::RESPONSE_OK, string $contentType = self::CONTENT_TYPE_JSON)
    {
        $this->data = $data;
        $this->code = $code;
        $this->contentType = $contentType;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if ($this->contentType === self::CONTENT_TYPE_JSON) {
            return json_encode($this->data);
        }

        return $this->data;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }
}