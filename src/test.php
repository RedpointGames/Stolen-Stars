<?php
require 'include.php';

class Player extends DAO {
  protected $party_id;
  protected $place_id;
  protected $name;
  protected $real_name;
  protected $stats_id;
  protected $inventory_id;
}

class Stats extends DAO {
  protected $role;
  protected $plot_points;
  protected $wounds;
  protected $stun;
  protected $strength;
  protected $agility;
  protected $intelligence;
  protected $willpower;
  protected $alertness;
  protected $past;
  protected $goal;
  protected $bio;
  protected $inventory;
}

// ====== Test Load ======

echo "====== Test Load ======<br/>";

$player = new Player($db);
$player->load(2);

echo $player->getName() . "<br/>";
echo $player->getRealName() . "<br/>";
echo $player->getStatsID() . "<br/>";
echo $player->getInventoryID() . "<br/>";
$player->setName("Test");
echo $player->getName() . "<br/>";

// ====== Test Save ======

echo "====== Test Save ======<br/>";

$player->save();

$player = new Player($db);
$player->load(2);

echo $player->getName() . "<br/>";
$player->setName("Gaheris Tesla");
echo $player->getName() . "<br/>";

$player->save();

// ====== Test Insert ======

echo "====== Test Insert ======<br/>";

$player = new Player($db);
$player->setName("hello");
$player->setRealName("Blah Blah");
$player->setPartyID(100);
$player->setPlaceID(100);
$player->setStatsID(100);
$player->setInventoryID(100);

echo $player->getName() . "<br/>";
echo $player->getRealName() . "<br/>";

$player->save();

// ====== Test Resave ======

echo "====== Test Resave ======<br/>";

$player->setRealName("John");

echo $player->getName() . "<br/>";
echo $player->getRealName() . "<br/>";

$player->save();

// ====== Test Load All ======

echo "====== Test Load All ======<br/>";

$players = new Player($db);
foreach ($players->loadAll() as $player) {
  echo $player->getID() . " -> " . $player->getName() . "<br/>";
}

// ====== Test Implicit Load ======

echo "====== Test Implicit Load ======<br/>";

$player = new Player($db);
$player->load(1);

$stats = $player->getStats();
if ($stats === null) {
  echo "stats is null<br/>";
} else {
  echo "stats ID is ".$stats->getID()."<br/>";
  echo nl2br($stats->getPast());
}
