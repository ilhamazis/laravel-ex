<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AttachmentExtensionEnum: string
{
    use EnumToArray;

    case DOC = 'doc';
    case DOCX = 'docx';
    case PDF = 'pdf';

    public static function valuesWithCommaSeparatedFormat(): string
    {
        return implode(',', self::values());
    }

    public static function getIconPath(?AttachmentExtensionEnum $extensionEnum): string
    {
        return match ($extensionEnum) {
            self::DOC => '/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/doc-solid.svg',
            self::DOCX => '/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/docx-solid.svg',
            self::PDF => '/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/pdf-solid.svg',
            default => '/quantum-v2.0.0-202307280002/assets/images/misc-icons/file-document/txt-solid.svg',
        };
    }
}
