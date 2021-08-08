<?php

namespace Mathielen\CXml\Validation;

use Mathielen\CXml\Validation\Exception\CxmlInvalidException;
use PHPStan\Testing\TestCase;

class MessageValidatorTest extends TestCase
{
    private DtdValidator $sut;

    public function setUp(): void
    {
        $this->sut = new DtdValidator('tests/metadata/cxml/dtd');
    }

    public function testValidateSuccess(): void
    {
        $this->expectNotToPerformAssertions();

        $xml = file_get_contents('tests/metadata/cxml/samples/simple-profile-request.xml');
        $this->sut->validateAgainstDtd($xml);
    }

    public function testValidateMissingRootNode(): void
    {
        $this->expectException(CxmlInvalidException::class);

        $xml = '<some-node></some-node>';
        $this->sut->validateAgainstDtd($xml);
    }

    public function testValidateInvalid(): void
    {
        $this->expectException(CxmlInvalidException::class);

        $xml = '<cXML></cXML>';
        $this->sut->validateAgainstDtd($xml);
    }
}
