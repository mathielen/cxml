<?php

declare(strict_types=1);

namespace CXml\Model\Request;

use Assert\Assertion;
use CXml\Model\ExtrinsicsTrait;
use CXml\Model\IdReferencesTrait;
use JMS\Serializer\Annotation as Serializer;

#[Serializer\AccessorOrder(order: 'custom', custom: ['idReferences', 'extrinsics'])]
class ConfirmationHeader
{
    use ExtrinsicsTrait;
    use IdReferencesTrait;

    public final const TYPE_ACCEPT = 'accept';

    public final const TYPE_ALLDETAIL = 'allDetail';

    public final const TYPE_DETAIL = 'detail';

    public final const TYPE_BACKORDERED = 'backordered';

    public final const TYPE_EXCEPT = 'except';

    public final const TYPE_REJECT = 'reject';

    public final const TYPE_REQUESTTOPAY = 'requestToPay';

    public final const TYPE_REPLACE = 'replace';

    #[Serializer\XmlAttribute]
    #[Serializer\SerializedName('type')]
    private string $type;

    #[Serializer\XmlAttribute]
    private \DateTimeInterface $noticeDate;

    public function __construct(string $type, \DateTimeInterface $noticeDate = null)
    {
        Assertion::inArray($type, [
            self::TYPE_ACCEPT,
            self::TYPE_ALLDETAIL,
            self::TYPE_DETAIL,
            self::TYPE_BACKORDERED,
            self::TYPE_EXCEPT,
            self::TYPE_REJECT,
            self::TYPE_REQUESTTOPAY,
            self::TYPE_REPLACE,
        ]);

        $this->type = $type;
        $this->noticeDate = $noticeDate ?? new \DateTime();
    }

    public static function create(string $type, \DateTimeInterface $noticeDate = null): self
    {
        return new self(
            $type,
            $noticeDate,
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNoticeDate(): \DateTimeInterface
    {
        return $this->noticeDate;
    }
}
