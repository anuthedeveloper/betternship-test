<?php
function arrangeNumbersAscendingWithoutBuiltIn(array $array): array {
    for ($i = 0; $i < count($array); $i++) {
        for ($j = $i + 1; $j < count($array); $j++) {
            if ($array[$i] > $array[$j]) {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
    return $array;
}
// Example usage
$inputArray = [5, 2, 9, 1, 5, 6];
$outputArray = arrangeNumbersAscendingWithoutBuiltIn($inputArray);  
print_r($outputArray) . PHP_EOL; // Output: [1, 2, 5, 5, 6, 9]

function sortArrayAscendingWithoutBuiltIn(array $array): array {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
}

function removeDuplicates(array $array): array {
    return array_values(array_unique($array));
}

// Example usage
$input = [1, 2, 2, 3, 4, 4, 5];
$output = removeDuplicatesWithoutBuiltIn($input);
print_r($output) . PHP_EOL; // Output: [1, 2, 3, 4, 5]

print "\n\n";

function removeDuplicatesWithoutBuiltIn(array $array): array {
    $result = [];
    foreach ($array as $item) {
        if (!in_array($item, $result)) {
            $result[] = $item;
        }
    }
    return $result;
}

function reverseString(string $str): string {
    return strrev($str);
}
// Example usage
$inputStr = "Hello, World!";
$outputStr = reverseStringWithoutStrrev($inputStr);
echo $outputStr . "\n\n"; // Output: !dlroW ,olleH

function reverseStringWithoutStrrev(string $str): string {
    $reversed = '';
    for ($i= strlen($str) - 1; $i >=0; $i--) { 
        $reversed .= $str[$i];  
    }
    return $reversed;
}

function swapTwoVariables(&$a, &$b): mixed {
    $temp = $a;
    $a = $b;
    $b = $temp;
    return [$a, $b];
}

function swapTwoVariablesWithoutTemp(&$a, &$b): mixed {
    $a = $a + $b;
    $b = $a - $b;
    $a = $a - $b;
    return [$a, $b];
}

// Example usage
$x = 5;
$y = 10;
swapTwoVariablesWithoutTemp($x, $y);
echo "x: $x, y: $y"; // Output: x: 10

function countWordFrequency(string $str): array {
    $words = str_word_count(strtolower($str), 1);
    $frequency = array_count_values($words);
    return $frequency;
}
// Example usage
$inputText = "Hello everyone! Hello, hope you're feeling fine.";
$wordFrequency = countWordFrequency($inputText);
print_r($wordFrequency) . PHP_EOL; // Output: Array ( [hello] => 2 [world] => 1 [everyone] => 1 )   

function countWordFrequencyWithoutBuiltIn(string $str): array {
    $str = strtolower($str);
    $words = preg_split('/\W+/', $str, -1, PREG_SPLIT_NO_EMPTY);
    $frequency = [];
    foreach ($words as $word) {
        if (isset($frequency[$word])) {
            $frequency[$word]++;
        } else {
            $frequency[$word] = 1;
        }
    }
    return $frequency;
}

function findSecondLargestNumber(array $array): ?int {
    $uniqueArray = array_unique($array);
    rsort($uniqueArray);
    return $uniqueArray[1] ?? null;
}
// Example usage
$inputNumbers = [4, 1, 7, 3, 7, 2, 4];
$secondLargest = findSecondLargestNumber($inputNumbers);    
echo $secondLargest . "\n"; // Output: 4
function findSecondLargestNumberWithoutBuiltIn(array $array): ?int {
    $first = $second = PHP_INT_MIN;
    foreach ($array as $number) {
        if ($number > $first) {
            $second = $first;
            $first = $number;
        } elseif ($number > $second && $number != $first) {
            $second = $number;
        }
    }
    return $second === PHP_INT_MIN ? null : $second;
}

function groupArrayOfUsersByRole(array $users): array {
    $grouped = [];
    foreach ($users as $user) {
        $role = $user['role'];
        if (!isset($grouped[$role])) {
            $grouped[$role] = [];
        }
        $grouped[$role][] = $user;
    }
    return $grouped;
}
// Example usage
$users = [
    ['name' => 'Alice', 'role' => 'admin'],
    ['name' => 'Bob', 'role' => 'user'],
];
$groupedUsers = groupArrayOfUsersByRole($users);
print_r($groupedUsers) . PHP_EOL;

function test(&$value) {
    $value += 10;
}

$a = 5;
test($a);       
echo $a . "\n"; // Output: 15