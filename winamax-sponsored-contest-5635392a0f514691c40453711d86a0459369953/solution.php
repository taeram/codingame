<?php
$deck1 = null;
fscanf(STDIN, "%d", $numCardsPlayer1);
for ($i = 0; $i < $numCardsPlayer1; $i++) {
    fscanf(STDIN, "%s", $card);
    $deck1[] = $card;
}

$deck2 = null;
fscanf(STDIN, "%d", $numCardsPlayer2);
for ($i = 0; $i < $numCardsPlayer2; $i++) {
    fscanf(STDIN, "%s", $card);
    $deck2[] = $card;
}

$numRounds = 0;
$winner =  null;
$warChest1 = null;
$warChest2 = null;
while (true) {
    $card1 = array_shift($deck1);
    $card2 = array_shift($deck2);
    $battleResult = compareCards($card1, $card2);
    if ($battleResult > 0) {
        // Player 1 wins
        $warChest1[] = $card1;
        $warChest2[] = $card2;

        // To the victor go the spoils
        while($warChest1) {
            $deck1[] = array_shift($warChest1);
        }
        while($warChest2) {
            $deck1[] = array_shift($warChest2);
        }
        $numRounds++;
    } else if ($battleResult < 0) {
        // Player 2 wins
        $warChest1[] = $card1;
        $warChest2[] = $card2;

        // To the victor go the spoils
        while($warChest1) {
            $deck2[] = array_shift($warChest1);
        }
        while($warChest2) {
            $deck2[] = array_shift($warChest2);
        }
        $numRounds++;
    } else if ($battleResult ===  null) {
        // War!
        $warChest1[] = $card1;
        $warChest2[] = $card2;

        // Have either players run out of cards?
        if (count($deck1) < 3 || count($deck2) < 3) {
            $winner = 'PAT';
            break;
        }

        // Add the war piles to the war chests
        for ($i = 0; $i < 3; $i++) {
            $warChest1[] = array_shift($deck1);
            $warChest2[] = array_shift($deck2);
        }
    }

    // Has one of the players run out of cards?
    if (count($deck1) == 0) {
        $winner = 2;
        break;
    } else if (count($deck2) == 0) {
        $winner = 1;
        break;
    }
}

if ($winner == 'PAT') {
    echo "PAT\n";
} else {
    echo "$winner $numRounds\n";
}

/**
 * Compare two cards
 *
 * @param string $card1 The first card
 * @param string $card2 The second card
 *
 * @return mixed 1 if card1 > card2, -1 if card1 < card2, null if cards are equal
 */
function compareCards($card1, $card2) {
    $cards = array(
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13,
    );

    $card1Value = $cards[substr($card1, 0, -1)];
    $card2Value = $cards[substr($card2, 0, -1)];
    if ($card1Value > $card2Value) {
        return 1;
    } else if ($card1Value < $card2Value) {
        return -1;
    }

    return null;
}
