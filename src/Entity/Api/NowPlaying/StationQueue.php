<?php

declare(strict_types=1);

namespace App\Entity\Api\NowPlaying;

use App\Entity\Api\ResolvableUrlInterface;
use App\Entity\Api\Song;
use OpenApi\Attributes as OA;
use Psr\Http\Message\UriInterface;

#[OA\Schema(
    schema: 'Api_NowPlaying_StationQueue',
    type: 'object'
)]
class StationQueue implements ResolvableUrlInterface
{
    #[OA\Property(
        description: 'UNIX timestamp when the AutoDJ is expected to queue the song for playback.',
        example: 1609480800
    )]
    public int $cued_at = 0;

    #[OA\Property(
        description: 'UNIX timestamp when playback is expected to start.',
        example: 1609480800
    )]
    public int $played_at = 0;

    #[OA\Property(
        description: 'Duration of the song in seconds',
        example: 180
    )]
    public int $duration = 0;

    #[OA\Property(
        description: 'Indicates the playlist that the song was played from, if available, or empty string if not.',
        example: 'Top 100'
    )]
    public ?string $playlist = null;

    #[OA\Property(
        description: 'Indicates whether the song is a listener request.',
    )]
    public bool $is_request = false;

    #[OA\Property]
    public Song $song;

    /**
     * Re-resolve any Uri instances to reflect base URL changes.
     *
     * @param UriInterface $base
     */
    public function resolveUrls(UriInterface $base): void
    {
        if ($this->song instanceof ResolvableUrlInterface) {
            $this->song->resolveUrls($base);
        }
    }
}
