<?php
require 'vendor/autoload.php';

use SVG\Nodes\Structures\SVGDocumentFragment;
use SVG\SVG;
/**
 * @var $docTree SVGDocumentFragment
 */

const SKELETON_FILE = 'skeleton.svg';

//DOM tree IDs
const TALK = [
    0 => 8,
    1 => 19,
];
const SPEAKER = [
    0 => 20,
    1 => 21
];
const DETAILS = [
    'day' => 5,
    'month' => 6,
    'year' => 15,
    'time' => 22,
    'meetupNumber' => 18,
];

const VENUE_TREE = 7;
const VENUE_ADDRESS = 1;
const VENUE_COMPANY = 0;

$image = SVG::fromFile(SKELETON_FILE);

$data = !isset($argv[1]) ? $_REQUEST : json_decode(file_get_contents($argv[1]), true);

if(empty($data)){
    throw new Exception('No data for generating meetup');
}
$meetup = [
    'details' => [
        'meetupNumber' => $data['details']['meetupNumber'],
        'month' => $data['details']['month'],
        'day' => $data['details']['day'],
        'year' => $data['details']['year'],
        'time' => $data['details']['time'],
    ],
    'venue' => [
        'company' => $data['venue']['company'],
        'address' => $data['venue']['address'],
    ],
    'talks' => [],
];

//Initial tree
$docTree = $image->getDocument()->getChild(1)->getChild(1);

//Adding content
for ($talk = 0; $talk <= 1; $talk++){
    $meetup['talks'][$talk] = [
        'speaker' => $data['talks'][$talk]['speaker'],
        'talkName' => $data['talks'][$talk]['talkName']
    ];
    $docTree->getChild(TALK[$talk])->setValue($meetup['talks'][$talk]['talkName']);
    $docTree->getChild(SPEAKER[$talk])->setValue($meetup['talks'][$talk]['speaker']);
    $docTree->getChild(TALK[$talk])->setAttribute('x', strlen($meetup['talks'][$talk]['speaker']) + 330);
}

foreach (DETAILS as $key => $DETAIL) {
    $docTree->getChild($DETAIL)->setValue($meetup['details'][$key]);
};

/** @noinspection PhpUndefinedMethodInspection */
$docTree->getChild(VENUE_TREE)
    ->getChild(VENUE_COMPANY)->setValue($meetup['venue']['company']);
/** @noinspection PhpUndefinedMethodInspection */
$docTree->getChild(VENUE_TREE)
    ->getChild(VENUE_ADDRESS)
    ->setValue($meetup['venue']['address'])
    ->setAttribute('x', strlen($meetup['venue']['company']) + 120);

header('Content-Type: image/svg+xml');
echo $image;
