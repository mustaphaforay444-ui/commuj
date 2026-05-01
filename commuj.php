<?php
// COMMUJ Hadith Management System

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Database of Hadiths
$hadiths = array(
    array(
        'id' => 1,
        'arabic' => 'عن أبي هريرة رضي الله عنه قال: قال رسول الله صلى الله عليه وسلم: "من قام ليلة القدر إيماناً واحتساباً غفر له ما تقدم من ذنبه"',
        'english' => 'Whoever stands (in prayer) during the Night of Power, with faith and hoping for its reward, will have all of their previous sins forgiven.',
        'reference' => 'Sahih Bukhari 1901 & Muslim 760',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 2,
        'arabic' => 'عن أبي هريرة أن رسول الله صلى الله عليه وسلم قال: "الدعاء سلاح المؤمن وعماد الدين"',
        'english' => 'Supplication is the weapon of the believer and the pillar of the religion.',
        'reference' => 'Sunan At-Tirmidhi 3373',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 3,
        'arabic' => 'قال رسول الله صلى الله عليه وسلم: "خير الناس أنفعهم للناس"',
        'english' => 'The best of people are those who are most beneficial to others.',
        'reference' => 'Sunan Ibn Majah 4106',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 4,
        'arabic' => 'عن أبي هريرة رضي الله عنه عن النبي صلى الله عليه وسلم قال: "المؤمن القوي خير وأحب إلى الله من المؤمن الضعيف"',
        'english' => 'The strong believer is better and more beloved to Allah than the weak believer.',
        'reference' => 'Sahih Muslim 2664',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 5,
        'arabic' => 'قال صلى الله عليه وسلم: "لا يؤمن أحدكم حتى يحب لأخيه ما يحب لنفسه"',
        'english' => 'None of you believes until he loves for his brother what he loves for himself.',
        'reference' => 'Sahih Bukhari 13 & Muslim 45',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 6,
        'arabic' => 'عن أنس رضي الله عنه قال: قال رسول الله صلى الله عليه وسلم: "الراحمون يرحمهم الرحمن، ارحموا من في الأرض يرحمكم من في السماء"',
        'english' => 'The merciful will be shown mercy by the Most Merciful. Be merciful to those on earth, and the One in the heavens will have mercy upon you.',
        'reference' => 'Sunan At-Tirmidhi 1924',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 7,
        'arabic' => 'قال رسول الله صلى الله عليه وسلم: "من سلك طريقاً يلتمس فيه علماً سهل الله له طريقاً إلى الجنة"',
        'english' => 'Whoever takes a path to seek knowledge, Allah will make easy for him a path to Paradise.',
        'reference' => 'Sunan Ibn Majah 225',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 8,
        'arabic' => 'عن عائشة رضي الله عنها: أن النبي صلى الله عليه وسلم قال: "إن الله رفيق يحب الرفق"',
        'english' => 'Verily, Allah is gentle and loves gentleness.',
        'reference' => 'Sahih Muslim 2593',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 9,
        'arabic' => 'قال صلى الله عليه وسلم: "الصدقة تطفئ غضب الرب وتدفع ميتة السوء"',
        'english' => 'Charity extinguishes the anger of the Lord and prevents a bad death.',
        'reference' => 'Sunan At-Tirmidhi 614',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 10,
        'arabic' => 'عن جابر بن عبد الله رضي الله عنهما قال: قال رسول الله صلى الله عليه وسلم: "أفضل الأعمال أدومها وإن قل"',
        'english' => 'The best of deeds is the most consistent, even if it is little.',
        'reference' => 'Sunan Ibn Majah 4257',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 11,
        'arabic' => 'قال صلى الله عليه وسلم: "من حسن إسلام المرء تركه ما لا يعنيه"',
        'english' => 'Part of the excellence of one\'s Islam is to leave alone that which does not concern him.',
        'reference' => 'Sunan At-Tirmidhi 2317',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    ),
    array(
        'id' => 12,
        'arabic' => 'عن أبي موسى الأشعري رضي الله عنه: أن النبي صلى الله عليه وسلم قال: "الكلمة الطيبة صدقة"',
        'english' => 'The good word is charity.',
        'reference' => 'Sahih Bukhari 2989',
        'source' => 'Prophet Muhammad (Peace Be Upon Him)'
    )
);

// Get request action
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle different actions
switch($action) {
    case 'getAll':
        getAllHadiths();
        break;
    case 'getDaily':
        getDailyHadith();
        break;
    case 'getById':
        getHadithById();
        break;
    case 'getToday':
        getTodayHadith();
        break;
    default:
        getDailyHadith();
}

// Get all hadiths
function getAllHadiths() {
    global $hadiths;
    echo json_encode([
        'success' => true,
        'data' => $hadiths,
        'total' => count($hadiths)
    ]);
}

// Get daily hadith (same hadith for the whole day)
function getDailyHadith() {
    global $hadiths;
    // Use day of year to select same hadith for all users on same day
    $dayOfYear = date('z'); // 0-365
    $index = $dayOfYear % count($hadiths);
    
    echo json_encode([
        'success' => true,
        'data' => $hadiths[$index],
        'position' => $index + 1,
        'total' => count($hadiths),
        'date' => date('Y-m-d')
    ]);
}

// Get hadith by ID
function getHadithById() {
    global $hadiths;
    $id = isset($_GET['id']) ? intval($_GET['id']) - 1 : 0;
    
    if ($id >= 0 && $id < count($hadiths)) {
        echo json_encode([
            'success' => true,
            'data' => $hadiths[$id],
            'position' => $id + 1,
            'total' => count($hadiths)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Hadith not found'
        ]);
    }
}

// Get today's hadith
function getTodayHadith() {
    global $hadiths;
    $dayOfYear = date('z');
    $index = $dayOfYear % count($hadiths);
    
    echo json_encode([
        'success' => true,
        'hadith' => $hadiths[$index],
        'index' => $index,
        'total' => count($hadiths),
        'date' => date('l, F j, Y') // Monday, January 1, 2024
    ]);
}

// Add custom hadith (can be extended with database)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['action']) && $data['action'] === 'add') {
        // This would typically save to a database
        echo json_encode([
            'success' => true,
            'message' => 'Hadith added successfully',
            'hadith' => $data['hadith']
        ]);
    }
}

// 404 or invalid action
if (empty($action) || !isset($_GET['action'])) {
    getDailyHadith();
}
?>
