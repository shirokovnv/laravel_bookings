<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomDictionary: string
{
    case ALICE_IN_WONDERLAND = 'Alice in Wonderland';
    case CASINO_ROYALE = 'Casino Royale';
    case TIME_TRAVEL = 'Time Travel';

    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return \array_column(self::cases(), 'value');
    }
}
