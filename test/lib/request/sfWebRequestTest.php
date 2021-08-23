<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../../lib/request/sfWebRequest.class.php');

class sfWebRequestTest extends TestCase
{

    /**
     * @var sfWebRequest
     */
    private $request;

    protected function setUp(): void
    {
        $event_dispatcher = new sfEventDispatcher();
        $this->request = new sfWebRequest($event_dispatcher);
    }

    /**
     * @dataProvider splitHttpAcceptHeaderProvider
     * @covers sfWebRequest::splitHttpAcceptHeader
     */
    public function testSplitHttpAcceptHeader($header, $expected)
    {
        self::assertSame($expected, $this->request->splitHttpAcceptHeader($header));
    }

    public function splitHttpAcceptHeaderProvider()
    {
        return [
            [
                "text/javascript, text/html, application/xml, text/xml, */*",
                [
                    ' */*',
                    ' text/xml',
                    ' application/xml',
                    ' text/html',
                    'text/javascript',
                ]
            ],
            [
                "text/javascript, text/html;q=2.9, application/xml, text/xml, */*",
                [
                    'text/html',
                    ' */*',
                    ' text/xml',
                    ' application/xml',
                    'text/javascript',
                ]
            ],
            [
                "text/javascript;q=1.0, text/html;q=2.9, application/xml, text/xml, */*",
                [
                    'text/html',
                    ' */*',
                    ' text/xml',
                    ' application/xml',
                    'text/javascript',
                ]
            ],
            [
                "text/javascript;q=1.0, text/html;q=1.0, application/xml, text/xml, */*",
                [
                    ' */*',
                    ' text/xml',
                    ' application/xml',
                    'text/html',
                    'text/javascript',
                ]
            ]
        ];
    }
}
