<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequencies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="result-container">
        <?php
            $stop_words = array('a', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'for', 'from', 'has', 'he', 'in', 'is', 'it', 'its', 'of', 'on', 'that', 'the', 'to', 'was', 'were', 'will', 'with');
            function tokenize_text($text) {
                $text = strtolower($text);
                $text = preg_replace('/[^a-z\s]/i', '', $text);
                $tokens = explode(" ", $text);
                return $tokens;
            }

            // Function to calculate word frequencies
            function calculate_word_frequencies($tokens) {
                global $stop_words;
                $word_frequencies = array_count_values($tokens);
                foreach ($stop_words as $stop_word) {
                    if (array_key_exists($stop_word, $word_frequencies)) {
                        unset($word_frequencies[$stop_word]);
                    }
                }
                return $word_frequencies;
            }

            // Function to sort word frequencies by first letter
            function sort_word_frequencies($word_frequencies, $order) {
                $sorted_word_frequencies = array();
                foreach ($word_frequencies as $word => $frequency) {
                    $first_letter = substr($word, 0, 1);
                    if (!isset($sorted_word_frequencies[$first_letter])) {
                        $sorted_word_frequencies[$first_letter] = array();
                    }
                    $sorted_word_frequencies[$first_letter][$word] = $frequency;
                }

                if ($order === 'asc') {
                    ksort($sorted_word_frequencies, SORT_STRING);
                } else {
                    krsort($sorted_word_frequencies, SORT_STRING);
                }

                $final_sorted_word_frequencies = array();
                foreach ($sorted_word_frequencies as $words) {
                    asort($words, SORT_STRING);
                    $final_sorted_word_frequencies = array_merge($final_sorted_word_frequencies, $words);
                }

                return $final_sorted_word_frequencies;
            }

            // Function to display word frequencies
            function display_word_frequencies($word_frequencies, $limit) {
                $count = 0;
                echo "<table>";
                echo "<tr><th>Word</th><th>Frequency</th></tr>";
                foreach ($word_frequencies as $word => $frequency) {
                    echo "<tr><td>$word</td><td>$frequency</td></tr>";
                    $count++;
                    if ($count >= $limit) {
                        break;
                    }
                }
                echo "</table>";
            }
            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $text = $_POST["text"];
                $sort = $_POST["sort"];
                $limit = $_POST["limit"];

                $tokens = tokenize_text($text);
                $word_frequencies = calculate_word_frequencies($tokens);
                $sorted_word_frequencies = sort_word_frequencies($word_frequencies, $sort);

                echo "<h2>Word Frequencies</h2>";
                display_word_frequencies($sorted_word_frequencies, $limit);
            }
        ?>
    </div>
</body>
</html>

