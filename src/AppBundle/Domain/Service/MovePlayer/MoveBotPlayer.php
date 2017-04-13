<?php

namespace AppBundle\Domain\Service\MovePlayer;

use AppBundle\Domain\Entity\Game\Game;
use AppBundle\Domain\Entity\Player\BotPlayer;
use AppBundle\Domain\Entity\Player\Player;

/**
 * Class MoveBotPlayer
 *
 * @package AppBundle\Domain\Service\MovePlayer
 */
class MoveBotPlayer extends MovePlayer
{
    /**
     * Reads the next movement of the player: "up", "down", "left" or "right".
     *
     * @param Player $player
     * @param Game $game
     * @return string The next movement
     * @throws MovePlayerException
     */
    protected function readNextMovement(Player $player, Game $game)
    {
        if (!$player instanceof BotPlayer) {
            throw new MovePlayerException('The $player object must be an instance of ' . BotPlayer::class);
        }

        $command = $player->command();
        $data = $this->createRequestData($player, $game);

        $handler = tmpfile();
        fwrite($handler, $data);
        $metaDatas = stream_get_meta_data($handler);
        $filename = $metaDatas['uri'];

        $result = shell_exec($command . ' < ' . $filename);
        fclose($handler);

        if (null === $result) {
            throw new MovePlayerException('An error occurred calling the player BOT.');
        }

        $obj = json_decode($result);
        $direction = $obj->move;

        return $direction;
    }
}
